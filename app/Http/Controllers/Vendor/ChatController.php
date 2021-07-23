<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\chat_salon;
use App\salon_customer;
use App\role;
use App\customer;
use App\service;
use App\booking;
use App\booking_item;
use App\manage_address;
use App\booking_package;
use App\product;
use App\booking_product;
use Hash;
use session;
use Auth;
use Carbon\Carbon;
use DB;
use App\Events\ChatEvent;
use App\Events\ChatAdmin;
use PDF;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function printInvoice($id){
      $booking = booking::find($id);
      $customer = customer::find($booking->customer_id);
      $salon = User::find($booking->salon_id);

      $service = service::all();
      
      $booking_item = booking_item::where('booking_id',$id)->get();
      $booking_package = booking_package::where('booking_id',$id)->get();

      $pdf = PDF::loadView('pdf.invoicepdf',compact('booking','salon','customer','booking_item','booking_package','service'));
      $pdf->setPaper('A4');
      return $pdf->stream('report.pdf');
  }

    public function viewAddress($id){
      $data = manage_address::find($id);
      return response()->json($data); 
    }

    private function sendChatNotification($id){
      $chat = salon_customer::find($id);
      $customer = customer::find($chat->customer_id);
      $salon = User::find($chat->salon_id);
      $title;
      if($salon->salon_name != ''){
          $title = $salon->salon_name;
      }
      else{
          $title = $salon->name;
      }
      $body= $chat->text;

      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
      CURLOPT_HTTPHEADER => array(
          "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
          "Content-Type: application/json"
      ),
      ));
      
      $response = curl_exec($curl);
      curl_close($curl);
    }
    private function sendOTPNotification($id){
      $booking = booking::find($id);
      $customer = customer::find($booking->customer_id);
      $salon = User::find($booking->salon_id);
      $title;
      if($salon->salon_name != ''){
          $title = $salon->salon_name;
      }
      else{
          $title = $salon->name;
      }
      
      $body= "Your OTP is Verified";
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>"{\r\n\"to\":\"$customer->firebase_key\",\r\n \"notification\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n },\r\n \"data\" : {\r\n  \"sound\" : \"default\",\r\n  \"body\" :  \"$body\",\r\n  \"title\" : \"$title\",\r\n  \"content_available\" : true,\r\n  \"priority\" : \"high\"\r\n }\r\n}",
      CURLOPT_HTTPHEADER => array(
          "Authorization: key=AAAAoZ2bbM0:APA91bF6daZlElRDd4EhxqKm3ThtWlEDugroa1a83scavpILHohGCZWUfN5DX7zsfRnZBHUWJF1rorEdvm4vAi6xxAuC9pSFfEnqZdy4_qkdQSVG23v6K7LADuBzQnrldACFpI9PnFoN",
          "Content-Type: application/json"
      ),
      ));
      
      $response = curl_exec($curl);
      curl_close($curl);
  }
    public function verifiedOtp(Request $request)
    {
      if($request->id != ''){
          $booking = booking::find($request->id);
          if($booking->otp == $request->otp){
              $booking->booking_status = 1;
              $booking->save();
              //$this->sendOTPNotification($booking->id);
              return response()->json(['message' => 'Verified Your OTP'
              ,'status'=>200], 200);
          }else{
              return response()->json(['message' => 'Verification Code Not Valid','status'=>400], 200);
          }
      }else{
          return response()->json(['message' => 'Booking id not found','status'=>400], 200);
      }
    }

    public function updatePaymentStatus($id)
    {
        if($id !=null){

            $booking = booking::find($id);
            $booking->payment_status = 1;
            $booking->save();

            $bookid = 'book'.$booking->id;
            $message =  array(
                'payment_status'=> $booking->payment_status,
                'channel_name'=> $bookid,
            );
            //event(new MyEvent($message));
            event(new ChatEvent($message));

            return response()->json(['message' => 'Booking Paid Successfully'], 200);
        }else{
            return response()->json(['message' => 'booking id not found'], 400);
        }
    }

  public function getBooking(){
      $booking = booking::where('salon_id',Auth::user()->user_id)->orderBy('id','DESC')->get();
      $customer = customer::all();
      return view('vendor.booking',compact('booking','customer'));
  }

  public function bookingReadStatus(){
    $booking1 = booking::where('salon_read',0)->get();
    foreach($booking1 as $row){
        $booking2 = booking::find($row->id);
        $booking2->salon_read = 1;
        $booking2->save();
    }

    $booking = booking::where('salon_id',Auth::user()->user_id)->orderBy('id','DESC')->get();
      $customer = customer::all();
      return view('vendor.booking',compact('booking','customer'));
}
    
    public function chatToCustomer($id){
        $booking = booking::find($id);
        $customer = customer::find($booking->customer_id);
        $item =DB::table('booking_items as b')
        ->where('b.booking_id',$booking->id)
        ->join('services as s', 's.id', '=', 'b.service_id')
        ->select('s.id','s.service_name_english','b.price')
        ->get();
        $package =DB::table('booking_packages as b')
        ->where('b.booking_id',$booking->id)
        ->join('packages as p', 'p.id', '=', 'b.package_id')
        ->select('p.id','p.package_name_english','b.price')
        ->get();
        $product =DB::table('booking_products as b')
        ->where('b.booking_id',$booking->id)
        ->join('products as p', 'p.id', '=', 'b.product_id')
        ->select('p.id','p.product_name_english','b.price')
        ->get();
        return view('vendor.chat_to_customer',compact('customer','item','booking','package','product'));
    }

    public function saveCustomerChat(Request $request){
      $request->validate([
          'salon_text'=>'required',
      ]);
      date_default_timezone_set("Asia/Dubai");
      date_default_timezone_get();
      $salon_customer = new salon_customer;
      $salon_customer->text = $request->salon_text;
      $salon_customer->customer_id = $request->customer_id;
      $salon_customer->booking_id = $request->booking_id;
      $salon_customer->salon_id = Auth::user()->user_id;
      $salon_customer->message_from = 1;
      $salon_customer->save();

      //$this->sendChatNotification($salon_customer->id);

      $dateTime = new Carbon($salon_customer->updated_at, new \DateTimeZone('Asia/Dubai'));
        $message =  array(
           'message'=> $salon_customer->text,
           'message_from'=> '1',
           'date'=> $dateTime->diffForHumans(),
           'channel_name'=> $salon_customer->booking_id,
        );
        event(new ChatEvent($message));
      return response()->json($request->booking_id); 
    }

    public function saveAdminChat(Request $request){
      $request->validate([
          'salon_text'=>'required',
      ]);
      date_default_timezone_set("Asia/Dubai");
      date_default_timezone_get();
      $chat_salon = new chat_salon;
      $chat_salon->text = $request->salon_text;
      $chat_salon->salon_id = Auth::user()->user_id;
      $chat_salon->message_from = 0;
      $chat_salon->save();

      $dateTime = new Carbon($chat_salon->updated_at, new \DateTimeZone('Asia/Dubai'));
        $message =  array(
           'message'=> $chat_salon->text,
           'message_from'=> '0',
           'date'=> $dateTime->diffForHumans(),
           'channel_name'=> Auth::user()->user_id,
        );
        event(new ChatAdmin($message));
      return response()->json(Auth::user()->user_id); 
    }

    public function getCustomerChat($id){
        $chat = salon_customer::where('booking_id',$id)->get();

        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $output=''; 
    foreach($chat as $row){
        $dateTime = new Carbon($row->updated_at, new \DateTimeZone('Asia/Dubai'));
        if($row->message_from == 0){
        $output.='<div class="chat chat-left">
          <div class="chat-body">
            <div class="chat-message">
              <p>'.$row->text.'</p>
              <span style="left:10px !important;" class="chat-time">'.$dateTime->diffForHumans().'</span>
            </div>
          </div>
        </div>';
        }
        else{
        $output.='<div class="chat">
          <div class="chat-body">
            <div class="chat-message">
              <p>'.$row->text.'</p>
              <span class="chat-time">'.$dateTime->diffForHumans().'</span>
            </div>
          </div>
        </div>';
        }
    }

$output.='<script src="/app-assets/js/scripts/pages/app-chat.js"></script>
<script>
chatContainer.scrollTop($(".chat-container > .chat-content").height());
</script>
';
         
        return response()->json(['html'=>$output],200); 
    }


    public function getAdminChat($id){
      $chat = chat_salon::where('salon_id',$id)->get();

      date_default_timezone_set("Asia/Dubai");
      date_default_timezone_get();
      $output=''; 
  foreach($chat as $row){
      $dateTime = new Carbon($row->updated_at, new \DateTimeZone('Asia/Dubai'));
      if($row->message_from == 0){
      $output.='
      <div class="chat ">
        <div class="chat-body">
            <div class="chat-message">
                <p>'.$row->text.'</p>
                <span  style="right:20px !important;"  class="chat-time">'.$dateTime->diffForHumans().'</span>
            </div>
        </div>
      </div>';
      }
      else{
      $output.='
      <div class="chat chat-left">
          <div class="chat-body">
              <div class="chat-message">
                  <p>'.$row->text.'</p>
                  <span style="left:20px !important;" class="chat-time">'.$dateTime->diffForHumans().'</span>
              </div>
          </div>
      </div>';
      }
  }
       
      return response()->json(['html'=>$output],200); 
  }


}
