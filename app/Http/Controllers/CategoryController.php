<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function saveCategory(Request $request){
        $request->validate([
            'category_name_english'=>'required',
        ]);
        //image upload
        $fileName = null;
        $fileName1 = null;
        if($request->file('icon')!=""){
            $image = $request->file('icon');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        } 

        if($request->file('image')!=""){
            $image = $request->file('image');
            $fileName1 = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName1);
        }  

        $category = new category;
        $category->category_name_english = $request->category_name_english;
        $category->category_name_arabic = $request->category_name_arabic;
        $category->category_id = '0';
        $category->icon = $fileName;
        $category->image = $fileName1;
        $category->save();
        return response()->json('successfully save'); 
    }
    public function updateCategory(Request $request){
        $request->validate([
            'category_name_english'=> 'required',
        ]);
        
        $category = category::find($request->id);
        $category->category_name_english = $request->category_name_english;
        $category->category_name_arabic = $request->category_name_arabic;
        $category->category_id = '0';
        
        if($request->icon!=""){
            $old_image = "upload_files/".$request->icon1;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            //image upload
            $fileName = null;
            if($request->file('icon')!=""){
            $image = $request->file('icon');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
            }
        $category->icon = $fileName;
        }

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
        $category->image = $fileName;
        }

        $category->save();
        return response()->json('successfully update'); 
    }

    public function Category(){
        $category = category::where('category_id',0)->get();
        return view('admin.category',compact('category'));
    }
    public function editCategory($id){
        $category = category::find($id);
        return response()->json($category); 
    }
    
    public function deleteCategory($id){
        $category = category::find($id);

        $old_image = "upload_files/".$category->image;
        $old_image1 = "upload_files/".$category->icon;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        if (file_exists($old_image1)) {
            @unlink($old_image1);
        }
        $category->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }




    public function saveSubCategory(Request $request){
        $request->validate([
            'category_name_english'=>'required',
        ]);
        //image upload
        $fileName = null;
        $fileName1 = null;
        if($request->file('icon')!=""){
            $image = $request->file('icon');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        } 

        if($request->file('image')!=""){
            $image = $request->file('image');
            $fileName1 = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName1);
        }  

        $category = new category;
        $category->category_name_english = $request->category_name_english;
        $category->category_name_arabic = $request->category_name_arabic;
        $category->category_id = $request->category_id;
        $category->icon = $fileName;
        $category->image = $fileName1;
        $category->save();
        return response()->json('successfully save'); 
    }

    public function updateSubCategory(Request $request){
        $request->validate([
            'category_name_english'=> 'required',
        ]);
        
        $category = category::find($request->id);
        $category->category_name_english = $request->category_name_english;
        $category->category_name_arabic = $request->category_name_arabic;
        $category->category_id = $request->category_id;
        
        if($request->icon!=""){
            $old_image = "upload_files/".$request->icon1;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            //image upload
            $fileName = null;
            if($request->file('icon')!=""){
            $image = $request->file('icon');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
            }
        $category->icon = $fileName;
        }

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
        $category->image = $fileName;
        }

        $category->save();
        return response()->json('successfully update'); 
    }

    public function SubCategory($id){
        $category = category::where('category_id',$id)->get();
        return view('admin.sub_category',compact('category','id'));
    }
    public function editSubCategory($id){
        $category = category::find($id);
        return response()->json($category); 
    }
    
    public function deleteSubCategory($id){
        $category = category::find($id);

        $old_image = "upload_files/".$category->image;
        $old_image1 = "upload_files/".$category->icon;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        if (file_exists($old_image1)) {
            @unlink($old_image1);
        }
        $category->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }




}
