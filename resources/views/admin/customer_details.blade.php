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
                            @foreach($customer_all as $row)
                                <li>
                                    <a href="/admin/view-customer/{{$row->id}}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="/app-assets/images/portrait/small/avatar-s-8.jpg" height="36" width="36" alt="sidebar user image">
                                            <!-- <span class="avatar-status-offline"></span> -->
                                            <!-- <span class="avatar-status-away"></span>
                                            <span class="avatar-status-away"></span> -->
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">{{$row->name}}</h6>
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
 <section id="vertical-wizard" style="position: relative;left: 2px;">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">{{$customer->name}}</h4>
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
            <a style="background-color:#006a8f !important;" class="nav-link" id="order-tab" data-toggle="tab" href="#order" aria-controls="order" role="tab"
              aria-selected="false">
              <i class="bx bx-user align-middle"></i>
              <span class="align-middle">Order Details</span>
            </a>
          </li>
          <li class="nav-item">
            <a style="background-color:#006a8f !important;" class="nav-link" id="coupon-tab" data-toggle="tab" href="#coupon" aria-controls="coupon" role="tab"
              aria-selected="false">
              <i class="bx bx-message-square align-middle"></i>
              <span class="align-middle">Coupon</span>
            </a>
          </li>

        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
            <h6>PERSONAL INFORAMTION</h6>
            
            <ul class="list-unstyled">
              <!-- <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>California</li> -->
              <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i>Phone : {{$customer->phone}}</li>
              <!-- <li><i class="cursor-pointer bx bx-time mb-1 mr-50"></i>July 10</li> -->
              <li><i class="cursor-pointer bx bx-envelope mb-1 mr-50"></i>Mail : {{$customer->email}}</li>

              <li><i class="cursor-pointer bx bx-calendar mb-1 mr-50"></i>Date of Birth : <?php echo date('d-m-Y',strtotime($customer->dob)) ?></li>
            </ul>

                    <div class="row">
                      
                      <!-- <div class="col-12">
                        <h6>Package Details</h6>
                        <p>Package Name :</p>
                        <p>Price :</p>
                        <p>Validity :</p>
                      </div> -->
                    </div>
          </div>

          <div class="tab-pane" id="order" aria-labelledby="order-tab" role="tabpanel">

            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Salon Name</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($booking as $row)
                        <tr>
                            <td>#{{$row->id}}</td>
                            <td>{{$row->salon_name}}</td>
                            <td>
                              @if($row->payment_type == 0)
                              Cash
                              @else 
                              Card
                              @endif
                            </td>
                            <td>
                              @if($row->payment_status == 0)
                              Un Paid
                              @else 
                              Paid
                              @endif
                            </td>
                            <td>{{$row->total}} AED</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Salon Name</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>


          <div class="tab-pane" id="coupon" aria-labelledby="coupon-tab" role="tabpanel">

          <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                          <th>Coupon Code</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Discount Type</th>
                          <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon as $row)
                    @if($row->user_type == '')
                      <tr>
                        <td>
                          @if(date('Y-m-d') > $row->end_date )
                            <span style="color:red">{{$row->coupon_code}}</span>
                          @else
                            <span style="color:green">{{$row->coupon_code}}</span>
                          @endif
                        </td>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
                        <td>
                          @if($row->discount_type == '1')
                          Discount from product
                          @elseif($row->discount_type == '2')
                          Discount % from product
                          @elseif($row->discount_type == '3')
                          Discount from total cart
                          @else
                          Discount % from total cart
                          @endif
                        </td>
                        <td>{{$row->amount}}</td>
                      </tr>
                    @else 
                    <?php 
                      $arraydata=array();
                      foreach(explode(',',$row->user_id) as $user1){
                        $arraydata[]=$user1;
                      }
                    ?>
                      @if(in_array($customer->id , $arraydata))
                      <tr>
                        <td>
                          @if(date('Y-m-d') > $row->end_date )
                            <span style="color:red">{{$row->coupon_code}}</span>
                          @else
                            <span style="color:green">{{$row->coupon_code}}</span>
                          @endif
                        </td>
                        <td>{{$row->start_date}}</td>
                        <td>{{$row->end_date}}</td>
                        <td>
                          @if($row->discount_type == '1')
                          Discount from product
                          @elseif($row->discount_type == '2')
                          Discount % from product
                          @elseif($row->discount_type == '3')
                          Discount from total cart
                          @else
                          Discount % from total cart
                          @endif
                        </td>
                        <td>{{$row->amount}}</td>
                      </tr>
                      @endif
                    @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>Coupon Code</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Discount Type</th>
                          <th>Amount</th>
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
$('.customer').addClass('active');
var action_type;


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
            $("#form")[0].reset();
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

</script>
