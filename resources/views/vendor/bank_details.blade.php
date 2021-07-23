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
            <!-- <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Report</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Report
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">

	<div class="col-12">
        <div class="card">
        	<div class="card-content">
            <div class="card-body card-dashboard">
            <section class="hk-sec-wrapper">
                <h5 class="hk-sec-title">Update Bank Details</h5>
                <div class="row">
                    <div class="col-sm">
                    	<form id="form" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="id" id="id" value="{{$profile->id}}" >


                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Account Number</label>
                        <input value="{{$profile->account_number}}" autocomplete="off" type="text" id="account_number" name="account_number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bank Name</label>
                        <input value="{{$profile->bank_name}}" autocomplete="off" type="text" id="bank_name" name="bank_name" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>IBan Number</label>
                        <input value="{{$profile->iban_number}}" autocomplete="off" type="text" id="iban_number" name="iban_number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Swift Code</label>
                        <input value="{{$profile->swift_code}}" autocomplete="off" type="text" id="swift_code" name="swift_code" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Account Name</label>
                        <input value="{{$profile->account_name}}" autocomplete="off" type="text" id="account_name" name="account_name" class="form-control">
                    </div>
                </div>
                
                <button onclick="Save()" class="btn btn-primary" type="button">Update</button>
                    </form>
                    </div>
                </div>
            </section>
            </div>
        	</div>
        </div>
    </div>



                    </div>
                </section>
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

function Save(){
    var formData = new FormData($('#form')[0]);
    $.ajax({
      url : '/vendor/update-bank-details',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
        $("#form")[0].reset();
        toastr.success(data, 'Successfully Update');
        location.reload();
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