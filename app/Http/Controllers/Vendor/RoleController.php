<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\salon_role;
use Auth;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function saveRole(Request $request){
        $request->validate([
            'role_name'=>'required',
        ]);

        $salon_role = new salon_role;
        $salon_role->salon_id = Auth::user()->id;
        $salon_role->role_name = $request->role_name;
        $salon_role->dashboard = $request->dashboard;
        $salon_role->appointment = $request->appointment;
        $salon_role->calendor = $request->calendor;
        $salon_role->push_notification = $request->push_notification;
        $salon_role->service = $request->service;
        $salon_role->review = $request->review;
        $salon_role->coupon = $request->coupon;
        $salon_role->workers = $request->workers;
        $salon_role->reports = $request->reports;
        $salon_role->roles = $request->roles;
        $salon_role->save();
        return response()->json('successfully save'); 
    }
    public function updateRole(Request $request){
        $request->validate([
            'role_name'=> 'required',
        ]);
        
        $salon_role = salon_role::find($request->id);
        $salon_role->role_name = $request->role_name;
        $salon_role->dashboard = $request->dashboard;
        $salon_role->appointment = $request->appointment;
        $salon_role->calendor = $request->calendor;
        $salon_role->push_notification = $request->push_notification;
        $salon_role->service = $request->service;
        $salon_role->review = $request->review;
        $salon_role->coupon = $request->coupon;
        $salon_role->workers = $request->workers;
        $salon_role->reports = $request->reports;
        $salon_role->roles = $request->roles;
        $salon_role->save();
        return response()->json('successfully update'); 
    }

    public function Role(){
        $role = salon_role::where('salon_id', Auth::user()->user_id)->get();
        return view('vendor.role',compact('role'));
    }
    
    public function editRole($id){
        $salon_role = salon_role::find($id);
        return response()->json($salon_role); 
    }
    
    public function deleteRole($id){
        $salon_role = salon_role::find($id);
        $salon_role->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
