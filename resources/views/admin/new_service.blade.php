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
                            <h5 class="content-header-title float-left pr-1 mb-0">Service List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Service
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
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                                        
            <div class="table-responsive">
               
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Salon</th>
                            <th>Service</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($service as $key => $row)
                    @if($id == $row->id)
	                  <tr style="background-color:#fff;color:#000;">
                            <td>{{$key + 1}}</td>
                            <td>
                                @foreach($salon as $user1)
                            @if($user1->id == $row->salon_id)
                            {{$user1->salon_name}}
                            @endif
                            @endforeach
                            <td>{{$row->service_name}}</td>
                            <td>{{$row->duration}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->remark}}</td>
                            <td>
                            	@if($row->status == 1)
                            	Approved
                                @elseif($row->status == 2)
                                Denied
                            	@else
                            	Pending
                            	@endif
                            </td>
                            
                <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="updateService({{$row->id}},1)" class="dropdown-item" href="#">Approved</a>
                  <a onclick="updateModel({{$row->id}})" class="dropdown-item" href="#">Denied</a>
                </div>
              </div></td>
                            </tr>
                        @else 
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                @foreach($salon as $user1)
                            @if($user1->id == $row->salon_id)
                            {{$user1->salon_name}}
                            @endif
                            @endforeach
                            <td>{{$row->service_name}}</td>
                            <td>{{$row->duration}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->remark}}</td>
                            <td>
                            	@if($row->status == 1)
                            	Approved
                                @elseif($row->status == 2)
                                Denied
                            	@else
                            	Pending
                            	@endif
                            </td>
                            
                <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="updateService({{$row->id}},1)" class="dropdown-item" href="#">Approved</a>
                  <a onclick="updateModel({{$row->id}})" class="dropdown-item" href="#">Denied</a>
                </div>
              </div></td>
                            </tr>
                        @endif
                         @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Salon</th>
                                <th>Service</th>
	                            <th>Duration</th>
                                <th>Price</th>
	                            <th>Remark</th>
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
                        <label>Remark</label>
                        <textarea id="deny_remark" name="deny_remark" class="form-control"></textarea>
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
$('.new-service').addClass('active');

function updateService(id,id1){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/update-new-service/'+id+'/'+id1,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Update');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
}


function updateModel(id){
    $('#modal-title').text('Add Remark');
    $('#save').text('Save Change');
    $('input[name=id]').val(id);
    $('#popup_modal').modal('show');
}

function Save(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/admin/update-service-request',
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
}

</script>
@endsection