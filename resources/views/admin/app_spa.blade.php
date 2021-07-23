@section('css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <meta name="csrf-token" content="{{ csrf_token() }}" />
 @endsection
 @extends('admin.layouts')
@section('body-section')
 <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">App Spa List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">{{$city->area}}
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
          <span>New App Spa</span>
        </button>
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                
                <div class="table-responsive">
                   
                    <table id="draggable" class="table">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Busisness name</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                  @foreach($app_spa as $row)
                    <tr id="<?php echo $row->id ?>" class="ui-draggable ui-draggable-handle ui-sortable-handle">
                      <td>{{$row->order_id}}</td>
                      <td>{{$row->salon_name}}
                      </td>
                      <td>
                      <a onclick="Delete({{$row->id}})" href="#"><i class="bx bx-trash mr-1"></i> </a></td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Position</th>
                        <th>Busisness name</th>
                        <th>Delete</th>
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
                <input value="{{$city->id}}" type="hidden" name="city_id" id="city_id">

                    <!-- <div class="form-group">
                        <label>Title</label>
                        <input autocomplete="off" type="text" id="title" name="title" class="form-control">
                    </div> -->

                    <div class="form-group">
                      <label>Select the Spa</label>
                      <select style="width:100% !imporatnt;" id="salon_id" name="salon_id" class="select2 form-control">
                        <option value="">Choose One</option>
                        <optgroup label="Select Salon">
                        @foreach ($salon as $salon1)
                          @if($salon1->salon_name != '')
                          <option value="{{$salon1->id}}">{{$salon1->salon_name}}</option>
                          @else
                          <option value="{{$salon1->id}}">{{$salon1->name}}</option>
                          @endif
                        @endforeach
                        </optgroup>
                      </select>
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
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="/app-assets/js/scripts/forms/select/form-select2.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var $sortable = $( "#draggable > tbody" );
  $sortable.sortable({
      stop: function ( event, ui ) {
          var parameters = $sortable.sortable( "toArray" );
          $.ajax({
            url : '/admin/update-app-spa',
            type: "POST",
            data: {
              value:parameters,
              _token: '{{csrf_token()}}'
            },
            dataType: "JSON",
            success: function(data)
            {                
              location.reload();
            }
          });
      }
  });
</script>

<script type="text/javascript">
$('.app-spa').addClass('active');

$('#salon_id').select2();
// $(".select2").select2({
//     dropdownAutoWidth: true,
//     width: '100%',
//     //color:'#fff';
// });
//     $('#salon_id').select2({
//         dropdownParent: $('#popup_modal')
//     });


var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add App Spa');
    $('#salon_id').select2();
});


function Save(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/save-app-spa',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            $('#popup_modal').modal('hide');
            $('.table').load(location.href+' .table');
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
        url : '/admin/app-spa-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          $('.table').load(location.href+' .table');
        }
      });
    } 
}

</script>
@endsection