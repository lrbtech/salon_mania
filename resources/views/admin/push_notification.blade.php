 @section('css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
 @endsection
 @extends('admin.layouts')
@section('body-section')
 <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Push Notification List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Push Notification
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
        <button id="add_new" style="width: 300px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
          <i class="bx bx-plus"></i>
          <span>New Push Notification</span>
        </button>
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                
                <div class="table-responsive">
                   
                    <table class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Send To</th>
                                <th>Date and Time</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                  @foreach($push_notification as $row)
                    <tr>
                      <td>{{$row->title}}</td>
                      <td>{{$row->description}}</td>
                      <td>
                      @if($row->send_to == 1)
                      All Salon
                      @elseif($row->send_to == 2)
                      All Customer
                      @elseif($row->send_to == 3)
                      Selected Salon
                      @else
                      Selected Customer
                      @endif
                      </td>
                      <td>{{$row->created_at}}</td>
                      <td>{{$row->expiry_date}}</td>
                      <td>
                      <div class="dropdown">
                        <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                        </span>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                          @if($row->expiry_date != '')
                          @if($row->expiry_date >= date('Y-m-d'))
                          <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                          <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                          <!-- <a onclick="SendNotification({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-chat mr-1"></i> Send</a> -->
                          @else
                          <a class="dropdown-item" href="#">Expired</a>
                          @endif
                          @else
                          <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                          <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                          <!-- <a onclick="SendNotification({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-chat mr-1"></i> Send</a> -->
                          @endif
                        </div>
                      </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Send To</th>
                        <th>Date and Time</th>
                        <th>Expiry Date</th>
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

                    <div class="form-group">
                        <label>Title</label>
                        <input autocomplete="off" type="text" id="title" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Send To</label>
                        <select onchange="usertype()" id="send_to" name="send_to" class="form-control">
                        	<option value="">SELECT</option>
                        	<option value="1">All Salon</option>
                        	<option value="2">All Customer</option>
                          <option value="3">Selected Salon</option>
                          <option value="4">Selected Customer</option>
                        </select>
                    </div>

                    <div class="form-group" id="customershow">
                      <label>Select the Customer</label>
                      <select style="width:100% !imporatnt;" id="customer_id" name="customer_id[]" class="select2 form-control" multiple="multiple">
                        <optgroup label="Select Customer">
                        @foreach ($customer as $customer1)
                          <option value="{{$customer1->id}}">{{$customer1->name}}</option>
                        @endforeach
                        </optgroup>
                      </select>
                    </div>

                    <div class="form-group" id="salonshow">
                      <label>Select the Salon</label>
                      <select style="width:100% !imporatnt;" id="salon_id" name="salon_id[]" class="select2 form-control" multiple="multiple">
                        <optgroup label="Select Salon">
                        @foreach ($user as $user1)
                          @if($user1->salon_name != '')
                          <option value="{{$user1->id}}">{{$user1->salon_name}}</option>
                          @else
                          <option value="{{$user1->id}}">{{$user1->name}}</option>
                          @endif
                        @endforeach
                        </optgroup>
                      </select>
                    </div>

                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input autocomplete="off" type="date" id="expiry_date" name="expiry_date" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button onclick="Save()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Save</button>
                        <button onclick="Send()" id="sendButton" class="btn btn-primary btn-block mr-10" type="button">Save & Send</button>
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
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="/app-assets/js/scripts/forms/select/form-select2.js"></script>
<script type="text/javascript">
$('.push-notification').addClass('active');

$("#customershow").hide();
$("#salonshow").hide();
$('#salon_id').select2();
// $(".select2").select2({
//     dropdownAutoWidth: true,
//     width: '100%',
//     //color:'#fff';
// });
//     $('#salon_id').select2({
//         dropdownParent: $('#popup_modal')
//     });
function usertype(){
  var send_to = $("#send_to").val();
  if(send_to == '1'){
    $("#salonshow").hide();
    $("#customershow").hide();
  }
  else if(send_to == '2'){
    $("#salonshow").hide();
    $("#customershow").hide();
  }
  else if(send_to == '3'){
    $("#salonshow").show();
    $("#customershow").hide();
  }
  else if(send_to == '4'){
    $("#salonshow").hide();
    $("#customershow").show();
  }
}

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Push Notification');
    $('#salon_id').select2();
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-notification',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
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
      url : '/admin/update-notification',
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
           location.reload();
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


function Send(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-send-notification',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            location.reload();
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
      url : '/admin/update-send-notification',
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
           location.reload();
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
    url : '/admin/notification/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Notification');
      $('#save').text('Save Change');
      $('input[name=title]').val(data.title);
      $('input[name=expiry_date]').val(data.expiry_date);
      $('textarea[name=description]').val(data.description);
      $('select[name=send_to]').val(data.send_to);
      $('input[name=id]').val(id);
      $('#salon_id').select2();
  if(data.send_to == '1'){
    $("#salonshow").hide();
    $("#customershow").hide();
  }
  else if(data.send_to == '2'){
    $("#salonshow").hide();
    $("#customershow").hide();
  }
  else if(data.send_to == '3'){
    $("#salonshow").show();
    $("#customershow").hide();
    get_notification_salon(data.id);
  }
  else if(data.send_to == '4'){
    $("#salonshow").hide();
    $("#customershow").show();
    get_notification_customer(data.id);
  }
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}



function get_notification_salon(id)
{
    $.ajax({        
        url : '/admin/get-notification-salon/'+id,
        type: "GET",
        success: function(data)
        {
           $('#salon_id').html(data);
        }
   });
}
function get_notification_customer(id)
{
    $.ajax({        
        url : '/admin/get-notification-customer/'+id,
        type: "GET",
        success: function(data)
        {
           $('#customer_id').html(data);
        }
   });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/notification-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          location.reload();
        }
      });
    } 
}

function SendNotification(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/notification-send/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Send');
          location.reload();
        }
      });
    } 
}
</script>
@endsection