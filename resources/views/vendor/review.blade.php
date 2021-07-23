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
                            <h5 class="content-header-title float-left pr-1 mb-0">Review & Ratings</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Review & Ratings
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
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Invoice ID</th>
						                                <th>Customer Name</th>
						                                <th>Comments</th>
						                                <th>Reviews</th>
                                                        <th>Date & Time</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($review as $row)
                                                <tr>
                                                    <td>#{{$row->invoice_id}}</td>
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
                                                </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Invoice ID</th>
						                                <th>Customer Name</th>
						                                <th>Comments</th>
						                                <th>Reviews</th>
                                                        <th>Date & Time</th>
                                                        <th>Status</th>
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

$('.review').addClass('active');

</script>
@endsection