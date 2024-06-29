<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
    
class PhonePecontroller extends Controller
{
        public function phonePe()
        {
           

            $data = array (
                'merchantId' => 'PGTESTPAYUAT86',
                'merchantTransactionId' => uniqid(),
                'merchantUserId' => 'MUID123',
                'amount' => 10000,
                'redirectUrl' => route('response'),
                'redirectMode' => 'POST',
                'callbackUrl' => route('response'),
                'mobileNumber' => '9999999999',
                'paymentInstrument' => 
                array (
                'type' => 'PAY_PAGE',
                ),
            );
    
            $encode = base64_encode(json_encode($data));
    
            $saltKey = '96434309-7796-489d-8924-ab56988a6076';
            $saltIndex = 1;
    
            $string = $encode.'/pg/v1/pay'.$saltKey;
            $sha256 = hash('sha256',$string);
    
            $finalXHeader = $sha256.'###'.$saltIndex;
    
            $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";
    
            $response = Curl::to($url)
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withData(json_encode(['request' => $encode]))
                    ->post();
    
            $rData = json_decode($response);

            return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        }
    
        public function response(Request $request)
        {
            $input = $request->all();
            $saltKey = '96434309-7796-489d-8924-ab56988a6076';
            $saltIndex = 1;
    
            $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;
    
            $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
                    ->withHeader('Content-Type:application/json')
                    ->withHeader('accept:application/json')
                    ->withHeader('X-VERIFY:'.$finalXHeader)
                    ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
                    ->get();
    
                  $paymentok = json_decode($response);
                  if($paymentok->success == true){
                    return redirect('http://127.0.0.1:8000/student/')->with('message' ,'Payment Successfully..');
                  }
        }

        public function callback(Request $request)
        {
                    dd($request->all());
        }
    }    
