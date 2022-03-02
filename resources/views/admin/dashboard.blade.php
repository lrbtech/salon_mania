@extends('admin.layouts')
@section('css')
<link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-ecommerce.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/css/pages/dashboard-analytics.min.css">
<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/swiper.min.css">
@endsection
@section('body-section')


   <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

<section id="dashboard-analytics">
  <div class="row">
@if(count($top_3) > 0)
<div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  <!-- <ol class="carousel-indicators">
    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
  </ol> -->
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <!--First slide-->
    @foreach($top_3 as $key=> $row)
    @if($key == 0)
    <div class="carousel-item active">
    
      <div class="card">
        <div class="card-header">
          <h3 class="greeting-text">Congratulations 
          @if($row->salon_name !='')
          {{$row->salon_name}}
          @else
          {{$row->name}}
          @endif
          !</h3>
          <p class="mb-0">Best seller of the month</p>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end">
              <div class="dashboard-content-left">
                <h1 class="text-primary font-large-2 text-bold-500">AED {{$row->total_amount}}</h1>
                <!-- <p>You have done 57.6% more sales today.</p> -->
                <!-- <button type="button" class="btn btn-primary glow">View Sales</button> -->
              </div>
              <div class="dashboard-content-right">
                <img src="/images/cup-{{$key+1}}.jpg" height="220" width="220" class="img-fluid"
                  alt="Dashboard Ecommerce" />
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @else
    <div class="carousel-item">
    
      <div class="card">
        <div class="card-header">
          <h3 class="greeting-text">Congratulations 
          @if($row->salon_name !='')
          {{$row->salon_name}}
          @else
          {{$row->name}}
          @endif
          !</h3>
          <p class="mb-0">Best seller of the month</p>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end">
              <div class="dashboard-content-left">
                <h1 class="text-primary font-large-2 text-bold-500">AED {{$row->total_amount}}</h1>
                <!-- <p>You have done 57.6% more sales today.</p> -->
                <!-- <button type="button" class="btn btn-primary glow">View Sales</button> -->
              </div>
              <div class="dashboard-content-right">
                <img src="/images/cup-{{$key+1}}.jpg" height="220" width="220" class="img-fluid"
                  alt="Dashboard Ecommerce" />
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    @endif
    @endforeach        
    <!--/First slide-->
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a style="top:-100px !important;" class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a style="top:-100px !important;" class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
</div>
@else
    <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
      <div class="card">
        <div class="card-header">
          <h3 class="greeting-text">Congratulations Salon Mania!</h3>
          <p class="mb-0">Best seller of the month</p>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-end">
              <div class="dashboard-content-left">
                <h1 class="text-primary font-large-2 text-bold-500"></h1>
                <p>You have done 0% more sales today.</p>
                <button type="button" class="btn btn-primary glow">View Sales</button>
              </div>
              <div class="dashboard-content-right">
                <img src="/app-assets/images/icon/cup.png" height="220" width="220" class="img-fluid"
                  alt="Dashboard Ecommerce" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endif

    


      

  <!-- <div class="col-xl-4 col-md-6 col-12 activity-card">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Total Users</h4>
        </div>
        <div class="card-content"> 
          <div class="card-body pt-1">
            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-primary m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-bar-chart-alt-2 text-primary"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Salon</small>
                <small class="float-right">{{$salon_count}}</small>
                <div class="progress progress-bar-primary progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>
            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-success m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-dollar text-success"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Spa</small>
                <small class="float-right">{{$spa_count}}</small>
                <div class="progress progress-bar-success progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>

            <div class="d-flex activity-content">
              <div class="avatar bg-rgba-warning m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-stats text-warning"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Makeup Artist</small>
                <small class="float-right">{{$makeup_count}}</small>
                <div class="progress progress-bar-warning progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>

            <div class="d-flex mb-75">
              <div class="avatar bg-rgba-danger m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-check text-danger"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Beauty Clinic</small>
                <small class="float-right">{{$beauty_count}}</small>
                <div class="progress progress-bar-danger progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>

            <div class="d-flex mb-75">
              <div class="avatar bg-rgba-warning m-0 mr-75">
                <div class="avatar-content">
                  <i class="bx bx-stats text-warning"></i>
                </div>
              </div>
              <div class="activity-progress flex-grow-1">
                <small class="text-muted d-inline-block mb-50">Total Home Services</small>
                <small class="float-right">{{$home_count}}</small>
                <div class="progress progress-bar-warning progress-sm">
                  <div class="progress-bar" role="progressbar" aria-valuenow="50" style="width:50%"></div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div> -->
    <!-- Profit Report Card Starts-->
    <div class="col-xl-4 col-md-6 col-12 sales-card">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="card-title-content">
            <h4 class="card-title">Sales</h4>
            <small class="text-muted">Calculated in last 7 days</small>
          </div>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div id="sales-chart" class="mb-2"></div>
            <div class="d-flex justify-content-between my-1">
              <div class="sales-info d-flex align-items-center">
                <i class='bx bx-up-arrow-circle text-primary font-medium-5 mr-50'></i>
                <div class="sales-info-content">
                  <h6 class="mb-0">Last 7 Days</h6>
                  <small class="text-muted">Revenue</small>
                </div>
              </div>
              <h6 class="mb-0">AED {{$last7days}}</h6>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <div class="sales-info d-flex align-items-center">
                <i class='bx bx-down-arrow-circle icon-light font-medium-5 mr-50'></i>
                <div class="sales-info-content">
                  <h6 class="mb-0">Last 30 Days</h6>
                  <small class="text-muted">Revenue</small>
                </div>
              </div>
              <h6 class="mb-0">AED {{$last30days}}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Latest Update Starts -->
    <div class="col-xl-4 col-md-6 col-12 dashboard-latest-update">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center pb-50">
          <h4 class="card-title">Total Business Revenue</h4>
          <!-- <div class="dropdown">
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButtonSec"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              2019
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
              <a class="dropdown-item" href="#">2019</a>
              <a class="dropdown-item" href="#">2018</a>
              <a class="dropdown-item" href="#">2017</a>
            </div>
          </div> -->
        </div>
        <div class="card-content">
          <div class="card-body p-0 pb-1">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                <div class="list-left d-flex">
                  <div class="list-icon mr-1">
                    <div class="avatar bg-rgba-primary m-0">
                      <div class="avatar-content">
                        <i class="bx bxs-zap text-primary font-size-base"></i>
                      </div>
                    </div>
                  </div>
                  <div class="list-content">
                    <span class="list-title">Total Salon</span>
                    <small class="text-muted d-block">{{$salon_count}}</small>
                  </div>
                </div>
                <span>{{$salon_amount}} AED</span>
              </li>
              <li
                class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                <div class="list-left d-flex">
                  <div class="list-icon mr-1">
                    <div class="avatar bg-rgba-info m-0">
                      <div class="avatar-content">
                        <i class="bx bx-stats text-info font-size-base"></i>
                      </div>
                    </div>
                  </div>
                  <div class="list-content">
                    <span class="list-title">Total Spa</span>
                    <small class="text-muted d-block">{{$spa_count}}</small>
                  </div>
                </div>
                <span>{{$spa_amount}} AED</span>
              </li>
              <li
                class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                <div class="list-left d-flex">
                  <div class="list-icon mr-1">
                    <div class="avatar bg-rgba-danger m-0">
                      <div class="avatar-content">
                        <i class="bx bx-credit-card text-danger font-size-base"></i>
                      </div>
                    </div>
                  </div>
                  <div class="list-content">
                    <span class="list-title">Makeup Artist</span>
                    <small class="text-muted d-block">{{$makeup_count}}</small>
                  </div>
                </div>
                <span>{{$makeup_amount}} AED</span>
              </li>
              <li
                class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                <div class="list-left d-flex">
                  <div class="list-icon mr-1">
                    <div class="avatar bg-rgba-success m-0">
                      <div class="avatar-content">
                        <i class="bx bx-dollar text-success font-size-base"></i>
                      </div>
                    </div>
                  </div>
                  <div class="list-content">
                    <span class="list-title">Beauty Clinic</span>
                    <small class="text-muted d-block">{{$beauty_count}}</small>
                  </div>
                </div>
                <span>{{$beauty_amount}} AED</span>
              </li>
              <li
                class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                <div class="list-left d-flex">
                  <div class="list-icon mr-1">
                    <div class="avatar bg-rgba-primary m-0">
                      <div class="avatar-content">
                        <i class="bx bx-user text-primary font-size-base"></i>
                      </div>
                    </div>
                  </div>
                  <div class="list-content">
                    <span class="list-title">Home Services</span>
                    <small class="text-muted d-block">{{$home_count}}</small>
                  </div>
                </div>
                <span>{{$home_amount}} AED</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Earning Swiper Starts -->

    <div class="col-xl-4 col-md-12 col-sm-12">
      <div class="row">
        <!-- Conversion Chart Starts-->
        
        <div class="col-xl-12 col-md-6 col-12">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                      <div class="avatar-content">
                        <i class="bx bx-user text-primary font-medium-2"></i>
                      </div>
                    </div>
                    <div class="total-amount">
                      <h5 class="mb-0">{{$total_booking}}</h5>
                      <small class="text-muted">Total Booking</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-12 col-sm-12">
      <div class="row">
        <!-- Conversion Chart Starts-->
        
        <div class="col-xl-12 col-md-6 col-12">
          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                      <div class="avatar-content">
                        <i class="bx bx-dollar text-warning font-medium-2"></i>
                      </div>
                    </div>
                    <div class="total-amount">
                      <h5 class="mb-0">{{$today_booking}}</h5>
                      <small class="text-muted">Today Booking</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-12 col-sm-12">
      <div class="row">
        <!-- Conversion Chart Starts-->
        
        <div class="col-xl-12 col-md-6 col-12">
          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                      <div class="avatar-content">
                        <i class="bx bx-dollar text-warning font-medium-2"></i>
                      </div>
                    </div>
                    <div class="total-amount">
                      <h5 class="mb-0">{{$open_booking}}</h5>
                      <small class="text-muted">Open Booking</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    

  </div>
  <div class="row">
    


  <div class="col-xl-4 col-md-6 col-12 dashboard-earning-swiper" id="widget-earnings">
      <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
          <h5 class="card-title"><i class="bx bx-dollar font-medium-5 align-middle"></i> <span class="align-middle">Top 5 Buisness</span></h5>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="card-content">
          <div class="card-body py-1 px-0">
            <!-- earnings swiper starts -->
            <div class="widget-earnings-swiper swiper-container p-1">
              <div class="swiper-wrapper">

                <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="top-salon">
                  <i class="bx bx-check-shield mr-50 font-large-1"></i>
                  <div class="swiper-text">
                    <div class="swiper-heading">Top</div>
                    <small class="d-block">Salons</small>
                  </div>
                </div>

                <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="top-spa">
                  <i class="bx bx-check-shield mr-50 font-large-1"></i>
                  <div class="swiper-text">
                    <div class="swiper-heading">Top</div>
                    <small class="d-block">Spa</small>
                  </div>
                </div>

                <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="top-makeup">
                  <i class="bx bx-check-shield mr-50 font-large-1"></i>
                  <div class="swiper-text">
                    <div class="swiper-heading">Top</div>
                    <small class="d-block">Makeup Artist</small>
                  </div>
                </div>

                <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="top-beauty">
                  <i class="bx bx-check-shield mr-50 font-large-1"></i>
                  <div class="swiper-text">
                    <div class="swiper-heading">Top</div>
                    <small class="d-block">Beauty Clinic</small>
                  </div>
                </div>

                <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center" id="top-home">
                  <i class="bx bx-check-shield mr-50 font-large-1"></i>
                  <div class="swiper-text">
                    <div class="swiper-heading">Top</div>
                    <small class="d-block">Home Services</small>
                  </div>
                </div>

              </div>
            </div>
            <!-- earnings swiper ends -->
          </div>
        </div>
        <div class="main-wrapper-content">
          <div class="wrapper-content" data-earnings="top-salon">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                @foreach($top_salon as $row)
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="#">
                          <img src="/upload_files/{{$row->profile_image}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">{{$row->salon_name}}</h6>
                          <span class="font-small-2">+971 {{$row->phone}}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="top-spa">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                @foreach($top_spa as $row)
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="#">
                          <img src="/upload_files/{{$row->profile_image}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">{{$row->salon_name}}</h6>
                          <span class="font-small-2">+971 {{$row->phone}}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="top-makeup">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                @foreach($top_makeup as $row)
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="#">
                          <img src="/upload_files/{{$row->profile_image}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">{{$row->salon_name}}</h6>
                          <span class="font-small-2">+971 {{$row->phone}}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="top-beauty">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                @foreach($top_beauty as $row)
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="#">
                          <img src="/upload_files/{{$row->profile_image}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">{{$row->salon_name}}</h6>
                          <span class="font-small-2">+971 {{$row->phone}}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="wrapper-content" data-earnings="top-home">
            <div class="widget-earnings-scroll table-responsive">
              <table class="table table-borderless widget-earnings-width mb-0">
                <tbody>
                @foreach($top_home as $row)
                  <tr>
                    <td class="pr-75">
                      <div class="media align-items-center">
                        <a class="media-left mr-50" href="#">
                          <img src="/upload_files/{{$row->profile_image}}" alt="avatar"
                            class="rounded-circle" height="30" width="30">
                        </a>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">{{$row->name}}</h6>
                          <span class="font-small-2">+971 {{$row->phone}}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    

        <!-- Marketing Campaigns Starts -->
        <div class="col-xl-8 col-12 dashboard-marketing-campaign">
      <div class="card marketing-campaigns">
        <div class="card-header d-flex justify-content-between align-items-center pb-1">
          <h4 class="card-title">New Users</h4>
          <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
        </div>
        <div class="table-responsive">
          <!-- table start -->
          <table id="table-marketing-campaigns" class="table table-borderless table-marketing-campaigns mb-0">
            <thead>
              <tr>
                <td>#</td>
                <th>Busisness Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            @if(!empty($new_user))
            @foreach($new_user as $key => $row)
              <tr>
                <td class="py-1 line-ellipsis">
                {{$key+1}}
                </td>
                <td class="py-1">
                @if($row->salon_name != '')
                {{$row->salon_name}}
                @else
                {{$row->name}}
                @endif
                </td>
                <td class="py-1">
                +971 {{$row->phone}}
                </td>
                <td class="text-success">
                {{$row->email}}
                </td>
                <td class="text-center py-1">
                  <div class="dropdown">
                    <span
                      class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></span>
                    <div class="dropdown-menu dropdown-menu-right">
                      <!-- <a class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> View</a> -->
                      <a onclick="ChangeCommission({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-lock-alt mr-1"></i> Active</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            @else
            <tr>
            <td colspan="4">
            <center>No data!</center>
            </td>
            </tr>
            @endif
            </tbody>
          </table>
          <!-- table ends -->
        </div>
      </div>
    </div>


  </div>
</section>



            </div>
        </div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="commission_modal" tabindex="-1" role="dialog" aria-labelledby="commission_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="commission_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="commission_id" id="commission_id">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Commission Percentage</label>
                            <select id="commission_percentage" name="commission_percentage" class="form-control">
                                <option value="">SELECT</option>
                                <?php for($i=1;$i<=20;$i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button onclick="UpdateCommission()" class="btn btn-primary btn-block mr-10" type="button">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->
@endsection

@section('js')

 <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/swiper.min.js"></script>

    <script src="/app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
    <script src="/app-assets/js/scripts/pages/dashboard-analytics.min.js"></script>
<script>
$('.dashboard').addClass('active');

function ChangeStatus(id,id1){
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url : '/admin/ChangeStatus/'+id+'/'+id1,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        toastr.success(data, 'Successfully Update');
        location.reload();
      }
    });
  } 
}

function ChangeCommission(id){
  $('input[name=commission_id]').val(id);
  $('#commission_modal').modal('show');
}

function UpdateCommission(){
  var formData = new FormData($('#commission_form')[0]);
    $.ajax({
        url : '/admin/update-commission',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
            $("#commission_form")[0].reset();
            $('#commission_modal').modal('hide');
            // var new_url = '/admin/get-salon/'+$('#search_busisness_type').val();
            // orderPageTable.ajax.url(new_url).load();
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