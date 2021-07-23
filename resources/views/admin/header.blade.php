   <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <!-- <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon bx bx-chat"></i></a></li>
                           
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
                    <ul class="nav navbar-nav float-right">
                       
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="input" type="text" placeholder="Explore Frest..." tabindex="-1" data-search="template-search">
                                <div class="search-input-close"><i class="bx bx-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">{{$customer_count + $notification_count + $coupon_count + $service_count + $booking_count}}</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">{{$customer_count + $notification_count + $coupon_count + $service_count + $booking_count}} Notification</span>
                                    <!-- <span class="text-bold-400 cursor-pointer">Mark all as read</span> -->
                                </div>
                                </li>
                                <li class="scrollable-container media-list">
                                @foreach($customer as $row)
                                <a class="d-flex justify-content-between"  href="/admin/view-customer/{{$row->id}}">
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
                                @foreach($notification as $row)
                                <a class="d-flex justify-content-between"  href="/admin/notification-read-status/{{$row->id}}">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Push Notification From Salon : @foreach($salon as $user1)
                                @if($user1->id == $row->salon_id)
                                {{$user1->salon_name}}
                                @endif
                                @endforeach / Title : {{$row->title}}</span> / Description : {{$row->description}}
                                        </h6>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @foreach($coupon as $row)
                                <a class="d-flex justify-content-between"  href="/admin/coupon-read-status/{{$row->id}}">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Coupon Notification From Salon : @foreach($salon as $user1)
                                @if($user1->id == $row->salon_id)
                                {{$user1->salon_name}}
                                @endif
                                @endforeach / Coupon Code : {{$row->coupon_code}}</span> 
                                        </h6>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @foreach($service as $row)
                                <a class="d-flex justify-content-between"  href="/admin/service-read-status/{{$row->id}}">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Service Notification From Salon : @foreach($salon as $user1)
                                @if($user1->id == $row->salon_id)
                                {{$user1->salon_name}}
                                @endif
                                @endforeach / Service : {{$row->service_name}}</span> / Duration : {{$row->duration}} / Price : {{$row->price}}
                                        </h6>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @foreach($booking as $row)
                                <a class="d-flex justify-content-between"  href="/admin/booking-read-status/{{$row->id}}">
                                    <div class="media d-flex align-items-center">
                                        <div class="media-left pr-0">
                                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="39" width="39"></div>
                                        </div>
                                        <div class="media-body">
                                        <h6 class="media-heading">
                                        <span class="text-bold-500">Booking Notification From Salon : @foreach($salon as $user1)
                                @if($user1->id == $row->salon_id)
                                {{$user1->salon_name}}
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
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">{{ Auth::guard('admin')->user()->name }}</span><span class="user-status text-muted">Available</span></div><span><img class="round" src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                            <a class="dropdown-item" href="/admin/view-user/{{ Auth::guard('admin')->user()->id }}"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">     
                                <i class="bx bx-power-off mr-50"></i>Log out
                                </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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