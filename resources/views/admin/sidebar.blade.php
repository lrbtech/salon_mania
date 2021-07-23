<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/admin/dashboard">
                        <div class="brand-logo"><img class="logo" src="/images/logo/logo.png" /></div>
                        <h2 class="brand-text mb-0">SalonMania</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">

                @if($role->dashboard == 'on')
                <li class="dashboard nav-item">
                    <a href="/admin/dashboard">
                        <i class="menu-livicon" data-icon="desktop"></i>
                        <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    </a>            
                </li>
                @endif

                <li class=" navigation-header"><span>Apps</span></li>

                @if($role->customer_read == 'on')
                <li class="customer nav-item">
                    <a href="/admin/customer">
                        <i class="menu-livicon" data-icon="users"></i>
                        <span class="menu-title" data-i18n="Email">Customers</span>
                    </a>
                </li>
                @endif
                @if($role->salon_read == 'on')
                <li class="salon nav-item">
                    <a href="/admin/salon">
                        <i class="menu-livicon" data-icon="scissors"></i>
                        <span class="menu-title" data-i18n="Email">Business</span>
                    </a>
                </li>
                @endif
                @if($role->category_read == 'on')
                <!-- <li class="category nav-item">
                    <a href="/admin/category">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">Categories</span>
                    </a>
                </li> -->
                @endif
                @if($role->salon_package_read == 'on')
                <li class="package nav-item">
                    <a href="/admin/salon-package">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">Business Package</span>
                    </a>
                </li>
                @endif
                
                @if($role->review_ratings_read == 'on')
                <li class="review nav-item">
                    <a href="/admin/review">
                        <i class="menu-livicon" data-icon="like"></i>
                        <span class="menu-title" data-i18n="Email">Review & Rating</span>
                    </a>
                </li>
                @endif

                <li class="navigation-header"><span>About Us</span></li>
                <li class="app-terms nav-item">
                    <a href="/admin/app-terms">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App <br> Terms & Conditions</span>
                    </a>
                </li>
                <li class="app-about nav-item">
                    <a href="/admin/app-about">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App About</span>
                    </a>
                </li>
                <li class="app-privacy nav-item">
                    <a href="/admin/app-privacy">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App Privacy Policy</span>
                    </a>
                </li>

                <li class="navigation-header"><span>Mobile App Home Page List</span></li>
                <li class="app-salon nav-item">
                    <a href="/admin/app-salon">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App Salon List</span>
                    </a>
                </li>
                <li class="app-spa nav-item">
                    <a href="/admin/app-spa">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App Spa List</span>
                    </a>
                </li>
                <li class="app-beauty nav-item">
                    <a href="/admin/app-beauty">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App <br>Beauty Clinic List</span>
                    </a>
                </li>
                <li class="app-makeup nav-item">
                    <a href="/admin/app-makeup">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App <br>Makeup Artist List</span>
                    </a>
                </li>
                <li class="app-home nav-item">
                    <a href="/admin/app-home">
                        <i class="menu-livicon" data-icon="morph-folder"></i>
                        <span class="menu-title" data-i18n="Email">App <br>Home Services List</span>
                    </a>
                </li>

                <li class="navigation-header"><span>Services</span></li>

                @if($role->service_read == 'on')
                <li class="service nav-item">
                    <a href="/admin/service">
                        <i class="menu-livicon" data-icon="shoppingcart"></i>
                        <span class="menu-title" data-i18n="Email">Services</span>
                    </a>
                </li>   
                @endif
                @if($role->service_request_read == 'on')
                <li class="new-service nav-item">
                    <a href="/admin/new-service">
                        <i class="menu-livicon" data-icon="shoppingcart"></i>
                        <span class="menu-title" data-i18n="Email">Service Request</span>
                    </a>
                </li>
                @endif

                <li class="product-request nav-item">
                    <a href="/admin/product-request">
                        <i class="menu-livicon" data-icon="shoppingcart"></i>
                        <span class="menu-title" data-i18n="Email">Product Request</span>
                    </a>
                </li>

                <li class="navigation-header"><span>Push Notification</span></li>

                @if($role->push_notification_read == 'on')
                <li class="push-notification nav-item">
                    <a href="/admin/push-notification">
                        <i class="menu-livicon" data-icon="globe"></i>
                        <span class="menu-title" data-i18n="Email">Push Notification</span>
                    </a>
                </li>
                @endif
                @if($role->notification_request_read == 'on')
                <li class="salon-notification nav-item">
                    <a href="/admin/salon-notification">
                        <i class="menu-livicon" data-icon="globe"></i>
                        <span class="menu-title" data-i18n="Email">Notification Request</span>
                    </a>
                </li>
                @endif
                <li class=" navigation-header"><span>Coupon</span></li>
                @if($role->coupon_read == 'on')
                <li class="coupon nav-item">
                    <a href="/admin/coupon">
                        <i class="menu-livicon" data-icon="gift"></i>
                        <span class="menu-title" data-i18n="Email">Coupon</span>
                    </a>
                </li>
                @endif
                @if($role->coupon_request_read == 'on')
                <li class="new-coupon nav-item">
                    <a href="/admin/new-coupon">
                        <i class="menu-livicon" data-icon="gift"></i>
                        <span class="menu-title" data-i18n="Email">Coupon Request</span>
                    </a>
                </li>
                @endif
                <li class=" navigation-header"><span>Booking</span></li>

                @if($role->booking_read == 'on')
                 <li class="booking nav-item">
                    <a href="/admin/booking">
                        <i class="menu-livicon" data-icon="calendar"></i>
                        <span class="menu-title" data-i18n="Email">Booking</span>
                    </a>
                </li>
                @endif
                @if($role->area_read == 'on')
                <li class="area nav-item">
                    <a href="/admin/city">
                        <i class="menu-livicon" data-icon="map"></i>
                        <span class="menu-title" data-i18n="Email">Available City</span>
                    </a>
                </li>
                @endif

                <li class="country nav-item">
                    <a href="/admin/country">
                        <i class="menu-livicon" data-icon="map"></i>
                        <span class="menu-title" data-i18n="Email">Country</span>
                    </a>
                </li>

                <li class=" navigation-header"><span>Chat</span></li>

                 <li class="chat-to-salon nav-item">
                    <a href="/admin/chat-to-salon">
                        <i class="menu-livicon" data-icon="comments"></i>
                        <span class="menu-title" data-i18n="Chat">Chat to Business</span>
                    </a>
                </li>

                @if($role->chat_to_customer_read == 'on')
                 <li class="chat-to-customer nav-item">
                    <a href="/admin/chat-to-customer">
                        <i class="menu-livicon" data-icon="comments"></i>
                        <span class="menu-title" data-i18n="Chat">Chat View</span>
                    </a>
                </li>
                @endif
                <li class=" navigation-header"><span>Reports</span></li>

                @if($role->revenue_reports_read == 'on')
                <li class="revenue-report nav-item">
                    <a href="/admin/revenue-report">
                        <i class="menu-livicon" data-icon="pie-chart"></i>
                        <span class="menu-title" data-i18n="Email">Revenue Reports</span>
                    </a>
                </li>
                @endif
                
                <!-- <li class="settlement-report nav-item">
                    <a href="/admin/settlement-report">
                        <i class="menu-livicon" data-icon="notebook"></i>
                        <span class="menu-title" data-i18n="Email">Settlement Reports</span>
                    </a>
                </li> -->
                
                @if($role->settlement_reports_read == 'on')
                <li class=" navigation-header"><span>Settlement Reports</span></li>

                <li class="payments-in-report nav-item">
                    <a href="/admin/payments-in-report">
                        <i class="menu-livicon" data-icon="pie-chart"></i>
                        <span class="menu-title" data-i18n="Email">Payments In</span>
                    </a>
                </li>

                <li class="payments-out-report nav-item">
                    <a href="/admin/payments-out-report">
                        <i class="menu-livicon" data-icon="pie-chart"></i>
                        <span class="menu-title" data-i18n="Email">Payments Out</span>
                    </a>
                </li>
                @endif
                <li class=" navigation-header"><span>Master</span></li>

                @if($role->user_read == 'on')
                <li class="user nav-item">
                    <a href="/admin/user">
                        <i class="menu-livicon" data-icon="user"></i>
                        <span class="menu-title" data-i18n="Email">Users</span>
                    </a>
                </li>
                @endif
                @if($role->roles_read == 'on')
                <li class="roles nav-item">
                    <a href="/admin/role">
                        <i class="menu-livicon" data-icon="unlock"></i>
                        <span class="menu-title" data-i18n="Email">Roles</span>
                    </a>
                </li>
                @endif
                @if($role->application_settings_read == 'on')
                <!-- <li class="application-settings nav-item">
                    <a href="/admin/application-settings">
                        <i class="menu-livicon" data-icon="settings"></i>
                        <span class="menu-title" data-i18n="Chat">Application Settings</span>
                    </a>
                </li> -->
                @endif
                @if($role->terms_and_condition_read == 'on')
                <li class="terms-and-condition nav-item">
                    <a href="/admin/terms-and-condition">
                        <i class="menu-livicon" data-icon="wrench"></i>
                        <span class="menu-title" data-i18n="Chat">Terms and Condition</span>
                    </a>
                </li>
                @endif
                @if($role->slider_read == 'on')
                <li class="slider nav-item">
                    <a href="/admin/slider">
                        <i class="menu-livicon" data-icon="magic"></i>
                        <span class="menu-title" data-i18n="Chat">Slider</span>
                    </a>
                </li>
                @endif
                @if($role->banner_read == 'on')
                <!-- <li class="banner nav-item">
                    <a href="/admin/banner">
                        <i class="menu-livicon" data-icon="magic"></i>
                        <span class="menu-title" data-i18n="Chat">Promotion Banner</span>
                    </a>
                </li> -->
                @endif
                <!-- @if($role->settlement_period_read == 'on')
                <li class="settlement-period nav-item">
                    <a href="/admin/settlement-period">
                        <i class="menu-livicon" data-icon="save"></i>
                        <span class="menu-title" data-i18n="File Manager">Settlement Period</span>
                    </a>
                </li>
                @endif -->

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->