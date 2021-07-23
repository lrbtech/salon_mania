<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;
use App\salon_role;
use App\User;
use App\role;
use App\admin;
use App\booking;
use App\push_notification;
use App\coupon;
use App\new_service;
use App\customer;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('vendor.menu', function($view) {
            $role = array();
            if(Auth::user()->role_id != 'admin'){
            $role = salon_role::where('id',Auth::user()->role_id)->where('salon_id',Auth::user()->user_id)->first();
            }
            $view->with(compact('role'));
        });

        view()->composer('vendor.layouts', function($view) {
            $today = date('Y-m-d');
            $tommorrow = date('Y-m-d',strtotime("$today +1 day"));
            $sevendays = date('Y-m-d',strtotime("$today +7 day"));

            $customer = customer::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dob) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(dob)')->orderByRaw('DAYOFYEAR(dob)')->get();

            $customer_count = customer::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dob) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(dob)')->orderByRaw('DAYOFYEAR(dob)')->count();

            $booking = booking::where('salon_read',0)->get();
            $booking_count = booking::where('salon_read',0)->count();

            $customer_all = customer::all();
           
            $view->with(compact('customer','customer_count','booking','booking_count','customer_all'));
        });

        view()->composer('vendor.dashboard', function($view) {
            $role = array();
            if(Auth::user()->role_id != 'admin'){
            $role = salon_role::where('id',Auth::user()->role_id)->where('salon_id',Auth::user()->user_id)->first();
            }
            $view->with(compact('role'));
        });
        
        view()->composer('admin.sidebar', function($view) {
            $role = role::where('id',Auth::guard('admin')->user()->role_id)->first();
           
            $view->with(compact('role'));
        });

        view()->composer('admin.header', function($view) {
            $today = date('Y-m-d');
            $tommorrow = date('Y-m-d',strtotime("$today +1 day"));
            $sevendays = date('Y-m-d',strtotime("$today +7 day"));

            $salon = User::all();

            $customer = customer::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dob) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(dob)')->orderByRaw('DAYOFYEAR(dob)')->get();

            $customer_count = customer::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(dob) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(dob)')->orderByRaw('DAYOFYEAR(dob)')->count();

            $notification = push_notification::where('read_status',0)->get();
            $notification_count = push_notification::where('read_status',0)->count();

            $coupon = coupon::where('read_status',0)->get();
            $coupon_count = coupon::where('read_status',0)->count();

            $service = new_service::where('read_status',0)->get();
            $service_count = new_service::where('read_status',0)->count();

            $booking = booking::where('read_status',0)->get();
            $booking_count = booking::where('read_status',0)->count();
           
            $view->with(compact('customer','customer_count','notification_count','notification','coupon','coupon_count','service','service_count','booking','booking_count','salon'));
        });
    }   
}
