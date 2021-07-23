@extends('vendor.layouts')
@section('extra-css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
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
                            <h5 class="content-header-title float-left pr-1 mb-0">Roles</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Roles
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
                            	<div class="card-header">
							        <button id="add_new" style="width: 300px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
							          <i class="bx bx-plus"></i>
							          <span>Roles</span>
							        </button>
						        </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
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
                                                        <td>{{$key + 1 }}</td>
                                                        <td>{{$row->role_name}}</td>
                                                        <td>
            <div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> Edit</a>
                  <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> Delete</a>
                </div>
            </div>
                                                        </td>
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
                <!--/ Zero configuration table -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


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

                    <div class="form-group">
		              <label>Select Crediencial :</label>
		              <div class="row">
		             
		              	<div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="dashboard" name="dashboard">
				              <label class="custom-control-label mr-1" for="dashboard"></label>
				              <span>Dashboard</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="appointment" name="appointment">
				              <label class="custom-control-label mr-1" for="appointment"></label>
				              <span>Appointment</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="calendor" name="calendor">
				              <label class="custom-control-label mr-1" for="calendor"></label>
				              <span>Calendor</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="push_notification" name="push_notification">
				              <label class="custom-control-label mr-1" for="push_notification"></label>
				              <span>Push Notification</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="service" name="service">
				              <label class="custom-control-label mr-1" for="service"></label>
				              <span>Service</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="review" name="review">
				              <label class="custom-control-label mr-1" for="review"></label>
				              <span>Review</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="coupon" name="coupon">
				              <label class="custom-control-label mr-1" for="coupon"></label>
				              <span>Coupon</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="workers" name="workers">
				              <label class="custom-control-label mr-1" for="workers"></label>
				              <span>Workers</span>
				            </div>
		                </div>

		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="reports" name="reports">
				              <label class="custom-control-label mr-1" for="reports"></label>
				              <span>Reports</span>
				            </div>
		                </div>


		                <div class="col-md-4">
		                    <div class="custom-control custom-switch custom-control-inline mb-1">
				              <input type="checkbox" class="custom-control-input" id="roles" name="roles">
				              <label class="custom-control-label mr-1" for="roles"></label>
				              <span>Roles</span>
				            </div>
		                </div>


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

    <script src="/app-assets/js/scripts/forms/select/form-select2.js"></script>
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>

<script type="text/javascript">

$('.roles').addClass('active');



var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;

$.each([ 'dashboard', 'appointment','calendor','push_notification','service','review','coupon','workers','reports','roles' ], function( index, value ) {

if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
}

});
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Roles');
});


function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/vendor/save-role',
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
      url : '/vendor/update-role',
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
    url : '/vendor/role/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Role');
      $('#save').text('Save Change');
      $('input[name=role_name]').val(data.role_name);
      $('input[name=id]').val(id);
      

$.each([ 'dashboard', 'appointment','calendor','push_notification','service','review','coupon','workers','reports','roles' ], function( index, value ) {
//alert(value);
if (data[value] == 'on'){ 
  if ($('#'+value)[0].checked){ 
    // nothing
  }else{
    $('#'+value).trigger('click').attr("checked", "checked"); 
  }
}
else{ 
  if ($('#'+value)[0].checked){ 
    $('#'+value).trigger('click').removeAttr("checked"); 
  }else{ 
    // nothing, already off
  }
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
        url : '/vendor/role-delete/'+id,
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