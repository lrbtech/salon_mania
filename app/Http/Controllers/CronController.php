<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\settlement_period;
use App\admin;
use App\settings;
use App\User;
use App\customer;
use App\role;
use App\booking;
use App\booking_item;
use App\booking_package;
use App\payments_in;
use App\payments_out;
use App\area;
use App\slider;
use App\category;
use App\review;
use App\service;
use App\salon_service;
use App\manage_address;
use App\service_time;
use App\gallery;
use App\coupon;
use App\push_notification;
use App\salon_customer;
use App\package;
use App\country;
use App\app_beauty;
use App\app_home;
use App\app_makeup;
use App\app_salon;
use App\app_spa;
use App\used_package;

use Hash;
use session;
use Auth;
use DB;
use PDF;
use Validator;
use Mail;
use Carbon\Carbon;
use App\Events\ChatEvent;
use StdClass;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Image;
use Storage;
use Str;

class CronController extends Controller
{

    public function expiredSalon(){
        $today = date('Y-m-d');
        $user_package = User::where('package_status',0)->get();
        if(count($user_package) > 0){
            foreach($user_package as $row){
                $package = used_package::find($row->package_id);
                if( strtotime($today) > strtotime($package->expire_date) ){
                    $user = User::find($row->id);
                    $user->package_status = 1;
                    $user->save();
                }
            }
        }
        //return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function cashReport(){
        $booking =DB::table('bookings')
        ->where('payment_type',0)
        ->where('payment_status',1)
        ->where('status',0)
        ->select('salon_id' , DB::raw('SUM(total) as total_amount'))
        ->groupBy('salon_id')
        ->get();

        $settlement_period = settlement_period::find(1);
        foreach($booking as $row){
            $user = User::find($row->salon_id);
            
            $user->admin_pay = $user->admin_pay + $row->total_amount;
            $user->admin_balance = ($user->admin_pay + $row->total_amount) - $user->admin_paid;
            $user->save();

            $commission_amount = ($user->salon_commission / 100) * $row->total_amount;

            $payments_out = new payments_out;
            $payments_out->date = date('Y-m-d');
            $payments_out->salon_id = $row->salon_id;
            $payments_out->payment = $row->total_amount;
            $payments_out->commission_percentage = $user->salon_commission;
            $payments_out->commission_amount = $commission_amount;
            $payments_out->save();
        }

        $booking_status = DB::table('bookings')
        ->where('payment_type',0)
        ->where('payment_status',1)
        ->where('status',0)
        ->get();
        foreach($booking_status as $status){
            $booking_id = booking::find($status->id);
            $booking_id->status = 1;
            $booking_id->save() ;
        }
    }

    public function cardReport(){
        $booking =DB::table('bookings')
        ->where('payment_type',1)
        ->where('payment_status',1)
        ->where('status',0)
        ->select('salon_id' , DB::raw('SUM(total) as total_amount'))
        ->groupBy('salon_id')
        ->get();
        $settlement_period = settlement_period::find(1);
        foreach($booking as $row){
            $user = User::find($row->salon_id);
        
            $user->salon_pay = $user->salon_pay + $row->total_amount;
            $user->salon_balance = ($user->salon_pay + $row->total_amount) - $user->salon_paid;
            $user->save();

            $commission_amount = ($user->salon_commission / 100) * $row->total_amount;

            $payments_in = new payments_in;
            $payments_in->date = date('Y-m-d');
            $payments_in->salon_id = $row->salon_id;
            $payments_in->payment = $row->total_amount;
            $payments_in->commission_percentage = $user->salon_commission;
            $payments_in->commission_amount = $commission_amount;
            $payments_in->save();
        }

        $booking_status = DB::table('bookings')
        ->where('payment_type',1)
        ->where('payment_status',1)
        ->where('status',0)
        ->get();
        foreach($booking_status as $status){
            $booking_id = booking::find($status->id);
            $booking_id->status = 1;
            $booking_id->save() ;
        }
    }


    private function send_sms($phone,$msg,$country_id)
    {
      $country = country::find($country_id);
      $requestParams = array(
        //'Unicode' => '0',
        //'route_id' => '2',
        'datetime' => '2020-09-27',
        'username' => 'isalonuae',
        'password' => 'Ms5sbqBxif',
        'senderid' => 'ISalon UAE',
        'type' => 'text',
        'to' => '+'.$country->country_code.$phone,
        'text' => $msg
      );
      
      //merge API url and parameters
      $apiUrl = 'https://smartsmsgateway.com/api/api_http.php?';
      foreach($requestParams as $key => $val){
          $apiUrl .= $key.'='.urlencode($val).'&';
      }
      $apiUrl = rtrim($apiUrl, "&");
    
      //API call
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
      curl_exec($ch);
      curl_close($ch);
    }


    private function getAccessToken(){        
        $apikey="YmE2MjU0YmQtMjZhMi00MjE3LWIxODMtN2IwODI5NGZlN2MyOjZkZjVjNDNiLTQ2NjktNDE5YS1iYTc0LTAyYjI1MzcyNTQ0Zg==";     
        // enter your API key here
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token"); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "accept: application/vnd.ni-identity.v1+json",
            "authorization: Basic ".$apikey,
            "content-type: application/vnd.ni-identity.v1+json",
            "APP_KEY:8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
          )); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"realmName\":\"ni\"}"); 
        $output = json_decode(curl_exec($ch)); 
        return $output->access_token;
    }

    private function sendBookNotification($id){
        $booking = booking::find($id);
        $customer = customer::find($booking->customer_id);
        $salon = User::find($booking->salon_id);
        $title;
        if($salon->salon_name != ''){
            $title = $salon->salon_name;
        }
        else{
            $title = $salon->name;
        }
        
        $body= "Booking Successfull and your Booking ID #".$booking->id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }
        

    public function checkPaymentStatus(){
        $booking1 = DB::table('bookings')
        ->where('payment_type',1)
        ->where('payment_status',0)
        ->get();

    foreach($booking1 as $book){
        $booking = booking::find($book->id);
        $orderID = $booking->order_id;
        $outlet = "e437f4ad-8d6c-4621-bd89-c91672b4c88a";
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
          "Accept: application/vnd.ni-payment.v2+json",
          "APP_KEY:8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
        ],
      ]);
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
       $output = json_decode(curl_exec($curl)); 
       $payment_referrance_id = $output->_embedded->payment[0]->_id;
       $status = $output->_embedded->payment[0]->{'3ds'}->status; 
       
       $payment_id = str_replace('urn:payment:','',$payment_referrance_id);;
       
       $booking->payment_id = $payment_id;
       if($status == "SUCCESS"){
        $booking->payment_status = 1;
        $this->sendBookNotification($booking->id);

        $salon = User::find($booking->salon_id);
        $customer=customer::find($booking->customer_id);        
        $msg= "Dear Customer, Please use the code ".$booking->otp." to Approve your ".$salon->salon_name;
        $this->send_sms($customer->phone,$msg,$customer->country_id);
        $service_amount = (6 / 100) * ($booking->total);
        $salon->salon_pay = $salon->salon_pay + $service_amount;
        $salon->save();
       }
       else{
        $booking->payment_status = 0;
       }
       $booking->save();

      curl_close($curl);
      
    //   if ($err) {
    //     echo "cURL Error #:" . $err;
    //   } else {
    //     //echo $response;
    //     //return $status;
    //     return response()->json(['message' => 'Save Successfully'], 200);
    //   }
        
        }

    }


}
