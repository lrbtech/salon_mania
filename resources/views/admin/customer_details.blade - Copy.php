<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('admin.headlink');
<head>
  
     <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

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
                    <!-- <div class="chat-user-profile">
                        <header class="chat-user-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="bx bx-x"></i>
                            </span>
                            <div class="my-2">
                                <div class="avatar">
                                    <img src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0">John Doe</h5>
                                <span>Designer</span>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6 class="text-uppercase mb-1">ABOUT</h6>
                                <p class="mb-2">It is a long established fact that a reader will be distracted by the readable content .</p>
                                <h6>PERSONAL INFORAMTION</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25">email@gmail.com</li>
                                    <li>+1(789) 950 -7654</li>
                                </ul>
                                <h6 class="text-uppercase mb-1">CHANNELS</h6>
                                <ul class="list-unstyled mb-2">
                                    <li><a href="javascript:void(0);"># Devlopers</a></li>
                                    <li><a href="javascript:void(0);"># Designers</a></li>
                                </ul>
                                <h6 class="text-uppercase mb-1">SETTINGS</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="bx bx-tag mr-50"></i> Add
                                            Tag</a></li>
                                    <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="bx bx-star mr-50"></i>
                                            Important Contact</a>
                                    </li>
                                    <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="bx bx-image-alt mr-50"></i>
                                            Shared
                                            Documents</a></li>
                                    <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="bx bx-trash-alt mr-50"></i>
                                            Deleted
                                            Documents</a></li>
                                    <li><a href="javascript:void(0);" class="d-flex align-items-center"><i class="bx bx-block mr-50"></i> Blocked
                                            Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
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
                                        <img src="/app-assets/images/portrait/small/avatar-s-11.jpg" alt="user_avatar" height="36" width="36">
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
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="/app-assets/images/portrait/small/avatar-s-8.jpg" height="36" width="36" alt="sidebar user image">
                                            <span class="avatar-status-away"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">Sarah Woods</h6><span class="text-muted"> lemon drops</span>
                                        </div>
                                    </div>
                                </li>
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
 <section id="vertical-wizard" style="position: relative;
    left: 2px;">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Prasanth@</h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <form action="#" class="wizard-vertical wizard clearfix vertical" role="application" id="steps-uid-2"><div class="steps clearfix"><ul role="tablist"><li role="tab" aria-disabled="false" class="first current" aria-selected="true"><a id="steps-uid-2-t-0" href="#steps-uid-2-h-0" aria-controls="steps-uid-2-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span> 
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:gear.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.5'}" preserveAspectRatio="xMinYMin meet" style="left: 0.5px; top: 0.3125px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g>
            
            <g class="lievo-lineicon">
                <path fill="none" stroke="#5a8dee" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M46.26,13.74l2.12,2.12l-3.83,4.86l2.29,5.54L53,27v6l-6.15,0.73l-2.3,5.54l3.83,4.87l-4.24,4.24l-4.87-3.83l-5.54,2.29L33,53h-6l-0.73-6.15l-5.54-2.3l-4.86,3.83l-4.24-4.24l3.83-4.87l-2.3-5.54L7,33v-6l6.15-0.73l2.3-5.54l-3.83-4.86l4.24-4.24l4.87,3.83l5.54-2.3L27,7h6l0.73,6.15l5.54,2.3l4.87-3.83L46.26,13.74z" style=""></path>
                <path class="lievo-altstroke" fill="none" stroke="#5a8dee" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M38.5,21.5L37,20l-2.32,2.31C33.32,21.48,31.72,21,30,21c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-1.72-0.48-3.32-1.31-4.69L40,23L38.5,21.5z" style=""></path>
            </g>
        </g>
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#5a8dee" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">Users Details</span>
             
            </span>
          </a></li><li role="tab" aria-disabled="false" class="done" aria-selected="false"><a id="steps-uid-2-t-1" href="#steps-uid-2-h-1" aria-controls="steps-uid-2-p-1"><span class="number">2.</span> 
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:location.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.7'}" preserveAspectRatio="xMinYMin meet" style="left: 0.5px; top: 0.3125px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g>
            

            <g class="lievo-lineicon">
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M30,7c8.28,0,15,6.72,15,15c0,10-15,31-15,31S15,33,15,22C15,13.72,21.72,7,30,7z" style=""></path>
                <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M30,15c3.86,0,7,3.13,7,7s-3.14,7-7,7c-3.87,0-7-3.13-7-7S26.13,15,30,15z" style=""></path>
            </g>
            
            
        </g>
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">setup location</span>
              
            </span>
          </a></li><li role="tab" aria-disabled="false" class="done" aria-selected="false"><a id="steps-uid-2-t-2" href="#steps-uid-2-h-2" aria-controls="steps-uid-2-p-2"><span class="number">3.</span> 
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:headphones.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'0.8', 'repeat':'2', 'repeatDelay':'0'}" preserveAspectRatio="xMinYMin meet" style="left: 0.5px; top: -0.40625px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">

        <g class="lievo-common">
            <g>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
            </g>
            <g>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
            </g>
        </g>

        <g class="lievo-filledicon lievo-lineicon">
            <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M13,25c0-8.28,7.61-16,17-16s17,7.72,17,16" style=""></path>
            <g>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M6,35c0,4.42,2.24,8,5,8V27C8.24,27,6,30.58,6,35z" style=""></path>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M11,35v8c0,2.64,4,2.65,4,0c0-5.91,0-16,0-16c0-2.64-4-2.65-4,0V35z" style=""></path>
            </g>
            <g>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M54,35c0,4.42-2.24,8-5,8V27C51.76,27,54,30.58,54,35z" style=""></path>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M49,35v8c0,2.64-4,2.65-4,0c0-5.91,0-16,0-16c0-2.64,4-2.65,4,0V35z" style=""></path>
            </g>
        </g>

        

    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">Support channel</span>
            
            </span>
          </a></li><li role="tab" aria-disabled="false" class="last done" aria-selected="false"><a id="steps-uid-2-t-3" href="#steps-uid-2-h-3" aria-controls="steps-uid-2-p-3"><span class="number">4.</span> 
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:truck.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.7'}" preserveAspectRatio="xMinYMin meet" style="left: 0.5px; top: -0.125px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g class="lievo-common">
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M10.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C9.03,42.89,9,42.97,9,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C11.1,42.99,10.91,42.82,10.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M30.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C29.03,42.89,29,42.97,29,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C31.1,42.99,30.91,42.82,30.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M50.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C49.03,42.89,49,42.97,49,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C51.1,42.99,50.91,42.82,50.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
        </g>
        <g class="lievo-lineicon lievo-filledicon">
            <g>
                <circle fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="16" cy="43" r="4" style=""></circle>
                <circle fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="44" cy="43" r="4" style=""></circle>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M45,19h3c0.55,0,1.17,0.42,1.37,0.93l3.26,8.14C52.83,28.58,53,29.45,53,30v10c0,0.55-0.45,1-1,1h-1.29c-0.86-2.89-3.54-5-6.71-5c-1.96,0-5,0-5,0V19H45z M45,23h-2v8h6v-2l-2-6H45z" style=""></path>
                <line fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="23" y1="43" x2="37" y2="43" style=""></line>
                <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M21,13H7v26h3.26c1.27-1.81,3.36-3,5.74-3s4.47,1.19,5.74,3H35V13H21z" style=""></path>
                <line fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="8" y1="43" x2="9" y2="43" style=""></line>
            </g>
        </g>

        
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">delivered</span>
              
            </span>
          </a></li></ul></div><div class="content clearfix">
          <!-- step 1 -->
          <h3 id="steps-uid-2-h-0" tabindex="-1" class="title current">
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:gear.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.5'}" preserveAspectRatio="xMinYMin meet" style="left: 0px; top: 0px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g>
            
            <g class="lievo-lineicon">
                <path fill="none" stroke="#5a8dee" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M46.26,13.74l2.12,2.12l-3.83,4.86l2.29,5.54L53,27v6l-6.15,0.73l-2.3,5.54l3.83,4.87l-4.24,4.24l-4.87-3.83l-5.54,2.29L33,53h-6l-0.73-6.15l-5.54-2.3l-4.86,3.83l-4.24-4.24l3.83-4.87l-2.3-5.54L7,33v-6l6.15-0.73l2.3-5.54l-3.83-4.86l4.24-4.24l4.87,3.83l5.54-2.3L27,7h6l0.73,6.15l5.54,2.3l4.87-3.83L46.26,13.74z" style=""></path>
                <path class="lievo-altstroke" fill="none" stroke="#5a8dee" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M38.5,21.5L37,20l-2.32,2.31C33.32,21.48,31.72,21,30,21c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-1.72-0.48-3.32-1.31-4.69L40,23L38.5,21.5z" style=""></path>
            </g>
        </g>
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#5a8dee" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">Users Details</span>
              <small class="text-muted">Setup your account details here.</small>
            </span>
          </h3>
          <!-- step 1 end-->
          <!-- step 1 content -->
          <fieldset class="pt-0 body current" id="steps-uid-2-p-0" role="tabpanel" aria-labelledby="steps-uid-2-h-0" aria-hidden="false" style="">
            <h6 class="pb-50">Enter your Account Details</h6>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="firstName12">First Name </label>
                  <input type="text" class="form-control" id="firstName12" placeholder="Enter Your First Name">
                  <small class="text-muted form-text">Please enter your first name.</small>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="lastName1">Last Name</label>
                  <input type="text" class="form-control" id="lastName1" placeholder="Enter Your Last Name">
                  <small class="text-muted form-text">Please enter your last name.</small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="emailAddress12">Email</label>
                  <input type="email" class="form-control" id="emailAddress12" placeholder="Enter Your Email">
                  <small class="text-muted form-text">Please enter your email address.</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="tel" class="form-control" placeholder="+91586386368">
                  <small class="text-muted form-text">Please enter your phone number.</small>
                </div>
              </div>
            </div>
          </fieldset>
          <!-- step 1 content end-->
          <!-- step 2 -->
          <h3 id="steps-uid-2-h-1" tabindex="-1" class="title">
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:location.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.7'}" preserveAspectRatio="xMinYMin meet" style="left: 0px; top: 0px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g>
            

            <g class="lievo-lineicon">
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M30,7c8.28,0,15,6.72,15,15c0,10-15,31-15,31S15,33,15,22C15,13.72,21.72,7,30,7z" style=""></path>
                <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M30,15c3.86,0,7,3.13,7,7s-3.14,7-7,7c-3.87,0-7-3.13-7-7S26.13,15,30,15z" style=""></path>
            </g>
            
            
        </g>
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">setup location</span>
              <small class="text-muted">Choose your location here.</small>
            </span>
          </h3>
          <!-- step 2 end-->
          <!-- step 2 content -->
          <fieldset class="pt-0 body" id="steps-uid-2-p-1" role="tabpanel" aria-labelledby="steps-uid-2-h-1" aria-hidden="true" style="display: none;">
            <h6 class="py-50">Setup Your Current Location</h6>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="proposalTitle1">Address Line 1</label>
                  <input type="text" class="form-control" id="proposalTitle1" placeholder="Enter Your House no./ Flate No.">
                </div>
                <div class="form-group">
                  <label>Postcode</label>
                  <input type="text" class="form-control" placeholder="Enter Your Postcode">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="jobtitle">Address Line 2</label>
                  <input type="text" class="form-control" id="jobtitle" placeholder="Enter Your Area Name/ Landmark">
                </div>
                <div class="form-group">
                  <label>City</label>
                  <select class="custom-select form-control" id="eventLocation12" name="location">
                    <option value="new-york">New York</option>
                    <option value="chicago">Chicago</option>
                    <option value="san-francisco">San Francisco</option>
                    <option value="boston">Boston</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>State</label>
                  <input type="text" class="form-control" placeholder="VIC">
                  <small class="form-text text-muted">Please enter your Postcode.</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Country</label>
                  <select name="country" class="form-control">
                    <option value="">Select</option>
                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="ZW">Zimbabwe</option>
                  </select>
                  <small class="form-text text-muted">Select your Country</small>
                </div>
              </div>
            </div>
          </fieldset>
          <!-- step 2 content end-->
          <!-- section 3 -->
          <h3 id="steps-uid-2-h-2" tabindex="-1" class="title">
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:headphones.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'0.8', 'repeat':'2', 'repeatDelay':'0'}" preserveAspectRatio="xMinYMin meet" style="left: 0px; top: 0px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">

        <g class="lievo-common">
            <g>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M15.83,32.17C16.55,32.9,17,33.9,17,35c0,1.11-0.45,2.11-1.17,2.83" opacity="0" style=""></path>
            </g>
            <g>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
                <path class="lievo-altstroke lievo-donotdraw lievo-savelinecap" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M44.17,32.17C43.45,32.9,43,33.9,43,35c0,1.11,0.45,2.11,1.17,2.83" opacity="0" style=""></path>
            </g>
        </g>

        <g class="lievo-filledicon lievo-lineicon">
            <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M13,25c0-8.28,7.61-16,17-16s17,7.72,17,16" style=""></path>
            <g>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M6,35c0,4.42,2.24,8,5,8V27C8.24,27,6,30.58,6,35z" style=""></path>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M11,35v8c0,2.64,4,2.65,4,0c0-5.91,0-16,0-16c0-2.64-4-2.65-4,0V35z" style=""></path>
            </g>
            <g>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M54,35c0,4.42-2.24,8-5,8V27C51.76,27,54,30.58,54,35z" style=""></path>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M49,35v8c0,2.64-4,2.65-4,0c0-5.91,0-16,0-16c0-2.64,4-2.65,4,0V35z" style=""></path>
            </g>
        </g>

        

    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">Support channel</span>
              <small class="text-muted">add your support agents.</small>
            </span>
          </h3>
          <!-- section 3 end-->
          <!-- step 3 content -->
          <fieldset class="pt-0 body" id="steps-uid-2-p-2" role="tabpanel" aria-labelledby="steps-uid-2-h-2" aria-hidden="true" style="display: none;">
            <h6 class="py-50">Select your Services</h6>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Delivery Type</label>
                  <select name="delivery" class="form-control">
                    <option value="">Select a Service Type Option</option>
                    <option value="overnight" selected="">Overnight Delivery (within 48 hours)</option>
                    <option value="express">Express Delivery (within 5 working days)</option>
                    <option value="basic">Basic Delivery (within 5 - 10 working days)</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="eventLocation12">Preferred Delivery Window</label>
                  <select name="preferreddelivery" class="form-control">
                    <option value="">Select a Preferred Delivery Option</option>
                    <option value="morning" selected="">Morning Delivery (8:00AM - 11:00AM)</option>
                    <option value="afternoon">Afternoon Delivery (11:00AM - 3:00PM)</option>
                    <option value="evening">Evening Delivery (3:00PM - 7:00PM)</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Packing Type</label>
                  <select name="packaging" class="form-control">
                    <option value="">Select a Packaging Type Option</option>
                    <option value="regular" selected="">Regular Packaging</option>
                    <option value="oversized">Oversized Packaging</option>
                    <option value="fragile">Fragile Packaging</option>
                    <option value="frozen">Frozen Packaging</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="mr-2">Requirements :</label>
                  <div class="c-inputs-stacked">
                    <div class="d-inline-block mr-2">
                      <fieldset>
                        <div class="checkbox pb-1">
                          <input type="checkbox" class="checkbox__input" id="checkbox114">
                          <label for="checkbox114">Ordanary</label>
                        </div>
                      </fieldset>
                    </div>
                    <div class="d-inline-block">
                      <fieldset>
                        <div class="checkbox pb-1">
                          <input type="checkbox" class="checkbox__input" id="checkbox12">
                          <label for="checkbox12">Express</label>
                        </div>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <!-- step 3 content end-->
          <!-- step 4 -->
          <h3 id="steps-uid-2-h-3" tabindex="-1" class="title">
            <span class="fonticon-wrap mr-1">
              <i class="livicon-evo livicon-evo-holder" data-options="name:truck.svg; size: 50px; style:lines; strokeColor:#adb5bd;" style="visibility: visible; width: 50px;"><div class="lievo-svg-wrapper"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve" data-animoptions="{'duration':'2', 'repeat':'0', 'repeatDelay':'0.7'}" preserveAspectRatio="xMinYMin meet" style="left: 0px; top: 0px;"><g class="lievo-setrotation"><g class="lievo-setsharp"><g class="lievo-setflip"><g class="lievo-main">
        <g class="lievo-common">
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M10.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C9.03,42.89,9,42.97,9,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C11.1,42.99,10.91,42.82,10.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M30.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C29.03,42.89,29,42.97,29,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C31.1,42.99,30.91,42.82,30.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
            <path class="lievo-donotdraw lievo-likestroke" opacity="0" fill="#adb5bd" d="M50.67,42.77c0.02-0.05,0.03-0.11,0.03-0.17c0-0.3-0.22-0.55-0.5-0.55c-0.13,0-0.25,0.06-0.34,0.15c-0.1-0.09-0.24-0.15-0.41-0.15c-0.3,0-0.55,0.2-0.55,0.45c0,0.13,0.07,0.24,0.17,0.32C49.03,42.89,49,42.97,49,43.05c0,0.26,0.23,0.47,0.51,0.49c0.02,0.23,0.21,0.41,0.44,0.41c0.21,0,0.37-0.14,0.43-0.33c0.06,0.02,0.11,0.03,0.17,0.03c0.3,0,0.55-0.2,0.55-0.45C51.1,42.99,50.91,42.82,50.67,42.77z" stroke="none" style="stroke-width: 0;"></path>
        </g>
        <g class="lievo-lineicon lievo-filledicon">
            <g>
                <circle fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="16" cy="43" r="4" style=""></circle>
                <circle fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" cx="44" cy="43" r="4" style=""></circle>
                <path fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M45,19h3c0.55,0,1.17,0.42,1.37,0.93l3.26,8.14C52.83,28.58,53,29.45,53,30v10c0,0.55-0.45,1-1,1h-1.29c-0.86-2.89-3.54-5-6.71-5c-1.96,0-5,0-5,0V19H45z M45,23h-2v8h6v-2l-2-6H45z" style=""></path>
                <line fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="23" y1="43" x2="37" y2="43" style=""></line>
                <path class="lievo-altstroke" fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M21,13H7v26h3.26c1.27-1.81,3.36-3,5.74-3s4.47,1.19,5.74,3H35V13H21z" style=""></path>
                <line fill="none" stroke="#adb5bd" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" x1="8" y1="43" x2="9" y2="43" style=""></line>
            </g>
        </g>

        
    <rect x="-19" y="-19" width="4" height="4" fill="none" stroke="#adb5bd" style="stroke-width: 2; stroke-linecap: butt; stroke-linejoin: round; opacity: 0;" class="lievo-checkshift lievo-donotdraw lievo-nohoverstroke lievo-nohovercolor"></rect></g></g></g></g>
    
<desc>LivIcons Evolution</desc><defs></defs></svg></div></i>
            </span>
            <span class="icon-title">
              <span class="d-block">delivered</span>
              <small class="text-muted">Delivered to you.</small>
            </span>
          </h3>
          <!-- step 4 end-->
          <!-- step 4 content -->
          <fieldset class="pt-0 body" id="steps-uid-2-p-3" role="tabpanel" aria-labelledby="steps-uid-2-h-3" aria-hidden="true" style="display: none;">
            <h6 class="py-50">Enter your Payment Details</h6>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="eventName13">Name on Card</label>
                  <input type="text" class="form-control" id="eventName13" placeholder="Enter Name On Card">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Card Number</label>
                  <input type="text" class="form-control" placeholder="Enter Card No.">
                  <small class="form-text text-muted">Credit / Debit / ATM Card/Master Card</small>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Card Expiry Month</label>
                  <input type="number" class="form-control" name="ccmonth" placeholder="Card Expiry Month" value="01">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Card Expiry Year</label>
                  <input type="number" class="form-control" name="ccyear" placeholder="Card Expire Year" value="21">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Card CVV Number</label>
                  <input type="password" class="form-control" name="ccyear" placeholder="Card CVV Number" value="212">
                </div>
              </div>
            </div>
          </fieldset>
          <!-- step 4 content end-->
        </div><div class="actions clearfix"><ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true"><a href="#previous" role="menuitem" class="btn btn-light-primary">Previous</a></li><li aria-hidden="false" aria-disabled="false" class="" style="display: list-item;"><a href="#next" role="menuitem" class="btn btn-light-primary">Next</a></li><li aria-hidden="true" style="display: none;"><a href="#finish" role="menuitem" class="btn btn-light-primary">Submit</a></li></ul></div></form>
      </div>
    </div>
  </div>
</section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->
 
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

  @include('admin.footer')
<script src="/app-assets/js/scripts/pages/app-chat.js"></script>