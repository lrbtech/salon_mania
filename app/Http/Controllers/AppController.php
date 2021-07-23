<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\settlement_period;
use App\admin;
use App\settings;
use App\User;
use App\customer;
use App\role;
use App\booking;
use App\payments_in;
use App\payments_out;
use App\app_salon;
use App\app_spa;
use App\app_beauty;
use App\app_makeup;
use App\app_home;
use App\area;
use Hash;
use App\service;
use App\salon_service;
use session;
use Auth;
use DB;

class AppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AppSalon(){
        $city = area::where('parent_id',0)->get();
        return view('admin.app_salon_city',compact('city'));
    }

    public function getAppSalon($id){
        $salon = User::where('role_id','admin')->where('busisness_type',1)->where('status',1)->where("city",$id)->get();
        $app_salon =DB::table('app_salons as a')
        ->join('users as u', 'u.id', '=', 'a.salon_id')
        ->select('a.*','u.salon_name','u.name')
        ->where('a.city_id',$id)
        ->orderBy('a.order_id','asc')
        ->get();
        $city = area::find($id);
        return view('admin.app_salon',compact('app_salon','salon','city'));
    }

    public function updateAppSalon(Request $request)
    {
        foreach ($request->value as $key => $value) 
        {
            $order_id=$key+1;
            $app_salon = app_salon::find($value);
            $app_salon->order_id = $order_id;
            $app_salon->save();
        }
        return response()->json(['message'=>'Successfully Update'],200);
    }

    public function saveAppSalon(Request $request){
        $request->validate([
            //'salon_id'=>'required|unique:app_salons',
            'salon_id' => 'required|unique:app_salons,salon_id,NULL,id,city_id,'.$request->city_id
        ]); 
        $count = app_salon::where("city_id",$request->city_id)->count();
        $app_salon = new app_salon;
        $app_salon->order_id = $count + 1;
        $app_salon->city_id = $request->city_id;
        $app_salon->salon_id = $request->salon_id;
        $app_salon->save();
        return response()->json('successfully save'); 
    }

    public function deleteAppSalon($id){
        $app_salon = app_salon::find($id);
        $app_salon->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function AppSpa(){
        $city = area::where('parent_id',0)->get();
        return view('admin.app_spa_city',compact('city'));
    }

    public function getAppSpa($id){
        $salon = User::where('role_id','admin')->where('busisness_type',2)->where('status',1)->where("city",$id)->get();
        $app_spa =DB::table('app_spas as a')
        ->join('users as u', 'u.id', '=', 'a.salon_id')
        ->select('a.*','u.salon_name','u.name')
        ->where('a.city_id',$id)
        ->orderBy('a.order_id','asc')
        ->get();
        $city = area::find($id);
        return view('admin.app_spa',compact('app_spa','salon','city'));
    }

    public function updateAppSpa(Request $request)
    {
        foreach ($request->value as $key => $value) 
        {
            $order_id=$key+1;
            $app_spa = app_spa::find($value);
            $app_spa->order_id = $order_id;
            $app_spa->save();
        }
        return response()->json(['message'=>'Successfully Update'],200);
    }

    public function saveAppSpa(Request $request){
        $request->validate([
            //'salon_id'=>'required|unique:app_spas',
            'salon_id' => 'required|unique:app_spas,salon_id,NULL,id,city_id,'.$request->city_id
        ]); 
        $count = app_spa::where("city_id",$request->city_id)->count();
        $app_spa = new app_spa;
        $app_spa->order_id = $count + 1;
        $app_spa->city_id = $request->city_id;
        $app_spa->salon_id = $request->salon_id;
        $app_spa->save();
        return response()->json('successfully save'); 
    }

    public function deleteAppSpa($id){
        $app_spa = app_spa::find($id);
        $app_spa->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function AppBeauty(){
        $city = area::where('parent_id',0)->get();
        return view('admin.app_beauty_city',compact('city'));
    }

    public function getAppBeauty($id){
        $salon = User::where('role_id','admin')->where('busisness_type',4)->where('status',1)->where("city",$id)->get();
        $app_beauty =DB::table('app_beauties as a')
        ->join('users as u', 'u.id', '=', 'a.salon_id')
        ->select('a.*','u.salon_name','u.name')
        ->where('a.city_id',$id)
        ->orderBy('a.order_id','asc')
        ->get();
        $city = area::find($id);
        return view('admin.app_beauty',compact('app_beauty','salon','city'));
    }

    public function updateAppBeauty(Request $request)
    {
        foreach ($request->value as $key => $value) 
        {
            $order_id=$key+1;
            $app_beauty = app_beauty::find($value);
            $app_beauty->order_id = $order_id;
            $app_beauty->save();
        }
        return response()->json(['message'=>'Successfully Update'],200);
    }

    public function saveAppBeauty(Request $request){
        $request->validate([
            //'salon_id'=>'required|unique:app_beauties',
            'salon_id' => 'required|unique:app_beauties,salon_id,NULL,id,city_id,'.$request->city_id
        ]); 
        $count = app_beauty::where("city_id",$request->city_id)->count();
        $app_beauty = new app_beauty;
        $app_beauty->order_id = $count + 1;
        $app_beauty->city_id = $request->city_id;
        $app_beauty->salon_id = $request->salon_id;
        $app_beauty->save();
        return response()->json('successfully save'); 
    }

    public function deleteAppBeauty($id){
        $app_beauty = app_beauty::find($id);
        $app_beauty->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function AppMakeup(){
        $city = area::where('parent_id',0)->get();
        return view('admin.app_makeup_city',compact('city'));
    }

    public function getAppMakeup($id){
        $salon = User::where('role_id','admin')->where('busisness_type',3)->where('status',1)->where("city",$id)->get();
        $app_makeup =DB::table('app_makeups as a')
        ->join('users as u', 'u.id', '=', 'a.salon_id')
        ->select('a.*','u.salon_name','u.name')
        ->where('a.city_id',$id)
        ->orderBy('a.order_id','asc')
        ->get();
        $city = area::find($id);
        return view('admin.app_makeup',compact('app_makeup','salon','city'));
    }

    public function updateAppMakeup(Request $request)
    {
        foreach ($request->value as $key => $value) 
        {
            $order_id=$key+1;
            $app_makeup = app_makeup::find($value);
            $app_makeup->order_id = $order_id;
            $app_makeup->save();
        }
        return response()->json(['message'=>'Successfully Update'],200);
    }

    public function saveAppMakeup(Request $request){
        $request->validate([
            //'salon_id'=>'required|unique:app_makeups',
            'salon_id' => 'required|unique:app_makeups,salon_id,NULL,id,city_id,'.$request->city_id
        ]); 
        $count = app_makeup::where("city_id",$request->city_id)->count();
        $app_makeup = new app_makeup;
        $app_makeup->order_id = $count + 1;
        $app_makeup->city_id = $request->city_id;
        $app_makeup->salon_id = $request->salon_id;
        $app_makeup->save();
        return response()->json('successfully save'); 
    }

    public function deleteAppMakeup($id){
        $app_makeup = app_makeup::find($id);
        $app_makeup->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

    public function AppHome(){
        $city = area::where('parent_id',0)->get();
        return view('admin.app_home_city',compact('city'));
    }

    public function getAppHome($id){
        $salon = User::where('role_id','admin')->where('busisness_type',5)->where('status',1)->where("city",$id)->get();
        $app_home =DB::table('app_homes as a')
        ->join('users as u', 'u.id', '=', 'a.salon_id')
        ->select('a.*','u.salon_name','u.name')
        ->where('a.city_id',$id)
        ->orderBy('a.order_id','asc')
        ->get();
        $city = area::find($id);
        return view('admin.app_home',compact('app_home','salon','city'));
    }

    public function updateAppHome(Request $request)
    {
        foreach ($request->value as $key => $value) 
        {
            $order_id=$key+1;
            $app_home = app_home::find($value);
            $app_home->order_id = $order_id;
            $app_home->save();
        }
        return response()->json(['message'=>'Successfully Update'],200);
    }

    public function saveAppHome(Request $request){
        $request->validate([
            //'salon_id'=>'required|unique:app_homes',
            'salon_id' => 'required|unique:app_homes,salon_id,NULL,id,city_id,'.$request->city_id
        ]); 
        $count = app_home::where("city_id",$request->city_id)->count();
        $app_home = new app_home;
        $app_home->order_id = $count + 1;
        $app_home->city_id = $request->city_id;
        $app_home->salon_id = $request->salon_id;
        $app_home->save();
        return response()->json('successfully save'); 
    }

    public function deleteAppHome($id){
        $app_home = app_home::find($id);
        $app_home->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }

}
