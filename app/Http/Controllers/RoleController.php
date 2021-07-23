<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function saveRole(Request $request){
        $request->validate([
            'role_name'=>'required',
        ]);

        $role = new role;
        $role->role_name = $request->role_name;
        $role->dashboard = $request->dashboard;
        $role->customer_read = $request->customer_read;
        $role->customer_create = $request->customer_create;
        $role->customer_edit = $request->customer_edit;
        $role->customer_delete = $request->customer_delete;
        $role->salon_read = $request->salon_read;
        $role->salon_create = $request->salon_create;
        $role->salon_edit = $request->salon_edit;
        $role->salon_delete = $request->salon_delete;
        $role->category_read = $request->category_read;
        $role->category_create = $request->category_create;
        $role->category_edit = $request->category_edit;
        $role->category_delete = $request->category_delete;
        $role->salon_package_read = $request->salon_package_read;
        $role->salon_package_create = $request->salon_package_create;
        $role->salon_package_edit = $request->salon_package_edit;
        $role->salon_package_delete = $request->salon_package_delete;
        $role->review_ratings_read = $request->review_ratings_read;
        $role->service_read = $request->service_read;
        $role->service_create = $request->service_create;
        $role->service_edit = $request->service_edit;
        $role->service_delete = $request->service_delete;
        $role->service_request_read = $request->service_request_read;
        $role->service_request_update = $request->service_request_update;
        $role->push_notification_read = $request->push_notification_read;
        $role->push_notification_create = $request->push_notification_create;
        $role->push_notification_edit = $request->push_notification_edit;
        $role->push_notification_delete = $request->push_notification_delete;
        $role->notification_request_read = $request->notification_request_read;
        $role->notification_request_update = $request->notification_request_update;
        $role->coupon_read = $request->coupon_read;
        $role->coupon_create = $request->coupon_create;
        $role->coupon_edit = $request->coupon_edit;
        $role->coupon_delete = $request->coupon_delete;
        $role->coupon_request_read = $request->coupon_request_read;
        $role->coupon_request_update = $request->coupon_request_update;
        $role->booking_read = $request->booking_read;
        $role->area_read = $request->area_read;
        $role->area_create = $request->area_create;
        $role->area_edit = $request->area_edit;
        $role->area_delete = $request->area_delete;
        $role->chat_to_salon_read = $request->chat_to_salon_read;
        $role->chat_to_customer_read = $request->chat_to_customer_read;
        $role->revenue_reports_read = $request->revenue_reports_read;
        $role->settlement_reports_read = $request->settlement_reports_read;
        $role->user_read = $request->user_read;
        $role->user_create = $request->user_create;
        $role->user_edit = $request->user_edit;
        $role->user_delete = $request->user_delete;
        $role->roles_read = $request->roles_read;
        $role->roles_create = $request->roles_create;
        $role->roles_edit = $request->roles_edit;
        $role->roles_delete = $request->roles_delete;
        $role->slider_read = $request->slider_read;
        $role->slider_create = $request->slider_create;
        $role->slider_edit = $request->slider_edit;
        $role->slider_delete = $request->slider_delete;
        $role->banner_read = $request->banner_read;
        $role->banner_create = $request->banner_create;
        $role->banner_edit = $request->banner_edit;
        $role->banner_delete = $request->banner_delete;
        $role->application_settings_read = $request->application_settings_read;
        $role->terms_and_condition_read = $request->terms_and_condition_read;
        $role->settlement_period_read = $request->settlement_period_read;
        $role->save();
        return response()->json('successfully save'); 
    }
    public function updateRole(Request $request){
        $request->validate([
            'role_name'=> 'required',
        ]);
        
        $role = role::find($request->id);
        $role->role_name = $request->role_name;
        $role->dashboard = $request->dashboard;
        $role->customer_read = $request->customer_read;
        $role->customer_create = $request->customer_create;
        $role->customer_edit = $request->customer_edit;
        $role->customer_delete = $request->customer_delete;
        $role->salon_read = $request->salon_read;
        $role->salon_create = $request->salon_create;
        $role->salon_edit = $request->salon_edit;
        $role->salon_delete = $request->salon_delete;
        $role->category_read = $request->category_read;
        $role->category_create = $request->category_create;
        $role->category_edit = $request->category_edit;
        $role->category_delete = $request->category_delete;
        $role->salon_package_read = $request->salon_package_read;
        $role->salon_package_create = $request->salon_package_create;
        $role->salon_package_edit = $request->salon_package_edit;
        $role->salon_package_delete = $request->salon_package_delete;
        $role->review_ratings_read = $request->review_ratings_read;
        $role->service_read = $request->service_read;
        $role->service_create = $request->service_create;
        $role->service_edit = $request->service_edit;
        $role->service_delete = $request->service_delete;
        $role->service_request_read = $request->service_request_read;
        $role->service_request_update = $request->service_request_update;
        $role->push_notification_read = $request->push_notification_read;
        $role->push_notification_create = $request->push_notification_create;
        $role->push_notification_edit = $request->push_notification_edit;
        $role->push_notification_delete = $request->push_notification_delete;
        $role->notification_request_read = $request->notification_request_read;
        $role->notification_request_update = $request->notification_request_update;
        $role->coupon_read = $request->coupon_read;
        $role->coupon_create = $request->coupon_create;
        $role->coupon_edit = $request->coupon_edit;
        $role->coupon_delete = $request->coupon_delete;
        $role->coupon_request_read = $request->coupon_request_read;
        $role->coupon_request_update = $request->coupon_request_update;
        $role->booking_read = $request->booking_read;
        $role->area_read = $request->area_read;
        $role->area_create = $request->area_create;
        $role->area_edit = $request->area_edit;
        $role->area_delete = $request->area_delete;
        $role->chat_to_salon_read = $request->chat_to_salon_read;
        $role->chat_to_customer_read = $request->chat_to_customer_read;
        $role->revenue_reports_read = $request->revenue_reports_read;
        $role->settlement_reports_read = $request->settlement_reports_read;
        $role->user_read = $request->user_read;
        $role->user_create = $request->user_create;
        $role->user_edit = $request->user_edit;
        $role->user_delete = $request->user_delete;
        $role->roles_read = $request->roles_read;
        $role->roles_create = $request->roles_create;
        $role->roles_edit = $request->roles_edit;
        $role->roles_delete = $request->roles_delete;
        $role->slider_read = $request->slider_read;
        $role->slider_create = $request->slider_create;
        $role->slider_edit = $request->slider_edit;
        $role->slider_delete = $request->slider_delete;
        $role->banner_read = $request->banner_read;
        $role->banner_create = $request->banner_create;
        $role->banner_edit = $request->banner_edit;
        $role->banner_delete = $request->banner_delete;
        $role->application_settings_read = $request->application_settings_read;
        $role->terms_and_condition_read = $request->terms_and_condition_read;
        $role->settlement_period_read = $request->settlement_period_read;
        $role->save();
        return response()->json('successfully update'); 
    }

    public function Role(){
        $role = role::all();
        return view('admin.role',compact('role'));
    }
    
    public function editRole($id){
        $role = role::find($id);
        return response()->json($role); 
    }
    
    public function deleteRole($id){
        $role = role::find($id);
        $role->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }
}
