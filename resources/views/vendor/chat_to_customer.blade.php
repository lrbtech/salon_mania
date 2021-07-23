@extends('vendor.layouts')
@section('extra-css')
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
   
@endsection
@section('body-section')


<!-- BEGIN: Content-->
    <div class="app-content content">
  
        <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
            <!-- app chat user profile left sidebar start -->

  <!-- app chat user profile left sidebar ends -->
  <!-- app chat sidebar start -->
  <div class="chat-sidebar card">
    <span class="chat-sidebar-close">
      <i class="bx bx-x"></i>
    </span>
    <!-- <div class="chat-sidebar-search">
      <div class="d-flex align-items-center">
        <div class="chat-sidebar-profile-toggle">
          <div class="avatar">
            <img src="/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" height="36" width="36">
          </div>
        </div>
        <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
          <input type="text" class="form-control round" id="chat-search" placeholder="Search">
          <div class="form-control-position">
            <i class="bx bx-search-alt text-dark"></i>
          </div>
        </fieldset>
      </div>
    </div> -->
    <div class="chat-sidebar-list-wrapper pt-2">
      
    <h6 class="px-2 pb-25 mb-0">Booking ID : {{$booking->id}}</h6>
    <hr>
    @if(!empty($item))
      @foreach($item as $row)
      <h6 class="px-2 pb-25 mb-0">Service Name : {{$row->service_name_english}} : Price : {{$row->price}}</h6>
      @endforeach
    @endif
    <hr>
    @if(!empty($package))
      @foreach($package as $row)
      <h6 class="px-2 pb-25 mb-0">Package Name : {{$row->package_name_english}} : Price : {{$row->price}}</h6>
      @endforeach
    @endif
    <hr>
    @if(!empty($product))
      @foreach($product as $row)
      <h6 class="px-2 pb-25 mb-0">Product Name : {{$row->product_name_english}} : Price : {{$row->price}}</h6>
      @endforeach
    @endif
    <hr>
    <h6 class="px-2 pb-25 mb-0">Sub Total : {{$booking->subtotal}}</h6>
    <h6 class="px-2 pb-25 mb-0">Discount : {{$booking->discount}}</h6>
    <h6 class="px-2 pb-25 mb-0">total : {{$booking->total}}</h6>
    </div>
  </div>
  <!-- app chat sidebar ends -->
				</div>
			</div>
			<div class="content-right">
          <div class="content-overlay"></div>
				<div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
            <!-- app chat overlay -->
<div class="chat-overlay"></div>
<!-- app chat window start -->
<section class="chat-window-wrapper">
  <div class="chat-start d-none">
    <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
    <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
    <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
      Conversation!</button>
  </div>
  <div class="chat-area ">
    <div class="chat-header">
      <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
        <div class="d-flex align-items-center">
          <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
          </div>
          <!-- <div class="avatar chat-profile-toggle m-0 mr-1">
            <img src="/images/portrait/small/avatar-s-26.jpg" alt="avatar" height="36" width="36" />
            <span class="avatar-status-busy"></span>
          </div> -->
          <h6 class="mb-0">{{$customer->name}}</h6>
        </div>
        <!-- <div class="chat-header-icons">
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
        </div> -->
      </header>
    </div>
    <!-- chat card start -->
    <div class="card chat-wrapper shadow-none">
      <div class="card-content">
        <div class="card-body chat-container">
          <div id="chat_customer" class="chat-content">
            
            
          </div>
        </div>
      </div>
      <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
      <form id="salon_form" class="d-flex align-items-center" action="javascript:void(0);">
        {{csrf_field()}}
          <!-- <i class="bx bx-face cursor-pointer"></i>
          <i class="bx bx-paperclip ml-1 cursor-pointer"></i> -->
          <input type="hidden" value="{{$booking->id}}" name="booking_id" id="booking_id">
          <input type="hidden" value="{{$booking->customer_id}}" name="customer_id" id="customer_id">
          <input type="text" name="salon_text" id="salon_text" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
          <button type="button" onclick="SalonChatSave()" class="btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
            <span class="d-none d-lg-block ml-1">Send</span></button>
        </form>
      </div>
    </div>
    <!-- chat card ends -->
  </div>
</section>
<!-- app chat window ends -->
<!-- app chat profile right sidebar start -->
<!-- app chat profile right sidebar ends -->
          </div>
        </div>
			</div>
		</div>
	  </div>
  <!-- END: Content-->
@endsection
@section('extra-js')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
    
    <script src="/app-assets/js/scripts/pages/app-chat.js"></script>
    
 <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
$('.chat-to-customer').addClass('active');
$('#body').addClass('chat-application');
   Pusher.logToConsole = true;
    // var channel_name = $('#channel_name').val();
      var pusher = new Pusher('ed548d5fbe8deba9d224', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe("<?php echo $booking->id; ?>");
    channel.bind('chat-event', function(data) {
        console.log(data);
        viewChat("<?php echo $booking->id; ?>");
    });
viewChat(<?php echo $booking->id; ?>);
function viewChat(id)
{
    $.ajax({
    url : '/vendor/get-customer-chat/'+id,
    type: "GET",
    success: function(data)
    {
      $('#chat_customer').html(data.html);
      chatContainer.scrollTop($(".chat-container > .chat-content").height());
    }
  });
}

function SalonChatSave(){
  //alert($("#service_id").val());
  var formData = new FormData($('#salon_form')[0]);
  $.ajax({
      url : '/vendor/save-customer-chat',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);                
        $("#salon_form")[0].reset();
        //$('.table').load(location.href+' .table');
        toastr.success('Chat Send Successfully', 'Successfully Update');
        //window.location.href="/vendor/coupon/";
        //viewChat(data);
      },
      error: function (data, errorThrown) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
  });
}
</script>
@endsection

