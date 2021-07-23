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
                            <h5 class="content-header-title float-left pr-1 mb-0">Master</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Settlement Period
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
        
        				<form id="form" action="/admin/settlement-period" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input value="{{ $data->id }}" type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Settlement Period</label>
                                <select class="form-control" name="settlement_period" id="settlement_period">
                                	<option <?php echo ($data->settlement_period == '') ?  "selected" : "" ;  ?> value="">SELECT</option>
                                	<option <?php echo ($data->settlement_period == '1') ?  "selected" : "" ;  ?> value="1">Weekly</option>
                                	<option <?php echo ($data->settlement_period == '2') ?  "selected" : "" ;  ?> value="2">Two Weeks</option>
                                	<option <?php echo ($data->settlement_period == '3') ?  "selected" : "" ;  ?> value="3">Monthly</option>
                                	<option <?php echo ($data->settlement_period == '4') ?  "selected" : "" ;  ?> value="4">Two Months</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 form-group">
                                <label>Settlement Amount</label>
                                <input value="{{$data->settlement_amount}}" class="form-control" type="text" name="settlement_amount" id="settlement_amount">
                            </div>
                        </div>
                        
                        <hr>
                        <button class="btn btn-primary" type="submit">Save</button>
                        </form>

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
$('.settlement-period').addClass('active');
</script>
@endsection