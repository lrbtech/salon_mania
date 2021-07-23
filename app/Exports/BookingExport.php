<?php

namespace App\Exports;

use App\booking;
use App\salon_service;
use App\service;
use App\booking_item;
use App\booking_package;
use App\User;
use App\customer;
use App\package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingExport implements FromCollection, ShouldAutoSize , WithHeadings , WithMapping
{
    //use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($fdate , $tdate)
    {
        $this->fdate = $fdate;
        $this->tdate = $tdate;
    }

    public function collection()
    {
        if($this->fdate != '1970-01-01' && $this->tdate != '1970-01-01'){
            return booking::whereBetween('date', [$this->fdate, $this->tdate])->get();
        }else{
            return booking::orderBy('id','desc')->get();
        }
        //return booking::query()->whereYear('created_at', $this->fdate);
    }

    public function map($booking): array
    {
        $user = User::find($booking->salon_id);
        $salon_name='';
        $salon_details='';
        if($user->salon_name !=''){
            $salon_name=$user->salon_name;
        }
        else{
            $salon_name=$user->name;
        }
        if(empty($user)){
        $salon_details = '';
        }
        else{
        $salon_details = $salon_name.','.$user->phone;
        }
        $customer = customer::find($booking->customer_id);
        $customer_details='';
        if(empty($customer)){
            $customer_details='';
        }
        else{
            $customer_details = $customer->name.','.$customer->phone;
        }

        $busisness_type='';
        if($user->busisness_type == 1){
            $busisness_type='Salon';
        }
        elseif($user->busisness_type == 2){
            $busisness_type='Salon';
        }
        elseif($user->busisness_type == 3){
            $busisness_type='Salon';
        }
        elseif($user->busisness_type == 4){
            $busisness_type='Salon';
        }
        elseif($user->busisness_type == 5){
            $busisness_type='Salon';
        }

        $booking_item = booking_item::where('booking_id',$booking->id)->get();
        $booking_package = booking_package::where('booking_id',$booking->id)->get();
        $service_details=array();
        if(!empty($booking_item)){
            foreach($booking_item as $row){
                $service = service::find($row->service_id);
                $service_details[] = $service->service_name_english;
            }
        }
        if(!empty($booking_package)){
            foreach($booking_package as $row){
                $data  = package::find($row->package_id);
                $arraydata=array();
                foreach(explode(',',$data->service_ids) as $service_id){
                    $service = service::find($service_id);
                    $service_details[] = $service->service_name_english;
                }   
            }
        }

        $tax_amount = (5 / 100) * ($booking->total);
        $subtotal = $booking->total - $tax_amount;

        $payment_type = '';
        if ($booking->payment_type == 0) {
            $payment_type='Cash';
        } else {
            $payment_type='Card Payment';
        }

        $service_charge = ($user->salon_commission / 100) * ($booking->total);

        $payable_amount = $booking->total - $service_charge;

        return [
            $booking->id,
            $booking->date,
            $busisness_type,
            $user->salon_id,
            $salon_details,
            $customer_details,
            $booking->appointment_date .'&'.$booking->appointment_time,
            $service_details,
            'AED '.$subtotal,
            'AED '.$tax_amount,
            'AED '.$booking->total,
            $user->salon_commission.' %' ,
            'AED '.$service_charge,
            'AED '.$payable_amount,
            $payment_type,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Busisness Type',
            'Busisness ID',
            'Salon Details',
            'Customer Details',
            'Appointment Date & Time',
            'Service Details',
            'Sub Total',
            'Tax (5%)',
            'Total Amount',
            'Service Charge (%)',
            'Service Charge (Amount)',
            'Payable Amount',
            'Payment Type',
        ];
    }
}
