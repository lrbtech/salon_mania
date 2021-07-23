<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\push_notification;
use App\customer;
use App\city;
use App\area;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function saveNotification(Request $request){
        $request->validate([
            'title'=>'required',
            'send_to'=> 'required',
        ]);

        //  $customer_ids = '';
        // if($request->send_to == '2'){
        //     foreach($request->customer_ids as $row){
        //         $customer_id[]=$row;
        //     }
        //     $customer_ids = collect($customer_id)->implode(',');
        // }

        $push_notification = new push_notification;
        $push_notification->salon_id = Auth::user()->id;
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        $push_notification->save();
        return response()->json('successfully save'); 
    }

    public function updateNotification(Request $request){
        $request->validate([
            'title'=> 'required',
            'send_to'=> 'required',
        ]);
        
        // $customer_ids = '';
        // if($request->send_to == '2'){
        //     foreach($request->customer_ids as $row){
        //         $customer_id[]=$row;
        //     }
        //     $customer_ids = collect($customer_id)->implode(',');
        // }

        $push_notification = push_notification::find($request->id);
        $push_notification->title = $request->title;
        $push_notification->description = $request->description;
        $push_notification->send_to = $request->send_to;
        $push_notification->save();
        return response()->json('successfully update'); 
    }

    public function Notification(){
        $notification = push_notification::where('salon_id',Auth::user()->user_id)->get();
        $customer = customer::all();
        $area = area::all();
        return view('vendor.push_notification',compact('notification','customer','area'));
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


    public function getNotificationCustomer($id){ 
        $data  = push_notification::find($id);

        $customer = customer::all();

      $arraydata=array();
      foreach(explode(',',$data->customer_ids) as $customer1){
        $arraydata[]=$customer1;
      }
      $output = '<option value="">ALL</option>';
        foreach ($customer as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->email.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->email.'</option>'; 
            }
        }
      // $output .='</option>';
      
      echo $output;
      
    }

}
