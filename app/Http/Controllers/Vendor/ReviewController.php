<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\review;
use App\customer;
use App\service_time;
use App\User;
use Auth;

class ReviewController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function Review(){
        $review = review::where('salon_id',Auth::user()->user_id)->get();
        $customer = customer::all();
        return view('vendor.review',compact('review','customer'));
    }

    public function bankDetails(){
        $profile = User::find(Auth::user()->id);
        return view('vendor.bank_details',compact('profile'));
    }

    public function updateBankDetails(Request $request){
        $request->validate([
            'account_number'=> 'required',
            'bank_name'=> 'required',
            'iban_number'=> 'required',
            'swift_code'=> 'required',
            'account_name'=> 'required',
        ]);
        
        $profile = User::find($request->id);
        $profile->bank_name = $request->bank_name;
        $profile->account_number = $request->account_number;
        $profile->iban_number = $request->iban_number;
        $profile->swift_code = $request->swift_code;
        $profile->account_name = $request->account_name;
        $profile->save();
        return response()->json('successfully update'); 
    }

    public function storeTime(){
        $salon_id = Auth::user()->user_id;
        $service_time = service_time::where('salon_id',Auth::user()->user_id)->get();
        return view('vendor.update_time',compact('service_time','salon_id'));
    }

    public function updateStoreTime(Request $request){
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

}
