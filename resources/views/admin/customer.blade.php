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
                            <h5 class="content-header-title float-left pr-1 mb-0">Customer List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Customer
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
                     <button id="add_new" style="width: 300px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
          <i class="bx bx-plus"></i>
          <span>New Customer</span>
        </button>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <!-- <p class="card-text">In this Table Show All type of Customer Personal Information, Booking Details and Payment Details.</p> -->
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>E-mail</th>
                                        <th>Registered On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $key => $row)
                                    <tr>
                                        <td>{{$row->c_id}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>Active</td>
                                        <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                  <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                  <!-- <a class="dropdown-item" href="/admin/chat-to-customer"><i class="bx bxs-chat mr-1"></i> Chat</a> -->
                  <!-- <a class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Block</a> -->
                  <a class="dropdown-item" href="/admin/view-customer/{{$row->id}}"><i class="bx bx-show-alt mr-1"></i> See Profile</a>
                </div>
              </div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>E-mail</th>
                                        <th>Registered On</th>
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
                        <label>Name</label>
                        <input autocomplete="off" type="text" id="name" name="name" class="form-control">
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

                    <div class="form-group col-md-8">
                        <label>Phone</label>
                        <input autocomplete="off" type="text" id="phone" name="phone" class="form-control">
                    </div>
                    </div>

                    <div class="form-group">
                        <label>Gender</label>
                        <select id="gender" name="gender" class="form-control">
                          <option value="">SELECT</option>
                          <option value="0">Male</option>
                          <option value="1">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input autocomplete="off" type="email" id="email" name="email" class="form-control">
                    </div>
                  <div class="form-group">
                    <fieldset>
                      <div class="checkbox">
                        <input type="checkbox" class="checkbox-input" id="customer_password" name="customer_password">
                        <label for="customer_password">Customer Create Password</label>
                      </div>
                    </fieldset>
                  </div>
                    <div class="form-group show-password">
                        <label>Password</label>
                        <input autocomplete="off" type="password" id="password" name="password" class="form-control">
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

$('.customer').addClass('active');


// if ($("input[name=customer_password]").prop("checked") == true) { 
//   $('.show-password').hide();
// }

$('input[type="checkbox"]').click(function(){
  if($(this).prop("checked") == true){
      $('.show-password').hide();
  }
  else if($(this).prop("checked") == false){
      $('.show-password').show();
  }
});

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add customer');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-customer',
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
      url : '/admin/update-customer',
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
    url : '/admin/customer/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Customer');
      $('#save').text('Save Change');
      $('input[name=name]').val(data.name);
      $('input[name=phone]').val(data.phone);
      $('input[name=email]').val(data.email);
      $('select[name=country_id]').val(data.country_id);
      $('select[name=gender]').val(data.gender);
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
        url : '/admin/customer-delete/'+id,
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
@endsection