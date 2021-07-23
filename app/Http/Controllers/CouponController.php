<?php

namespace App\Http\Controllers;
use App\coupon;
use App\User;
use App\customer;
use App\service;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $coupon = coupon::where('status',1)->get();
        return view('admin.couponList',compact('coupon'));
    }

    public function couponReadStatus($id){
        // $coupon1 = coupon::where('read_status',0)->get();
        // foreach($coupon1 as $row){
        //     $coupon2 = coupon::find($row->id);
        //     $coupon2->read_status = 1;
        //     $coupon2->save();
        // }

        $coupon2 = coupon::find($id);
        $coupon2->read_status = 1;
        $coupon2->save();

        $coupon = coupon::where('salon_id','!=','admin')->orderBy('id','DESC')->get();
        $user = User::where('role_id','admin')->where('status',1)->get();
        return view('admin.new_coupon',compact('coupon','user','id'));
    }

    public function addCoupon(){
        $service = service::all();
        $user = customer::all();
        return view('admin.addCoupon',compact('user','service'));
    }

    public function CouponSave(Request $request){
        $request->validate([
            'coupon_code'=>'required|unique:coupons',
            'description'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'discount_type'=>'required',
            'amount'=>'required',
        ]);
        // $service='';
        // if($request->discount_type == '1' || $request->discount_type == '2'){
        //     $serviceDummy;
        //     foreach($request->service_id as $row){
        //         $serviceDummy[]=$row;
        //     }
        //     $service = collect($serviceDummy)->implode(',');
        // }
        $user_id='';
        if($request->user_type == '1'){
            $user1;
            foreach($request->user_id as $row){
                $user1[]=$row;
            }
            $user_id = collect($user1)->implode(',');
        }

        $coupon = new coupon;
        $coupon->salon_id = 'admin';
        $coupon->coupon_code = $request->coupon_code;
        $coupon->description = $request->description;
        $coupon->start_date = date('Y-m-d',strtotime($request->start_date));
        $coupon->end_date = date('Y-m-d',strtotime($request->end_date));
        $coupon->discount_type = $request->discount_type;
        //$coupon->service_id = $service;
        $coupon->amount = $request->amount;
        //$coupon->max_value = $request->max_value;
        $coupon->limit_per_user = $request->limit_per_user;
        $coupon->min_order_val = $request->min_order_val;
        $coupon->user_type = $request->user_type;
        $coupon->user_id = $user_id;
        $coupon->status = 1;
        $coupon->save();
        return response()->json($coupon); 
    }
   
    public function CouponEdit($id){
        $coupon = coupon::find($id);
        return response()->json($coupon); 
    }

    public function viewCoupon($id){ 
        $service = service::all();
        $user = customer::all();
        return view('admin.addCoupon',compact('id','service','user'));
    }

    public function CouponUpdate(Request $request){
        $request->validate([
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$request->id,
            'description'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'discount_type'=>'required',
            'amount'=>'required',
        ]);
        // $service='';
        // if($request->discount_type == '1' || $request->discount_type == '2'){
        //     $serviceDummy;
        //     foreach($request->service_id as $row){
        //         $serviceDummy[]=$row;
        //     }
        //     $service = collect($serviceDummy)->implode(',');
        // }
        $user_id='';
        if($request->user_type == '1'){
            $user1;
            foreach($request->user_id as $row){
                $user1[]=$row;
            }
            $user_id = collect($user1)->implode(',');
        }

        $coupon = coupon::find($request->id);
        $coupon->coupon_code = $request->coupon_code;
        $coupon->description = $request->description;
        $coupon->start_date = date('Y-m-d',strtotime($request->start_date));
        $coupon->end_date = date('Y-m-d',strtotime($request->end_date));
        $coupon->discount_type = $request->discount_type;
        //$coupon->service_id = $service;
        $coupon->amount = $request->amount;
        //$coupon->max_value = $request->max_value;
        $coupon->limit_per_user = $request->limit_per_user;
        $coupon->min_order_val = $request->min_order_val;
        $coupon->user_type = $request->user_type;
        $coupon->user_id = $user_id;
        $coupon->save();
        return response()->json($coupon);
    }

    public function CouponDelete($id){
        $coupon = coupon::find($id);
        $coupon->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function get_coupon_service($id){ 
        //$data = newsletter::find($id);
        $data  = coupon::find($id);

        $service = service::all();

      $arraydata=array();
      foreach(explode(',',$data->service_id) as $user1){
        $arraydata[]=$user1;
      }
      $output = '<optgroup label="Select service">';
        foreach ($service as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->service_name_english.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->service_name_english.'</option>'; 
            }
        }
      $output .='</optgroup>';
      
      echo $output;
      
    }
    
    public function get_coupon_user($id){ 
        //$data = newsletter::find($id);
        $data  = coupon::find($id);

        $user = customer::all();

      $arraydata=array();
      foreach(explode(',',$data->user_id) as $user1){
        $arraydata[]=$user1;
      }
      $output = '<optgroup label="Select User">';
        foreach ($user as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->email.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->email.'</option>'; 
            }
        }
      $output .='</optgroup>';
      
      echo $output;
      
    }


    public function newCoupon(){
        $coupon = coupon::where('salon_id','!=','admin')->orderBy('id','DESC')->get();
        $user = User::where('role_id','admin')->where('status',1)->get();
        $id=0;
        return view('admin.new_coupon',compact('coupon','user','id'));
    }

    public function updateNewCoupon($id,$status){
        $coupon = coupon::find($id);
        $coupon->status = $status;
        $coupon->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }

    public function updateCouponRequest(Request $request){
        $request->validate([
            'deny_remark'=> 'required',
        ]);
        
        $coupon = coupon::find($request->id);
        $coupon->deny_remark = $request->deny_remark;
        $coupon->status = 2;
        $coupon->save();
        return response()->json('successfully update'); 
    }

}
