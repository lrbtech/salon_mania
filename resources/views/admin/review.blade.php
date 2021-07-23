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
                            <h5 class="content-header-title float-left pr-1 mb-0">Reviews & Ratings List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Reviews & Ratings
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
        <!-- <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
          <i class="bx bx-plus"></i>
          <span>New Salon</span>
        </button> -->
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                
                <div class="table-responsive">
                   
                    <table class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>Invoice ID</th>
                                <th>Salon Name</th>
                                <th>Customer Name</th>
                                <th>Comments</th>
                                <th>Reviews</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($review as $row)
                            <tr>
                            	<td>#{{$row->invoice_id}}</td>
                                <td>
                                @foreach($salon as $sal)
                                @if($sal->id == $row->salon_id)
                                    @if($sal->salon_name != '')
                                    {{$sal->salon_name}}
                                    @else
                                    {{$sal->name}}
                                    @endif
                                @endif
                                @endforeach
                                </td>
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
                                <td>
                                @if($row->status == 0)
                                Waiting
                                @elseif($row->status == 1)
                                Approved
                                @elseif($row->status == 2)
                                Denied
                                @endif
                                </td>
                <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                @if($row->status == 0)
                  <a onclick="ChangeStatus({{$row->id}} , 1)" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> Approved</a>
                  <a onclick="ChangeStatus({{$row->id}} , 2)" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> Denied</a>
                @elseif($row->status == 1)
                    <a onclick="ChangeStatus({{$row->id}} , 2)" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> Denied</a>
                @elseif($row->status == 2)
                    <a onclick="ChangeStatus({{$row->id}} , 1)" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> Approved</a>
                @endif
                </div>
              </div></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Salon Name</th>
                        <th>Customer Name</th>
                        <th>Comments</th>
                        <th>Reviews</th>
                        <th>Date & Time</th>
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

$('.review').addClass('active');

var action_type;

$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Salon');
});

function ChangeStatus(id,id1){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/review-status/'+id+'/'+id1,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Status Changed Successfully');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
}
</script>
@endsection