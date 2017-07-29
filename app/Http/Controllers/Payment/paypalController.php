<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\Product\CartRepository;

use PayPal\Rest\ApiContext; 
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use Session;
use Cart;
use URL;

class paypalController extends Controller 
{
    private $_api_context;

    public function __construct() 
    {
	    // setup PayPal api context
	    $paypal_conf = config('paypal');
	    $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'], 
            $paypal_conf['secret'])
        );
	    $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function postIndex(Request $request) 
    {
		$payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $inputs = (object) $request->all();
        $total_price = 0;
        $items = [];

        for ($i = 1; $i <= $request->input('items_number'); $i++) { 
            if($request->input("checked_item_$i") != null){
                $item_name = $request->input("item_name_$i");
                $item_quantity = $request->input("item_quantity_$i");
                $item_price = $request->input("item_price_$i");

                if(empty($item_price) || $item_price == 0){
                    return back()->withErrors(['Empty price.']);
                }  

                $item = new Item();
                $item->setName($item_name)
                     ->setQuantity($item_quantity)
                     ->setPrice($item_price)
                     ->setCurrency($inputs->main_currency);

                $total_price += $item_price * $item_quantity;
                $items[] = $item;
            }
        }

        if(empty($items)){
            return back()->withErrors(['Your choosen is empty.']);
        }

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems($items);

        // price of all items together
        $amount = new Amount();
        $amount->setCurrency($inputs->main_currency)
               ->setTotal($total_price);


        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('This is just a demo transaction.');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('/paypal-payment/done'))
                      ->setCancelUrl(URL::to('/paypal-payment/cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            	->setPayer($payer)
            	->setRedirectUrls($redirect_urls)
            	->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            /*if (config('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, Sorry for inconvenient');
            }*/
            // Don't spit out errors or use "exit" like this in production code
            echo '<pre>';
            print_r(json_decode($ex->getData()));
            exit;
        }

        foreach($payment->getLinks() as $link) 
        {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }



        /* here you could already add a database entry that a person started buying stuff (not finished of course) */
        Session::put('paypal_payment_id', $payment->getId());



        /* detect selected items and approve it */
        $cart_items = json_decode(Cart::getContent()->toJson());
        $selected_ids = explode(',', $inputs->selected_ids);

        foreach ($cart_items as $key => $item) {
            if(in_array($item->id, $selected_ids)){
                $arrts = Cart::get($item->id)->toArray()['attributes'];
                $arrts['approved'] = 1; 

                Cart::update($item->id, [
                    'attributes' => $arrts
                ]);
            }
        }



        if(isset($redirect_url)) {
            // redirect to paypal
            return redirect()->away($redirect_url);
        }

        return back()->withErrors(['There is some error.']);
	}

	public function getDone(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        Session::forget("paypal_payment_id");

        if(empty($request->input("PayerID")) || empty($request->input("token"))){
            return "Paymeant operation failed";
        }

        if($payment_id == null) {
            return "Paymeant operation failed";
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();

        $execution->setPayerId($request->input("PayerID"));
        $request = $payment->execute($execution, $this->_api_context);

        if($request->getState() == "approved"){
            $cart_items = json_decode(Cart::getContent()->toJson());

            foreach ($cart_items as $key => $item) {
                if($item->attributes->approved){

                    $cartRepository = new CartRepository;
                    $cartRepository->createItem($item, 'paypal', 1);

                    // remove added product only
                    Cart::remove($item->id);
                }
            }

            return view("front.$this->frontendNumber.payments.paypal.done");
        } else {
            return "Fail request";
        }
	}

	public function getCancel()
    {
        return view("front.$this->frontendNumber.payments.paypal.cancel");
	}
}
