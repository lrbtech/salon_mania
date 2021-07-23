@extends('vendor.layouts')
@section('body-section')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
<style>
.card{
  background-color:#046486 !important;
  color:#eeb861 !important;
}
.text-muted {
    color: #eeb861 !important;
}
h3.mb-0{
  color:#fff !important;
}

</style>
@if(!empty($role))
@if($role->dashboard == 'on')
    <div class="col-12">
        <div class="row">

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

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Today Revenue</div>
                    <h3 class="mb-0">AED {{$today_value}}</h3>
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
                    <div class="text-muted line-ellipsis">Current Month Revenue</div>
                    <h3 class="mb-0">AED {{$current_month_value}}</h3>
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
                    <div class="text-muted line-ellipsis">Last 7 Days Revenue</div>
                    <h3 class="mb-0">AED {{$last7days}}</h3>
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
                    <div class="text-muted line-ellipsis">Last 30 Days Revenue</div>
                    <h3 class="mb-0">AED {{$last30days}}</h3>
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
                    <div class="text-muted line-ellipsis">Total Services</div>
                    <h3 class="mb-0">{{$total_services}}</h3>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

@else
    <div class="col-12">
        <div class="row">

<!-- users view card details start -->
  <div class="card">
    <div class="card-content">
      <div class="card-body">
        <div class="col-12">
          <h5 class="mb-1"><i class="bx bx-info-circle"></i> Personal Info</h5>
          <table class="table table-borderless mb-0">
            <tbody>
              <tr>
                <td>Name:</td>
                <td>{{Auth::user()->name}}</td>
              </tr>
              <tr>
                <td>Email ID:</td>
                <td>{{Auth::user()->email}}</td>
              </tr>
              <tr>
                <td>Phone:</td>
                <td>{{Auth::user()->phone}}</td>
              </tr>
              <tr>
                <td>Address:</td>
                <td>{{Auth::user()->address}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- users view card details ends -->



        </div>
    </div>
@endif
@else

      <div class="col-12">
        <div class="row">

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

            <div class="col-md-3 dashboard-users-danger">
              <div class="card text-center">
                <div class="card-content">
                  <div class="card-body py-1">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <div class="text-muted line-ellipsis">Today Revenue</div>
                    <h3 class="mb-0">AED {{$today_value}}</h3>
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
                    <div class="text-muted line-ellipsis">Current Month Revenue</div>
                    <h3 class="mb-0">AED {{$current_month_value}}</h3>
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
                    <div class="text-muted line-ellipsis">Last 7 Days Revenue</div>
                    <h3 class="mb-0">AED {{$last7days}}</h3>
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
                    <div class="text-muted line-ellipsis">Last 30 Days Revenue</div>
                    <h3 class="mb-0">AED {{$last30days}}</h3>
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
                    <div class="text-muted line-ellipsis">Total Services</div>
                    <h3 class="mb-0">{{$total_services}}</h3>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

@endif
    
    

            </div>
        </div>
    </div>
@endsection