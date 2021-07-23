<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('admin.headlink');
<head>
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout content-left-sidebar chat-application navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="dark-layout">


    <!-- END: Header-->
 @include('admin.header')
 @include('admin.sidebar')

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
    <div class="chat-sidebar-search">
      <div class="d-flex align-items-center">
        <div class="chat-sidebar-profile-toggle">
          <div class="avatar">
            <img src="/images/logo/logo.png" alt="user_avatar" height="36" width="36">
          </div>
        </div>
        <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
          <input type="text" class="form-control round" id="chat-search" placeholder="Search">
          <div class="form-control-position">
            <i class="bx bx-search-alt text-dark"></i>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="chat-sidebar-list-wrapper pt-2">
    
      <h6 class="px-2 pt-2 pb-25 mb-0">CONTACTS<i class="bx bx-plus float-right cursor-pointer"></i></h6>
      <ul class="chat-sidebar-list">
        @foreach($salon as $row)
          <li>
              <a href="#">
              <div class="d-flex align-items-center">
                  <div class="avatar m-0 mr-50"><img src="/app-assets/images/portrait/small/avatar-s-8.jpg" height="36" width="36" alt="sidebar user image">
                      <!-- <span class="avatar-status-offline"></span> -->
                      <!-- <span class="avatar-status-away"></span>
                      <span class="avatar-status-away"></span> -->
                  </div>
                  <div class="chat-sidebar-name">
                      <a onclick="viewChat({{$row->id}})"><h6 class="mb-0">{{$row->salon_name}}</h6><span class="text-muted"> {{$row->phone}}</span></a>
                  </div>
              </div>
              </a>
          </li>
      @endforeach
      </ul>
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
  <div class="chat-start">
    <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
    <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
    <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
      Conversation!</button>
  </div>
  <div id="chat_salon" class="chat-area d-none">
    
  </div>
</section>

<!-- app chat window ends -->
<!-- app chat profile right sidebar start -->
<!-- <section class="chat-profile">
  <header class="chat-profile-header text-center border-bottom">
    <span class="chat-profile-close">
      <i class="bx bx-x"></i>
    </span>
    <div class="my-2">
      <div class="avatar">
        <img src="/images/portrait/small/avatar-s-26.jpg" alt="chat avatar" height="100" width="100">
      </div>
      <h5 class="app-chat-user-name mb-0">Elizabeth Elliott</h5>
      <span>Devloper</span>
    </div>
  </header>
  <div class="chat-profile-content p-2">
    <h6 class="mt-1">ABOUT</h6>
    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
    <h6 class="mt-2">PERSONAL INFORMATION</h6>
    <ul class="list-unstyled">
      <li class="mb-25">email@gmail.com</li>
      <li>+1(789) 950-7654</li>
    </ul>
  </div>
</section> -->
<!-- app chat profile right sidebar ends -->
          </div>
        </div>
			</div>
		</div>
	  </div>
  <!-- END: Content-->
   @include('admin.footer')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
    
    <script src="/app-assets/js/scripts/pages/app-chat.js"></script>
    
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">
$('.chat-to-salon').addClass('active');
$('#body').addClass('chat-application');
//    Pusher.logToConsole = true;
//       var channel_name = $('#salon_id').val();
//       alert(channel_name);
//       var pusher = new Pusher('ed548d5fbe8deba9d224', {
//       cluster: 'ap2'
//     });
//     var channel = pusher.subscribe(channel_name);
//     channel.bind('chat-event', function(data) {
//         console.log(data);
//         viewChat(channel_name);
//     });

// viewChat(channel_name);

function viewChat(id)
{
    $.ajax({
    url : '/admin/get-salon-chat/'+id,
    type: "GET",
    success: function(data)
    {
      $('#chat_salon').html(data.html);
      chatContainer.scrollTop($(".chat-container > .chat-content").height());
    }
  });
}

function SalonChatSave(){
  //alert($("#service_id").val());
  var formData = new FormData($('#salon_form')[0]);
  $.ajax({
      url : '/admin/save-salon-chat',
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
        //window.location.href="/admin/coupon/";
        viewChat(data);
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

