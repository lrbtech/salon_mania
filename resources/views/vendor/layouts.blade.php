
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="author" content="PIXINVENT">
    <title>Salon Mania</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/dragula.min.css"> -->
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-analytics.css"> -->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('toastr/toastr.css')}}">
        <style>
            @media screen and (max-width:768px) {
          .navbar-brand {
    
    margin-right: 0rem;

}
            }
  
        </style>
    @yield('extra-css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body id="body" class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

<!-- <body class="vertical-layout vertical-menu-modern content-left-sidebar chat-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar"> -->

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed bg-primary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item">
                    <a class="navbar-brand" href="/vendor/dashboard">
                        <div class="brand-logo"><img class="logo" src="/images/logo/logo.png"></div>
                        <h2 class="brand-text mb-0">Salon Mania</h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="bx bx-menu"></i></a></li>
                        </ul>
                        <!-- <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon bx bx-envelope"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon bx bx-chat"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon bx bx-check-circle"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon bx bx-calendar-alt"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon bx bx-star warning"></i></a>
                                <div class="bookmark-input search-input">
                                    <div class="bookmark-input-icon"><i class="bx bx-search primary"></i></div>
                                    <input class="form-control input" type="text" placeholder="Explore Frest..." tabindex="0" data-search="template-search">
                                    <ul class="search-list"></ul>
                                </div>
                            </li>
                        </ul> -->
                    </div>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <!-- <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language d-lg-inline d-none">English</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i>English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i>French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i>German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i>Portuguese</a></div>
                        </li> -->
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        <!-- <li class="nav-item nav-search"><a class="nav-link nav-link-search pt-2"><i class="ficon bx bx-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore Frest..." tabindex="-1" data-search="template-search">
                                <div class="search-input-close"><i class="bx bx-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li> -->
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">{{$customer_count + $booking_count}}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">{{$customer_count + $booking_count}} Notification</span>
                                    <!-- <span class="text-bold-400 cursor-pointer">Mark all as read</span> -->
                                </div>
                                </li>
                                <li class="scrollable-container media-list">
                                @foreach($customer as $row)
                                <a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Name : {{$row->name}} / Phone : +971 {{$row->phone}}</span> / Email : {{$row->email}}
                                        </h6>
                                        <small class="notification-text">Date of Birth : {{date('d-m-Y',strtotime($row->dob))}}</small>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @foreach($booking as $row)
                                <a class="d-flex justify-content-between"  href="/vendor/booking-read-status">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Booking Notification : @foreach($customer_all as $user1)
                                @if($user1->id == $row->customer_id)
                                {{$user1->name}}
                                @endif
                                @endforeach / Booking ID : {{$row->b_id}}</span> / Value : AED {{$row->total}}
                                        </h6>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                </li>
                               
                                <!-- <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li> -->
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none">
                                    <span class="user-name">{{Auth::user()->name}}</span>
                                    <span class="user-status">Available</span>
                                </div>
                                <span>
                                    <img class="round" src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <!-- <a class="dropdown-item" href="page-user-profile.html"><i class="bx bx-user mr-50"></i> Edit Profile</a> -->

                                <!-- <a class="dropdown-item" href="/vendor/role"><i class="bx bx-lock-open-alt mr-50"></i> Add Roles</a> -->
                                <a class="dropdown-item" href="/vendor/edit-profile"><i class="bx bx-lock-open-alt mr-50"></i> Edit Profile</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">     
                        <i class="bx bx-power-off mr-50"></i>Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    @include('vendor.menu')

    <!-- BEGIN: Content-->
    @yield('body-section')
    <!-- END: Content-->

    <!-- demo chat-->
    <div class="widget-chat-demo">
        <button class="btn btn-primary chat-demo-button glow px-1"><i class="livicon-evo" data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i></button>
        <div class="widget-chat widget-chat-demo d-none">
            <div class="card mb-0">
                <div class="card-header border-bottom p-0">
                    <div class="media m-75">
                        <a href="JavaScript:void(0);">
                            <div class="avatar mr-75">
                                <img src="/images/logo/logo.png" alt="avtar images" width="32" height="32">
                                <span class="avatar-status-online"></span>
                            </div>
                        </a>
                        <div class="media-body">
                            <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);">Chat to Admin</a></h6>
                            <!-- <span class="text-muted font-small-3">Active</span> -->
                        </div>
                        <i class="bx bx-x widget-chat-close float-right my-auto cursor-pointer"></i>
                    </div>
                </div>
                <div class="card-body widget-chat-container widget-chat-demo-scroll">
                    <div id="chat_admin" class="chat-content">
                        <!-- <div class="badge badge-pill badge-light-secondary my-1">today</div> -->
                        
                    </div>
                </div>
                <div class="card-footer border-top p-1">
                    <form id="salon_form" class="d-flex" action="javascript:void(0);">
                    {{csrf_field()}}
                        <input name="salon_text" id="salon_text" type="text" class="form-control chat-message-demo mr-75" placeholder="Type here...">
                        <button onclick="SalonChatSave()" type="button" class="btn btn-primary glow px-1"><i class="bx bx-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">{{date('Y')}} &copy; Salon Mania</span>
        <span style="margin-right:200px !important;" class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="https://lrbinfotech.com/" target="_blank">LRB Infotech</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/dragula.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/js/scripts/components.js"></script>
    <script src="/app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('toastr/toastr.min.js')}}" type="text/javascript"></script>
    @yield('extra-js')

    
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">
    Pusher.logToConsole = true;
    // var channel_name = $('#channel_name').val();
      var pusher = new Pusher('ed548d5fbe8deba9d224', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe("<?php echo Auth::user()->user_id; ?>");
    channel.bind('chat-admin', function(data) {
        console.log(data);
        viewChat("<?php echo Auth::user()->user_id; ?>");
    });

viewChat(<?php echo Auth::user()->user_id; ?>);

function viewChat(id)
{
    $.ajax({
    url : '/vendor/get-admin-chat/'+id,
    type: "GET",
    success: function(data)
    {
      $('#chat_admin').html(data.html);
      //chatContainer.scrollTop($(".chat-container > .chat-content").height());
    }
  });
}

function SalonChatSave(){
  //alert($("#service_id").val());
  var formData = new FormData($('#salon_form')[0]);
  $.ajax({
      url : '/vendor/save-admin-chat',
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

</body>
<!-- END: Body-->

</html>