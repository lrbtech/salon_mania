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
                            <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Revenue Report
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
    <form id="form" action="/admin/excel-revenue-report" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card-header">
        <div class="row">
            <div class="form-group col-md-4">
                <label>From Date</label>
                <input autocomplete="off" type="date" id="from_date" name="from_date" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>To Date</label>
                <input autocomplete="off" type="date" id="to_date" name="to_date" class="form-control">
            </div>

            <div class="form-group col-md-2">
                <button id="search" class="btn btn-primary btn-block mr-10" type="button">Search</button>
            </div>
            <div class="form-group col-md-2">
                <button id="downloadexcel" class="btn btn-primary btn-block mr-10" type="submit">Excel</button>
            </div>
        </div>
    </div>
    </form>
        <div class="card-content">
            <div class="card-body card-dashboard">
                
                <div class="table-responsive">
                    <table id="datatable" class="table zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Salon Name</th>
                                <th>Customer</th>
                                <th>Total Services /
                                <br>Packages</br></th>
                                <th>Transaction /
                                <br>Mode</br></th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Salon Name</th>
                                <th>Customer</th>
                                <th>Total Services /
                                <br>Packages</br></th>
                                <th>Transaction /
                                <br>Mode</br></th>
                                <th>Total Amount</th>
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
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- <script src="/app-assets/js/scripts/datatables/datatable.js"></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> -->

<script type="text/javascript">
$('.revenue-report').addClass('active');


var orderPageTable = $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    //"pageLength": 50,
    "ajax":{
        "url": "/admin/get-booking/1/1",
        "dataType": "json",
        "type": "POST",
        "data":{ _token: "{{csrf_token()}}"}
    },
    "columns": [
        { data: 'booking_id', name: 'booking_id' },
        { data: 'booking_date', name: 'booking_date' },
        { data: 'salon_details', name: 'salon_details' },
        { data: 'customer_details', name: 'customer_details' },
        { data: 'total_services', name: 'total_services' },
        { data: 'payment_type', name: 'payment_type' },
        { data: 'total_amount', name: 'total_amount' },
    ]
});


$('#search').click(function(){
    //alert('hi');
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var fdate;
    var tdate;
    if(from_date!=""){
      fdate = from_date;
    }else{
      fdate = '1';
    }
    if(to_date!=""){
      tdate = to_date;
    }else{
      tdate = '1';
    }

    var new_url = '/admin/get-booking/'+fdate+'/'+tdate;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
});


// $('#downloadexcel').click(function(){
//   var formData = new FormData($('#form')[0]);
//     $.ajax({
//         url : '/admin/excel-revenue-report',
//         type: "POST",
//         data: formData,
//         contentType: false,
//         processData: false,
//         dataType: "JSON",
//         success: function(data)
//         {                
//             $("#form")[0].reset();
//             toastr.success(data, 'Successfully Export');
//         },error: function (data) {
//             var errorData = data.responseJSON.errors;
//             $.each(errorData, function(i, obj) {
//             toastr.error(obj[0]);
//       });
//     }
//     });
// });


</script>
@endsection
