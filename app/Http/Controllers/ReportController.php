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
        $this->middleware('auth:admin');
    }

    public function revenueReport(){
        return view('admin.revenue_report');
    }

    public function paymentsInReport(){
        return view('admin.payments_in_report');
    }

    public function paymentsOutReport(){
        return view('admin.payments_out_report');
    }

    public function changeStatusPaymentsout($id,$status){
        $payments_out = payments_out::find($id);
        $payments_out->status = $status;
        $payments_out->save();
        return response()->json('successfully update'); 
    }

    public function getBooking($fdate,$tdate){

        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $booking = booking::whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
        }else{
            $booking = booking::orderBy('id','desc')->get();
        }

        return Datatables::of($booking)
            ->addColumn('booking_id', function ($booking) {
                return '<td>#'.$booking->id.'</td>';
            })
            ->addColumn('payment_type', function ($booking) {
                if ($booking->payment_type == 0) {
                    return '<td>Cash</td>';
                } else {
                    return '<td>Card Payment</td>';
                }
            })
            ->addColumn('booking_date', function ($booking) {
                return '<td>
                <p>' . $booking->date . '</p>
                </td>';
            })
            ->addColumn('salon_details', function ($booking) {
                $user = User::find($booking->salon_id);
                $salon_name='';
                if($user->salon_name !=''){
                    $salon_name=$user->salon_name;
                }
                else{
                    $salon_name=$user->name;
                }
                if(empty($user)){
                return '<td>
                <p></p>
                </td>';
                }
                else{
                return '<td>
                <p>' . $salon_name . '</p>
                <p>' . $user->phone . '</p>
                </td>';
                }
            })
            ->addColumn('customer_details', function ($booking) {
                $customer = customer::find($booking->customer_id);
                if(empty($customer)){
                return '<td>
                <p></p>
                </td>';
                }
                else{
                return '<td>
                <p>' . $customer->name . '</p>
                <p>' . $customer->phone . '</p>
                </td>';
                }
            })
            ->addColumn('total_services', function ($booking) {
                $booking_item = booking_item::where('booking_id',$booking->id)->count();
                $booking_package = booking_package::where('booking_id',$booking->id)->count();

                $service_count = $booking_item + $booking_package;
                return '<td>
                <p>' . $service_count . '</p>
                </td>';
            })
            ->addColumn('total_amount', function ($booking) {
                return '<td>
                <p>AED' . $booking->total . '</p>
                </td>';
            })
            
        ->rawColumns(['booking_id','booking_date', 'payment_type', 'customer_details','salon_details', 'total_services','total_amount'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getPaymentsInReport($fdate,$tdate){

        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $booking = payments_in::whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
        }else{
            $booking = payments_in::orderBy('id','DESC')->get();
        }

        return Datatables::of($booking)
            ->addColumn('id', function ($booking) {
                return '<td>#'.$booking->id.'</td>';
            })
            ->addColumn('payment_type', function ($booking) {
                if ($booking->payment_type == '0') {
                    return '<td>Cash</td>';
                } else if ($booking->payment_type == '1') {
                    return '<td>Bank</td>';
                }
            })
            ->addColumn('status', function ($booking) {
                if ($booking->status == '0') {
                    return '<td>Un Paid</td>';
                } else if ($booking->status == '1') {
                    return '<td>Paid</td>';
                }
            })
            ->addColumn('date', function ($booking) {
                return '<td>
                <p>' . $booking->date . '</p>
                </td>';
            })
            ->addColumn('salon_details', function ($booking) {
                $user = User::find($booking->salon_id);
                $salon_name='';
                if($user->salon_name !=''){
                    $salon_name=$user->salon_name;
                }
                else{
                    $salon_name=$user->name;
                }
                if(empty($user)){
                return '<td>
                <p></p>
                </td>';
                }
                else{
                return '<td>
                <p>' . $salon_name . '</p>
                <p>' . $user->phone . '</p>
                </td>';
                }
            })
            ->addColumn('payment', function ($booking) {
                return '<td>
                <p>AED' . $booking->payment . '</p>
                </td>';
            })

            ->addColumn('payable_amount', function ($booking) {
                $payable_amount = $booking->payment - $booking->commission_amount;
                return '<td>
                <p>(AED '.$payable_amount.')</p>
                </td>';
            })

            ->addColumn('commission', function ($booking) {
                return '<td>
                <p>('.$booking->commission_percentage.' %)</p>
                <p>'.$booking->commission_amount.'</p>
                </td>';
            })

        ->rawColumns(['id','date', 'payment_type','salon_details','payment','status','commission','payable_amount'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    public function getPaymentsOutReport($fdate,$tdate){

        $fdate = date('Y-m-d', strtotime($fdate));
        $tdate = date('Y-m-d', strtotime($tdate));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $booking = payments_out::whereBetween('date', [$fdate, $tdate])->orderBy('id','DESC')->get();
        }else{
            $booking = payments_out::orderBy('id','DESC')->get();
        }

        return Datatables::of($booking)
            ->addColumn('id', function ($booking) {
                return '<td>#'.$booking->id.'</td>';
            })
            ->addColumn('payment_type', function ($booking) {
                if ($booking->payment_type == '0') {
                    return '<td>Cash</td>';
                } else if ($booking->payment_type == '1') {
                    return '<td>Bank</td>';
                }
            })
            ->addColumn('status', function ($booking) {
                if ($booking->status == '0') {
                    return '<td>Un Paid</td>';
                } else if ($booking->status == '1') {
                    return '<td>Paid</td>';
                }
            })
            ->addColumn('date', function ($booking) {
                return '<td>
                <p>' . $booking->date . '</p>
                </td>';
            })
            ->addColumn('salon_details', function ($booking) {
                $user = User::find($booking->salon_id);
                $salon_name='';
                if($user->salon_name !=''){
                    $salon_name=$user->salon_name;
                }
                else{
                    $salon_name=$user->name;
                }
                if(empty($user)){
                return '<td>
                <p></p>
                </td>';
                }
                else{
                return '<td>
                <p>' . $salon_name . '</p>
                <p>' . $user->phone . '</p>
                </td>';
                }
            })
            ->addColumn('payment', function ($booking) {
                return '<td>
                <p>AED' . $booking->payment . '</p>
                </td>';
            })
            ->addColumn('commission', function ($booking) {
                return '<td>
                <p>('.$booking->commission_percentage.' %)</p>
                <p>'.$booking->commission_amount.'</p>
                </td>';
            })

            ->addColumn('payable_amount', function ($booking) {
                $payable_amount = $booking->payment - $booking->commission_amount;
                return '<td>
                <p>(AED '.$payable_amount.')</p>
                </td>';
            })

            ->addColumn('action', function ($booking) {
                $output='';
                if($booking->status == '0'){
                    $output.='<a onclick="ChangeStatus('.$booking->id.',1)" class="dropdown-item" href="#"> Paid</a>';
                }
                elseif($booking->status == '1'){
                    $output.='<a onclick="ChangeStatus('.$booking->id.',0)" class="dropdown-item" href="#"> Un Paid</a>';
                }
                return'<td>
                    <div class="dropdown">
                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                            '.$output.'    
                        </div>
                    </div>
                </td>';
            })

        ->rawColumns(['id','date', 'payment_type','salon_details','payment','status','action','commission','payable_amount'])
        ->make(true);

        //return Datatables::of($orders) ->addIndexColumn()->make(true);
    }

    




    public function excelRevenueReport(Request $request){
        // $request->validate([
        //     'from_date'=>'required',
        //     'to_date'=>'required',
        // ]);
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));

        return Excel::download(new BookingExport($fdate,$tdate), 'report.xlsx');
        //return (new BookingExport($fdate,$tdate))->download('report.xlsx');
    }

    public function datePaymentsInReport(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $booking = payments_in::whereBetween('date', [$fdate, $tdate])->get();
        }else{
            $booking = payments_in::orderBy('id','desc')->get();
        }
        $customer = customer::all();
        $salon = User::all();
        return view('admin.payments_in_report',compact('booking','customer','salon'));
    }

    public function datePaymentsOutReport(Request $request){
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));

        if($fdate != '1970-01-01' && $tdate != '1970-01-01'){
            $booking = payments_out::whereBetween('date', [$fdate, $tdate])->get();
        }else{
            $booking = payments_out::orderBy('id','desc')->get();
        }
        $customer = customer::all();
        $salon = User::all();
        return view('admin.payments_out_report',compact('booking','customer','salon'));
    }

    public function settlementReport(){
        return view('admin.settlement_report');
    }
}
