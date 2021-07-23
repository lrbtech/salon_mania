 @section('css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
 @endsection
 @extends('admin.layouts')
@section('body-section')
 <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">User</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Role
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
           
                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
        <!-- new task button -->
        <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
          <i class="bx bx-plus"></i>
          <span>New Role</span>
        </button>
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                                        
            <div class="table-responsive">
               
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($role as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->role_name}}</td>
                            
                <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                  <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                </div>
              </div></td>
                            </tr>

                         @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>


                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
            
        </div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label>Role Name</label>
                        <input autocomplete="off" type="text" id="role_name" name="role_name" class="form-control">
                    </div>


                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-1">
                                <thead>
                                	<tr>
                                        <th colspan="5">Select All 
                                        	<div class="checkbox"><input type="checkbox" name="all_click" id="all_click" class="all_click checkbox-input">
                                            <label for="all_click"></label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Module Permission</th>
                                        <th>Read</th>
                                        <th>Create</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Customer</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="customer_read" id="customer_read" class="checkbox-input">
                                            <label for="customer_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="customer_create" id="customer_create" class="checkbox-input">
                                            <label for="customer_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="customer_edit" id="customer_edit" class="checkbox-input">
                                            <label for="customer_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="customer_delete" id="customer_delete" class="checkbox-input">
                                            <label for="customer_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Salon</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_read" id="salon_read" class="checkbox-input">
                                            <label for="salon_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_create" id="salon_create" class="checkbox-input">
                                            <label for="salon_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_edit" id="salon_edit" class="checkbox-input">
                                            <label for="salon_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_delete" id="salon_delete" class="checkbox-input">
                                            <label for="salon_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Salon Package</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_package_read" id="salon_package_read" class="checkbox-input">
                                            <label for="salon_package_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_package_create" id="salon_package_create" class="checkbox-input">
                                            <label for="salon_package_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_package_edit" id="salon_package_edit" class="checkbox-input">
                                            <label for="salon_package_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="salon_package_delete" id="salon_package_delete" class="checkbox-input">
                                            <label for="salon_package_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Category</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="category_read" id="category_read" class="checkbox-input">
                                            <label for="category_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="category_create" id="category_create" class="checkbox-input">
                                            <label for="category_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="category_edit" id="category_edit" class="checkbox-input">
                                            <label for="category_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="category_delete" id="category_delete" class="checkbox-input">
                                            <label for="category_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Service</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_read" id="service_read" class="checkbox-input">
                                            <label for="service_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_create" id="service_create" class="checkbox-input">
                                            <label for="service_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_edit" id="service_edit" class="checkbox-input">
                                            <label for="service_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_delete" id="service_delete" class="checkbox-input">
                                            <label for="service_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Service Request</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_request_read" id="service_request_read" class="checkbox-input">
                                            <label for="service_request_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="service_request_update" id="service_request_update" class="checkbox-input">
                                            <label for="service_request_update"></label>
                                            </div>
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Push Notification</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="push_notification_read" id="push_notification_read" class="checkbox-input">
                                            <label for="push_notification_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="push_notification_create" id="push_notification_create" class="checkbox-input">
                                            <label for="push_notification_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="push_notification_edit" id="push_notification_edit" class="checkbox-input">
                                            <label for="push_notification_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="push_notification_delete" id="push_notification_delete" class="checkbox-input">
                                            <label for="push_notification_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Push Notification Request</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="notification_request_read" id="notification_request_read" class="checkbox-input">
                                            <label for="notification_request_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="notification_request_update" id="notification_request_update" class="checkbox-input">
                                            <label for="notification_request_update"></label>
                                            </div>
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Coupon</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_read" id="coupon_read" class="checkbox-input">
                                            <label for="coupon_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_create" id="coupon_create" class="checkbox-input">
                                            <label for="coupon_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_edit" id="coupon_edit" class="checkbox-input">
                                            <label for="coupon_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_delete" id="coupon_delete" class="checkbox-input">
                                            <label for="coupon_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Coupon Request</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_request_read" id="coupon_request_read" class="checkbox-input">
                                            <label for="coupon_request_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="coupon_request_update" id="coupon_request_update" class="checkbox-input">
                                            <label for="coupon_request_update"></label>
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Available Area</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="area_read" id="area_read" class="checkbox-input">
                                            <label for="area_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="area_create" id="area_create" class="checkbox-input">
                                            <label for="area_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="area_edit" id="area_edit" class="checkbox-input">
                                            <label for="area_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="area_delete" id="area_delete" class="checkbox-input">
                                            <label for="area_delete"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>User</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="user_read" id="user_read" class="checkbox-input">
                                            <label for="user_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="user_create" id="user_create" class="checkbox-input">
                                            <label for="user_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="user_edit" id="user_edit" class="checkbox-input">
                                            <label for="user_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="user_delete" id="user_delete" class="checkbox-input">
                                            <label for="user_delete"></label>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Roles</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="roles_read" id="roles_read" class="checkbox-input">
                                            <label for="roles_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="roles_create" id="roles_create" class="checkbox-input">
                                            <label for="roles_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="roles_edit" id="roles_edit" class="checkbox-input">
                                            <label for="roles_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="roles_delete" id="roles_delete" class="checkbox-input">
                                            <label for="roles_delete"></label>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Slider</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="slider_read" id="slider_read" class="checkbox-input">
                                            <label for="slider_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="slider_create" id="slider_create" class="checkbox-input">
                                            <label for="slider_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="slider_edit" id="slider_edit" class="checkbox-input">
                                            <label for="slider_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="slider_delete" id="slider_delete" class="checkbox-input">
                                            <label for="slider_delete"></label>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Promotion Banner</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="banner_read" id="banner_read" class="checkbox-input">
                                            <label for="banner_read"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="banner_create" id="banner_create" class="checkbox-input">
                                            <label for="banner_create"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="banner_edit" id="banner_edit" class="checkbox-input">
                                            <label for="banner_edit"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="banner_delete" id="banner_delete" class="checkbox-input">
                                            <label for="banner_delete"></label>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>Dashboard</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="dashboard" id="dashboard" class="checkbox-input">
                                            <label for="dashboard"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                    <tr>
                                        <td>Review & Ratings</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="review_ratings_read" id="review_ratings_read" class="checkbox-input">
                                            <label for="review_ratings_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Bookings</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="booking_read" id="booking_read" class="checkbox-input">
                                            <label for="booking_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Chat to Customer</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="chat_to_customer_read" id="chat_to_customer_read" class="checkbox-input">
                                            <label for="chat_to_customer_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Revenue Reports</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="revenue_reports_read" id="revenue_reports_read" class="checkbox-input">
                                            <label for="revenue_reports_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Settlement Reports</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="settlement_reports_read" id="settlement_reports_read" class="checkbox-input">
                                            <label for="settlement_reports_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Application Settings</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="application_settings_read" id="application_settings_read" class="checkbox-input">
                                            <label for="application_settings_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Terms and Condition</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="terms_and_condition_read" id="terms_and_condition_read" class="checkbox-input">
                                            <label for="terms_and_condition_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Settlement Reports</td>
                                        <td>
                                            <div class="checkbox"><input type="checkbox" name="settlement_period_read" id="settlement_period_read" class="checkbox-input">
                                            <label for="settlement_period_read"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button onclick="Save()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->
@endsection
@section('js')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
                    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
<script type="text/javascript">
$('.roles').addClass('active');


$(document).on('click','.all_click', function(){
  if($(".all_click").prop('checked') == true){
      $.each([ 'dashboard','customer_read','customer_create','customer_edit','customer_delete','salon_read','salon_create','salon_edit','salon_delete','category_read','category_create','category_edit','category_delete','salon_package_read','salon_package_create','salon_package_edit','salon_package_delete','review_ratings_read','service_read','service_create','service_edit','service_delete','service_request_read',
            'service_request_update','push_notification_read','push_notification_create','push_notification_edit','push_notification_delete','notification_request_read','notification_request_update','coupon_read',
            'coupon_create','coupon_edit','coupon_delete','coupon_request_read',
            'coupon_request_update','booking_read','area_read','area_create',
            'area_edit','area_delete','chat_to_salon_read','chat_to_customer_read','revenue_reports_read','settlement_reports_read','user_read',
            'user_create','user_edit','user_delete','roles_read','roles_create','roles_edit','roles_delete','slider_read','slider_create','slider_edit','slider_delete','banner_read','banner_create','banner_edit','banner_delete','application_settings_read','terms_and_condition_read','settlement_period_read' ], function( index, value ) {
	$('#'+value).prop('checked', true);
});
  } else{
      $.each([ 'dashboard','customer_read','customer_create','customer_edit','customer_delete','salon_read','salon_create','salon_edit','salon_delete','category_read','category_create','category_edit','category_delete','salon_package_read','salon_package_create','salon_package_edit','salon_package_delete','review_ratings_read','service_read','service_create','service_edit','service_delete','service_request_read',
            'service_request_update','push_notification_read','push_notification_create','push_notification_edit','push_notification_delete','notification_request_read','notification_request_update','coupon_read',
            'coupon_create','coupon_edit','coupon_delete','coupon_request_read',
            'coupon_request_update','booking_read','area_read','area_create',
            'area_edit','area_delete','chat_to_salon_read','chat_to_customer_read','revenue_reports_read','settlement_reports_read','user_read',
            'user_create','user_edit','user_delete','roles_read','roles_create','roles_edit','roles_delete','slider_read','slider_create','slider_edit','slider_delete','banner_read','banner_create','banner_edit','banner_delete','application_settings_read','terms_and_condition_read','settlement_period_read' ], function( index, value ) {
	$('#'+value).prop('checked', false);
});
  }
});

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;

$.each([ 'dashboard','customer_read','customer_create','customer_edit','customer_delete','salon_read','salon_create','salon_edit','salon_delete','category_read','category_create','category_edit','category_delete','salon_package_read','salon_package_create','salon_package_edit','salon_package_delete','review_ratings_read','service_read','service_create','service_edit','service_delete','service_request_read',
            'service_request_update','push_notification_read','push_notification_create','push_notification_edit','push_notification_delete','notification_request_read','notification_request_update','coupon_read',
            'coupon_create','coupon_edit','coupon_delete','coupon_request_read',
            'coupon_request_update','booking_read','area_read','area_create',
            'area_edit','area_delete','chat_to_salon_read','chat_to_customer_read','revenue_reports_read','settlement_reports_read','user_read',
            'user_create','user_edit','user_delete','roles_read','roles_create','roles_edit','roles_delete','slider_read','slider_create','slider_edit','slider_delete','banner_read','banner_create','banner_edit','banner_delete','application_settings_read','terms_and_condition_read','settlement_period_read' ], function( index, value ) {
	$('#'+value).prop('checked', false);
});

    $('#saveButton').text('Save');
    $('#modal-title').text('Add Roles');
});


function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-role',
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
      url : '/admin/update-role',
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

function Edit(id){
  $.ajax({
    url : '/admin/role/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Role');
      $('#save').text('Save Change');
      $('input[name=role_name]').val(data.role_name);
      $('input[name=id]').val(id);
      

$.each([ 'dashboard','customer_read','customer_create','customer_edit','customer_delete','salon_read','salon_create','salon_edit','salon_delete','category_read','category_create','category_edit','category_delete','salon_package_read','salon_package_create','salon_package_edit','salon_package_delete','review_ratings_read','service_read','service_create','service_edit','service_delete','service_request_read',
            'service_request_update','push_notification_read','push_notification_create','push_notification_edit','push_notification_delete','notification_request_read','notification_request_update','coupon_read',
            'coupon_create','coupon_edit','coupon_delete','coupon_request_read',
            'coupon_request_update','booking_read','area_read','area_create',
            'area_edit','area_delete','chat_to_salon_read','chat_to_customer_read','revenue_reports_read','settlement_reports_read','user_read',
            'user_create','user_edit','user_delete','roles_read','roles_create','roles_edit','roles_delete','slider_read','slider_create','slider_edit','slider_delete','banner_read','banner_create','banner_edit','banner_delete','application_settings_read','terms_and_condition_read','settlement_period_read' ], function( index, value ) {
//alert(value);
if (data[value] == 'on'){ 
  $('#'+value).prop('checked', true);
}
else{ 
  $('#'+value).prop('checked', false);
}

//alert( index + ": " + value );
});

      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}


function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/role-delete/'+id,
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
</script>
</script>
@endsection