<?php

namespace App\Http\Controllers;
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
use App\booking_package;
use App\push_notification;
use App\salon_customer;
use App\package;
use App\country;
use App\app_beauty;
use App\app_home;
use App\app_makeup;
use App\app_salon;
use App\app_spa;
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
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Image;
use Storage;
use Str;


class ApiController extends Controller
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

    public function getApiOtpCheck()
    {
        $phone =567100733;
        $msg= "Dear Customer, Your Salon Appointment Successfully Booked Order ID : ISL003 
        Your Verification OTP : 4562";
        $this->send_sms($phone,$msg);
        return response()->json(['message' => 'Otp Send Successfully'], 200);
    }

    public function payment_gatway(){

        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => [
            "accept: application/vnd.ni-identity.v1+json",
            "content-type: application/vnd.ni-identity.v1+json"
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

    public function createCustomer(Request $request){
        try{
            $exist = customer::where('email',$request->email)->get();
            if(count($exist)>0){
                 return response()->json(['message' => 'This Email Address Has been Already Registered','status'=>403], 403);
            }
            $phone_exist = customer::where('phone',$request->phone)->get();
            if(count($phone_exist)>0){
                return response()->json(['message' => 'This Phone Number Has been Already Registered','status'=>403], 403);
           }
        $randomid = mt_rand(1000,9999); 

        $config = [
            'table' => 'customers',
            'field' => 'c_id',
            'length' => 10,
            'prefix' => 'IS-'
        ];
        $c_id = IdGenerator::generate($config);
        
        $customer = new customer;
        $customer->c_id = $c_id;
        $customer->date = date('Y-m-d');
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->dob = date('Y-m-d',strtotime($request->dob));
        $customer->city = $request->city;
        $customer->country_id = $request->country_id;
        $customer->firebase_key = $request->firebase_key;
        if($request->gender == 'male'){
            $customer->gender = 0;
        }else{
            $customer->gender = 1;
        }
        $customer->otp = $randomid;
        $customer->password = Hash::make($request->password);
        $customer->save();

        $msg= "Dear Customer, Please use the code ".$customer->otp." to verify your Salon Mania Account";

        $this->send_sms($customer->phone,$msg,$customer->country_id);
        return response()->json(
            ['message' => 'Register Successfully',
            // 'name'=>$customer->name,
            // 'email'=>$customer->email,
            // 'phone'=>$customer->phone,
            'country_id'=>(int)$request->country_id,
            'customer_id'=>$customer->id],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function profileUpdate(Request $request){
        try{
            $exist = customer::where('email',$request->email)->where('id','!=',$request->customer_id)->get();
            if(count($exist)>0){
                 return response()->json(['message' => 'This Email Address Has been Already Registered','status'=>403], 403);
            }
            $phone_exist = customer::where('phone',$request->phone)->where('id','!=',$request->customer_id)->get();
            if(count($phone_exist)>0){
                return response()->json(['message' => 'This Phone Number Has been Already Registered','status'=>403], 403);
            }
        $randomid = mt_rand(1000,9999); 
        $phone_status = 0;
        $customer = customer::find($request->customer_id);
        if(isset($request->name)){
            $customer->name = $request->name;
        }

        if(isset($request->email)){
            $customer->email = $request->email;
        }

        if(isset($request->dob)){
            $customer->dob = date('Y-m-d',strtotime($request->dob));
        }

        if(isset($request->gender)){
            if($request->gender =='male'){
                $customer->gender =0;
            }else{
                $customer->gender = 1;
            }
        }

        // if(isset($request->image)){
        //     if($request->file('image')!=""){
        //         $old_image = "upload_files/".$customer->image;
        //         if (file_exists($old_image)) {
        //             @unlink($old_image);
        //         }
        //         // $image_64 = $request->image; //your base64 encoded data
        //         // $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        //         // $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        //         // // find substring fro replace here eg: data:image/png;base64,
        //         // $image = str_replace($replace, '', $image_64); 
        //         // $image = str_replace(' ', '+', $image); 
        //         // $imageName = Str::random(10).'.'.$extension;
        //         // file_put_contents(public_path().'/upload_files/'.$imageName, base64_decode($image));            
        //         // $customer->image =  $imageName;
        //         $image = $request->image;
        //         $image_name = $request->image_name;
        //         $filename1='';
        //         foreach(explode('.', $image_name) as $info){
        //             $filename1 = $info;
        //         }
        //         $fileName = rand() . '.' . $filename1;
        //         $realImage = base64_decode($image);
        //         file_put_contents(public_path().'/upload_files/'.$fileName, $realImage);    
        //         $customer->image =  $fileName;
        //    }
        // }

        if(isset($request->country_id)){
            $customer->country_id = $request->country_id;
        }
        if($request->phone != $customer->phone){
            $customer->phone = $request->phone;
            $customer->otp = $randomid;
            $customer->status = 0;
            $msg= "Dear Customer, Please use the code ".$customer->otp." to verify your Salon Mania Account";

            $country_id = $customer->country_id;
            if($request->country_id != $customer->country_id){
                $country_id = $request->country_id;
            }
            $this->send_sms($customer->phone,$msg,$country_id);
            $phone_status = 1;
        }

        $customer->save();

        $city='';
        if($customer->city != ''){
            $city = $customer->city;
        }
        // $image='';
        // if($customer->image != ''){
        //     $image = $customer->image;
        // }
        return response()->json(
            ['message' => 'Update Successfully',
            'name'=>$customer->name,
            'email'=>$customer->email,
            'phone'=>$customer->phone,
            'dob'=>date('d-m-Y', strtotime($customer->dob)),
            'gender'=>$customer->gender,
            'country_id'=>(int)$customer->country_id,
            'city'=>$city,
            //'image'=>$image,
            'phone_status'=>$phone_status,
            'customer_id'=>$customer->id],
        200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }



    public function profileImageUpdate(Request $request){
        try{
        $customer = customer::find($request->customer_id);
        if(isset($request->image)){
            if($request->image!=""){
                $old_image = "upload_files/".$customer->image;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            
                $image = $request->image;
                $image_name = $request->image_name;
                $filename1='';
                foreach(explode('.', $image_name) as $info){
                    $filename1 = $info;
                }
                $fileName = rand() . '.' . $filename1;

                $realImage = base64_decode($image);
                file_put_contents(public_path().'/upload_files/'.$fileName, $realImage);    
            $customer->image =  $fileName;

          }
        }

        $customer->save();

        return response()->json(
            ['message' => 'Update Successfully',
            'image'=>$customer->image,
            'customer_id'=>$customer->id],
        200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }


    public function editCustomer($id){
        $customer = customer::find($id);
        return response()->json($customer);
    }

    public function customerLogin(Request $request){
        $exist = customer::where('email',$request->email)->get();
        if(count($exist)>0){
            if($exist[0]->status == 1){
                if(Hash::check($request->password,$exist[0]->password)){
                    $customer = customer::find($exist[0]->id);
                    $customer->firebase_key = $request->firebase_key;
                    $customer->save();

                    $city='';
                    if($customer->city != ''){
                        $city = $customer->city;
                    }
                    $image='';
                    if($customer->image != ''){
                        $image = $customer->image;
                    }
                return response()->json(['message' => 'Login Successfully',
                'name'=>$exist[0]->name,
                'email'=>$exist[0]->email,
                'phone'=>$exist[0]->phone,
                'dob'=>date('d-m-Y', strtotime($exist[0]->dob)),
                'gender'=>$exist[0]->gender,
                'country_id'=>(int)$exist[0]->country_id,
                'city'=>$city,
                'image'=>$image,
                'customer_id'=>$exist[0]->id,'status'=>200], 200);
                }else{
                    return response()->json(['message' => 'Records Does not Match','status'=>403], 403);
                }
            }else{
                return response()->json(['message' => 'Verify Your Account','status'=>401,'customer_id'=>$exist[0]->id], 401);
            }
        }else{
            return response()->json(['message' => 'this Email Address Not Registered','status'=>404], 404);
        }
    }

    public function forgetPassword(Request $request){
        try{
            $exist = customer::where('email',$request->email)->get();
        //return response()->json(count($exist));
        if(count($exist)>0){
        $customer = customer::find($exist[0]->id);
        $randomid = mt_rand(100000,999999);
        $customer->otp = $randomid;
        $customer->save();

        $msg= "Dear Customer, Please use the code ".$customer->otp." to Change your password";

        $this->send_sms($customer->phone,$msg,$customer->country_id);

        // Mail::send('mail.forgetpasswordmail',compact('customer'),function($message) use($customer){
        //     $message->to($customer->email)->subject('Change Password Request');
        //     $message->from('mail.lrbinfotech@gmail.com','Salon Mania Reset Password');
        // });
        

        return response()->json(['message' => 'Successfully Send','_id'=>$customer->id], 200);
            }else{
                return response()->json(['message' => 'this Email Address Not Registered','status'=>403], 403);
            }
        
        }catch (\Exception $e) {
            return response()->json($e);
            return response()->json(['message' => 'this Email Address Not Registered','status'=>200], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        if($request->customer_id !=null){
            $customer = customer::find($request->customer_id);
            if($customer->otp == $request->otp){
                $customer->password = Hash::make($request->get('password'));
                $customer->save();
                return response()->json(['message' => 'Successfully Reset'], 200);
            }else{
                return response()->json(['message' => 'Verification Code Not Valid','status'=>400], 400);
            }
        }else{
            return response()->json(['message' => 'Customer id not found'], 400);
        }
    }

    public function changePassword(Request $request){
        $customer = customer::find($request->customer_id);
        $hashedPassword = $customer->password;
 
        if (\Hash::check($request->oldpassword , $hashedPassword )) {
            if (!\Hash::check($request->password , $hashedPassword)) {
                $customer->password = Hash::make($request->password);
                $customer->save();
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
        if($request->customer_id !=null){
            $customer = customer::find($request->customer_id);
            $randomid = mt_rand(1000,9999);
            $customer->otp = $randomid;
            $customer->save();
            $msg= "Dear Customer, Please use the code ".$customer->otp." to verify your Salon Mania Account";
            $this->send_sms($customer->phone,$msg,$customer->country_id);
            return response()->json(['message' => 'Otp Send Successfully'], 200);
        }else{
            return response()->json(['message' => 'Customer id not found'], 400);
        }
    }

    public function verifyCustomer(Request $request)
    {
        if($request->customer_id !=null){
            $customer = customer::find($request->customer_id);
            if($customer->otp == $request->otp){
                $customer->status = 1;
                $customer->save();
                $city='';
                if($customer->city != ''){
                    $city = $customer->city;
                }
                return response()->json(['message' => 'Verified Your Account',
                'name'=>$customer->name,
                'email'=>$customer->email,
                'phone'=>$customer->phone,
                'dob'=>date('d-m-Y', strtotime($customer->dob)),
                'gender'=>$customer->gender,
                'country_id'=>(int)$customer->country_id,
                'city'=>$city,
                'customer_id'=>$customer->id,'status'=>200], 200);
            }else{
                return response()->json(['message' => 'Verification Code Not Valid','status'=>400], 400);
            }
        }else{
            return response()->json(['message' => 'Customer id not found'], 400);
        }
    }


    public function splitAddress(Request $request)
    {
        if($request->address !=null){
            $split_address = explode("-", $request->address);

            $split_count = count($split_address) - 2;
            $country = $split_address[$split_count + 1];
            if($country == ' United Arab Emirates'){
                for($i=0;$i<=$split_count;$i++){
                    $address1[]= $split_address[$i];
                }
                $new_address = collect($address1)->implode(' - ');

                $split_city = explode(" ", $split_address[$split_count]);

                $city = area::where('area', 'like', '%' .$split_city[1]. '%')->first();
                
                if(!empty($city)){
                    return response()->json(['message' => 'Address Split Successfully',
                        'address'=>$new_address,
                        'city'=>$city->area,
                        'status'=>200], 200);
                }
                else{
                    return response()->json(['message' => 'This Address Not Available'], 400);
                }
            }
            else{
                return response()->json(['message' => 'This Address Not Available'], 400);
            }
        }else{
            return response()->json(['message' => 'address not found'], 400);
        }
    }

    public function getApiSlider(){
        $data = slider::select('text','button','text_position','text_color','button_color','background_color','indicator_color','slider_image','image_fit','service_id','salon_id')->orderBy('order', 'asc')->get();
        return response()->json($data); 
    }

    public function getApiTerms($id){
        if($id == "en"){
            $data = settings::select('app_terms_english')->first();
            return response()->json($data->app_terms_english);
        }
        else{
            $data = settings::select('app_terms_arabic')->first();
            return response()->json($data->app_terms_arabic);
        }
    }

    public function getApiPrivacy($id){
        if($id == "en"){
            $data = settings::select('app_privacy_english')->first();
            return response()->json($data->app_privacy_english);
        }
        else{
            $data = settings::select('app_privacy_arabic')->first();
            return response()->json($data->app_privacy_arabic);
        }
    }

    public function getApiAbout($id){
        if($id == "en"){
            $data = settings::select('app_about_english')->first();
            return response()->json($data->app_about_english);
        }
        else{
            $data = settings::select('app_about_arabic')->first();
            return response()->json($data->app_about_arabic);
        }
    }

    public function getApiCategory(){
        $data = category::select('category_name_english')->get();
        return response()->json($data); 
    }

    public function getApiServices(){
        $data = service::select('service_name_english','service_name_arabic','image','id','status')->get();
        return response()->json($data); 
    }

    public function getPushNotification($id){
        $data = push_notification::where('status',1)->where('send_to',2)->get();
        $data1 = push_notification::where('status',1)->where('send_to',4)->get();
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
            foreach(explode(',',$value->customer_ids) as $customer1){
                $arraydata[]=$customer1;
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

    public function getApiCity(){
        $data = area::where('parent_id',0)->select('area')->get();
        $datas =array();
        foreach($data as $row){
            $datas[]=$row->area;
        }
        return response()->json($datas); 
    }

    public function getApiAllOtherServices($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("users")
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        //->where("users.busisness_type",1)
        ->where("users.city",$citys->id)
        ->where('users.status',1)
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiOtherServices($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("users")
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        //->where("users.busisness_type",1)
        ->where("users.city",$citys->id)
        ->where('users.status',1)
        //->groupBy("users.id")
        ->inRandomOrder()->limit(10)->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiSalonDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_salons")
        ->join('users', 'users.id', '=', 'app_salons.salon_id')
        ->where("app_salons.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",1)
        ->where('users.status',1)
        ->orderBy('app_salons.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiSpaDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_spas")
        ->join('users', 'users.id', '=', 'app_spas.salon_id')
        ->where("app_spas.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",2)
        ->where('users.status',1)
        ->orderBy('app_spas.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiMakeupDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_makeups")
        ->join('users', 'users.id', '=', 'app_makeups.salon_id')
        ->where("app_makeups.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",3)
        ->where('users.status',1)
        ->orderBy('app_makeups.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiBeautyDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_beauties")
        ->join('users', 'users.id', '=', 'app_beauties.salon_id')
        ->where("app_beauties.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",4)
        ->where('users.status',1)
        ->orderBy('app_beauties.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiDermatologistDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_dermatologists")
        ->join('users', 'users.id', '=', 'app_dermatologists.salon_id')
        ->where("app_dermatologists.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",6)
        ->where('users.status',1)
        ->orderBy('app_dermatologists.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getApiPetGroomingDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_petgroomings")
        ->join('users', 'users.id', '=', 'app_petgroomings.salon_id')
        ->where("app_petgroomings.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",7)
        ->where('users.status',1)
        ->orderBy('app_petgroomings.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiHomeDetails($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        //$user = User::where('role_id','admin')->where('busisness_type',1)->where('city',$citys->id)->get();

        $user = DB::table("app_homes")
        ->join('users', 'users.id', '=', 'app_homes.salon_id')
        ->where("app_homes.city_id",$citys->id)
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        //->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",5)
        ->where('users.status',1)
        ->orderBy('app_homes.order_id', 'ASC')
        //->groupBy("users.id")
        ->get();

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiServiceDetails($id,$city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        // $user = User::where('role_id','admin')->where('busisness_type',$id)->where('city',$citys->id)->get();
        $user =DB::table('salon_services as s')
        ->where('s.service_id',$id)
        ->join('users as u', 'u.id', '=', 's.salon_id')
        ->where('u.role_id','admin')
        ->where('u.city',$citys->id)
        ->where('u.status',1)
        ->select('u.id','u.cover_image','u.address','u.salon_name','u.name' , DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(u.latitude)) 
        * cos(radians(u.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(u.latitude))) AS distance"))
        ->orderBy('distance', 'ASC')
        //->groupBy('u.id')
        ->get();
        $user = $user->unique('id')->values()->all();
        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => $value->cover_image,
                'address' => '',
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(!empty($value->address)){
                $data['address'] = $value->address;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getApiAllShop($city,$lat,$lon){
        $citys = area::where('area',$city)->first();
        
        $user = DB::table("users")
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where("users.busisness_type",'!=',5)
        ->where("users.city",$citys->id)
        //->groupBy("users.id")
        ->get();    

        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'salon_id' => $value->id,
                'cover_image' => $value->cover_image,
                'address' => $value->address,
                'salon_name' => $value->salon_name,
                'distance' => $distance,
                'latitude' => '',
                'longitude' => '',
            );
            if($value->latitude != null){
                $data['latitude'] = $value->latitude;
            }
            if($value->longitude != null){
                $data['longitude'] = $value->longitude;
            }
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getSalonProduct($id){
        $product = product::where('salon_id',$id)->where('status',1)->get();
        $datas=array();
        foreach ($product as $key => $value) {
            $data = array(
                'product_id' => $value->id,
                'product_name_english' => $value->product_name_english,
                'product_name_arabic' => $value->product_name_arabic,
                'price' => (int)$value->price,
                'description' => $value->description,
                'image' => '',
            );
            if($value->image != null){
                $data['image'] = $value->image;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function exclusiveSalonProduct(){
        $product = product::where('exclusive',1)->where('status',1)->get();
        $datas=array();
        foreach ($product as $key => $value) {
            $data = array(
                'salon_id' => $value->salon_id,
                'product_name_english' => $value->product_name_english,
                'product_name_arabic' => $value->product_name_arabic,
                'price' => $value->price,
                'description' => $value->description,
                'image' => '',
            );
            if($value->image != null){
                $data['image'] = $value->image;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function saveAddress(Request $request){
        try{
            $ma = new manage_address;
            $ma->map_title = $request->map_title;
            $ma->addr_title = $request->addr_title;
            $ma->address = $request->address;
            $ma->landmark = $request->landmark;
            $ma->lat = $request->lat;
            $ma->lng = $request->lng;
            $ma->city = $request->city;
            $ma->customer_id = $request->customer_id;
            $ma->status =0;
            $ma->save();
            return response()->json(['message' => 'Address Store Successfully','id'=>$ma->id], 200);
        }catch (\Exception $e) {
            return response()->json(['message' => ' Server Busy','status'=>400], 400);
        }
    }
     
    public function getAddress($id){
        $addr = manage_address::where('customer_id',$id)->select('map_title','lat','lng','addr_title','address','id','city','landmark')->where('status',0)->get();
        return response()->json($addr);
    }

    public function updateAddress(Request $request){
        try{
        $ma =  manage_address::find($request->addr_id);
        $ma->map_title = $request->map_title;
        $ma->addr_title = $request->addr_title;
        $ma->address = $request->address;
        $ma->landmark = $request->landmark;
        $ma->lat = $request->lat;
        $ma->lng = $request->lng;
        $ma->city = $request->city;
        $ma->save();
        return response()->json(['message' => 'Address Update Successfully',], 200);
         }catch (\Exception $e) {
            return response()->json(['message' => ' Server Busy','status'=>400], 400);
        }
    }

    public function deleteAddress(Request $request){
    $address = manage_address::find($request->addr_id);
    $address->status = 1;
    $address->save();
    return response()->json(['message' => 'Address Delete Successfully',], 200);
    }

    public function getShopReview($id){
        $q =DB::table('reviews as r');
        $q->where('r.salon_id', '=', $id);
        $q->where('r.status', '=', 1);
        $q->join('customers as c','c.id', '=', 'r.customer_id');
        $q->select('r.comments','r.reviews','c.name','r.updated_at');
        $reviews = $q->get();
        $data =array();
        $datas = array();
        foreach ($reviews as $key => $value) {
            $dateTime = new Carbon($value->updated_at, new \DateTimeZone('Asia/Dubai'));
            $data = array(
                'comments' => $value->comments,
                'reviews' => $value->reviews,
                'name' => $value->name,
                'time' => $dateTime->diffForHumans(),
            );
            $datas[] = $data;
        }  
        return response()->json($datas); 
    }

    public function getShopGallery($id){
        $gallery = gallery::where('salon_id',$id)->select('image')->where('status',0)->get();
        $datas = array();
        if(count($gallery) > 0){
            foreach ($gallery as $key => $value) {            
                $datas[] = $value->image;
            }  

        }else{
            $datas = array();
        }
        return response()->json($datas); 
    }


    public function getShopDetails($id){
        $user = User::find($id);
        $data =array();
        $data = array(
            'review_count' => '',
            'review_average' => '',
            'salon_id' => $user->id,
            'busisness_type' => $user->busisness_type,
            'cover_image' => '',
            'address' => $user->address,
            'salon_name' => $user->salon_name,
            'website' => $user->website,
            'lat' => $user->latitude,
            'lng' => $user->longitude,
            'phone' => $user->phone,
            'about_us' => $user->about_us,
        );
        if(empty($user->salon_name)){
            $data['salon_name'] = $user->name;
        }
        if(!empty($user->cover_image)){
            $data['cover_image'] = $user->cover_image;
        }
        $q =DB::table('reviews as r');
        $q->where('r.salon_id', '=', $user->id);
        $q->where('r.status', '=', 1);
        $q->groupBy('r.salon_id');
        $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
        $review = $q->first();

        if(!empty($review)){
            $data['review_count'] = $review->review_count;
            $data['review_average'] = $review->review_average;
        }
        $datas[] = $data;
        return response()->json($datas); 
    }

    public function getApiShopStatus($id){
        $user = User::find($id);
        if($user->busisness_type == '5'){
            $data = array(
                'status' => 1,
            );
        }
        else{
            $data = array(
                'status' => 0,
            );
        }   
        return response()->json($data); 
    }

    public function getShopWorkers($id){
        $user = User::where('user_id',$id)->get();
        $data =array();
        $datas =array();
        foreach ($user as $key => $value) {
            $data = array(
                'worker_id' => $value->id,
                'profile_image' => $value->profile_image,
                'name' => $value->name,
                'email' => $value->email,
                'phone' => $value->phone,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getAllPackage($city){

        $citys = area::where('area',$city)->first();
        
        $package = DB::table("users as u")
        ->where('u.role_id','admin')
        ->where('u.status',1)
        ->where('u.city',$citys->id)
        ->join('packages as p', 'u.id', '=', 'p.salon_id')
        ->select('p.*','u.salon_name','u.name','u.user_id')
        ->get();  

        //$package = package::where('salon_id',$id)->get();
        $data =array();
        $datas =array();
        foreach ($package as $key => $value) {
            $data = array(
                'package_id' => $value->id,
                'salon_id' => (int)$value->user_id,
                'salon_name' => '',
                'package_image' => $value->image,
                'package_name_english' => $value->package_name_english,
                'package_name_arabic' => '',
                'price' => (double)$value->price,
            );
            if($value->package_name_arabic != null){
                $data['package_name_arabic'] = $value->package_name_arabic;
            }
            if($value->salon_name != ''){
                $data['salon_name'] = $value->salon_name;
            }
            else{
                $data['salon_name'] = $value->name;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }


    public function getShopPackage($id){
        $package = package::where('salon_id',$id)->get();
        $data =array();
        foreach ($package as $key => $value) {
            $data = array(
                'package_id' => $value->id,
                'package_image' => $value->image,
                'package_name_english' => $value->package_name_english,
                'package_name_arabic' => '',
                'price' => (double)$value->price,
            );
            if($value->package_name_arabic != null){
                $data['package_name_arabic'] = $value->package_name_arabic;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getPackageServices($id){
        $package = package::find($id);
        $data =array();
        foreach(explode(',',$package->service_ids) as $service_id){
            $service = service::find($service_id);
            $data = array(
                'service_id' => $service->id,
                'service_name' => $service->service_name_english,
                'service_image' => $service->image,
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getShopHours($id){
        $user = service_time::where('salon_id',$id)->get();
        $data =array();
        foreach ($user as $key => $value) {
            $data = array(
                'hours_id' => $value->id,
                'days' => $value->days,
                'open_time' => '',
                'close_time' => '',
                'status' => $value->status,
            );

            if($value->open_time != null){
                $data['open_time'] = $value->open_time;
            }
            if($value->close_time != null){
                $data['close_time'] = $value->close_time;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getShopServices($id){
        $user = salon_service::where('salon_id',$id)->get();
        $data =array();
        foreach ($user as $key => $value) {
            $service = service::find($value->service_id);
            $data = array(
                'salon_service_id' => $value->id,
                'service_id' => $service->id,
                'service_name_english' => $service->service_name_english,
                'service_name_arabic' => $service->service_name_arabic,
                'service_image' => $service->image,
                'price' => (double)$value->price,
                'duration' => (double)$value->duration,
                'sub'=>0
            );
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function getApiShopName($name,$lat,$lon){
        $user = DB::table("users")
        ->select("users.*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->orderBy('distance', 'ASC')
        ->where("users.role_id",'admin')
        ->where('salon_name','LIKE', "%$name%")
        ->where('status',1)
        //->groupBy("users.id")
        ->get();   

        $data =array();
        foreach ($user as $key => $value) {
            $distance=0;
            if(round($value->distance,3) > 0.999 ){
                $distance = round($value->distance,3) . ' km';
            }
            else{
                $distance = substr($value->distance,-3) . ' m';
            }
            $data = array(
                'review_count' => '',
                'review_average' => '',
                'salon_id' => $value->id,
                'cover_image' => '',
                'address' => $value->address,
                'salon_name' => $value->salon_name,
                'distance' => $distance,
            );
            if(empty($value->salon_name)){
                $data['salon_name'] = $value->name;
            }
            if(!empty($value->cover_image)){
                $data['cover_image'] = $value->cover_image;
            }
            $q =DB::table('reviews as r');
            $q->where('r.salon_id', '=', $value->id);
            $q->where('r.status', '=', 1);
            $q->groupBy('r.salon_id');
            $q->select([DB::raw("(count(*)) AS review_count"), DB::raw("(sum(r.reviews) / count(*)) AS review_average")]);
            $review = $q->first();

            if(!empty($review)){
                $data['review_count'] = $review->review_count;
                $data['review_average'] = $review->review_average;
            }
            $datas[] = $data;
        }   
        return response()->json($datas);
    }


    public function getShopWeeks($id){
        $data = service_time::where('salon_id',$id)->select('id','days')->get();
        return response()->json($data);
    }

    public function getShopBooking($id,$getdate){
        $getdate1 = date("l" , strtotime($getdate));
        $value = service_time::where('salon_id',$id)->where('days',$getdate1)->first();
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $today = date("l");
        $time = date("h:i A"); 
        $data = array();
 
        $times = array('12:00 AM','01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM','07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM');

        foreach($times as $row){
            if(strtotime($value->open_time) < strtotime($row)){
                if($today == $value->days){
                    if(strtotime($time) < strtotime($row)){
                        if(strtotime($row) < strtotime($value->close_time)){
                            $data[] =  (String)$row;
                        }
                    }
                }
                else{
                    if(strtotime($row) < strtotime($value->close_time)){
                        $data[] =  (String)$row;
                    }
                }
            }
        }


        return response()->json($data); 
    }


    public function getShopNear(Request $request){
        $lat = '24.491054';
        $lon = '54.363560';

    $data = DB::table("users")
        ->select("users.id"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(users.latitude)) 
        * cos(radians(users.longitude) - radians(" . $lon . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(users.latitude))) AS distance"))
        ->where("users.role_id",'admin')
        //->groupBy("users.id")
        ->get();

        return response()->json($data); 
    }

    public function chatReadCount($id){
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $chat = salon_customer::where('booking_id',$id)->orderBy('id','DESC')->get();
        $chat_count=0;

        foreach ($chat as $key => $value) {
            if($value->message_from == 0){
            break;
            }
            $chat_count++;
        }   
        return response()->json([
            'chat_count'=>$chat_count
        ], 200);
    }


    public function getChatBooking($id){
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

    public function getCouponCode($id){
        $coupon = coupon::where('status',1)->get();
        //return response()->json($coupon); 
        $data =array();
        $datas =array();
        foreach ($coupon as $key => $value) {
            if(empty($value->user_type) && date('Y-m-d') < $value->end_date){
                $data = array(
                    'coupon_id' => $value->id,
                    'coupon_code' => $value->coupon_code,
                    'description' => $value->description,
                    'start_date' => $value->start_date,
                    'end_date' => $value->end_date,
                    'discount_type' => $value->discount_type,
                    'amount' => $value->amount,
                    'user_type' => 0,
                );
                $datas[] = $data;
            }
            else{
                $coupon1  = coupon::find($value->id);
                $arraydata=array();
                foreach(explode(',',$coupon1->user_id) as $user1){
                    if($user1 == $id && date('Y-m-d') < $value->end_date){
                        $data = array(
                            'coupon_id' => $value->id,
                            'coupon_code' => $value->coupon_code,
                            'description' => $value->description,
                            'start_date' => $value->start_date,
                            'end_date' => $value->end_date,
                            'discount_type' => $value->discount_type,
                            'amount' => $value->amount,
                            'user_type' => 1,
                        );
                        $datas[] = $data;
                    }
                }
            }
        }   
        return response()->json($datas); 
    }

    public function getAllNation(){
        $country = country::all();
        $data =array();
        $datas =array();
        foreach ($country as $key => $value) {
            $data = array(
                'id' => $value->id,
                'country_code' => $value->country_code,
                'country_name_english' => $value->country_name_english,
                'country_name_arabic' => $value->country_name_arabic,
                'image' => '',
            );
            if($value->image != null){
                $data['image'] = $value->image;
            }
            $datas[] = $data;
        }   
        return response()->json($datas); 
    }

    public function couponModule($id,$code,$value,$salon_id){
        $coupon = coupon::where('coupon_code',$code)->where('status',1)->get();
if(count($coupon)>0){
    if($salon_id == $coupon[0]->salon_id || $coupon[0]->salon_id == 'admin'){
        if($value >= $coupon[0]->min_order_val){
            if($coupon[0]->start_date <= date('Y-m-d') && $coupon[0]->end_date >= date('Y-m-d')){
                // return response()->json(['message' => 'Valid Date',], 200);
                if($coupon[0]->user_type ==1){
                    $arraydata=0;
                    foreach(explode(',',$coupon[0]->user_id) as $user1){
                        if($id == $user1){
                            $arraydata=1;
                        }
                    }
                    if($arraydata==0){
                        return response()->json(['message' => 'coupon not valid for you',], 400);
                    }else{
                        if($coupon[0]->limit_per_user !=null){
                        $booking_count = booking::where('customer_id',$id)->where('coupon_id',$coupon[0]->id)->get();
                        if(count($booking_count)< $coupon[0]->limit_per_user){
                            $amount = 0;
                            if($coupon[0]->discount_type == 4){
                            $amount = ($value/100) * $coupon[0]->amount;
                            }
                            else{
                                $amount = $coupon[0]->amount;
                            }
                            return response()->json([
                                'message' => 'Coupon Updated Succssfully',
                                'coupon_id' => $coupon[0]->id,
                                'discount'=>$amount
                            ], 200);
                        }else{
                            return response()->json(['message' => 'coupon Already Used',], 400);
                        }
                        }
                        $amount = 0;
                        if($coupon[0]->discount_type == 4){
                        $amount = ($value/100) * $coupon[0]->amount;
                        }
                        else{
                            $amount = $coupon[0]->amount;
                        }
                        return response()->json([
                            'message' => 'Coupon Updated Succssfully',
                            'coupon_id' => $coupon[0]->id,
                            'discount'=>$amount
                        ], 200);

                    }
                }else{
                    if($coupon[0]->limit_per_user !=null){
                        $booking_count = booking::where('customer_id',$id)->where('coupon_id',$coupon[0]->id)->get();
                        if(count($booking_count)< $coupon[0]->limit_per_user){
                            $amount = 0;
                            if($coupon[0]->discount_type == 4){
                            $amount = ($value/100) * $coupon[0]->amount;
                            }
                            else{
                                $amount = $coupon[0]->amount;
                            }
                            return response()->json([
                                'message' => 'Coupon Updated Succssfully',
                                'coupon_id' => $coupon[0]->id,
                                'discount'=>$amount
                            ], 200);
                        }else{
                            return response()->json(['message' => 'coupon Already Used',], 400);
                        }
                    }
                    $amount = 0;
                    if($coupon[0]->discount_type == 4){
                    $amount = ($value/100) * $coupon[0]->amount;
                    }
                    else{
                        $amount = $coupon[0]->amount;
                    }
                    return response()->json([
                        'message' => 'Coupon Updated Succssfully',
                        'coupon_id' => $coupon[0]->id,
                        'discount'=>$amount
                    ], 200);
                }
            }
            return response()->json(['message' => 'coupon expired',], 400);
        }else{
            return response()->json(['message' => 'Cart Value Not Enough',], 400);
        }
    }else{
        return response()->json(['message' => 'Coupon Code Not for this Salon',], 400);
    }
}else{
    return response()->json(['message' => 'invalid coupon code',], 400);
}
    
}

    private function getAccessToken(){        
        $apikey="MmNjNTRhMjctOTlhNy00Y2U5LThhYWEtZTY3NDAyZTlmMDZmOjJhYzU0YTQ0LWZiMWUtNDM0ZS04ZGQzLTYxZTE1NDFjZTM1Mg==";     
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
        
        
        
    private function createPaymentOrder($total,$id){
        // foreach(explode('.', $d) as $info) {
            
        $amount = $total.'00';
        $customer = customer::find($id);
        $postData = new StdClass(); 
        $postData->action = "SALE"; 
        $postData->firstName = $customer->name; 
        $postData->email = $customer->email; 
        $postData->merchantAttributes = new StdClass();
        $postData->merchantAttributes->redirectUrl = "http://salonmania.ae/payment-success";
        $postData->amount = new StdClass();
        $postData->amount->currencyCode = "AED"; 
        $postData->amount->value = $amount; 
        
        $outlet = "b603c81e-dc26-40e7-8088-acd938b6440b";
        $token=$this->getAccessToken();
         
        $json = json_encode($postData);
        $ch = curl_init(); 
         
        curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/$outlet/orders"); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$token, 
            "Content-Type: application/vnd.ni-payment.v2+json", 
            "Accept: application/vnd.ni-payment.v2+json",
            "APP_KEY:8Shm171pe2oTGvJlql7nxe2Ys/tHJaiiVq6vr5wIu5EJhEEmI3gVi",
          )); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
         
        $output = json_decode(curl_exec($ch)); 
        $order_reference = $output->reference; 
        $order_paypage_url = $output->_links->payment->href; 
        curl_close ($ch);
        $data = array(
        'pay_url' => $order_paypage_url,
        'order_reference' => $order_reference,
        );
        return $data;
        //$this->paymentPay($order_paypage_url);
    }

    public function getRetrivePayment($id){
        $booking = booking::find($id);
        $orderID = $booking->order_id;
        $outlet = "b603c81e-dc26-40e7-8088-acd938b6440b";
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
        //$this->sendBookNotification($booking->id);

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
      
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        //echo $response;
        //return $status;
        return response()->json(['message' => 'Save Successfully'], 200);
      }


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
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$booking->id\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    }

    public function saveBooking(Request $request){
        try{
        $config = [
            'table' => 'bookings',
            'field' => 'b_id',
            'length' => 10,
            'prefix' => 'SM-'
        ];
        $b_id = IdGenerator::generate($config);
        $randomid = mt_rand(1000,9999); 
        $booking = new booking;
        $booking->b_id = $b_id;
        $booking->salon_id = $request->salon_id;
        $booking->date = date('Y-m-d');
        $booking->customer_id = $request->customer_id;
        $booking->appointment_date = date('Y-m-d',strtotime($request->appointment_date));
        $booking->appointment_time = $request->appointment_time;
        //$booking->workers_id = $request->workers_id;
        $booking->coupon_id = $request->coupon_id;
        $booking->coupon = $request->coupon;
        $booking->subtotal = $request->subtotal;
        $booking->discount = $request->discount;
        $booking->total = $request->total;
        $booking->otp = $randomid;
        $booking->address_id = $request->address_id;
        $booking->payment_type = $request->payment_type;
        $booking->payment_status = 0;
        
        if($request->payment_type == 1){
        $totalData = explode('.',$request->total);
        $output = $this->createPaymentOrder($totalData[0],$request->customer_id);
        $booking->order_id = $output['order_reference'];
        $booking->pay_url = $output['pay_url'];
        //$booking->save();
        }
        $booking->save();
        $salon = User::find($request->salon_id);
        $customer=customer::find($request->customer_id);
        //return response()->json($request);
        
        $msg= "Dear Customer, Please use the code ".$booking->otp." to Approve your ".$salon->salon_name;

        
        if($request->payment_type == 1){
            return response()->json(
            ['message' => 'Save Successfully',
            'booking_id'=>$booking->id,
            'pay_url'=>$output['pay_url'],
            'order_id'=>$output['order_reference'],
            ], 200);
        }
        else{
            $this->send_sms($customer->phone,$msg,$customer->country_id);
            $service_amount = (6 / 100) * ($booking->total);
            $salon->admin_pay = $salon->admin_pay + $service_amount;
            $salon->save();
            //$this->sendBookNotification($booking->id);
            return response()->json(
                ['message' => 'Save Successfully',
                'booking_id'=>$booking->id,
                ], 200);
        }
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveBookingItem(Request $request){
        try{
            $service = service::find($request->service_id);

            $booking_item = new booking_item;
            $booking_item->booking_id = $request->booking_id;
            $booking_item->service_id = $request->service_id;
            $booking_item->service_name = $service->service_name_english;
            $booking_item->price = $request->price;
            $booking_item->save();
        return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveBookingPackage(Request $request){
        try{
            $booking_package = new booking_package;
            $booking_package->booking_id = $request->booking_id;
            $booking_package->package_id = $request->package_id;
            $booking_package->package_name = $request->package_name;
            $booking_package->price = $request->price;
            $booking_package->save();
        return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function saveBookingProduct(Request $request){
        try{
            $booking_product = new booking_product;
            $product = product::find($request->product_id);
            $booking_product->booking_id = $request->booking_id;
            $booking_product->product_id = $request->product_id;
            $booking_product->product_name = $product->product_name_english;
            $booking_product->price = $request->price;
            $booking_product->save();
        return response()->json(
            ['message' => 'Save Successfully'],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function getBooking($id){
        $booking = booking::where('customer_id',$id)->orderBy('id','DESC')->get();
        
        $data =array();
        foreach ($booking as $key => $value) {
           // $salon = User::where('id',$booking->salon_id)->first();
            if($value->payment_type == '1' && $value->payment_status == '0'){
            }
            else{
            $salon = User::find($value->salon_id);
            // return response()->json($salon); 
            $data = array(
                'booking_id' => $value->id,
                'cover_image' => $salon->cover_image,
                'address' => $salon->address,
                'salon_name' => $salon->salon_name,
                'phone' => $salon->phone,
                'appointment_date' => $value->appointment_date,
                'appointment_time' => $value->appointment_time,
                'booking_status' => (int)$value->booking_status,
                'payment_type' => (int)$value->payment_type,
                'payment_status' => (int)$value->payment_status,
                'latitude' => '',
                'longitude' => '',
                'website' => '',
                'otp' => $value->otp,
                'subtotal' => $value->subtotal,
                'total' => $value->total,
                'coupon' => '',
                'discount' => 0.0,
                'address_id'=> (int)$value->address_id,
            );
            if($salon->latitude != null){
                $data['latitude'] = $salon->latitude;
            }
            if($salon->longitude != null){
                $data['longitude'] = $salon->longitude;
            }
            if(empty($salon->salon_name)){
                $data['salon_name'] = $salon->name;
            }
            if($value->coupon !=null){
                $data['coupon'] = $value->coupon;
            }
            if($value->discount !=null){
                $data['discount'] = $value->discount;
            }
            if($salon->website !=null){
                $data['website'] = $salon->website;
            }
            $datas[] = $data;
            }
        }   
        return response()->json($datas); 
    }

    public function getBookingItem($id){
        $booking = booking_item::where('booking_id',$id)->get();
        $data =array();
        if(count($booking) >0){
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
        }else{
            $datas=array();
        }
        return response()->json($datas); 
    }

    public function getBookingPackage($id){
        $package = booking_package::where('booking_id',$id)->get();
        $data =array();
        if(count($package) >0){

            foreach ($package as $key => $value) {
                $pack = package::find($value->package_id);
                $data = array(
                    'package_id' => $value->package_id,
                    'package_name' => $value->package_name,
                    'package_price' => $value->price,
                    'package_image' => $pack->image,
                );
                $datas[] = $data;
            }   
        }else{
            $datas=array();
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
                    'product_image' => '',
                );
                if(!empty($pack)){
                    $data['product_image'] = $pack->image;
                }
                else{
                    $data['product_image'] = 'no_product.jpg';
                }

                $datas[] = $data;
            }   
        }else{
            $datas=array();
        }
        return response()->json($datas); 
    }

    public function getBookingTransaction($id){
        $booking = booking::where('customer_id',$id)->orderBy('id','DESC')->get();
        $data =array();
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

    private function sendChatNotification($id){
        $chat = salon_customer::find($id);
        $customer = customer::find($chat->customer_id);
        $salon = User::where('user_id',$chat->salon_id)->get();

        $title = "Booking ID #".$chat->booking_id;
        $body= $chat->text;
        foreach($salon as $salon1){
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
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$salon1->fcm_token\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$chat->id\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        }
    }

    public function saveChatBooking(Request $request){
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $booking = booking::find($request->booking_id);
        $salon_customer = new salon_customer;
        $salon_customer->text = $request->message;
        $salon_customer->customer_id = $booking->customer_id;
        $salon_customer->booking_id = $request->booking_id;
        $salon_customer->salon_id = $booking->salon_id;
        $salon_customer->message_from = 0;
        if( $request->message != ''){
        $salon_customer->save();
        
        //$this->sendChatNotification($salon_customer->id);

        $dateTime = new Carbon($salon_customer->updated_at, new \DateTimeZone('Asia/Dubai'));
        $message =  array(
           'message'=> $salon_customer->text,
           'message_from'=> '0',
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


      //Home Service Order final page show manage address
      public function getManageAddress($id){
          $ma = manage_address::find($id);
          return response()->json($ma);
      }

      public function saveReview(Request $request){
        try{
            $order = booking::find($request->booking_id);
            $exist = review::where('salon_id',$order->salon_id)->where('invoice_id',$request->booking_id)->get();
            if(count($exist)>0){
                 return response()->json(['message' => 'Review Has been Already Stored','status'=>403], 403);
            }
        
        $review = new review;
        $review->invoice_id = $request->booking_id;
        $review->salon_id = $order->salon_id;
        $review->customer_id = $order->customer_id;
        $review->comments = $request->review;
        $review->reviews = $request->rating;
        $review->save();

        return response()->json(
            ['message' => 'Register Successfully',
            // 'name'=>$review->name,
            'review_id'=>$review->id],
             200);
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(),'status'=>400], 400);
        } 
    }

    public function getReview($order_id){
        $order = booking::find($order_id);
        $review = review::where('invoice_id',$order_id)->where('salon_id',$order->salon_id)->get();
        $data =array();
        if(count($review)>0){
            $data = array(
                'review' => $review[0]->comments,
                'rating' => (int)$review[0]->reviews,
            );
        }
        else{
            $data = array(
                'review' => '',
                'rating' => '',
            );
        }
        return response()->json($data); 
    }

    public function getweeks($id){
        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $week = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

        $today = date("l");

        $day = date('Y-m-d', strtotime(' +1 day'));

        $tomorrow = date('l', strtotime($day));

        $third1 = date('Y-m-d', strtotime(' +2 day'));
        $third = date('l', strtotime($third1));
        $four1 = date('Y-m-d', strtotime(' +3 day'));
        $four = date('l', strtotime($four1));
        $five1 = date('Y-m-d', strtotime(' +4 day'));
        $five = date('l', strtotime($five1));
        $six1 = date('Y-m-d', strtotime(' +5 day'));
        $six = date('l', strtotime($six1));
        $seven1 = date('Y-m-d', strtotime(' +6 day'));
        $seven = date('l', strtotime($seven1));

        $data = array();
        $time = date("h:i A"); 
 
        $times = array('12:00 AM','01:00 AM','02:00 AM','03:00 AM','04:00 AM','05:00 AM','06:00 AM','07:00 AM','08:00 AM','09:00 AM','10:00 AM','11:00 AM','12:00 PM','01:00 PM','02:00 PM','03:00 PM','04:00 PM','05:00 PM','06:00 PM','07:00 PM','08:00 PM','09:00 PM','10:00 PM','11:00 PM');


        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$today)->where('status',1)->first();
            if(!empty($getvalue)){
                foreach($times as $row){
                    if(strtotime($getvalue->open_time) < strtotime($row)){
                        if(strtotime($time) < strtotime($row)){
                            if(strtotime($row) < strtotime($getvalue->close_time)){
                                if($today == $value){
                                    $weeks = "Today";
                                    $data[] = array(
                                    'weeks' => $weeks,
                                    'days' => date('d-m-Y', strtotime($today)),
                                    'month' => date('M', strtotime($today)),
                                    'date' => date('d', strtotime($today)),
                                    );
                                }
                                break;
                            }
                        }
                    }
                }
            }
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$tomorrow)->where('status',1)->first();
            if(!empty($getvalue)){
                if($tomorrow == $value){
                    $weeks = "Tomorrow";
                    $data[] = array(
                    'weeks' => $weeks,
                    'days' => date('d-m-Y', strtotime($tomorrow)),
                    'month' => date('M', strtotime($tomorrow)),
                    'date' => date('d', strtotime($tomorrow)),
                    );
                }    
            }       
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$third)->where('status',1)->first();
            if(!empty($getvalue)){
                if($third == $value){
                    $data[] = array(
                    'weeks' => $value,
                    'days' => date('d-m-Y', strtotime($third)),
                    'month' => date('M', strtotime($third)),
                    'date' => date('d', strtotime($third)),
                    );
                }
            }
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$four)->where('status',1)->first();
            if(!empty($getvalue)){
                if($four == $value){
                    $data[] = array(
                    'weeks' => $value,
                    'days' => date('d-m-Y', strtotime($four)),
                    'month' => date('M', strtotime($four)),
                    'date' => date('d', strtotime($four)),
                    );
                }
            }
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$five)->where('status',1)->first();
            if(!empty($getvalue)){
                if($five == $value){
                    $data[] = array(
                    'weeks' => $value,
                    'days' => date('d-m-Y', strtotime($five)),
                    'month' => date('M', strtotime($five)),
                    'date' => date('d', strtotime($five)),
                    );
                }
            }
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$six)->where('status',1)->first();
            if(!empty($getvalue)){
                if($six == $value){
                    $data[] = array(
                    'weeks' => $value,
                    'days' => date('d-m-Y', strtotime($six)),
                    'month' => date('M', strtotime($six)),
                    'date' => date('d', strtotime($six)),
                    );
                }
            }
        }
        foreach ($week as $key => $value) {
            $getvalue = service_time::where('salon_id',$id)->where('days',$seven)->where('status',1)->first();
            if(!empty($getvalue)){
                if($seven == $value){
                    $data[] = array(
                    'weeks' => $value,
                    'days' => date('d-m-Y', strtotime($seven)),
                    'month' => date('M', strtotime($seven)),
                    'date' => date('d', strtotime($seven)),
                    );
                } 
            }
        }
        return response()->json($data);
    }


}
