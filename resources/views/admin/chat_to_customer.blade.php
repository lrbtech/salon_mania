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

<body class="vertical-layout vertical-menu-modern dark-layout content-left-sidebar chat-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="dark-layout">


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
        @foreach($booking as $row)
          <li>
              <a href="#">
              <div class="d-flex align-items-center">
                  <div class="avatar m-0 mr-50"><img src="/app-assets/images/portrait/small/avatar-s-8.jpg" height="36" width="36" alt="sidebar user image">
                      <!-- <span class="avatar-status-offline"></span> -->
                      <!-- <span class="avatar-status-away"></span>
                      <span class="avatar-status-away"></span> -->
                  </div>
                  <div class="chat-sidebar-name">
                    <a onclick="viewChat({{$row->id}})">
                      <h6 class="mb-0">Booking Id : #{{$row->id}}</h6>
                      <span class="text-muted">Salon Name :
                      @foreach($salon as $salon1)
                      @if($salon1->id == $row->salon_id)
                      {{$salon1->salon_name}}
                      @endif
                      @endforeach
                      </span>
                      <span class="text-muted">Customer Name :
                      @foreach($customer as $customer1)
                      @if($customer1->id == $row->customer_id)
                      {{$customer1->name}}
                      @endif
                      @endforeach
                      </span>
                    </a>
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
  <div class="chat-start d-none">
    <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
    <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
    <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
      Conversation!</button>
  </div>
  <div class="chat-area ">
    <!-- chat card start -->
    <div class="card chat-wrapper shadow-none">
      <div class="card-content">
        <div class="card-body chat-container">
          <div id="chat_customer" class="chat-content">
            
            
          </div>
        </div>
      </div>
      
    </div>
    <!-- chat card ends -->
  </div>
</section>
<!-- app chat window ends -->

          </div>
        </div>
			</div>
		</div>
	  </div>
  <!-- END: Content-->
   @include('admin.footer')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
    
    <script src="/app-assets/js/scripts/pages/app-chat.js"></script>
    

<script type="text/javascript">
$('.chat-to-customer').addClass('active');

function viewChat(id)
{
    $.ajax({
    url : '/admin/get-customer-chat/'+id,
    type: "GET",
    success: function(data)
    {
      $('#chat_customer').html(data.html);
      chatContainer.scrollTop($(".chat-container > .chat-content").height());
    }
  });
}
</script>

