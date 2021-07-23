<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\User;
use App\area;
use App\slider;
use App\category;
use App\review;
use App\settings;
use App\service;
use App\salon_service;
use App\manage_address;
use App\service_time;
use App\gallery;
use App\coupon;
use App\booking;
use App\booking_item;
use Hash;
use Auth;
use DB;
use Validator;
use Mail;
use Carbon\Carbon;
use StdClass;

class PaymentController extends Controller
{


public function getAccessToken(){
$apikey="YmZjY2MwZjktMjhjNS00Njk1LWFjN2UtNDJmNWJjYTBhOGExOjY2MWI3OWRjLTRkODgtNDAzYi05MWY0LTM0YTBhZjY3YTE5MA==";     
// enter your API key here
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "accept: application/vnd.ni-identity.v1+json",
    "authorization: Basic ".$apikey,
    "content-type: application/vnd.ni-identity.v1+json",
    "APP_KEY: 8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
  )); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"realmName\":\"ni\"}"); 
$output = json_decode(curl_exec($ch)); 
return $output->access_token;
}



public function createPaymentOrder(Request $request){
  $amount = '100';
  $postData = new StdClass();  
  $postData->action = "SALE"; 
  $postData->merchantAttributes = new StdClass();
  $postData->merchantAttributes->redirectUrl = "http://86.97.176.102:6700/payment-success"; 
  $postData->amount = new StdClass();
  $postData->amount->currencyCode = "AED"; 
  $postData->amount->value = $amount; 

$outlet = "ae35008c-52e8-485a-92c0-c3fa31350e36";
$token=$this->getAccessToken();
 
$json = json_encode($postData);
$ch = curl_init(); 
 
curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/$outlet/orders"); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$token, 
    "Content-Type: application/vnd.ni-payment.v2+json", 
    "Accept: application/vnd.ni-payment.v2+json",
    "APP_KEY: 8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
  )); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
 
$output = json_decode(curl_exec($ch)); 
$order_reference = $output->reference; 
$order_paypage_url = $output->_links->payment->href; 
curl_close ($ch);
return response()->json(
  ['message' => 'Save Successfully',
  'pay_url'=>$order_paypage_url,
  'order_reference'=>$order_reference
],
   200);
//$this->paymentPay($order_paypage_url);
}

public function paymentPay($cardpay_url){
$postData = new StdClass();
$postData->pan = "4111111111111111";
$postData->expiry = "2025-04";
$postData->cvv = "123";
$postData->cardholderName = "John Brown";

$json = json_encode($postData);
$outlet = "ae35008c-52e8-485a-92c0-c3fa31350e36";
$token=$this->getAccessToken();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $cardpay_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer $token", 
"Content-Type: application/vnd.ni-payment.v2+json", 
"Accept: application/vnd.ni-payment.v2+json",
"APP_KEY: 8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

$output = json_decode(curl_exec($ch));

$state = $output->state;
print_r($state);
// if ($state == "AWAIT_3DS") {
//   echo $cnp3ds_url = $output->_links->{'cnp:3ds'}->href;
//   echo $acsurl = $output->{'3ds'}->acsUrl;
//   echo $acspareq = $output->{'3ds'}->acsPaReq;
//   echo $acsmd = $output->{'3ds'}->acsMd;
//   echo $acsterm = "https://[your-post-3ds-script]";                                                    
// }

curl_close ($ch);

}


public function getRetrivePayment(){
  $orderID = "54be22d2-ac65-451e-9581-d027e35ae270";
  $outlet = "ae35008c-52e8-485a-92c0-c3fa31350e36";
  $token=$this->getAccessToken();

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/$outlet/orders/$orderID",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer $token",
    "Accept: application/vnd.ni-payment.v2+json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
  
  }



}
