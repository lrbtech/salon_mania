<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\settlement_period;
use App\admin;
use App\settings;
use App\User;
use App\customer;
use App\role;
use App\booking;
use App\booking_item;
use App\booking_package;
use App\payments_in;
use App\payments_out;
use Hash;
use App\service;
use App\salon_service;
use session;
use Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Report(){
        return view('vendor.report');
    }

    public function changeStatusPaymentsout($id,$status){
        $payments_in = payments_in::find($id);
        $payments_in->status = $status;
        $payments_in->save();
        return response()->json('successfully update'); 
    }

    public function PaymentsInReport(){
        $booking = payments_out::where('salon_id',Auth::user()->user_id)->orderBy('id','desc')->get();
        $customer = customer::all();
        $salon = User::all();
        return view('vendor.payments_in_report',compact('booking','customer','salon'));
    }

    public function PaymentsOutReport(){
        $booking = payments_in::where('salon_id',Auth::user()->user_id)->orderBy('id','desc')->get();
        $customer = customer::all();
        $salon = User::all();
        return view('vendor.payments_out_report',compact('booking','customer','salon'));
    }


}
