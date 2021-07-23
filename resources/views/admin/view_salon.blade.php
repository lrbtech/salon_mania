<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('admin.headlink');
<head>
  
     <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCanHknp355-rJzwBPbz1FZDWs9t9ym_lY&sensor=false&libraries=places"></script>

    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMTNFnPj4AizpevEiZcG77II6MptFemd4&sensor=false&libraries=places"></script> -->
    <style type="text/css">
        .input-controls {
          margin-top: 10px;
          border: 1px solid transparent;
          border-radius: 2px 0 0 2px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          height: 32px;
          outline: none;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }
        #searchInput {
          background-color: #fff;
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
          margin-left: 12px;
          padding: 0 11px 0 13px;
          text-overflow: ellipsis;
          width: 50%;
        }
        #searchInput:focus {
          border-color: #4d90fe;
        }
    </style>
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
                            @foreach($all_salon as $row)
                                <li>
                                    <a href="/admin/view-salon/{{$row->id}}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="/app-assets/images/portrait/small/avatar-s-8.jpg" height="36" width="36" alt="sidebar user image">
                                            <!-- <span class="avatar-status-offline"></span> -->
                                            <!-- <span class="avatar-status-away"></span>
                                            <span class="avatar-status-away"></span> -->
                                        </div>
                                        <div class="chat-sidebar-name">
                                            @if($row->salon_name != "")
                                            <h6 class="mb-0">{{$row->salon_name}}</h6>
                                            @else
                                            <h6 class="mb-0">{{$row->name}}</h6>
                                            @endif
                                            <span class="text-muted"> {{$row->phone}}</span>
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
            <div style="max-height: 900px;overflow: scroll;" class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- app chat overlay -->
                        <div class="chat-overlay"></div>
 <section id="vertical-wizard" >
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{$salon->salon_name}}</h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        
<section id="basic-tabs-components">
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab"
              aria-selected="true">
              <i class="bx bx-home align-middle"></i>
              <span class="align-middle">View Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="workers-tab" data-toggle="tab" href="#workers" aria-controls="workers" role="tab"
              aria-selected="false">
              <i class="bx bx-user align-middle"></i>
              <span class="align-middle">Our Specialist</span>
            </a>
          </li>
          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="service-tab" data-toggle="tab" href="#service" aria-controls="service" role="tab"
              aria-selected="false">
              <i class="bx bx-user align-middle"></i>
              <span class="align-middle">Service</span>
            </a>
          </li>

          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="service-package-tab" data-toggle="tab" href="#service-package" aria-controls="service-package" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Service Package</span>
            </a>
          </li>

          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="working-hours-tab" data-toggle="tab" href="#working-hours" aria-controls="working-hours" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Working Hours</span>
            </a>
          </li>

          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="location-tab" data-toggle="tab" href="#location" aria-controls="location" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Location</span>
            </a>
          </li>

          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" aria-controls="reviews" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Reviews & Rating</span>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" id="appointment-tab" data-toggle="tab" href="#appointment" aria-controls="appointment" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Appointment</span>
            </a>
          </li> -->

          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" aria-controls="gallery" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Gallery</span>
            </a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
            <h6>PERSONAL INFORAMTION</h6>

            <ul class="list-unstyled">
              <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i>{{$salon->phone}}</li>
              <li><i class="cursor-pointer bx bx-envelope mb-1 mr-50"></i>{{$salon->email}}</li>
              <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>{{$salon->address}}</li>
            </ul>

              <div class="row">

                <div class="col-6">
                  <h6><small class="text-muted">Salon Name</small></h6>
                  <p>{{$salon->salon_name}}</p>
                </div>
                <div class="col-6">
                  <h6><small class="text-muted">Salon ID</small></h6>
                  <p>{{$salon->salon_id}}</p>
                </div>
                <div class="col-6">
                  <h6><small class="text-muted">Emirates ID</small></h6>
                  <p>{{$salon->emirates_id}}</p>
                </div>
                <div class="col-6">
                  <h6><small class="text-muted">Passport Number</small></h6>
                  <p>{{$salon->passport_number}}</p>
                </div>

                <div class="col-6">
                  <h6><small class="text-muted">Profile Image</small></h6>
                  <p><img style="width:100px;height:100px;" src="/upload_files/{{$salon->profile_image}}"></p>
                </div> 
                <div class="col-6">
                  <h6><small class="text-muted">Cover Image</small></h6>
                  <p><img style="width:200px;height:100px;" src="/upload_files/{{$salon->cover_image}}"></p>
                </div>
                @if(!empty($salon_package))
                <div class="col-12">
                  <h6>Package Details</h6>
                  <p>Package Name : {{$salon_package->package_name}}</p>
                  <p>Price : {{$salon_package->price}} AED</p>
                  @if($salon_package->validity == 1)
                  <p>Validity : {{$salon_package->validity_count}} Days</p>
                  @else 
                  <p>Validity : {{$salon_package->validity_count}} Month</p>
                  @endif
                </div>
                @endif
                
              </div>

              <div class="row">
                <div class="col-12">
                  <h6>Attachements</h6>
                  <div class="col-4">
                    <h6><small class="text-muted">Trade License Copy</small></h6>
                    @if($salon->trade_license != '')
                    <p><img style="width:200px;height:100px;" src="/upload_files/{{$salon->trade_license}}"></p>
                    <a download="trade-license-{{$salon->trade_license}}" href="/upload_files/{{$salon->trade_license}}" target="_blank" class="btn btn-danger">Download</a>

                    @endif
                  </div> 
                  <div class="col-4">
                    <h6><small class="text-muted">Passport Copy</small></h6>
                    @if($salon->passport_copy != '')
                    <p><img style="width:200px;height:100px;" src="/upload_files/{{$salon->passport_copy}}"></p>
                    <a download="Passport-{{$salon->trade_license}}" href="/upload_files/{{$salon->passport_copy}}" target="_blank" class="btn btn-danger">Download</a>
                    @endif
                  </div>
                  <div class="col-4">
                    <h6><small class="text-muted">Emirated ID Copy</small></h6>
                    @if($salon->emirated_id_copy != '')
                    <p><img style="width:200px;height:100px;" src="/upload_files/{{$salon->emirated_id_copy}}"></p>
                    <a download="Emirated-ID-{{$salon->trade_license}}" href="/upload_files/{{$salon->emirated_id_copy}}" target="_blank" class="btn btn-danger">Download</a>
                    @endif
                  </div>
                </div>
              </div>
          </div>

          <div class="tab-pane" id="service" aria-labelledby="service-tab" role="tabpanel">
            <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
              <i class="bx bx-plus"></i>
              <span>New Service</span>
            </button>

            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salon_service as $row)
                        <tr>
                            <td>
                            @foreach($service as $ser)
                            @if($ser->id == $row->service_id)
                            {{$ser->service_name_english}}
                            @endif
                            @endforeach
                            </td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->duration}}</td>
                            <td><div class="dropdown">
                                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                                  <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                                  <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                                </div>
                              </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Service</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>


          <div class="tab-pane" id="service-package" aria-labelledby="service-package-tab" role="tabpanel">
            
            <button id="add_new_package" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
              <i class="bx bx-plus"></i>
              <span>Service Package</span>
            </button>

            <div class="table-responsive">
                <table class="table zero-configuration1">
                <thead>
                        <tr>
                        <th>#</th>
                            <th>Package English</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($package as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->package_name_english}}</td>
                            <td>{{$row->price}}</td>
                            <td>
                              <img style="width:200px;height:150px;" src="/upload_files/{{$row->image}}">
                            </td>
                            <td>
                              <div class="dropdown">
                                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                </span>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a onclick="EditPackage({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                                <a onclick="DeletePackage({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
                                </div>
                              </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Package English</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>

          <div class="tab-pane" id="working-hours" aria-labelledby="working-hours-tab" role="tabpanel">
            <button id="add_hours" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
              <i class="bx bx-plus"></i>
              <span>Working Hours</span>
            </button>
            <div class="table-responsive">
                <table class="table working-hours-table">
                    <thead>
                        <tr>
                            <th>Days</th>
                            <th>Active/Not Active</th>
                            <th>Opening Time</th>
                            <th>Closing Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($service_time as $row)
                        <tr>
                            <td>{{$row->days}}</td>
                            <td>
                                @if($row->status == 1)
                                Active
                                @else
                                Not Active
                                @endif
                            </td>
                            <td>{{$row->open_time}}</td>
                            <td>{{$row->close_time}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

          </div>

          <div class="tab-pane" id="workers" aria-labelledby="workers-tab" role="tabpanel">
         
            <div class="table-responsive">
                <table class="table workers-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Certification Image</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($salon_worker as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td><img style="width:100px;height:100px;" src="/upload_files/{{$row->profile_image}}"></td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->email}}</td>
                            <td><img style="width:100px;height:100px;" src="/upload_files/{{$row->certification_image}}"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

          </div>

          <div class="tab-pane" id="location" aria-labelledby="location-tab" role="tabpanel">
            <h6>Location Details</h6>
            <form id="location_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" value="{{$salon_id}}" name="up_salon_id" id="up_salon_id">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Latitude</label>
                        <input autocomplete="off" value="{{$salon->latitude}}" type="text" id="latitude" name="latitude" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Longitude</label>
                        <input autocomplete="off" value="{{$salon->longitude}}" type="text" id="longitude" name="longitude" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <button onclick="updateLocation()" class="btn btn-primary btn-block mr-10" type="button">Update Location</button>
                    </div>
                </div>
            
            <input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">
            <div class="map" id="map" style="width: 100%; height: 300px;"></div>
            </form>
          </div>


          <div class="tab-pane" id="reviews" aria-labelledby="reviews-tab" role="tabpanel">

            <div class="table-responsive">
                <table class="table reviews-table">
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer Name</th>
                            <th>Comments</th>
                            <th>Reviews</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($review as $row)
                    <tr>
                        <td>#{{$row->invoice_id}}</td>
                        <td>
                        @foreach($customer as $cus)
                        @if($cus->id == $row->customer_id)
                        {{$cus->name}}
                        @endif
                        @endforeach
                        </td>
                        <td>{{$row->comments}}</td>
                <td>
                @if($row->reviews == '1')
                    <div class="mb-1 font-small-2">
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                    </div>
                @elseif($row->reviews == '2')
                    <div class="mb-1 font-small-2">
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                    </div>
                @elseif($row->reviews == '3')
                    <div class="mb-1 font-small-2">
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                    </div>
                @elseif($row->reviews == '4')
                    <div class="mb-1 font-small-2">
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bx-star text-muted"></i>
                    </div>
                @elseif($row->reviews == '5')
                    <div class="mb-1 font-small-2">
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                      <i class="cursor-pointer bx bxs-star text-warning"></i>
                    </div>
                @endif
                </td>
                        <td>{{$row->created_at}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer Name</th>
                            <th>Comments</th>
                            <th>Reviews</th>
                            <th>Date & Time</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>


          <div class="tab-pane" id="appointment" aria-labelledby="appointment-tab" role="tabpanel">

            <div class="table-responsive">
                <table class="table appointment-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Appoinment DateTime</th>
                            <th>Services</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#001</td>
                        <td>Aravind</td>
                        <td>08-07-2020</td>
                        <td></td>
                        <td>100 AED</td>
                    </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Appoinment DateTime</th>
                            <th>Services</th>
                            <th>Payment</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>


        <div class="tab-pane" id="gallery" aria-labelledby="gallery-tab" role="tabpanel">

            <div class="row">
            @foreach($gallery as $key => $row)
              <div class="col-lg-3 col-md-3 col-xs-3 thumb">
                <a class="thumbnail" href="#">
                  <img style="width:150px;height:150px;" class="img-responsive img-thumbnail" src="/upload_gallery/{{$row->image}}" alt="{{$row->name}}">
                </a>
              </div>
            @endforeach  
            </div>

        </div>


        </div>
      </div>
    </div>
  </div>
</section>



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

<!-- Bootstrap Modal -->
<div class="modal fade" id="package_modal" tabindex="-1" role="dialog" aria-labelledby="package_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="package_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <input type="hidden" name="package_id" id="package_id">
                   <div class="form-group">
                        <label>Package Name English</label>
                        <input autocomplete="off" type="text" id="package_name_english" name="package_name_english" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Package Name Arabic</label>
                        <input autocomplete="off" type="text" id="package_name_arabic" name="package_name_arabic" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input autocomplete="off" type="text" id="price" name="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Package Image</label>
                        <input autocomplete="off" type="file" id="image" name="image" class="form-control">
                    </div>
                    <div class="form-group customershow">
                        <label>Select Services</label>
                        <select id="service_ids" name="service_ids[]" class="form-control select2" multiple="multiple">
                        	<option value="">SELECT</option>
                        	@foreach($service as $row)
                        	<option value="{{$row->id}}">{{$row->service_name_english}}</option>
                        	@endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <button onclick="SavePackage()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->

<!-- Bootstrap Modal -->
<div class="modal fade" id="time_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="time_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Days</th>
                                <th>Active/Not Active</th>
                                <th>Opening Time</th>
                                <th>Closing Time</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$time = array('12:00 AM','12:30 AM','01:00 AM','01:30 AM','02:00 AM','02:30 AM','03:00 AM','03:30 AM','04:00 AM','04:30 AM','05:00 AM','05:30 AM','06:00 AM','06:30 AM','07:00 AM','07:30 AM','08:00 AM','08:30 AM','09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','01:00 PM','01:30 PM','02:00 PM','02:30 PM','03:00 PM','03:30 PM','04:00 PM','04:30 PM','05:00 PM','05:30 PM','06:00 PM','06:30 PM','07:00 PM','07:30 PM','08:00 PM','08:30 PM','09:00 PM','09:30 PM','10:00 PM','10:30 PM','11:00 PM','11:30 PM');
?>
                        @foreach($service_time as $row)
                            <tr>
                                <td>
                                    {{$row->days}}
                                    <input value="{{$row->id}}" type="hidden" name="timing_id[]">
                                </td>
                                <td>
                                    <select name="status[]" class="form-control">
                                        <option value="">SELECT</option>
                                        <option {{$row->status == 1 ?'selected':''}} value="1">Active</option>
                                        <option {{$row->status == 2 ?'selected':''}} value="2">Not Active</option>
                                    </select>
                                </td>

                                <td>
                                    <select name="open_time[]" class="form-control">
                                        <option value="">SELECT</option>
                                        @for ($i = 0; $i < 48; $i++) {
                                        <option {{$row->open_time == $time[$i] ?'selected':''}} value="{{$time[$i]}}">{{$time[$i]}}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <select name="close_time[]" class="form-control">
                                        <option value="">SELECT</option>
                                        @for ($i = 0; $i < 48; $i++) {
                                        <option {{$row->close_time == $time[$i] ?'selected':''}} value="{{$time[$i]}}">{{$time[$i]}}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                    <div class="form-group">
                        <button onclick="timeUpdate()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->


<!-- Bootstrap Modal -->
<div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <input type="hidden" value="{{$salon_id}}" name="salon_id" id="salon_id">

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Choose Service</label>
                        <select id="service_id" name="service_id" class="form-control">
                            <option value="">SELECT</option>
                            @foreach($service as $row)
                            <option value="{{$row->id}}">{{$row->service_name_english}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Price</label>
                        <input autocomplete="off" type="text" id="price" name="price" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Choose Duration</label>
                        <select id="duration" name="duration" class="form-control">
                            <option value="">SELECT</option>
                            <option value="15">15 Minutes</option>
                            <option value="30">30 Minutes</option>
                            <option value="45">45 Minutes</option>
                            <option value="60">1 hour</option>
                            <option value="75">1 hour 15 Minutes</option>
                            <option value="90">1 hour 30 Minutes</option>
                            <option value="105">1 hour 45 Minutes</option>
                            <option value="120">2 hour</option>
                        </select>
                    </div>
                </div>

                    <div class="form-group">
                        <button onclick="Save()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->



@include('admin.footer')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
    
    <script src="/app-assets/js/scripts/pages/app-chat.js"></script>

    <script src="/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>                                     
    


<script type="text/javascript">
$('.salon').addClass('active');
var action_type;
var package_type;
$('#add_hours').click(function(){
    $('#time_modal').modal('show');
    $("#time_form")[0].reset();
    $('#saveButton').text('Update');
    $('#modal-title').text('Add Hours');
});

$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%',
    //color:'#fff';
});

$('#add_new_package').click(function(){
    $('#package_modal').modal('show');
    $("#package_form")[0].reset();
    package_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Service Package');
});

$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Service');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-addservice',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            $('.zero-configuration').load(location.href+' .zero-configuration');
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
  }else{
    $.ajax({
      url : '/admin/update-addservice',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
          $("#form")[0].reset();
           $('#popup_modal').modal('hide');
           $('.zero-configuration').load(location.href+' .zero-configuration');
           toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
    });
  }
}

//updateLocation
function updateLocation(){
  var formData = new FormData($('#location_form')[0]);
    $.ajax({
        url : '/admin/update-location',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#location_form")[0].reset();
            toastr.success(data, 'Successfully Update');
            location.reload();;
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}

function timeUpdate(){
  var formData = new FormData($('#time_form')[0]);
    $.ajax({
        url : '/admin/update-time',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#time_form")[0].reset();
            $('#time_modal').modal('hide');
            toastr.success(data, 'Successfully Save');
            location.reload();;
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}

function Edit(id){
  $.ajax({
    url : '/admin/addservice/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Service');
      $('#save').text('Save Change');
      $('select[name=service_id]').val(data.service_id);
      $('input[name=price]').val(data.price);
      $('select[name=duration]').val(data.duration);
      $('input[name=id]').val(id);
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/addservice-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
}

function SavePackage(){
  var formData = new FormData($('#package_form')[0]);
  if(package_type == 1){
    $.ajax({
        url : '/admin/save-service-package',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#package_form")[0].reset();
            $('#package_modal').modal('hide');
            $('.zero-configuration1').load(location.href+' .zero-configuration1');
            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
  }else{
    $.ajax({
      url : '/admin/update-service-package',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
          $("#package_form")[0].reset();
           $('#package_modal').modal('hide');
           $('.zero-configuration1').load(location.href+' .zero-configuration1');
           toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
    });
  }
}

function EditPackage(id){
  $.ajax({
    url : '/admin/service-package/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Service Package');
      $('#save').text('Save Change');
      $('input[name=package_name_english]').val(data.package_name_english);
      $('input[name=package_name_arabic]').val(data.package_name_arabic);
      $('input[name=price]').val(data.price);
      $('input[name=package_id]').val(id);
      
       get_services(data.id);

      $('#package_modal').modal('show');
      package_type = 2;
    }
  });
}

function get_services(id)
{
    $.ajax({        
        url : '/admin/get_package_services/'+id,
        type: "GET",
        success: function(data)
        {
           $('#service_ids').html(data);
        }
   });
}

function DeletePackage(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/service-package-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          $('.zero-configuration1').load(location.href+' .zero-configuration1');
        }
      });
    } 
}
</script>

<script>
/* script */
function initialize() {
   var latlng = new google.maps.LatLng(24.453884,54.3773438);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
   });
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
  // document.getElementById('location').value = address;
   document.getElementById('latitude').value = lat;
   document.getElementById('longitude').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

