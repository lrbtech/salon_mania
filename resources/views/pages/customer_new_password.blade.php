<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Salon Mania Create Your Own Password</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

     <link rel="stylesheet" type="text/css" href="{{ asset('toastr/toastr.css')}}">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
<!-- register section starts -->
<section class="row flexbox-container">
    <div class="col-xl-8 col-10">
        <div class="card bg-authentication mb-0">
            <div class="row m-0">
                <!-- register section left -->
                <div class="col-md-12 col-12 px-0">
                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                    <?php
                    $today = date('Y-m-d');
                    ?>
                    @if($customer->status == '0')
                    @if($customer->end_date >= $today)
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="text-center mb-2">Create Password</h4>
                            </div>
                        </div>
                        <!-- <div class="text-center">
                            <p> <small> Please enter your details to sign up and be part of our great community</small>
                            </p>
                        </div> -->
                        <div class="card-content">
                            <div class="card-body">
                                <form id="form" method="POST" enctype="multipart/form-data">
                                	{{ csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$id}}">
                                <input type="hidden" name="customer_id" id="customer_id" value="{{$customer->customer_id}}">
				                <div class="form-row">
				                    <div class="form-group col-md-12 mb-50">
				                        <label>New Password</label>
				                        <input class="form-control" type="password" name="password" id="password">
				                	</div>
				                </div>
				                <div class="form-row">
				                    <div class="form-group col-md-12 mb-50">
				                        <label>Confirm Password</label>
				                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
				                	</div>
				                </div>
                                </form> 
                                    <button onclick="Save()" type="button" class="btn btn-primary glow position-relative w-100">Save<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                
                            </div>
                        </div>
                    @else
                    <center>Your Link has Expired</center>
                    @endif
                    @else
                    <center>Already Register Your Password</center>
                    @endif
                    </div>
                </div>
                <!-- image section right -->
                <!-- <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <img class="img-fluid" src="/app-assets/images/pages/register.png" alt="branding logo">
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/js/scripts/components.js"></script>
    <script src="/app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->
<script src="{{ asset('toastr/toastr.min.js')}}"></script>
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->
<script type="text/javascript">
// $('.salon').addClass('active');


function Save(){
  var formData = new FormData($('#form')[0]);
    $.ajax({
        url : '/customer-update-password',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#form")[0].reset();
            // $('#popup_modal').modal('hide');
            // $('.zero-configuration').load(location.href+' .zero-configuration');
            toastr.success(data, 'Successfully Update');
            window.location.href="/";
        },error: function (data) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
            toastr.error(obj[0]);
      });
    }
    });
}
</script>
</html>