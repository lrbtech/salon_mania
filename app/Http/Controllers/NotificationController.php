<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\push_notification;
use App\customer;
use App\User;


class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveNotification(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $salon_id='';
        if($request->send_to == '3'){
            $salon1;
            foreach($request->salon_id as $row){
                $salon1[]=$row;
            }
            $salon_id = collect($salon1)->implode(',');
        }

        $push_notification = new push_notification;
        $push_notification->salon_id = 'admin';
        $push_notification->title = $request->title;
        $push_notification->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
        $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
        $push_notification->salon_ids = $salon_id;
        }
        $push_notification->status = 1;
        $push_notification->save();

        return response()->json('successfully save'); 
    }

    public function saveSendNotification(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $salon_id='';
        if($request->send_to == '3'){
            $salon1;
            foreach($request->salon_id as $row){
                $salon1[]=$row;
            }
            $salon_id = collect($salon1)->implode(',');
        }
        $push_notification = new push_notification;
        $push_notification->salon_id = 'admin';
        $push_notification->title = $request->title;
        $push_notification->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
        $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
        $push_notification->salon_ids = $salon_id;
        }
        $push_notification->status = 1;
        $push_notification->save();

        //$this->sendNotification($push_notification->id);
        return response()->json('successfully save'); 
    }

    public function updateNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $salon_id='';
        if($request->send_to == '3'){
            $salon1;
            foreach($request->salon_id as $row){
                $salon1[]=$row;
            }
            $salon_id = collect($salon1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
        $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
        $push_notification->salon_ids = $salon_id;
        }
        $push_notification->save();

        return response()->json('successfully update'); 
    }

    public function updateSendNotification(Request $request){
        $request->validate([
            'title'=> 'required',
        ]);
        
        $customer_id='';
        if($request->send_to == '4'){
            $customer1;
            foreach($request->customer_id as $row){
                $customer1[]=$row;
            }
            $customer_id = collect($customer1)->implode(',');
        }
        $salon_id='';
        if($request->send_to == '3'){
            $salon1;
            foreach($request->salon_id as $row){
                $salon1[]=$row;
            }
            $salon_id = collect($salon1)->implode(',');
        }
        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        if($request->send_to == '4'){
        $push_notification->customer_ids = $customer_id;
        }
        if($request->send_to == '3'){
        $push_notification->salon_ids = $salon_id;
        }
        $push_notification->save();

        //$this->sendNotification($push_notification->id);

        return response()->json('successfully update'); 
    }

    public function Notification(){
        $push_notification = push_notification::all();
        $customer = customer::all();
        $user = User::where('role_id','admin')->where('status',1)->get();
        return view('admin.push_notification',compact('push_notification','customer','user'));
    }

    public function notificationReadStatus($id){
        // $notification = push_notification::where('read_status',0)->get();
        // foreach($notification as $row){
        //     $not = push_notification::find($row->id);
        //     $not->read_status = 1;
        //     $not->save();
        // }

        $notification = push_notification::find($id);
        $notification->read_status = 1;
        $notification->save();

        $salon_push_notification = push_notification::all();
        $customer = customer::all();
        $user = User::where('role_id','admin')->where('status',1)->get();
        $salon = User::all();
        return view('admin.salon_notification',compact('salon_push_notification','customer','user','notification','id','salon'));
    }


    public function editNotification($id){
        $push_notification = push_notification::find($id);
        return response()->json($push_notification); 
    }
    
    public function deleteNotification($id){
        $push_notification = push_notification::find($id);
        $push_notification->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


public function sendNotification($id){
    //$body = "Pickup date/time : ".$request->pickup_date.'/'.$request->pickup_time.' Delivery Type :'.$request->delivery_option;
    $push_notification = push_notification::find($id);

    if($push_notification->send_to == '1'){
        $salon = User::where('fcm_token','!=',null)->get();
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
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$salon1->fcm_token\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$push_notification->id\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAQfsJwUI:APA91bGf-mxvaz1HHZCMMAHKDdbTCt6Jw_DE95GEyxNeU_otDjjO7bqJYpKSu-kIdxmLVt7SsOPP6pne4CUxZhwafPKGbx-ZfMACHjkhJtuG-Cg6SDE4YqtiQkcFPKlM83CAvQv9Sn-y",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        }
    }
    elseif($push_notification->send_to == '2'){
        $customers = customer::where('firebase_key','!=',null)->get();
        foreach($customers as $customer){
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
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$push_notification->id\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAQfsJwUI:APA91bGf-mxvaz1HHZCMMAHKDdbTCt6Jw_DE95GEyxNeU_otDjjO7bqJYpKSu-kIdxmLVt7SsOPP6pne4CUxZhwafPKGbx-ZfMACHjkhJtuG-Cg6SDE4YqtiQkcFPKlM83CAvQv9Sn-y",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        }
    }
    elseif($push_notification->send_to == '3'){
        foreach(explode(',',$push_notification->salon_ids) as $salon_id){
            $salon = User::find($salon_id);
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
            CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$salon->fcm_token\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$push_notification->id\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAQfsJwUI:APA91bGf-mxvaz1HHZCMMAHKDdbTCt6Jw_DE95GEyxNeU_otDjjO7bqJYpKSu-kIdxmLVt7SsOPP6pne4CUxZhwafPKGbx-ZfMACHjkhJtuG-Cg6SDE4YqtiQkcFPKlM83CAvQv9Sn-y",
                "Content-Type: application/json"
            ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            }
    }
    elseif($push_notification->send_to == '4'){
        foreach(explode(',',$push_notification->customer_ids) as $customer_id){
        $customer = customer::find($customer_id);
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
        CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"click_action\" : \"FLUTTER_NOTIFICATION_CLICK\",\r\n  \"id\" : \"$push_notification->id\",\r\n  \"body\" :  \"$push_notification->description\",\r\n  \"title\" : \"$push_notification->title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: key=AAAAQfsJwUI:APA91bGf-mxvaz1HHZCMMAHKDdbTCt6Jw_DE95GEyxNeU_otDjjO7bqJYpKSu-kIdxmLVt7SsOPP6pne4CUxZhwafPKGbx-ZfMACHjkhJtuG-Cg6SDE4YqtiQkcFPKlM83CAvQv9Sn-y",
            "Content-Type: application/json"
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        }
    }
        
    

    return response()->json(['message'=>'Successfully Send'],200); 
}




public function getNotificationSalon($id){ 
    $data  = push_notification::find($id);
    $user = User::all();

  $arraydata=array();
  foreach(explode(',',$data->salon_ids) as $salon1){
    $arraydata[]=$salon1;
  }
  $output = '<optgroup label="Select Salon">';
    foreach ($user as $value){
        if(in_array($value->id , $arraydata))
        {
            $output .='<option selected="true" value="'.$value->id.'">'.$value->salon_name.'</option>'; 
        }
        else{
            $output .='<option value="'.$value->id.'">'.$value->salon_name.'</option>'; 
        }
    }
  $output .='</optgroup>';
  
  echo $output;
}

public function getNotificationCustomer($id){ 
    $data  = push_notification::find($id);
    $user = customer::all();

  $arraydata=array();
  foreach(explode(',',$data->user_id) as $user1){
    $arraydata[]=$user1;
  }
  $output = '<optgroup label="Select User">';
    foreach ($user as $value){
        if(in_array($value->id , $arraydata))
        {
            $output .='<option selected="true" value="'.$value->id.'">'.$value->name.'</option>'; 
        }
        else{
            $output .='<option value="'.$value->id.'">'.$value->name.'</option>'; 
        }
    }
  $output .='</optgroup>';
  
  echo $output;
  
}


}
