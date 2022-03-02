<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-header d-xl-none d-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="/vendor/dashboard">
                    <div class="brand-logo"><img class="logo" src="/images/logo/logo.png"></div>
                    <h2 class="brand-text mb-0">Salon Mania</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include /includes/mixins -->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="filled">
<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
} 
function isMobileDev(){
    if(!empty($_SERVER['HTTP_USER_AGENT'])){
       $user_ag = $_SERVER['HTTP_USER_AGENT'];
       if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
          return true;
       };
    };
    return false;
}
?>
            @if(!empty($role))
            
            @if($role->dashboard == 'on')
            <li class="dashbord nav-item">
            	<a class="dropdown-toggle nav-link" href="/vendor/dashboard/">
            		<i class="menu-livicon" data-icon="desktop"></i>
            		<span data-i18n="Dashboard">Dashboard</span>
            	</a>
            </li>
            @endif

            @if($role->appointment == 'on')
            <li class="booking nav-item" data-menu="dropdown">
            	<a class="dropdown-toggle nav-link" href="/vendor/get-booking">
            		<i class="menu-livicon" data-icon="briefcase"></i>
            		<span data-i18n="Booking">Booking</span>
            	</a>
            </li>
            @endif

            @if($role->push_notification == 'on')
            <li class="push-notification nav-item" data-menu="dropdown">
            	<a class="dropdown-toggle nav-link" href="/vendor/push-notification">
            	<i class="menu-livicon" data-icon="comments"></i>
            	<span>Push Notification</span></a>
            </li>
            @endif

            @if($role->service == 'on')
            <li class="service dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Service</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="service-payment dropdown-item align-items-center" href="/vendor/service-payment" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Payment</a>
                    </li>
                    <li data-menu=""><a class="service-package dropdown-item align-items-center" href="/vendor/service-package" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Package</a>
                    </li>
                    <li data-menu=""><a class="new-service dropdown-item align-items-center" href="/vendor/new-service" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Request</a>
                    <li data-menu=""><a class="product dropdown-item align-items-center" href="/vendor/product" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Product</a>
                </ul>
            </li>
            @endif

            @if($role->review == 'on')
            <li class="review nav-item" data-menu="dropdown">
            	<a class="dropdown-toggle nav-link" href="/vendor/review/">
            		<i class="menu-livicon" data-icon="desktop"></i>
            		<span data-i18n="Review & Rating">Review & Rating</span>
            	</a>
            </li>
            @endif

            @if($role->coupon == 'on')
            <li class="coupon nav-item" data-menu="dropdown">
            	<a class="dropdown-toggle nav-link" href="/vendor/coupon/">
            		<i class="menu-livicon" data-icon="desktop"></i>
            		<span data-i18n="Coupon">Coupon</span>
            	</a>
            </li>
            @endif

            <li class="apps dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                @if(Auth::user()->busisness_type != 5)
                    @if($role->workers == 'on')
                    <li data-menu=""><a class="workers dropdown-item align-items-center" href="/vendor/workers" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Workers</a></li>
                    @endif
                    @if($role->roles == 'on')
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/role" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Roles</a></li>
                    @endif
                @endif
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/gallery" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Gallery</a></li>
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/store-time" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Update Store Time</a></li>
                </ul>
            </li>

            @if($role->reports == 'on')
            <!-- <li class="report nav-item" data-menu="dropdown">
            	<a class="dropdown-toggle nav-link" href="/vendor/report/">
            		<i class="menu-livicon" data-icon="notebook"></i>
            		<span data-i18n="Revenue Reports">Revenue Reports</span>
            	</a>
            </li> -->
            <li class="report dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Revenue Reports</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="payments-in-report dropdown-item align-items-center" href="/vendor/payments-in-report" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Payments In</a></li>
                    <li data-menu=""><a class="payments-out-report dropdown-item align-items-center" href="/vendor/payments-out-report" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Payments Out</a></li>
                </ul>
            </li>
            @endif

            @else

            <li class="dashbord nav-item">
                <a class="nav-link" href="/vendor/dashboard/">
                    <i class="menu-livicon" data-icon="desktop"></i>
                    <span data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class="booking nav-item" >
            	<a class="nav-link" href="/vendor/get-booking">
            		<i class="menu-livicon" data-icon="briefcase"></i>
            		<span data-i18n="Booking">Booking</span>
            	</a>
            </li>

            <li class="push-notification nav-item">
                <a class="nav-link" href="/vendor/push-notification">
                <i class="menu-livicon" data-icon="comments"></i>
                <span>Push Notification</span></a>
            </li>

            <li class="service dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Service</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="service-payment dropdown-item align-items-center" href="/vendor/service-payment" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Payment</a></li>
                    <li data-menu=""><a class="service-package dropdown-item align-items-center" href="/vendor/service-package" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Package</a></li>
                    <li data-menu=""><a class="new-service dropdown-item align-items-center" href="/vendor/new-service" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Service Request</a></li>
                    <li data-menu=""><a class="product dropdown-item align-items-center" href="/vendor/product" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>New Product</a>
                </ul>
            </li>

            <li class="review nav-item" >
                <a class=" nav-link" href="/vendor/review/">
                    <i class="menu-livicon" data-icon="desktop"></i>
                    <span data-i18n="Review & Rating">Review & Rating</span>
                </a>
            </li>

            <li class="coupon nav-item" >
                <a class=" nav-link" href="/vendor/coupon/">
                    <i class="menu-livicon" data-icon="desktop"></i>
                    <span data-i18n="Coupon">Coupon</span>
                </a>
            </li>

            <li class="apps dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Settings</span></a>
                <ul class="dropdown-menu">
                @if(Auth::user()->busisness_type != 5)
                    <li data-menu=""><a class="workers dropdown-item align-items-center" href="/vendor/workers" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Workers</a></li>
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/role" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Roles</a></li>
                @endif
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/gallery" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Add Gallery</a></li>
                    <!-- <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/bank-details" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Bank Details</a></li> -->
                    <li data-menu=""><a class="roles dropdown-item align-items-center" href="/vendor/store-time" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Update Store Time</a></li>
                </ul>
            </li>

            <!-- <li class="report nav-item" data-menu="dropdown">
                <a class="dropdown-toggle nav-link" href="/vendor/report/">
                    <i class="menu-livicon" data-icon="notebook"></i>
                    <span data-i18n="Revenue Reports">Revenue Reports</span>
                </a>
            </li> -->
            <li class="report dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="comments"></i><span>Revenue Reports</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="payments-in-report dropdown-item align-items-center" href="/vendor/payments-in-report" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Payments In</a></li>
                    <li data-menu=""><a class="payments-out-report dropdown-item align-items-center" href="/vendor/payments-out-report" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Payments Out</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- END: Main Menu-->