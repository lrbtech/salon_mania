<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\new_service;
use App\service;
use App\service_time;
use App\salon_service;
use App\package;
use Auth;

use App\User;
use App\booking;

use App\terms_and_condition;


class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){    
        $today = date('Y-m-d');
        $cfdate = date('Y-m-d',strtotime('first day of this month'));
        $cldate = date('Y-m-d',strtotime('last day of this month'));
  
        $sevendays = date('Y-m-d',strtotime("$today -7 day"));
          $thirtydays = date('Y-m-d',strtotime("$today -30 day"));
    
        $total_booking = booking::where('salon_id',Auth::user()->user_id)->count();
        $today_booking = booking::where('salon_id',Auth::user()->user_id)->where('date', $today)->count();
        $open_booking = booking::where('salon_id',Auth::user()->user_id)->where('booking_status', 0)->count();
        
        $today_value = booking::where('salon_id',Auth::user()->user_id)->where('date', $today)->get()->sum("total");
        $current_month_value = booking::where('salon_id',Auth::user()->user_id)->whereBetween('date', [$cfdate, $cldate])->get()->sum("total");
  
        $last7days = booking::where('salon_id',Auth::user()->user_id)->whereBetween('date', [$sevendays, $today])->get()->sum("total");
        $last30days = booking::where('salon_id',Auth::user()->user_id)->whereBetween('date', [$thirtydays, $today])->get()->sum("total");
  
        $total_services = salon_service::where('salon_id',Auth::user()->user_id)->count();    
  
  
        return view('vendor.dashboard',compact('total_booking','today_booking','open_booking','today_value','current_month_value','last7days','last30days','total_services'));
    }
    
    public function saveService(Request $request){
        $request->validate([
            'service_name'=> 'required',
            'price'=> 'required',
            'duration'=> 'required',
        ]);

        $new_service = new new_service;
        $new_service->service_name = $request->service_name;
        $new_service->price = $request->price;
        $new_service->duration = $request->duration;
        $new_service->remark = $request->remark;
        $new_service->salon_id = Auth::user()->user_id;
        $new_service->save();
        return response()->json('successfully save'); 
    }
    
    public function updateService(Request $request){
        $request->validate([
            'service_name'=> 'required',
            'price'=> 'required',
            'duration'=> 'required',
        ]);
        
        $new_service = new_service::find($request->id);
        $new_service->service_name = $request->service_name;
        $new_service->price = $request->price;
        $new_service->duration = $request->duration;
        $new_service->remark = $request->remark;
        $new_service->save();
        return response()->json('successfully update'); 
    }

    public function service(){
        $service = new_service::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.service',compact('service'));
    }
    
    public function editService($id){
        $service = new_service::find($id);
        return response()->json($service); 
    }
    
    public function deleteService($id){
        $service = new_service::find($id);
        $service->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function ServicePayment(){
        $service = service::all();
        $salon_service = salon_service::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.service_payment',compact('service','salon_service'));
    }

    public function saveServicePayment(Request $request){
        $request->validate([
            'service_id' => 'required|unique:salon_services,service_id,NULL,id,salon_id,'.Auth::user()->user_id,
            'duration'=> 'required',
            'price'=> 'required',
        ]);
        $salon_service = new salon_service;
        $salon_service->salon_id = Auth::user()->user_id;
        $salon_service->service_id = $request->service_id;
        $salon_service->price = $request->price;
        $salon_service->duration = $request->duration;
        $salon_service->save();

        return response()->json('successfully save'); 
    }

    public function updateServicePayment(Request $request){
        $request->validate([
            'service_id' => 'required|unique:salon_services,service_id,'.$request->id.',id,salon_id,'.Auth::user()->user_id,
            'duration'=> 'required',
            'price'=> 'required',
        ]);
        $salon_service = salon_service::find($request->id);
        $salon_service->salon_id = Auth::user()->user_id;
        $salon_service->service_id = $request->service_id;
        $salon_service->price = $request->price;
        $salon_service->duration = $request->duration;
        $salon_service->save();
        return response()->json('successfully update'); 
    }

    public function editServicePayment($id){
        $salon_service = salon_service::find($id);
        return response()->json($salon_service); 
    }
    
    public function deleteServicePayment($id){
        $salon_service = salon_service::find($id);
        $salon_service->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function updateTime(Request $request){
        for ($x=0; $x<count($_POST['timing_id']); $x++) 
        {
            $service_time = service_time::find($_POST['timing_id'][$x]);
            $service_time->open_time = $_POST['open_time'][$x];
            $service_time->close_time = $_POST['close_time'][$x];
            $service_time->status = $_POST['status'][$x];
            $service_time->save();
        }
        return response()->json('Successfully Update'); 
    }


    public function ServicePackage(){
        $service = service::all();
        $package = package::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.service_package',compact('package','service'));
    }


    public function saveServicePackage(Request $request){
        $request->validate([
            'package_name_english' => 'required|unique:packages,package_name_english,NULL,id,salon_id,'.Auth::user()->user_id,
            'package_name_arabic'=> 'required',
            'price'=> 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Package Image Field is Required',
        ]);

        $service_ids='';
        $service_id;
        foreach($request->service_ids as $row){
            $service_id[]=$row;
        }
        $service_ids = collect($service_id)->implode(',');

        $package = new package;
        $package->salon_id = Auth::user()->user_id;
        $package->service_ids = $service_ids;
        $package->price = $request->price;
        $package->package_name_english = $request->package_name_english;
        $package->package_name_arabic = $request->package_name_arabic;
        if($request->file('image')!=""){
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $package->image = $fileName;
        }
        $package->save();

        return response()->json('successfully save'); 
    }

    public function updateServicePackage(Request $request){
        $request->validate([
            'package_name_english' => 'required|unique:packages,package_name_english,'.$request->id.',id,salon_id,'.Auth::user()->user_id,
            'package_name_arabic'=> 'required',
            'price'=> 'required',
            'image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Package Image Field is Required',
        ]);

        $service_ids='';
        $service_id;
        foreach($request->service_ids as $row){
            $service_id[]=$row;
        }
        $service_ids = collect($service_id)->implode(',');

        $package = package::find($request->id);
        $package->service_ids = $service_ids;
        $package->price = $request->price;
        $package->package_name_english = $request->package_name_english;
        $package->package_name_arabic = $request->package_name_arabic;
        if($request->file('image')!=""){
            $old_image = "upload_files/".$package->image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $package->image = $fileName;
        }
        $package->save();
        return response()->json('successfully update'); 
    }

    public function editServicePackage($id){
        $package = package::find($id);
        return response()->json($package); 
    }
    
    public function deleteServicePackage($id){
        $package = package::find($id);
        $old_image = "upload_files/".$package->image;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $package->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function getPackageServices($id){ 
        $data  = package::find($id);

        $service = service::all();

      $arraydata=array();
      foreach(explode(',',$data->service_ids) as $service_id){
        $arraydata[]=$service_id;
      }
      $output = '';
        foreach ($service as $value){
            if(in_array($value->id , $arraydata))
            {
                $output .='<option selected="true" value="'.$value->id.'">'.$value->service_name_english.'</option>'; 
            }
            else{
                $output .='<option value="'.$value->id.'">'.$value->service_name_english.'</option>'; 
            }
        }
      
      echo $output;
      
    }



}
