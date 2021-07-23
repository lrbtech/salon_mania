@extends('vendor.layouts')
@section('extra-css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
@section('body-section')

<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Appointment</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Appointments
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer Name</th>
                                                        <th>Appointment Date/Time</th>
                                                        <th>Amount</th>
                                                        <th>Payment Mode</th>
                                                        <th>Paid / Un Paid</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($booking as $row)
                                                @if($row->payment_type == '1' && $row->payment_status == '0')
                                                @else
                                                    <tr>
                                                        <td>#{{$row->id}}</td>
                                                        <td>
                                                            @foreach($customer as $cus)
                                                            @if($cus->id == $row->customer_id)
                                                            {{$cus->name}}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{$row->appointment_date}} / {{$row->appointment_time}}</td>
                                                        <td>{{$row->total}} AED</td>
                                                        <td>
                                                        @if($row->payment_type == 0)
                                                        Cash
                                                        @else
                                                        Card
                                                        @endif
                                                        <td>
                                                        @if($row->payment_status == 0)
                                                        Un Paid
                                                        @else
                                                        Paid
                                                        @endif
                                                        <td>
                                                        @if($row->booking_status == 0)
                                                        Un Visit
                                                        @else
                                                        Visited
                                                        @endif
                                                        </td>
                                                        <td>
            <div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                @if($row->booking_status == 0)
                  <a href="/vendor/chat-to-customer/{{$row->id}}" class="dropdown-item"> Chat</a>
                  <a onclick="OTP({{$row->id}})" class="dropdown-item" href="#"> Verified Otp</a>
                @endif
                @if($row->payment_status == 0)
                    <a onclick="Paid({{$row->id}})" href="#" class="dropdown-item"> Paid</a>
                @endif
                @if($row->address_id != '')
                    <a onclick="ViewAddress({{$row->id}})" href="#" class="dropdown-item"> Customer Address</a>
                @endif
                <a target="_blank" href="/vendor/print-invoice/{{$row->id}}" class="dropdown-item"> Print</a>
                </div>
            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Customer Name</th>
                                                        <th>Appointment Date/Time</th>
                                                        <th>Amount</th>
                                                        <th>Payment Mode</th>
                                                        <th>Paid / Un Paid</th>
                                                        <th>Status</th>
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
                <!--/ Zero configuration table -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


<!-- Bootstrap Modal -->
<div class="modal fade" id="otp_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title" id="modal-title">Update OTP</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <label>Enter OTP</label>
                        <input autocomplete="off" type="text" id="otp" name="otp" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button onclick="updateOTP()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->

<!-- Bootstrap Modal -->
<div class="modal fade" id="address_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title" id="modal-title1">View Location</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            <ul class="list-unstyled">
                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>
                <label>Building / Community : </label><label id="addr_title"></label>
                </li>
                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>
                <label>Appartment Number : </label><label id="address"></label>
                </li>
                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>
                <label>Landmark : </label><label id="landmark"></label>
                </li>
                <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>
                <label>Address : </label><label id="map_title"></label>
                </li>
            </ul>
                    
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->
@endsection
@section('extra-js')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
                    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>

<script type="text/javascript">
$('.booking').addClass('active');

function updateOTP(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/vendor/verified-otp',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            if(data.status == 400){
                toastr.error(data.message);
            }
            else{
                toastr.success(data.message);
                $("#form")[0].reset();
                $('#otp_modal').modal('hide');
                $('.zero-configuration').load(location.href+' .zero-configuration');
            }
        }
    });
}


function ViewAddress(id){
  $.ajax({
    url : '/vendor/view-address/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title1').text('View Location');
      $('#map_title').text(data.map_title);
      $('#city').text(data.city);
      $('#addr_title').text(data.addr_title);
      $('#address').text(data.address);
      $('#landmark').text(data.landmark);
      $('#address_modal').modal('show');
    }
  });
}

function OTP(id){
    $('input[name=id]').val(id);
    $('#otp_modal').modal('show');
}

function Paid(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/vendor/update-payment-status/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Paid');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
}

</script>
@endsection