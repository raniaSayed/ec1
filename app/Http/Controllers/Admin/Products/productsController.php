<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use App\Http\Requests\Product\Create\Step1Request;
use App\Http\Requests\Product\Create\Step2Request;

use App\Logic\Product\ProductRepository;
use App\Logic\Product\InsertConditions;
use App\Logic\Product\Categories;

use App\Models\Product\Product;
use App\Models\Product\Tag;
use App\Models\Product\TagRelationship;
use App\Models\Product\Image;
use App\Models\Product\Carousel;
use App\Models\Product\Comment;
use App\Models\Product\LiveCarousel;
use App\Models\Product\Category1;

use Hashids\Hashids;

use DB;
use File;
use Image as ImageManager;
use Storage;
use Session;
use Response;
use Validator;

class productsController extends Controller {

    public function __construct(){
        $this->middleware('admin_function:create_products', ['only' => ['create', 'store']]);
        $this->middleware('admin_function:edit_products', ['only' => ['edit', 'update']]);
        $this->middleware('admin_function:delete_products', ['only' => 'destroy']);
        $this->middleware('admin_function:product_live_status', ['only' => 'liveStatus']);
    }

    protected function checkPage($paginate_number)
    {
        $paginate_count = ceil(Product::count() / $paginate_number);

        if(isset($_GET['page']) && $_GET['page'] > $paginate_count)
            return abort(404);
    }

    public function index()
    {
        $paginate_number = 5;
        $this->checkPage($paginate_number);

        $products = Product::orderBy('id', 'DESC')->paginate($paginate_number);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeIndexProductContoller($products);

        return view("back.products.view")->with(compact(
            'products', 'SF_price', 'SF_sales'
        ));
    }

    protected function checkForIssetCategories()
    {
        if(Category1::count() <= 0){
            Session::flash('flashMessage', [
                "type" => "warning",
                "content" => trans2('A497', "Excuse me, you must add 1 category at least to can create a ::products.", ["products"=>"products"])
            ]);
            return false;
        } else {
            return true;
        }
    }

    public function generateUniqueSerialNumber()
    {
        $hashids = new Hashids('', 0, '0123456789AEOIUC');
        return $hashids->encode(time());
    }

    public function create($step_id = NULL)
    {
        if(!$this->checkForIssetCategories()) 
            return redirect("/admin/products/categories");

        if(!isset($step_id))
            return redirect(route("admin.products..create")."/step/1");

        switch($step_id){
            case 1:
                Session::forget('products_step1');

                $p_cat1 = Category1::lists('name', 'id');
                $categories_table_number = json_decode(Storage::get("static_setting.json"))->categories_table_number;

                return view('back.products.create.steps.1')->with(compact(
                    "p_cat1", "categories_table_number"
                ));
            break;
            case 2:
                if(!Session::has('products_step1'))
                    return abort(404);

                return view('back.products.create.steps.2');
            break;
            default:
                return abort(404);
        }
    }


    protected function insertStep1($input){
        $product = new Product;
        $product->serial_number = $input->serial_number;
        $product->name = $input->product_name;
        $product->description = $input->product_description;
        $product->price = $input->product_price; // USD (by default)
        $product->discount_percentage = $input->discount_percentage;
        $product->category_table_number = $input->category_table_number;
        $product->category_id = $input->category_id;

        $insertConditions = new InsertConditions;
        $insertConditions->isAmountUnlimited($input, $product);
        $insertConditions->isStartViewNow($input, $product);
        $insertConditions->expiresCondition($input, $product);

        $product->save();

        return $product;
    }

    protected function insertTags($input){
        $products_tags = explode(',', $input->product_tags);

        foreach ($products_tags as $tag) {
            $isSavedTag = DB::table('products_tags_relationship')->insert([
                'product_id' => $input->product_id,
                'tag_id' => $tag
            ]);

            if(!$isSavedTag)
                return back()->withErrors(['Some error in save tags.']);
        }
    }
    

    public function store($step_id, Request $request)
    {
        if(!$this->checkForIssetCategories()) 
            return redirect("/admin/products/categories");

        switch($step_id){
            case 1:
                $input = (object) $request->all();
                $input->product_price = str_replace(",", "", $input->product_price);

                $request1 = new Step1Request;
                $validator = Validator::make((array) $input, $request1->rules(), $request1->messages());

                if ($validator->fails())
                    return back()->withErrors($validator)->withInput();

                $product = $this->insertStep1($input);

                $request->session()->set('products_step1', [
                    'product_id' => $product->id
                ]);

                return redirect(route('admin.products..create').'/step/2');
            break;
            case 2:
                $input = (object) $request->all();

                $request2 = new Step2Request;
                $validator = Validator::make((array) $input, $request2->rules(), $request2->messages());

                if ($validator->fails())
                    return back()->withErrors($validator);

                $product = Product::find($input->product_id);

                $product->is_new = $input->is_new;

                // to set counterdown for 'new_status' expires
                if($product->is_new == 1) {
                    $product->new_status_time = time();
                }

                $product->is_live = $input->is_live;

                $product->is_payment_on_delivery = $input->is_payment_on_delivery;
                $product->is_payment_by_paypal = $input->is_payment_by_paypal;

                $product->primary_image_id = isset($input->primary_image_id) ? $input->primary_image_id : null;
                $product->primary_carousel_id = isset($input->primary_carousel_id) ? $input->primary_carousel_id : null;

                /*if($input->is_payment_by_paypal == 0 && $input->is_payment_on_delivery == 0){
                    return back()->withErrors(["Please choose 1 payment method at least."]);
                }*/

                $this->insertTags($input);

                $product->timestamps = false;
                $product->save();

                if($input->is_carousel_live) {
                    $liveCarousel = new LiveCarousel;
                    $liveCarousel->product_id = $input->product_id;
                    $liveCarousel->save();
                }

                $request->session()->forget('products_step1');
                $request->session()->flash('flashMessage', [
                    "type" => "success",
                    "content" => trans2('A498', "::product was created successfully.", ["product"=>"product"])
                ]);

                if($input->create_again){
                    return redirect(route('admin.products..create').'/step/1');
                } else {
                    return redirect('/admin/products');
                }
            break;
            default:
                return abort(404);
        }
    }

    public function show($id)
    {
    	$product = Product::find($id);

        if($product == null) abort(404);

        $productRepository = new ProductRepository;
        $product = $productRepository->optimizeShowProduct($product);

        $products_tags = $product->tags()->select("products_tags.tag_name")->lists('tag_name');

        return view("back.products.show")->with(compact(
            'product', 'products_tags'
        ));
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $productRepository = new ProductRepository;
        $product = $productRepository->optimizeShowProduct($product);

        $product_categories_list = Product::categories_list($product->category_table_number, $product->category_id);

        $productCats = new Categories;
        $product_trueCats = $productCats->getCategories();

        $products_tags = $product->tags()->select("products_tags.id", "products_tags.tag_name")->lists('tag_name', 'id');

        return view("back.products.edit")->with(compact(
            'product', 'product_trueCats', 'product_categories_list',
            'products_tags'
        ));
    }

    protected function updateTags($input){
        $tags_ids = explode(',', $input->product_tags_ids);

        if(strlen($input->product_tags_ids) > 0) {
            foreach ($tags_ids as $tag) {
                $isFounded = TagRelationship::where([
                    'product_id' => $input->product_id,
                    'tag_id' => $tag
                ])->count();

                if(!$isFounded) {
                    $isSavedTag = DB::table('products_tags_relationship')->insert([
                        'product_id' => $input->product_id,
                        'tag_id' => $tag
                    ]);

                    if(!$isSavedTag)
                        return back()->withErrors(['Some error in save tags.']);
                }
            }

            TagRelationship::whereNotIn('tag_id', $tags_ids)->delete();
        } else {
            $product = Product::find($input->product_id);
            $tags_ids = $product->tags()->select("products_tags.id")->lists('id');

            if($tags_ids->count() > 0){
                Tag::destroy($tags_ids);
                TagRelationship::whereIn('tag_id', $tags_ids)->delete();
            }   
        }
    } 

    public function update(Request $request, $id)
    {
        $input = (object) $request->all();
        $input->product_id = $id; // to use it in insertTags protected fn
        $input->product_price = str_replace(",", "", $input->product_price);

        $request1 = new Step1Request;
        $validator = Validator::make((array) $input, $request1->rules(), $request1->messages());

        if ($validator->fails())
            return back()->withErrors($validator);

        $product = Product::find($id);
        $product->serial_number = $input->serial_number;
        $product->name = $input->product_name;
        $product->description = $input->product_description;
        $product->price = $input->product_price;
        $product->discount_percentage = $input->discount_percentage;
        $product->category_table_number = $input->category_table_number;
        $product->category_id = $input->category_id;
        $product->is_payment_on_delivery = $input->is_payment_on_delivery;
        $product->is_payment_by_paypal = $input->is_payment_by_paypal;

        $insertConditions = new InsertConditions;
        $insertConditions->isAmountUnlimited($input, $product);
        $insertConditions->isStartViewNow($input, $product);
        $insertConditions->expiresCondition($input, $product);

        /*if($input->is_payment_by_paypal == 0 && $input->is_payment_on_delivery == 0){
            return back()->withErrors(["Please choose 1 payment method at least."]);
        }*/

        $this->updateTags($input);

        $product->save();

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "product was updated successfully."
        ]);

        return redirect("/admin/products/$id");
    }

    public function destroy($id)
    {
        $carousel_list = Carousel::where("parent_id", $id)->lists('carousel_name');
        $images_list = Image::where("parent_id", $id)->lists('image_name');

    	Product::destroy($id);
        Carousel::where("parent_id", $id)->delete();
        Image::where("parent_id", $id)->delete();
        LiveCarousel::where('product_id', $id)->delete();

        foreach ($carousel_list as $name) {
            File::delete("uploaded/products/carousel_gallery/$name");
        }

        foreach ($images_list as $name) {
            File::delete("uploaded/products/images/full_size/$name");
            File::delete("uploaded/products/images/icon_size/$name");
        }

    	return back();
    }

    public function liveStatus(Request $request){
        $input = (object) $request->all();

        $product = Product::find($input->product_id);

        if($input->status == 1){
            $product->is_live = 0;
            $status = 0;
        } else {
            $product->is_live = 1;
            $status = 1;
        }

        $product->save();
        return json_encode($status);
    }

    public function isNewStatus(Request $request){
        $input = (object) $request->all();

        $product = Product::find($input->product_id);

        if($input->status == 1){
            $product->is_new = 0;
            $status = 0;
        } else {
            $product->is_new = 1;
            $product->new_status_time = time(); // reset time controller
            $status = 1;
        }

        $product->save();

        return json_encode($status);
    }
}
