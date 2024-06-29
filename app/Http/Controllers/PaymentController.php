<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Arr;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
 {
        $validator = Validator::make($request->all(), [
        'card_no' => 'required',
        'ccExpiryMonth' => 'required',
        'ccExpiryYear' => 'required',
        'cvvNumber' => 'required',
        //'amount' => 'required',
        ]);
        $input = $request->all();

        if ($validator->passes()) { 
        // $input = array_except($input,array('_token'));
        $input = Arr::except($input,array('_token'));

        $stripe = new \Stripe\StripeClient("sk_test_51POHsdEFh87V2j8ZsjdxYcbmsJYiXFUKa6M7lXMdcuLOqM198tfIUkKEHnSSlmdTvOFv35ijRQZecJW1cdyNwfx5001tBm3eqk");
       
        try {
        $token = \Stripe\Token::create([
        'card' => [
        'number' => $request->get('card_no'),
        'exp_month' => $request->get('ccExpiryMonth'),
        'exp_year' => $request->get('ccExpiryYear'),
        'cvc' => $request->get('cvvNumber'),
        ],
        ]);
        
        dd($token);

        if (!isset($token['id'])) {
        return redirect()->route('addmoney.paymentstripe');
        }
        $charge = $stripe->charges()->create([
        'card' => $token['id'],
        'currency' => 'USD',
        'amount' => 20.49,
        'description' => 'wallet',
        ]);
        
        if($charge['status'] == 'succeeded') {
        echo "<pre>";
        print_r($charge);exit();
        return redirect()->route('addmoney.paymentstripe');
        } else {
        \Illuminate\Support\Facades\Session::put('error','Money not add in wallet!!');
        return redirect()->route('addmoney.paymentstripe');
        }
        } catch (Exception $e) {
          \Illuminate\Support\Facades\Session::put('error',$e->getMessage());
          dd('ff');
        return redirect()->route('addmoney.paymentstripe');
        } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
          \Illuminate\Support\Facades\Session::put('error',$e->getMessage());
        return redirect()->route('addmoney.paywithstripe');
        } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
          \Illuminate\Support\Facades\Session::put('error',$e->getMessage());
        return redirect()->route('addmoney.paymentstripe');
        }
        }
        }


   
    // public function processPayment(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient("sk_test_51POHsdEFh87V2j8ZsjdxYcbmsJYiXFUKa6M7lXMdcuLOqM198tfIUkKEHnSSlmdTvOFv35ijRQZecJW1cdyNwfx5001tBm3eqk");
 
    //     $product = $stripe->products->create([
    //       'name' => 'Starter Subscription',
    //       'description' => '$12/Month subscription',
    //     ]);
    //     echo "Success! Here is your starter subscription product id: " . $product->id . "\n";
     
    //     $price = $stripe->prices->create([ 
    //       'unit_amount' => 1200,
    //       'currency' => 'usd',
    //       'recurring' => ['interval' => 'month'],
    //       'product' => $product['id'],
    //     ]);
       
    //     echo "Success! Here is your starter subscription price id: " . $price->id . "\n";
    // }
}