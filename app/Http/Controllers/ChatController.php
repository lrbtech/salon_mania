<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\chat_salon;
use App\chat_customer;
use App\role;
use App\customer;
use App\booking;
use App\booking_item;
use App\salon_customer;
use Hash;
use session;
use Auth;
use Carbon\Carbon;
use App\Events\ChatEvent;
use App\Events\ChatAdmin;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function chatToCustomer(){
        $customer = customer::all();
        $salon = User::all();
        $booking = booking::all();
        return view('admin.chat_to_customer',compact('customer','salon','booking'));
    }

    public function chatToSalon(){
        $salon = User::where('role_id','admin')->where('status',1)->get();
        return view('admin.chat_to_salon',compact('salon'));
    }

    public function saveSalonChat(Request $request){
      $request->validate([
          'salon_text'=>'required',
      ]);
      date_default_timezone_set("Asia/Dubai");
      date_default_timezone_get();
      $chat_salon = new chat_salon;
      $chat_salon->text = $request->salon_text;
      $chat_salon->salon_id = $request->salon_id;
      $chat_salon->message_from = 1;
      $chat_salon->save();

      $dateTime = new Carbon($chat_salon->updated_at, new \DateTimeZone('Asia/Dubai'));
      $message =  array(
         'message'=> $chat_salon->text,
         'message_from'=> '1',
         'date'=> $dateTime->diffForHumans(),
         'channel_name'=> $chat_salon->salon_id,
      );
      event(new ChatAdmin($message));

      return response()->json($request->salon_id); 
    }

    public function getSalonChat($id){
        $salon = User::find($id);
        $chat = chat_salon::where('salon_id',$id)->get();

        date_default_timezone_set("Asia/Dubai");
        date_default_timezone_get();
        $time = date("h:i A"); 
        $date = date('Y-m-d'); 

//$output='';
$output='
<div class="chat-header">
  <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
    <div class="d-flex align-items-center">
      <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
      </div>
      <div class="avatar chat-profile-toggle m-0 mr-1">
        <img src="/upload_files/'.$salon->profile_image.'" alt="avatar" height="36" width="36" />
        <span class="avatar-status-busy"></span>
      </div>
      <h6 class="mb-0">'.$salon->name.'</h6>
    </div>
    <div class="chat-header-icons">
      <span class="chat-icon-favorite">
        <i class="bx bx-star font-medium-5 cursor-pointer"></i>
      </span>
      <span class="dropdown">
        <i class="bx bx-dots-vertical-rounded font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer"
          id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
        </i>
        <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-pin mr-25"></i> Pin to top</a>
          <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-trash mr-25"></i> Delete chat</a>
          <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-block mr-25"></i> Block</a>
        </span>
      </span>
    </div>
  </header>
</div>

<div class="card chat-wrapper shadow-none">
  <div class="card-content">
    <div class="card-body chat-container">
      <div class="chat-content">';
        
      foreach($chat as $row){
        $dateTime = new Carbon($row->updated_at, new \DateTimeZone('Asia/Dubai'));
        if($row->message_from == '0'){
      $output.='<div class="chat chat-left">
          <div class="chat-body">
            <div class="chat-message">
              <p>'.$row->text.'</p>
              <span class="chat-time">'.$dateTime->diffForHumans().'</span>
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

      $output.='</div>
    </div>
  </div>
  <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
    <form id="salon_form" class="d-flex align-items-center" action="javascript:void(0);">
    '.csrf_field().'
        <input type="hidden" value="'.$salon->id.'" name="salon_id" id="salon_id">
      <input type="text" name="salon_text" id="salon_text" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
      <button onclick="SalonChatSave()" type="button" class="btn btn-primary glow send d-lg-flex">
        <i class="bx bx-paper-plane"></i>
        <span class="d-none d-lg-block ml-1">Send</span>
      </button>
    </form>
  </div>
</div>
<script src="/app-assets/js/scripts/pages/app-chat.js"></script>
<script>
chatContainer.scrollTop($(".chat-container > .chat-content").height());
</script>
';
         
        return response()->json(['html'=>$output],200); 
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



}
