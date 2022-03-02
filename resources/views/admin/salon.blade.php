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
                            <h5 class="content-header-title float-left pr-1 mb-0">Busisness List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Busisness
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
        

<form id="search_form" action="#" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="card-header">
    <div class="row">
        <div class="form-group col-md-4">
<button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
    <i class="bx bx-plus"></i>
    <span>New Business</span>
</button>
        </div>

        <div class="form-group col-md-4">
            <label>Search Business Type</label>
            <select id="search_busisness_type" name="search_busisness_type" class="form-control">
                <option value="0">All</option>
                <option value="1">Salon</option>
                <option value="2">Spa</option>
                <option value="3">Makeup Artist</option>
                <option value="4">Beauty Clinic</option>
                <option value="5">Home Services</option>
                <option value="6">Dermatologist</option>
                <option value="7">Pet Grooming</option>
            </select>
        </div>

        <div class="form-group col-md-2">
            <button id="search" class="btn btn-primary btn-block mr-10" type="button">Search</button>
        </div>
        <!-- <div class="form-group col-md-2">
            <button id="downloadexcel" class="btn btn-primary btn-block mr-10" type="submit">Excel</button>
        </div> -->
    </div>
</div>
</form>
    
        </div>


        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                
                <div class="table-responsive">
                   
                    <table id="datatable" class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Business Name</th>
                                <th>Owner / Person Name</th>
                                <th>Phone Number</th>
                                <th>Membership Plan</th>
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Business Name</th>
                                <th>Owner / Person Name</th>
                                <th>Phone Number</th>
                                <th>Membership Plan</th>
                                <th>Current Status</th>
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
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Busisness Type</label>
                        <select id="busisness_type" name="busisness_type" class="form-control">
                            <option value="">SELECT</option>
                            <option value="1">Salon</option>
                            <option value="2">Spa</option>
                            <option value="3">Makeup Artist</option>
                            <option value="4">Beauty Clinic</option>
                            <option value="5">Home Services</option>
                            <option value="6">Dermatologist</option>
                            <option value="7">Pet Grooming</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Owner Name</label>
                        <input autocomplete="off" type="text" id="name" name="name" class="form-control">
                        <input type="hidden" id="salon_commission" name="salon_commission">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Email ID</label>
                        <input autocomplete="off" type="email" id="email" name="email" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Country</label>
                        <select id="country_id" name="country_id" class="form-control">
                            <!-- <option value="">SELECT</option> -->
                            @foreach($country as $row)
                            <option value="{{$row->id}}">{{$row->country_name_english}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Phone Number</label>
                        <input autocomplete="off" type="text" id="phone" name="phone" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Salon Package</label>
                        <select id="salon_package" name="salon_package" class="form-control">
                            <option value="">SELECT</option>
                            @foreach($salon_package as $row)
                            <option value="{{$row->id}}">{{$row->package_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                </div> -->
                <div class="row salon-view">
                    <div class="form-group col-md-6">
                        <label>Business Name</label>
                        <input type="text" id="salon_name" name="salon_name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Business ID</label>
                        <input type="text" id="salon_id" name="salon_id" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group">
                        <label>City</label>
                        <select onchange="getArea()" id="city" name="city" class="form-control">
                            <option value="">SELECT</option>
                            @foreach($city as $row)
                            <option value="{{$row->id}}">{{$row->area}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="address" name="address" class="form-control"></textarea>
                    </div>
                  </div>

                    <div class="form-group col-md-4">
                        <!-- <label>Salon Commission</label>
                        <input type="number" id="salon_commission" name="salon_commission" class="form-control"> -->
                        <label>Type</label>
                        <select id="gender" name="gender" class="form-control">
                          <!-- <option value="">SELECT</option> -->
                          <option value="1">Unisex</option>
                          <option value="2">Female</option>
                        </select>
                    </div>
                  
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Emirates ID</label>
                        <input type="text" id="emirates_id" name="emirates_id" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Trade License No</label>
                        <input type="text" id="trade_license_no" name="trade_license_no" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Vat Certificate No</label>
                        <input type="text" id="vat_certificate_no" name="vat_certificate_no" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Passport Number</label>
                        <input type="text" id="passport_number" name="passport_number" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4 trade-license">
                        <label>Trade License Copy</label>
                        <input type="file" id="trade_license" name="trade_license" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Passport Copy</label>
                        <input type="file" id="passport_copy" name="passport_copy" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Emirated ID Copy</label>
                        <input type="file" id="emirated_id_copy" name="emirated_id_copy" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Cover Image</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" class="form-control">
                    </div>
                </div>
                    <div class="form-group">
                        <button onclick="Save()" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->


<!-- Bootstrap Modal -->
<div class="modal fade" id="commission_modal" tabindex="-1" role="dialog" aria-labelledby="commission_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="commission_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="commission_id" id="commission_id">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Commission Percentage</label>
                            <select id="commission_percentage" name="commission_percentage" class="form-control">
                                <option value="">SELECT</option>
                                <?php for($i=1;$i<=20;$i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button onclick="UpdateCommission()" class="btn btn-primary btn-block mr-10" type="button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->

<style type="text/css">
.container {max-width: 850px; width: 100%; margin: 0 auto;}
.four { width: 32.26%; max-width: 32.26%;}


/* COLUMNS */

.col {
  display: block;
  float:left;
  margin: 1% 0 1% 1.6%;
}

.col:first-of-type { margin-left: 0; }

/* CLEARFIX */

.cf:before,
.cf:after {
    content: " ";
    display: table;
}

.cf:after {
    clear: both;
}

.cf {
    *zoom: 1;
}

.form .plan input, .form .payment-plan input, .form .payment-type input{
    display: none;
}

.form label{
    position: relative;
    color: #fff;
    background-color: #aaa;
    font-size: 26px;
    text-align: center;
    height: 150px;
    line-height: 150px;
    display: block;
    cursor: pointer;
    border: 3px solid transparent;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.form .plan input:checked + label, .form .payment-plan input:checked + label, .form .payment-type input:checked + label{
    border: 3px solid #333;
    background-color: #2fcc71;
}

.form .plan input:checked + label:after, form .payment-plan input:checked + label:after, .form .payment-type input:checked + label:after{
    content: "\2713";
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 100%;
    border: 2px solid #333;
    background-color: #2fcc71;
    z-index: 999;
    position: absolute;
    top: -10px;
    right: -10px;
}
</style>

<!-- Bootstrap Modal -->
<div class="modal fade" id="membership_modal" tabindex="-1" role="dialog" aria-labelledby="membership_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
    <div class="container">
        <form class="form cf" id="planform" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id">
            <section id="plan_view" class="plan cf">
                
            </section>
            <div class="form-group">
                <button onclick="UpdatePlan()" class="btn btn-primary btn-block mr-10" type="button">Add</button>
            </div>
        </form>
    </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->
@endsection
@section('js')
    <script src="/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- <script src="/app-assets/js/scripts/datatables/datatable.js"></script> -->
<script type="text/javascript">
$('.salon').addClass('active');

var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-salon/0",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'salon_name', name: 'salon_name' },
        { data: 'name', name: 'name' },
        { data: 'phone', name: 'phone' },
        { data: 'membership', name: 'membership' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' },
    ]
});


$('#search').click(function(){
    //alert('hi');
    var search_busisness_type = $('#search_busisness_type').val();
    var id;
    if(search_busisness_type!=""){
      id = search_busisness_type;
    }else{
      id = '0';
    }

    var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});




var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    $('#salon_package').removeAttr('disabled');
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Salon');
});

$(".trade-license").hide();
$(".salon-view").hide();
$('#busisness_type').change(function(){
    var busisness_type = $('#busisness_type').val();
    if(busisness_type == '5'){
        $(".salon-view").hide();
        $(".trade-license").hide();
    }
    else{
        $(".salon-view").show();
        $(".trade-license").show();
    }
});

function getArea(){
  var id = $('#city').val();
  $.ajax({
    url : '/get-area/'+id,
    type: "GET",
    success: function(data)
    {
        $('#area').html(data);
    }
  });
}

function Save(){
    // $(".text-danger").remove();
    // $('.form-group').removeClass('has-error').removeClass('has-success');
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-salon',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
                toastr.error(obj[0]);
            // $("#"+i).after('<p class="text-danger">'+obj[0]+'</p>');
            // $('#'+i).closest('.form-group').addClass('has-error');
            });
        }
    });
  }else{
    $.ajax({
      url : '/admin/update-salon',
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
           
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

           toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
            // $("#"+i).after('<p class="text-danger">'+obj[0]+'</p>');
            // $('#'+i).closest('.form-group').addClass('has-error');
        });
      }
    });
  }
}


function Edit(id){
  $.ajax({
    url : '/admin/salon/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Salon');
      $('#save').text('Save Change');
      $('select[name=busisness_type]').val(data.busisness_type);
    if(data.busisness_type == '5'){
        $(".salon-view").hide();
        $(".trade-license").hide();
    }
    else{
        $(".trade-license").show();
        $(".salon-view").show();
    }
      $('input[name=name]').val(data.name);
      $('input[name=phone]').val(data.phone);
      $('input[name=email]').val(data.email);
      $('input[name=salon_id]').val(data.salon_id);
      $('input[name=salon_name]').val(data.salon_name);
      $('input[name=emirates_id]').val(data.emirates_id);
      $('input[name=trade_license_no]').val(data.trade_license_no);
      $('input[name=vat_certificate_no]').val(data.vat_certificate_no);
      $('input[name=passport_number]').val(data.passport_number);
      $('select[name=country_id]').val(data.country_id);
      $('select[name=salon_package]').val(data.salon_package);
      $('select[name=city]').val(data.city);
      $('textarea[name=address]').val(data.address);
      $('#salon_package').attr('disabled', 'disabled');
      $('input[name=salon_commission]').val(data.salon_commission);
      $('input[name=id]').val(id);
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function UpgradePlan(id){
var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/get-package-plan/'+id,
        type: "GET",
        success: function(data)
        {
            $('#plan_view').html(data);
            $('input[name=id]').val(id);
            $('#membership_modal').modal('show');
        }
      });
    } 
}

function UpdatePlan(){
  var formData = new FormData($('#planform')[0]);
    $.ajax({
        url : '/admin/update-plan',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#planform")[0].reset();
            $('#membership_modal').modal('hide');
            
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

            toastr.success(data, 'Successfully Save');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}
function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/salon-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
            
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

        }
      });
    } 
}

function ChangeCommission(id){
    $('input[name=commission_id]').val(id);
    $('#commission_modal').modal('show');
}
    

function ChangeStatus(id,status){
    var r = confirm("Are you sure");
    if (r == true) {
    $.ajax({
        url : '/admin/ChangeStatus/'+id+'/'+status,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        toastr.success(data, 'Successfully Update');
        
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

        }
    });
    } 
}

function UpdateCommission(){
  var formData = new FormData($('#commission_form')[0]);
    $.ajax({
        url : '/admin/update-commission',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#commission_form")[0].reset();
            $('#commission_modal').modal('hide');
            
            var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            orderPageTable.ajax.url(new_url).load();

            toastr.success(data, 'Successfully Update');
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
            });
        }
    });
}

</script>
@endsection