<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\review;
use App\User;
use App\customer;

class ReviewController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Review(){
        $review = review::all();
        $salon = User::where('role_id','admin')->where('status',1)->get();
        $customer = customer::all();
        return view('admin.review',compact('review','customer','salon'));
    }

    public function reviewStatus($id,$status){
        $review = review::find($id);
        $review->status = $status;
        $review->save();

        return response()->json('successfully updated'); 
    }
}
