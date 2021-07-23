<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\booking;
use App\salon_service;
use App\service;
use App\terms_and_condition;
use Auth;

class HomeController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }

    public function SalonLogin($id){
    	$user = User::find($id);
        if (!empty($user)) {

    		Auth::loginUsingId($id);

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
    }
}
