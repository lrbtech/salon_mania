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
                <h5 class="hk-sec-title">Update Profile</h5>
                <div class="row">
                    <div class="col-sm">
                    	<form id="form" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input type="hidden" name="id" id="id" value="{{$profile->id}}" >


                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input value="{{$profile->name}}" autocomplete="off" type="text" id="name" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input value="{{$profile->phone}}" autocomplete="off" type="number" id="phone" name="phone" class="form-control">
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input value="{{$profile->email}}" autocomplete="off" type="email" id="email" name="email" class="form-control">
                    </div>
                    @if(Auth::user()->busisness_type != 5)
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <textarea id="address" name="address" class="form-control">{{$profile->address}}</textarea>
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Website</label>
                        <input value="{{$profile->website}}" autocomplete="off" type="text" id="website" name="website" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>About English</label>
                        <textarea row="5" id="about_english" name="about_english" class="form-control">{{$profile->about_english}}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>About Arabic</label>
                        <textarea row="5" id="about_arabic" name="about_arabic" class="form-control">{{$profile->about_arabic}}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>New Password</label>
                        <input autocomplete="off" type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>
                        <input autocomplete="off" type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Cover Image</label>
                        <input autocomplete="off" type="file" id="cover_image" name="cover_image" class="form-control">
                        <img style="width:100px;height:50px;" src="/upload_files/{{$profile->cover_image}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Profile Image</label>
                        <input autocomplete="off" type="file" id="profile_image" name="profile_image" class="form-control">
                        <img style="width:100px;height:50px;" src="/upload_files/{{$profile->profile_image}}">
                    </div>
                </div>
                
                    
                <hr>
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
      url : '/vendor/update-profile',
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