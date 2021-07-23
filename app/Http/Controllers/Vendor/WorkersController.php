<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\service;
use App\gallery;
use App\salon_role;
use Hash;
use Auth;
class WorkersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function saveWorkers(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:users',
            'role_id'=>'required',
            'certification_image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'certification_image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'certification_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'certification_image.required' => 'Certification Image Field is Required',
        ]);

        $service_ids='';
        $service_id;
        foreach($request->service_ids as $row){
            $service_id[]=$row;
        }
        $service_ids = collect($service_id)->implode(',');

        $salon_worker = new User;
        $salon_worker->name = $request->name;
        $salon_worker->phone = $request->phone;
        $salon_worker->email = $request->email;
        $salon_worker->role_id = $request->role_id;
        $salon_worker->service_ids = $service_ids;
        $salon_worker->user_id = Auth::user()->user_id;
        $salon_worker->password = Hash::make($request->password);
        if($request->file('certification_image')!=""){
            $fileName = null;
            $image = $request->file('certification_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon_worker->certification_image = $fileName;
        }
        $salon_worker->save();
        return response()->json('successfully save'); 
    }

    public function updateWorkers(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$request->id,
            'role_id'=>'required',
            'certification_image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'certification_image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'certification_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
        ]);

        $service_ids='';
        $service_id;
        foreach($request->service_ids as $row){
            $service_id[]=$row;
        }
        $service_ids = collect($service_id)->implode(',');
        
        $salon_worker = User::find($request->id);
        $salon_worker->name = $request->name;
        $salon_worker->phone = $request->phone;
        $salon_worker->role_id = $request->role_id;
        $salon_worker->service_ids = $service_ids;
        $salon_worker->email = $request->email;
        if($request->password != ''){
        $salon_worker->password = Hash::make($request->password);
    	}
        if($request->file('certification_image')!=""){
            $old_image = "upload_files/".$salon_worker->certification_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('certification_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon_worker->certification_image = $fileName;
        }
        $salon_worker->save();
        return response()->json('successfully update'); 
    }

    public function Workers(){
        $salon_worker = User::where('role_id', '!=' ,'admin')->where('user_id',Auth::user()->user_id)->get();

        $salon_role = salon_role::where('salon_id',Auth::user()->user_id)->get();
        $service = service::all();
        return view('vendor.workers',compact('salon_worker','service','salon_role'));
    }
    
    public function editWorkers($id){
        $salon_worker = User::find($id);
        return response()->json($salon_worker); 
    }
    
    public function deleteWorkers($id){
        $salon_worker = User::find($id);
        $salon_worker->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function getWorkersServices($id){ 
        $data  = User::find($id);

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


    public function editProfile(){
        $profile = User::find(Auth::user()->id);
        return view('vendor.edit_profile',compact('profile'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name'=> 'required',
            'email'=>'required|unique:users,email,'.$request->id,
            'phone'=>'required|unique:users,phone,'.$request->id,
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6'
        ]);
        
        $profile = User::find($request->id);
        $profile->name = $request->name;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->website = $request->website;
        $profile->about_english = $request->about_english;
        $profile->about_arabic = $request->about_arabic;
        $profile->email = $request->email;
        if($request->password != ''){
        $profile->password = Hash::make($request->password);
        }
        if($request->file('cover_image')!=""){
            $old_image = "upload_files/".$profile->cover_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('cover_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $profile->cover_image = $fileName;
        }

        if($request->file('profile_image')!=""){
            $old_image = "upload_files/".$profile->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $profile->profile_image = $fileName;
        }
        $profile->save();
        return response()->json('successfully update'); 
    }



    public function saveGallery(Request $request){
        $request->validate([
            'name'=> 'required',
        ]);

        $gallery = new gallery;
        $gallery->salon_id = Auth::user()->user_id;
        $gallery->name = $request->name;
        if($request->file('image')!=""){
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_gallery/'), $fileName);
        $gallery->image = $fileName;
        }
        $gallery->save();
        return response()->json('successfully save'); 
    }

    public function Gallery(){
        $gallery = gallery::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.gallery',compact('gallery'));
    }
    
    public function deleteGallery($id){
        $gallery = gallery::find($id);
        $gallery->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


}
