<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\area;
use App\country;


class AreaController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveCity(Request $request){
        $request->validate([
            'area'=>'required',
        ]); 

        $area = new area;
        $area->area = $request->area;
        $area->parent_id = 0;
        $area->save();
        return response()->json('successfully save'); 
    }
    public function updateCity(Request $request){
        $request->validate([
            'area'=> 'required',
        ]);
        
        $area = area::find($request->id);
        $area->area = $request->area;
        $area->parent_id = 0;
        $area->save();
        return response()->json('successfully update'); 
    }

    public function City(){
        $area = area::where('parent_id',0)->get();
        return view('admin.city',compact('area'));
    }
    public function editCity($id){
        $area = area::find($id);
        return response()->json($area); 
    }
    
    public function deleteCity($id){
        $area = area::find($id);
        $area->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }



    public function saveCountry(Request $request){
        $this->validate($request, [
            'country_code'=>'required',
            'country_name_english'=>'required',
            'country_name_arabic'=>'required',
            'phone_count'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Item Image Field is Required',
        ]);
        
        $country = new country;
        $country->country_code = $request->country_code;
        $country->country_name_english = $request->country_name_english;
        $country->country_name_arabic = $request->country_name_arabic;
        $country->phone_count = $request->phone_count;
        if($request->image!=""){
            if($request->file('image')!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $country->image = $upload_image;
            }
        }

        $country->save();
        return response()->json('successfully save'); 
    }

    public function updateCountry(Request $request){
        $this->validate($request, [
            'country_code'=>'required',
            'country_name_english'=>'required',
            'country_name_arabic'=>'required',
            'phone_count'=>'required',
            'image' => 'mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Item Image Field is Required',
        ]);
        
        $country = country::find($request->id);
        $country->country_code = $request->country_code;
        $country->country_name_english = $request->country_name_english;
        $country->country_name_arabic = $request->country_name_arabic;
        $country->phone_count = $request->phone_count;
        if($request->image!=""){
            $old_image = "upload_files/".$item->image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            if($request->file('image')!=""){
            $image = $request->file('image');
            $upload_image = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $upload_image);
            $country->image = $upload_image;
            }
        }
        $country->save();
        return response()->json('successfully update'); 
    }

    public function Country(){
        $country = country::all();
        return view('admin.country',compact('country'));
    }

    public function editCountry($id){
        $country = country::find($id);
        return response()->json($country); 
    }
    
    public function deleteCountry($id){
        $country = country::find($id);
        $country->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }




}
