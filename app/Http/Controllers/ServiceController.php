<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\service;
use App\category;
use App\new_service;
use App\product;
use App\User;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveService(Request $request){
        $request->validate([
            'service_name_english'=>'required',
        ]);
        //image upload
        $fileName = null;
        if($request->file('image')!=""){
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        }  

        $service = new service;
        $service->service_name_english = $request->service_name_english;
        $service->service_name_arabic = $request->service_name_arabic;
        //$service->category_id = $request->category_id;
        $service->image = $fileName;
        $service->save();
        return response()->json('successfully save'); 
    }
    public function updateService(Request $request){
        $request->validate([
            'service_name_english'=> 'required',
        ]);
        
        $service = service::find($request->id);
        $service->service_name_english = $request->service_name_english;
        $service->service_name_arabic = $request->service_name_arabic;
        //$service->category_id = $request->category_id;

        if($request->image!=""){
            $old_image = "upload_files/".$request->image1;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            //image upload
            $fileName = null;
            if($request->file('image')!=""){
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
            }
        $service->image = $fileName;
        }

        $service->save();
        return response()->json('successfully update'); 
    }

    public function service(){
        $service = service::all();
        $category = category::all();
        return view('admin.service',compact('service','category'));
    }
    public function editService($id){
        $service = service::find($id);
        return response()->json($service); 
    }
    
    public function deleteService($id){
        $service = service::find($id);
        $old_image = "upload_files/".$service->image;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $service->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function newService(){
        $service = new_service::orderBy('id','DESC')->get();
        $salon = User::all();
        $id=0;
        return view('admin.new_service',compact('service','salon','id'));
    }

    public function serviceReadStatus($id){
        // $new_service1 = new_service::where('read_status',0)->get();
        // foreach($new_service1 as $row){
        //     $new_service2 = new_service::find($row->id);
        //     $new_service2->read_status = 1;
        //     $new_service2->save();
        // }

        $new_service2 = new_service::find($id);
        $new_service2->read_status = 1;
        $new_service2->save();

        $service = new_service::orderBy('id','DESC')->get();
        $salon = User::all();
        return view('admin.new_service',compact('service','salon','id'));
    }

    public function updateNewService($id,$status){
        $new_service = new_service::find($id);
        $new_service->status = $status;
        $new_service->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }

    public function productRequest(){
        $product = product::orderBy('id','DESC')->get();
        $salon = User::all();
        $id=0;
        return view('admin.product',compact('salon','product','id'));
    }

    public function updateProductRequest($id,$status){
        $product = product::find($id);
        $product->status = $status;
        $product->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }

    public function updateServiceRequest(Request $request){
        $request->validate([
            'deny_remark'=> 'required',
        ]);
        
        $new_service = new_service::find($request->id);
        $new_service->deny_remark = $request->deny_remark;
        $new_service->status = 2;
        $new_service->save();
        return response()->json('successfully update'); 
    }




}
