@extends('admin.layouts')
@section('css')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-ecommerce.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/swiper.min.css">
@endsection
@section('body-section')


   <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">


                <div class="col-12">
        <div class="row">

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Salon</div>
                    <h3 class="mb-0">{{$salon_count}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Spa</div>
                    <h3 class="mb-0">{{$spa_count}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Makeup Artist</div>
                    <h3 class="mb-0">{{$makeup_count}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Beauty Clinic</div>
                    <h3 class="mb-0">{{$beauty_count}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Home Services</div>
                    <h3 class="mb-0">{{$home_count}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Total Booking</div>
                    <h3 class="mb-0">{{$total_booking}}</h3>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Today Booking</div>
                    <h3 class="mb-0">{{$today_booking}}</h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Open Booking</div>
                    <h3 class="mb-0">{{$open_booking}}</h3>
                  </div>
                </div>
              </div>
            </div>


        </div>
    </div>

                    
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
<script type="text/javascript">

$('.dashboard').addClass('active');

</script>
@endsection

@section('js')

 <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
@endsection