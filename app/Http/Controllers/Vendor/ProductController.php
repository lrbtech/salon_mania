<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\new_service;
use App\service;
use App\service_time;
use App\salon_service;
use App\product;
use App\package;
use Auth;

use App\User;
use App\booking;

use App\terms_and_condition;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Product(){
        $service = service::all();
        $product = product::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.product',compact('product','service'));
    }


    public function saveProduct(Request $request){
        $request->validate([
            'product_name_english' => 'required|unique:products,product_name_english,NULL,id,salon_id,'.Auth::user()->user_id,
            'product_name_arabic'=> 'required',
            'price'=> 'required',
            'description'=> 'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            'image.required' => 'Product Image Field is Required',
        ]);

        $product = new product;
        $product->salon_id = Auth::user()->user_id;
        $product->price = $request->price;
        $product->product_name_english = $request->product_name_english;
        $product->product_name_arabic = $request->product_name_arabic;
        $product->description = $request->description;
        if($request->file('image')!=""){
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $product->image = $fileName;
        }
        $product->save();

        return response()->json('successfully save'); 
    }

    public function updateProduct(Request $request){
        $request->validate([
            'product_name_english' => 'required|unique:products,product_name_english,'.$request->id.',id,salon_id,'.Auth::user()->user_id,
            'product_name_arabic'=> 'required',
            'price'=> 'required',
            'description'=> 'required',
            'image' => 'mimes:jpeg,jpg,png|max:1000', // max 1000kb
          ],[
            'image.mimes' => 'Only jpeg, png and jpg images are allowed',
            'image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
            //'image.required' => 'Product Image Field is Required',
        ]);

        $product = product::find($request->id);
        $product->price = $request->price;
        $product->product_name_english = $request->product_name_english;
        $product->product_name_arabic = $request->product_name_arabic;
        $product->description = $request->description;
        if($request->file('image')!=""){
            $old_image = "upload_files/".$product->image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $product->image = $fileName;
        }
        $product->save();
        return response()->json('successfully update'); 
    }

    public function editProduct($id){
        $product = product::find($id);
        return response()->json($product); 
    }
    
    public function deleteProduct($id){
        $product = product::find($id);
        $old_image = "upload_files/".$product->image;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $product->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function deleteExclusive($id,$status){
        $product = product::find($id);
        $product->exclusive = $status;
        $product->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
