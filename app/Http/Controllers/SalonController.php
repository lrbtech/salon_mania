<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\review;
use App\customer;
use App\booking;
use App\area;
use App\User;
use App\service;
use App\service_time;
use App\salon_service;
use App\push_notification;
use App\salon_password;
use App\salon_package;
use App\used_package;
use App\package;
use App\gallery;
use App\country;
use Hash;
use DB;
use Mail;
use session;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class SalonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Salon(){
        $salon = User::where('role_id','admin')->get();
        $city = area::where('parent_id',0)->get();
        $area = area::where('parent_id','!=',0)->get();
        $country = country::all();
        $salon_package = salon_package::all();
        return view('admin.salon',compact('salon','salon_package','city','area','country'));
    }

    public function getSalon($id){

        if($id != '0'){
            $salon = User::where('role_id','admin')->where('busisness_type',$id)->get();
        }else{
            $salon = User::where('role_id','admin')->get();
        }        

        return Datatables::of($salon)
            ->addColumn('salon_id', function ($salon) {
                return '<td>#'.$salon->id.'</td>';
            })
            ->addColumn('salon_name', function ($salon) {
                if ($salon->salon_name != '') {
                    return '<td>#'.$salon->salon_name.'</td>';
                } else {
                    return '<td>#'.$salon->name.'</td>';
                }
            })
            ->addColumn('name', function ($salon) {
                return '<td>
                <p>' . $salon->name . '</p>
                </td>';
            })
            ->addColumn('phone', function ($salon) {
                $country = country::find($salon->country_id);
                if(!empty($country)){
                    return '<td><p>+' . $country->country_code . '' . $salon->phone . '</p></td>';
                }
                else{
                    return '<td><p>' . $salon->phone . '</p></td>';
                }
            })
            ->addColumn('membership', function ($salon) {
                $package = used_package::find($salon->package_id);
                if($salon->package_status == 0){
                    if(!empty($package)){
                        return '<td><p>' . $package->package_name . '</p></td>';
                    }
                }
                else{
                    return '<td><p>Package Expired</p></td>';
                }
            })
            ->addColumn('status', function ($salon) {
                if($salon->status == '0'){
                    return '<td><span class="text-warning">New User</span>';
                }
                elseif($salon->status == '1'){
                    return '<td><span class="text-success">Active</span>';
                }
                elseif($salon->status == '2'){
                    return '<td><span class="text-danger">Pack Ecpired</span>';
                }
                elseif($salon->status == '3'){
                    return '<td><span class="text-danger">Blocked</span>';
                }
            })
            ->addColumn('action', function ($salon) {
                $output='';
                if($salon->status == '0'){
                    $output.='<a onclick="ChangeStatus('.$salon->id.',1)" class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Active</a>';
                }
                elseif($salon->status == '1'){
                    $output.='<a onclick="ChangeStatus('.$salon->id.',1)" class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Active</a>';
                }
                elseif($salon->status == '2'){
                    $output.='<a onclick="ChangeStatus('.$salon->id.',3)" class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Block</a>';
                }
                elseif($salon->status == '3'){
                    $output.='<a onclick="ChangeStatus('.$salon->id.',1)" class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Active</a>';
                }  
                
                return'<td>
                    <div class="dropdown">
                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a onclick="Edit('.$salon->id.')" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                            <a onclick="Delete('.$salon->id.')" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                            <a target="_blank" class="dropdown-item" href="/admin/salon-login/'.$salon->id.'"><i class="bx bxs-chat mr-1"></i> Salon Login</a>
                            '.$output.'    
                            <a onclick="UpgradePlan('.$salon->id.')" class="dropdown-item"><i class="bx bxs-chat mr-1"></i> Upgrade Package</a>
                            <a class="dropdown-item" href="/admin/view-salon/'.$salon->id.'"><i class="bx bx-show-alt mr-1"></i> See Profile</a>
                        </div>
                    </div>
                </td>';
            })
           

        ->rawColumns(['salon_id','salon_name', 'name', 'phone','membership', 'status','action'])
        ->addIndexColumn()
        ->make(true);
    }
    
    public function viewSalon($id){
        $salon_id = $id;
        $salon = User::find($id);
        $salon_package = salon_package::find($salon->salon_package);
        $customer = customer::all();
        $salon_worker = User::where('user_id',$id)->where('role_id','!=','admin')->get();
        $gallery = gallery::where('salon_id',$id)->get();
        $all_salon = User::where('role_id','admin')->where('status',1)->get();
        $review = review::all();
        $service = service::all();
        $service_time = service_time::where('salon_id',$id)->get();
        $salon_service = salon_service::where('salon_id',$id)->get();
        $package = package::where('salon_id',$id)->get();
        $booking = booking::where('salon_id',$id)->get();
        return view('admin.view_salon',compact('salon','all_salon','service_time','salon_service','service','salon_id','review','salon_worker','gallery','package','customer','booking','salon_package'));
    }

    public function saveSalon(Request $request){
        $country = country::find($request->country_id);
        $phone_count=0;
        if(!empty($country)){
            $phone_count = $country->phone_count;
        }

        if($request->busisness_type != '5'){
            $request->validate([
                'trade_license_no'=>'required',
                'salon_name'=>'required',
                'trade_license' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'email'=> 'required|email|unique:users',
                'country_id'=>'required',
                'phone'=> 'required|numeric|digits:'.$phone_count.'|unique:users',
                'name'=>'required',
                'emirates_id'=>'required',
                'vat_certificate_no'=>'required',
                'gender'=>'required',
                'busisness_type'=>'required',
                'cover_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'profile_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                //'passport_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'emirated_id_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            ],[
                'salon_name.required' => 'Busisness Name Field is required',
                'trade_license.mimes' => 'Only jpeg, png and jpg images are allowed',
                'trade_license.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'trade_license.required' => 'Trade license Copy Field is Required',
                'gender.required' => 'Type Field is required',
                'country_id.required' => 'Country Field is required',
                'name.required' => 'Owner Name Field is required',
                'cover_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'cover_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'cover_image.required' => 'Cover Image Field is Required',
                'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'profile_image.required' => 'Profile Image Field is Required',
                // 'passport_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                // 'passport_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                // 'passport_copy.required' => 'Passport ID Proof  Field is Required',
                'emirated_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                'emirated_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'emirated_id_copy.required' => 'Emirated ID Proof Field is Required',
            ]);
        }
        else{
            $request->validate([
                'email'=> 'required|email|unique:users',
                'country_id'=>'required',
                'phone'=> 'required|numeric|digits:'.$phone_count.'|unique:users',
                'name'=>'required',
                'emirates_id'=>'required',
                'vat_certificate_no'=>'required',
                'gender'=>'required',
                'busisness_type'=>'required',
                'cover_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'profile_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                //'passport_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'emirated_id_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            ],[
                'gender.required' => 'Type Field is required',
                'country_id.required' => 'Country Field is required',
                'name.required' => 'Owner Name Field is required',
                'cover_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'cover_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'cover_image.required' => 'Cover Image Field is Required',
                'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'profile_image.required' => 'Profile Image Field is Required',
                // 'passport_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                // 'passport_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                // 'passport_copy.required' => 'Passport ID Proof  Field is Required',
                'emirated_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                'emirated_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'emirated_id_copy.required' => 'Emirated ID Proof Field is Required',
            ]);
        }

        //image upload
        $fileName = null;
        if($request->file('trade_license')!=""){
            $image = $request->file('trade_license');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        }

        $salon = new User;
        $salon->date = date('Y-m-d');
        $salon->busisness_type = $request->busisness_type;
        $salon->name = $request->name;
        $salon->email = $request->email;
        $salon->phone = $request->phone;
        $salon->gender = $request->gender;
        // $salon->password = Hash::make($request->password);
        $salon->salon_name = $request->salon_name;
        $salon->country_id = $request->country_id;
        $salon->salon_id = $request->salon_id;
        $salon->emirates_id = $request->emirates_id;
        $salon->trade_license_no = $request->trade_license_no;
        $salon->vat_certificate_no = $request->vat_certificate_no;
        $salon->passport_number = $request->passport_number;
        $salon->city = $request->city;
        $salon->address = $request->address;
        $salon->salon_package = $request->salon_package;
        //$salon->salon_commission = $request->salon_commission;
        $salon->status = 1;
        $salon->trade_license = $fileName;

        if($request->file('passport_copy')!=""){
            $fileName = null;
            $image = $request->file('passport_copy');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->passport_copy = $fileName;
        }
        if($request->file('emirated_id_copy')!=""){
            $fileName = null;
            $image = $request->file('emirated_id_copy');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->emirated_id_copy = $fileName;
        }
        if($request->file('cover_image')!=""){
            $fileName = null;
            $image = $request->file('cover_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->cover_image = $fileName;
        }
        if($request->file('profile_image')!=""){
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->profile_image = $fileName;
        }
        $salon->save();

        $user = User::find($salon->id);
        $user->role_id = 'admin';
        $user->user_id = $salon->id;
        $user->save();

        $days = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        for ($i = 0; $i < 7; $i++) {
            $service_time = new service_time;
            $service_time->salon_id = $salon->id;
            $service_time->days = $days[$i];
            $service_time->save();
        }

        $salon_password = new salon_password;
        $salon_password->date = date('Y-m-d');
        $salon_password->end_date = date('Y-m-d', strtotime("+14 days"));
        $salon_password->salon_id = $salon->id;
        $salon_password->salon_name = $salon->salon_name;
        $salon_password->owner_name = $salon->name;
        $salon_password->email = $salon->email;
        $salon_password->save();

        $package = salon_package::find($salon->salon_package);

        $used_package = new used_package;
        $used_package->salon_id = $salon->id;
        $used_package->package_id = $package->id;
        $used_package->package_name = $package->package_name;
        $used_package->price = $package->price;
        $used_package->duration_period = $package->duration_period;
        $used_package->duration = $package->duration;
        $used_package->no_of_service = $package->no_of_service;
        $used_package->no_of_product = $package->no_of_product;
        $used_package->no_of_package = $package->no_of_package;

        $days=0;
        if($package->duration_period == 1){
            $days = $package->duration * 28;
        }
        elseif($row->duration_period == 2){
            $days = $package->duration;
        }
        $today = date('Y-m-d');
        $used_package->apply_date = $today;
        $used_package->expire_date = date('Y-m-d', strtotime($today . '+'.$days.'days'));
        $used_package->no_of_days = $days;

        $used_package->save();


        $salon_update = User::find($salon->id);
        $salon_update->package_id = $used_package->id;
        $salon_update->package_status = 0;
        $salon_update->save();

        $all = $salon_password::find($salon_password->id);
        Mail::send('mail.salon_send_mail',compact('all'),function($message) use($all){
            $message->to($all['email'])->subject('Create your Own Password');
            $message->from('mail.lrbinfotech@gmail.com','Salon Mania Website');
        });

        return response()->json('successfully save'); 
    }

    public function updateSalon(Request $request){
        $country = country::find($request->country_id);
        $phone_count=0;
        if(!empty($country)){
            $phone_count = $country->phone_count;
        }

        if($request->busisness_type != '5'){
            $request->validate([
                'trade_license_no'=>'required',
                'salon_name'=>'required',
                'trade_license' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'email'=>'required|unique:users,email,'.$request->id,
                'country_id'=>'required',
                'phone'=> 'required|numeric|digits:'.$phone_count.'|unique:users,phone,'.$request->id,
                'name'=>'required',
                'emirates_id'=>'required',
                'vat_certificate_no'=>'required',
                'gender'=>'required',
                'busisness_type'=>'required',
                'cover_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'profile_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                //'passport_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'emirated_id_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            ],[
                'salon_name.required' => 'Busisness Name Field is required',
                'trade_license.mimes' => 'Only jpeg, png and jpg images are allowed',
                'trade_license.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'trade_license.required' => 'Trade license Copy Field is Required',
                'gender.required' => 'Type Field is required',
                'country_id.required' => 'Country Field is required',
                'name.required' => 'Owner Name Field is required',
                'cover_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'cover_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'cover_image.required' => 'Cover Image Field is Required',
                'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'profile_image.required' => 'Profile Image Field is Required',
                // 'passport_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                // 'passport_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                // 'passport_copy.required' => 'Passport ID Proof  Field is Required',
                'emirated_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                'emirated_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'emirated_id_copy.required' => 'Emirated ID Proof Field is Required',
            ]);
        }
        else{
            $request->validate([
                'email'=>'required|unique:users,email,'.$request->id,
                'country_id'=>'required',
                'phone'=> 'required|numeric|digits:'.$phone_count.'|unique:users,phone,'.$request->id,
                'name'=>'required',
                'emirates_id'=>'required',
                'vat_certificate_no'=>'required',
                'gender'=>'required',
                'busisness_type'=>'required',
                'cover_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'profile_image' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                //'passport_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
                'emirated_id_copy' => 'required|mimes:jpeg,jpg,png,pdf|max:1000', // max 1000kb
            ],[
                'gender.required' => 'Type Field is required',
                'country_id.required' => 'Country Field is required',
                'name.required' => 'Owner Name Field is required',
                'cover_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'cover_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'cover_image.required' => 'Cover Image Field is Required',
                'profile_image.mimes' => 'Only jpeg, png and jpg images are allowed',
                'profile_image.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'profile_image.required' => 'Profile Image Field is Required',
                // 'passport_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                // 'passport_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                // 'passport_copy.required' => 'Passport ID Proof  Field is Required',
                'emirated_id_copy.mimes' => 'Only jpeg, png and jpg images are allowed',
                'emirated_id_copy.max' => 'Sorry! Maximum allowed size for an image is 1MB',
                'emirated_id_copy.required' => 'Emirated ID Proof Field is Required',
            ]);
        }

        $salon = User::find($request->id);
        $salon->busisness_type = $request->busisness_type;
        $salon->name = $request->name;
        $salon->email = $request->email;
        $salon->phone = $request->phone;
        $salon->gender = $request->gender;
     //    if($request->password != ''){
     //    $salon->password = Hash::make($request->password);
        // }
        $salon->city = $request->city;
        $salon->trade_license_no = $request->trade_license_no;
        $salon->vat_certificate_no = $request->vat_certificate_no;
        $salon->address = $request->address;
        $salon->salon_name = $request->salon_name;
        $salon->country_id = $request->country_id;
        $salon->salon_id = $request->salon_id;
        $salon->emirates_id = $request->emirates_id;
        $salon->passport_number = $request->passport_number;
        //$salon->salon_package = $request->salon_package;
        //$salon->salon_commission = $request->salon_commission;
        //$salon->status = 1;
        
        
        if($request->file('trade_license')!=""){
            $old_image = "upload_files/".$salon->trade_license;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('trade_license');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->trade_license = $fileName;
        }

        if($request->file('passport_copy')!=""){
            $old_image = "upload_files/".$salon->passport_copy;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('passport_copy');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->passport_copy = $fileName;
        }

        if($request->file('emirated_id_copy')!=""){
            $old_image = "upload_files/".$salon->emirated_id_copy;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('emirated_id_copy');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->emirated_id_copy = $fileName;
        }

        if($request->file('cover_image')!=""){
            $old_image = "upload_files/".$salon->cover_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('cover_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->cover_image = $fileName;
        }

        if($request->file('profile_image')!=""){
            $old_image = "upload_files/".$salon->profile_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('profile_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $salon->profile_image = $fileName;
        }

        $salon->save();
        return response()->json('successfully update'); 
    }
    

    public function editSalon($id){
        $salon = User::find($id);
        return response()->json($salon); 
    }
    
    public function deleteSalon($id){
        $salon = User::find($id);
        $old_image = "upload_files/".$salon->trade_license;
        if (file_exists($old_image)) {
            @unlink($old_image);
        }
        $salon->delete();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }


    public function ChangeStatus($id,$status){
        $salon = User::find($id);
        $salon->status = 1;
        $salon->save();
        return response()->json(['message'=>'Successfully Delete'],200); 
    }



    public function saveAddService(Request $request){
        $salon_service = new salon_service;
        $salon_service->salon_id = $request->salon_id;
        $salon_service->service_id = $request->service_id;
        $salon_service->price = $request->price;
        $salon_service->duration = $request->duration;
        $salon_service->save();

        return response()->json('successfully save'); 
    }
    public function updateAddService(Request $request){
        $salon_service = salon_service::find($request->id);
        $salon_service->salon_id = $request->salon_id;
        $salon_service->service_id = $request->service_id;
        $salon_service->price = $request->price;
        $salon_service->duration = $request->duration;
        $salon_service->save();
        return response()->json('successfully update'); 
    }

    public function editAddService($id){
        $salon_service = salon_service::find($id);
        return response()->json($salon_service); 
    }
    
    public function deleteAddService($id){
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

    public function updateLocation(Request $request){
        $salon = User::find($request->up_salon_id);
        $salon->latitude = $request->latitude;
        $salon->longitude = $request->longitude;
        $salon->save();
        return response()->json('Successfully Update'); 
    }

    public function salonNotification(){
        $salon_push_notification = push_notification::all();
        $salon = User::all();
        $id=0;
        return view('admin.salon_notification',compact('salon_push_notification','salon','id'));
    }

    public function updateSalonNotification($id,$status){
        $push_notification = push_notification::find($id);
        $push_notification->status = $status;
        $push_notification->save();
        return response()->json(['message'=>'Successfully Update'],200); 
    }

    public function updateNotificationRequest(Request $request){
        $request->validate([
            'deny_remark'=> 'required',
        ]);
        
        $push_notification = push_notification::find($request->id);
        $push_notification->deny_remark = $request->deny_remark;
        $push_notification->status = 2;
        $push_notification->save();
        return response()->json('successfully update'); 
    }


    public function getPackagePlan($id){ 
    
    $salon = User::find($id);
    
    $data = salon_package::all();

$output ='';
foreach ($data as $key => $value) {
    if($value->id == $salon->salon_package){
        $output .= '<input checked type="radio" name="upgrade_plan" id="'.$value->id.'" value="'.$value->id.'"><label class="four col" for="'.$value->id.'">'.$value->package_name.'</label>';
    }
    else{
        $output .= '<input  type="radio" name="upgrade_plan" id="'.$value->id.'" value="'.$value->id.'"><label class="four col" for="'.$value->id.'">'.$value->package_name.'</label>';
    }

}
      
      echo $output;
      
    }


    public function updatePlan(Request $request){

        $package = salon_package::find($request->upgrade_plan);

        $used_package = new used_package;
        $used_package->salon_id = $request->id;
        $used_package->package_id = $package->id;
        $used_package->package_name = $package->package_name;
        $used_package->price = $package->price;
        $used_package->duration_period = $package->duration_period;
        $used_package->duration = $package->duration;
        $used_package->no_of_service = $package->no_of_service;
        $used_package->no_of_product = $package->no_of_product;
        $used_package->no_of_package = $package->no_of_package;

        $days=0;
        if($package->duration_period == 1){
            $days = $package->duration * 28;
        }
        elseif($row->duration_period == 2){
            $days = $package->duration;
        }
        $today = date('Y-m-d');
        $used_package->apply_date = $today;
        $used_package->expire_date = date('Y-m-d', strtotime($today . '+'.$days.'days'));
        $used_package->no_of_days = $days;

        $used_package->save();

        $user = User::find($request->id);
        $user->package_id = $used_package->id;
        $user->package_status = 0;
        $user->save();

        return response()->json('successfully save'); 
    }


    public function saveServicePackage(Request $request){
        $request->validate([
            'package_name_english'=> 'required',
            'package_name_arabic'=> 'required',
            'price'=> 'required',
            //'service_ids'=> 'required',
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
            $old_image = "upload_files/".$profile->image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload_files/'), $fileName);
        $package->image = $fileName;
        }
        $package->save();

        return response()->json('successfully save'); 
    }

    public function updateServicePackage(Request $request){
        $request->validate([
            'package_name_english'=> 'required',
            'package_name_arabic'=> 'required',
            //'service_ids.*'=> 'required',
        ]);

        $service_ids='';
        $service_id;
        foreach($request->service_ids as $row){
            $service_id[]=$row;
        }
        $service_ids = collect($service_id)->implode(',');

        $package = package::find($request->package_id);
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
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
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
