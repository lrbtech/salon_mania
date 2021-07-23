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
                            <h5 class="content-header-title float-left pr-1 mb-0">Report List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Settlement Report
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
                                                        <th>Salon Name</th>
                                                        <th>From Date</th>
						                                <th>To Date</th>
						                                <th>Period</th>
						                                <th>Commission Amount</th>
						                                <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
					                            <tr>
                                                    <td>Jojo Salon</td>
					                            	<td>09-07-2020</td>
					                                <td>20-07-2020</td>
					                                <td>Weekly</td>
					                                <td>100 AED</td>
					                                <td>Print</td>
					                    		</tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Salon Name</th>
                                                        <th>From Date</th>
						                                <th>To Date</th>
						                                <th>No of Services</th>
						                                <th>Withdraw Amount</th>
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
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>
<script type="text/javascript">
$('.settlement-report').addClass('active');


</script>
@endsection