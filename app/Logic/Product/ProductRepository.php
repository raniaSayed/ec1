<?php

namespace App\Logic\Product;

use App\Models\Product\Product;
use App\Models\Product\Image;
use App\Models\Product\Carousel;
use App\Models\Product\LiveCarousel;

use Storage;

class ProductRepository
{
    public function amountFormat($product){
        if($product->is_amount_unlimited){              
            $product->amount = trans2("A64", "unlimited");
        }
    }

    public function setDiscountedPriceFormat($product){
        $product->discountPrice = $product->price - ($product->price * ($product->discount_percentage / 100));
        $product->discountPrice = round($product->discountPrice, 2);
    }

    public function setCategoryViewFormat($product){
        $categories_list = Product::categories_list($product->category_table_number, $product->category_id);
        $product->categories_list = "<span>" . implode('</span> -> <span>', $categories_list) . "</span>";
    }


    public function setImageFormat($product){
        $order = $product->primary_image_id;

        if($order != null) {
            $image_list = Image::where('parent_id', $product->id)->lists('image_name', 'id');

            if(count($image_list) >= 1) {
                // to check if order founded call it or get default image name (first name)
                $product->image_name = isset($image_list[$order]) ? $image_list[$order] : current($image_list->toArray());
                $product->$product = $product->image_name;
            } else {
                $product->$product = null;
            }
            
        } else {
            $product->$product = null;
        }
    }

    public function setCarouselFormat($product){
        $order = $product->primary_carousel_id;
        
        if($order != null) {
            $carousel_list = Carousel::where('parent_id', $product->id)->lists('carousel_name', 'id');

            if(count($carousel_list) >= 1){
                $product->carousel_name = isset($carousel_list[$order]) ? $carousel_list[$order] : current($carousel_list->toArray());
                $product->$product = $product->carousel_name;
            } else {
                $product->$product = null;
            }
        } else {
            $product->$product = null;
        }
    }


    public function setImagesFormat($product){
        $product->images = Image::where('parent_id', $product->id)->lists('image_name', 'id');
        $product->$product = $product->images;
    }

    public function setCarouselsFormat($product){
        $product->carousels = Carousel::where('parent_id', $product->id)->lists('carousel_name', 'id');
        $product->$product = $product->carousels;
    }


    public function setLiveCarouselFormat($product){
        $product->carousel_status = LiveCarousel::where("product_id", $product->id)->count();
        $product->$product = $product->carousel_status;
    }

    public function startAtFormat($product){
        $product->start_at = date("g:i a - d M y", $product->start_at);
    }

    public function expiresAtFormat($product){
        if($product->is_forever) {
            $product->expires_at = trans2('A65', 'forever');
        } else {
            $product->expires_at = date("g:i a - d M y", $product->expires_at);
        }
    }

    public function paymentsFormat($product){
        if($product->is_payment_on_delivery){
            $product->payment_on_delivery = trans2('A66', 'active');
        } else {
            $product->payment_on_delivery = trans2('A67', 'disactive');
        }

        if($product->is_payment_by_paypal){
            $product->payment_by_paypal = trans2('A68', 'active');
        } else {
            $product->payment_by_paypal = trans2('A69', 'disactive');
        }
    }


    protected function timeOff($timeFormat){
        $timeFormat = explode(' ', $timeFormat);
        $time_value = $timeFormat[0];
        $time_detector = $timeFormat[1];

        switch($time_detector){
            case 'second': case 'seconds':
                $current_time = $time_value;
            break;
            case 'minute': case 'minutes':
                $current_time = $time_value * 60;
            break;
            case 'hour': case 'hours':
                $current_time = $time_value * 60 * 60;
            break;
            case 'day': case 'days':
                $current_time = $time_value * 60 * 60 * 24;
            break;
            case 'week': case 'weeks':
                $current_time = $time_value * 60 * 60 * 24 * 7;
            break;
            case 'month': case 'months':
                $current_time = $time_value * 60 * 60 * 24 * 7 * 4;
            break;
            default:
                return false;
        }

        return $current_time;
    }

    protected function newStatusTimeOff(){
        $site_setting = json_decode(Storage::get("setting.json"));
        $caller = trans('admin_setting.timeOff')[$site_setting->newStatusTimeOff];
        $newStatusTimeOff = $this->timeOff($caller);

        return $newStatusTimeOff; // integer
    }

    public function newStatusControl($product, $integerTimeOff){
        if($product->is_new) {
            if($product->new_status_time + $integerTimeOff < time()){
                $product->is_new = 0;
            }
        }
    }


	public function optimizeIndexProductContoller($products){
        $integerTimeOff = $this->newStatusTimeOff();

		foreach ($products as $product) {
            $this->newStatusControl($product, $integerTimeOff);

            $this->amountFormat($product);
            $this->startAtFormat($product);
            $this->expiresAtFormat($product);
            $this->setDiscountedPriceFormat($product);
            $this->setImageFormat($product);
            $this->setLiveCarouselFormat($product);
        }
        return $products;
	}

    public function optimizeShowProduct($product){
        $integerTimeOff = $this->newStatusTimeOff();
        $this->newStatusControl($product, $integerTimeOff);

        $this->amountFormat($product);
        $this->setCategoryViewFormat($product);
        $this->setDiscountedPriceFormat($product);
        $this->paymentsFormat($product);
        $this->setImagesFormat($product);
        $this->setCarouselsFormat($product);
        $this->setLiveCarouselFormat($product);
        
        return $product;
    }

    public function optimizeEditProduct($product){
        $this->setDiscountedPriceFormat($product);
        $this->setImagesFormat($product);
        $this->setCarouselsFormat($product);
        
        return $product;
    }

    public function optimizeCarouselController($products){
        $integerTimeOff = $this->newStatusTimeOff();
        foreach ($products as $product) {
            $this->newStatusControl($product, $integerTimeOff);
            
            $this->amountFormat($product);
            $this->setImageFormat($product);
            $this->setCarouselFormat($product);
            $this->setLiveCarouselFormat($product);
        }
        return $products;
    }
}