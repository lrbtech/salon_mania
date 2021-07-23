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
                            <h5 class="content-header-title float-left pr-1 mb-0">Booking List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Booking
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
                            <th>Order ID</th>
                            <th>Salon Name</th>
                            <th>Customer Name</th>
                            <th>Appointment Date/Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($booking as $row)
                    @if($row->payment_type == '1' && $row->payment_status == '0')
                    @else
                        @if($id == $row->id)
	                    <tr style="background-color:#fff;color:#000;">
                            <td>#{{$row->b_id}}</td>
                            <td>
                                @foreach($salon as $sal)
                                @if($sal->id == $row->salon_id)
                                {{$sal->salon_name}}
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
                            <td>{{$row->appointment_date}} / {{$row->appointment_time}}</td>
                            
                            <td>{{$row->total}} AED</td>
                            <td>
                            @if($row->booking_status == 0)
                            Un Visit
                            @else
                            Visited
                            @endif
                            </td>
                            <td>
                            <a href="/admin/print-invoice/{{$row->id}}" target="_blank">Print</a>
                            </td>
                        </tr>
                        @else 
                        <tr>
                            <td>#{{$row->b_id}}</td>
                            <td>
                                @foreach($salon as $sal)
                                @if($sal->id == $row->salon_id)
                                {{$sal->salon_name}}
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
                            <td>{{$row->appointment_date}} / {{$row->appointment_time}}</td>
                            
                            <td>{{$row->total}} AED</td>
                            <td>
                            @if($row->booking_status == 0)
                            Un Visit
                            @else
                            Visited
                            @endif
                            </td>
                            <td>
                            <a href="/admin/print-invoice/{{$row->id}}" target="_blank">Print</a>
                            </td>
                        </tr>
                        @endif
                    @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Salon Name</th>
                            <th>Customer Name</th>
                            <th>Appointment Date/Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Print</th>
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
$('.booking').addClass('active');


</script>
@endsection