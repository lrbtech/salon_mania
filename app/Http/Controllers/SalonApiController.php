<?php

namespace App\Http\Controllers;
use App\salon;
use App\User;
use App\area;
use App\slider;
use App\customer;
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
use App\push_notification;
use App\salon_salon;
use App\package;
use App\salon_customer;
use App\country;
use App\product;
use App\booking_product;
use Hash;
use Auth;
use DB;
use Validator;
use Mail;
use Carbon\Carbon;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use StdClass;

class SalonApiController extends Controller
{
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

    private function sendOTPNotification($id){
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
        
        $body= "Your OTP is Verified";
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

    private function sendChatNotification($id){
        $chat = salon_customer::find($id);
        $customer = customer::find($chat->customer_id);
        $salon = User::find($chat->salon_id);
        $title;
        if($salon->salon_name != ''){
            $title = $salon->salon_name;
        }
        else{
            $title = $salon->name;
        }
        $body= $chat->text;
  
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

    public function editSalon($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function salonLogin(Request $request){
        $exist = User::where('email',$request->email)->where('status',1)->get();
        if(count($exist)>0){
            // if($exist[0]->status == 1){
                if(Hash::check($request->password,$exist[0]->password)){
                    $salon = User::find($exist[0]->id);
                    $salon1 = User::find($exist[0]->user_id);
                        if($salon1->status == 1){
                        $salon->fcm_token = $request->fcm_token;
                        $salon->save();
                        $user_type;
                        if($salon->role_id == 'admin'){
                            $user_type=1;
                        }
                        else{
                            $user_type=0;
                        }
                        
                        $cover_image = '';
                        if($salon1->cover_image != null){
                            $cover_image = $salon1->cover_image;
                        }
                        $salon_name = '';
                        if($salon1->salon_name != null){
                            $salon_name = $salon1->salon_name;
                        }
                        else{
                            $salon_name = $salon1->name;
                        }
                    return response()->json(['message' => 'Login Successfully',
                    'name'=>$exist[0]->name,
                    'email'=>$exist[0]->email,
                    'user_type'=>$user_type,
                    'cover_image'=>$cover_image,
                    'salon_name'=>$salon_name,
                    'salon_id'=>$exist[0]->id,'status'=>200], 200);
                    }else{
                        return response()->json(['message' => 'Your Account is Blocked','status'=>403], 403);
                    }
                }else{
                    return response()->json(['message' => 'Records Does not Match','status'=>403], 403);
                }
            // }else{
            //     return response()->json(['message' => 'Verify Your Account','status'=>401,'salon_id'=>$exist[0]->id], 401);
            // }
        }else{
            return response()->json(['message' => 'this Email Address Not Registered','status'=>404], 404);
        }
    }

    public function forgetPassword(Request $request){
        try{
            $exist = User::where('email',$request->email)->get();
        //return response()->json(count($exist));
        if(count($exist)>0){
        $salon = User::find($exist[0]->id);
        $randomid = mt_rand(100000,999999);
        $salon->otp = $randomid;
        $salon->save();

        $msg= "Dear salon, Please use the code ".$salon->otp." to Change your password";

        $this->send_sms($salon->phone,$msg,$salon->country_id);

        // Mail::send('mail.forgetpasswordmail',compact('salon'),function($message) use($salon){
        //     $message->to($salon->email)->subject('Change Password Request');
        //     $message->from('mail.lrbinfotech@gmail.com','Salon Mania Reset Password');
        // });

        return response()->json(['message' => 'Successfully Send','_id'=>$salon->id], 200);
            }else{
                return response()->json(['message' => 'this Email Address Not Registered','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'this Email Address Not Registered()','status'=>200], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        if($request->salon_id !=null){
            $salon = User::find($request->salon_id);
            if($salon->otp == $request->otp){
                $salon->password = Hash::make($request->get('password'));
                $salon->save();
                return response()->json(['message' => 'Successfully Reset'], 200);
            }else{
                return response()->json(['message' => 'Verification Code Not Valid','status'=>400], 400);
            }
        }else{
            return response()->json(['message' => 'salon id not found'], 400);
        }
    }

    public function changePassword(Request $request){
        $salon = User::find($request->salon_id);
        $hashedPassword = $salon->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
            if (!\Hash::check($request->password , $hashedPassword)) {
                $salon->password = Hash::make($request->password);
                $salon->save();
                return response()->json(['message' => 'Successfully Update'], 200);
            }
            else{
                return response()->json(['message' => 'new password can not be the old password!','status'=>400], 400);
            }
        }
        else{
            return response()->json(['message' => 'old password doesnt matched','status'=>400], 400);
        }
    }

    public function getApiOtpResend(Request $request)
    {
        if($request->salon_id !=null){
            $salon = User::find($request->salon_id);
            $randomid = mt_rand(1000,9999);
            $salon->otp = $randomid;
            $salon->save();
            $msg= "Dear salon, Please use the code ".$salon->otp." to verify your Salon Mania Account";
            $this->send_sms($salon->phone,$msg,$salon->country_id);
            return response()->json(['message' => 'Otp Send Successfully'], 200);
        }else{
            return response()->json(['message' => 'salon id not found'], 400);
        }
    }

    public function getPushNotification($id){
        $data = push_notification::where('status',1)->where('send_to',1)->get();
        $data1 = push_notification::where('status',1)->where('send_to',3)->get();
        foreach ($data as $key => $value) {
            $data = array(
                'title' => $value->title,
                'description' => '',
            );
            if($value->description != null){
                $data['description'] = $value->description;
            }
            $datas[] = $data;
        }   
        
        foreach ($data1 as $key => $value) {
            $arraydata=array();
            foreach(explode(',',$value->salon_ids) as $salon1){
                $arraydata[]=$salon1;
            }
            if(in_array($id , $arraydata))
            {
                $data = array(
                    'title' => $value->title,
                    'description' => '',
                );
                if($value->description != null){
                    $data['description'] = $value->description;
                }
                $datas[] = $data;
            }
        }   
        return response()->json($datas); 
    }


    public function uodateBookingStatus(Request $request)
    {
        if($request->booking_id !=null){

            $booking = booking::find($request->booking_id);
            $booking->payment_status = 1;
            $booking->save();

            $bookid = 'book'.$booking->id;
            $message =  array(
                'payment_status'=> $booking->payment_status,
                'channel_name'=> $bookid,
            );
            //event(new MyEvent($message));
            event(new ChatEvent($message));

            return response()->json(['message' => 'Booking Paid Successfully'], 200);
        }else{
            return response()->json(['message' => 'booking id not found'], 400);
        }
    }


    public function getBooking($id){
        $user=User::find($id);
        if($user->role_id == 'admin'){
            $booking = booking::where('salon_id',$user->user_id)->orderBy('id','DESC')->get();
        }
        else{
            $booking = booking::where('salon_id',$user->user_id)->where('workers_id',$id)->orderBy('id','DESC')->get();
        }
        
        $data =array();
        foreach ($booking as $key => $value) {
           // $salon = User::where('id',$booking->salon_id)->first();
            $customer = customer::find($value->customer_id);
            // return response()->json($salon); 
            $data = array(
                'booking_id' => $value->id,
                'appointment_date' => $value->appointment_date,
                'appointment_time' => $value->appointment_time,
                'booking_status' => (int)$value->booking_status,
                'payment_status' => (int)$value->payment_status,
                'otp' => $value->otp,
                'subtotal' => $value->subtotal,
                'total' => $value->total,
                'coupon' => '',
                'address_id' => 0,
                'discount' => 0.0,
            );

            if(!empty($customer)){
                $data['customer_name'] = $customer->name;
                $data['customer_phone'] = $customer->phone;
                $data['customer_email'] = $customer->email;
            }

            if($value->address_id !=null){
                $data['address_id'] = (int)$value->address_id;
            }
            
            if($value->coupon !=null){
                $data['coupon'] = $value->coupon;
            }
            if($value->discount !=null){
                $data['discount'] = $value->discount;
            }
            if(!empty($customer)){
            $datas[] = $data;
            }
        }   
        return response()->json($datas); 
    }

    public function getBookingItem($id){
        $booking = booking_item::where('booking_id',$id)->get();
        $data =array();
        foreach ($booking as $key => $value) {
            $service = service::find($value->service_id);
            $data = array(
                'booking_id' => $value->id,
                'service_image' => $service->image,
                'service_name_english' => $service->service_name_english,
                'service_name_arabic' => $service->service_name_arabic,
                'price' => $value->price,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getBookingPackage($id){
        $package = package::where('booking_id',$id)->get();
        $data =array();
        foreach ($package as $key => $value) {
            $data = array(
                'package_id' => $value->package_id,
                'package_name' => $value->package_name,
                'package_price' => $value->price,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getBookingProduct($id){
        $package = booking_product::where('booking_id',$id)->get();
        $data =array();
        if(count($package) >0){
            foreach ($package as $key => $value) {
                $pack = product::find($value->product_id);
                $data = array(
                    'product_id' => $value->product_id,
                    'product_name' => $value->product_name,
                    'product_price' => $value->price,
                    'product_image' => $pack->image,
                );
                $datas[] = $data;
            }   
        }else{
            $datas=array();
        }
        return response()->json($datas); 
    }

    public function getBookingTransaction($id){
        $booking = booking::where('customer_id',$id)->get();
        $data =array();
        $datas=array();
        foreach ($booking as $key => $value) {
            if($value->payment_type == '1' && $value->payment_status == '0'){
            }
            else{
            $dateTime = new Carbon($value->updated_at, new \DateTimeZone('Asia/Dubai'));
            $data = array(
                'booking_id' => $value->id,
                'date' => $dateTime->diffForHumans(),
                'payment_id' => '0',
                'total' => $value->total,
                'payment_type' => (int)$value->payment_type,
                'payment_status' => (int)$value->payment_status,
            );
            if($value->payment_id == 0){
                $data['payment_id'] = '0';
            }
            if($value->payment_id == 1){
                $data['payment_id'] = $value->order_id;
            }
            $datas[] = $data;
            }
        }   
        return response()->json($datas); 
    }


    public function getDashboard($id){    
        $user=User::find($id);
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));

        $sevendays = date('Y-m-d',strtotime("$today -7 day"));
        $thirtydays = date('Y-m-d',strtotime("$today -30 day"));
    
        $total_booking = booking::where('salon_id',$user->user_id)->count();
        $today_booking = booking::where('salon_id',$user->user_id)->where('date', $today)->count();
        $open_booking = booking::where('salon_id',$user->user_id)->where('booking_status', 0)->count();
        
        $today_value = booking::where('salon_id',$user->user_id)->where('date', $today)->get()->sum("total");
        $current_month_value = booking::where('salon_id',$user->user_id)->whereBetween('date', [$cfdate, $cldate])->get()->sum("total");

        $last7days = booking::where('salon_id',$user->user_id)->whereBetween('date', [$sevendays, $today])->get()->sum("total");
        $last30days = booking::where('salon_id',$user->user_id)->whereBetween('date', [$thirtydays, $today])->get()->sum("total");

        $total_services = salon_service::where('salon_id',$user->user_id)->count();    

        $data = array(
            'total_booking' => $total_booking,
            'today_booking' => $today_booking,
            'open_booking' => $open_booking,
            'today_value' => $today_value,
            'last7days' => $last7days,
            'last30days' => $last30days,
            'current_month_value' => $current_month_value,
            'total_services' => $total_services,
        );
    
        return response()->json($data); 
    }


    public function BookingOtpVerified(Request $request)
    {
      if($request->id != ''){
          $booking = booking::find($request->id);
          if($booking->otp == $request->otp){
              $booking->booking_status = 1;
              $booking->save();
              //$this->sendOTPNotification($booking->id);
              return response()->json(['message' => 'Verified Your OTP'
              ,'status'=>200], 200);
          }else{
              return response()->json(['message' => 'Verification Code Not Valid','status'=>400], 400);
          }
      }else{
          return response()->json(['message' => 'Booking id not found','status'=>400], 400);
      }
    }



    public function getChatSalon($id){
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $chat = salon_customer::where('booking_id',$id)->orderBy('id','DESC')->get();
        $data =array();
        foreach ($chat as $key => $value) {
            $dateTime = new Carbon($value->updated_at, new \DateTimeZone('Asia/Dubai'));
            $data = array(
                'salon_id' => $value->salon_id,
                'message' => $value->text,
                'message_from' => $value->message_from,
                'time' => $dateTime->diffForHumans(),
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function saveChatSalon(Request $request){
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $booking = booking::find($request->booking_id);
        $salon_customer = new salon_customer;
        $salon_customer->text = $request->message;
        $salon_customer->customer_id = $booking->customer_id;
        $salon_customer->booking_id = $request->booking_id;
        $salon_customer->salon_id = $booking->salon_id;
        $salon_customer->message_from = 1;
        if( $request->message != ''){
        $salon_customer->save();
        //$this->sendChatNotification($salon_customer->id);
        $dateTime = new Carbon($salon_customer->updated_at, new \DateTimeZone('Asia/Dubai'));
        $message =  array(
           'message'=> $salon_customer->text,
           'message_from'=> '1',
           'date'=> $dateTime->diffForHumans(),
           'channel_name'=> $salon_customer->booking_id,
        );
            //event(new MyEvent($message));
            event(new ChatEvent($message));
        }
        return response()->json(
            ['message' => 'Save Successfully'],
        200);
    }



    public function getSalonService($id){
        $user=User::find($id);
        $salon_service = salon_service::where('salon_id',$user->user_id)->get();
        $data =array();
        foreach ($salon_service as $key => $value) {
            $service = service::find($value->service_id);
            $data = array(
                'service_id' => $value->id,
                'service_image' => '',
                'service_name_english' => '',
                'service_name_arabic' => '',
                'price' => '',
                'duration' => '',
            );
            if($value->price != null){
                $data['price'] = $value->price;
            }
            if($value->duration != null){
                $data['duration'] = $value->duration;
            }
            if($service->image != null){
                $data['service_image'] = $service->image;
            }
            if($service->service_name_arabic != null){
                $data['service_name_arabic'] = $service->service_name_arabic;
            }
            if($service->service_name_english != null){
                $data['service_name_english'] = $service->service_name_english;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function updateSalonService(Request $request){
        try{
            $salon_service = salon_service::find($request->id);
            $salon_service->price = $request->price;
            $salon_service->duration = $request->duration;
            $salon_service->save();

            return response()->json(
            ['message' => 'Update Successfully',
            // 'name'=>$review->name,
            'service_id'=>$salon_service->id],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        }
    }

}
