 @section('css')
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/tables/datatable/datatables.min.css">
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
     <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/pickadate/pickadate.css">
	<link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
<style>
  .select2-container--default .select2-selection--multiple {
    width: 100% !important;
  }
  </style>
 @endsection
 @extends('admin.layouts')
@section('body-section')
 <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Coupon</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Coupon
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
                                <div class="card-header">
        
        				<form id="coupon_form" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input type="hidden" value="{{ Request::segment(3) }}" name="id" id="id">

						<div class="form-body">
                              
                              <h4 class="form-section"><i class="ft-clipboard"></i> Coupons</h4>
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput5">Coupon Code</label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control" placeholder="Enter your coupon code"
                                  name="coupon_code" id="coupon_code">
                                </div>
                              </div>
                                                            
                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput9">Description</label>
                                <div class="col-md-9">
                                  <textarea rows="5" class="form-control" name="description" id="description" placeholder="Term & Conditions"></textarea>
                                </div>
                              </div>
                            
                         
                                    <h4 class="form-section"><i class="la la-eye"></i> Coupon Usage Range</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput1">Start Date</label>
                                          <div class="input-group col-md-9">
                                            <input name="start_date" id="start_date" type="text" class="form-control pickadate" placeholder="Select Date">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput2">Expire Date</label>
                                          <div class="input-group col-md-9">
                                          	<input name="end_date" id="end_date" type="text" class="form-control pickadate" placeholder="Select Date">
                                           </div>
                                        </div>
                                      </div>
                                    </div>
                                    <h4 class="form-section"><i class="la la-eye"></i> General</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput7">Discount type</label>
                                              <div class="col-md-9">
                                                <select onchange="discounttype()" id="discount_type" name="discount_type" class="form-control">
                                                  <option value="0" selected="" disabled="">Select the Discount type</option>
                                                  <!-- <option value="1">Discount from service</option>
                                                  <option value="2">% Discount from service</option> -->
                                                  <option value="3">Discount Value</option>
                                                  <option value="4">% Discount Percentage</option>
                                                </select>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label id="per" class="col-md-3 label-control" for="userinput2">Amount</label>
                                          <div class="col-md-9">
                                            <input type="text" id="amount" name="amount" class="form-control border-primary" placeholder="Enter the discount Amount"
                                           >
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- <div  class="row">
                                      <div id="serviceshow" class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput3">Select the service</label>
                                          <div class="col-md-9">
                                            <select style="width:100% !imporatnt;" id="service_id" name="service_id[]" class="select2 form-control" multiple="multiple">
                                              <optgroup label="Select service">
                                              @foreach ($service as $service1)
                                                <option value="{{$service1->id}}">{{$service1->service_name_english}}</option>
                                              @endforeach
                                              </optgroup>
                                            </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div id="maxshow" class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput3">Max Value</label>
                                          <div class="col-md-9">
                                            <input type="text" id="max_value" name="max_value" class="form-control border-primary" placeholder="Enter the Max Value">
                                          </div>
                                        </div>
                                      </div>
                                 
                                    </div> -->
                                    
                                    <h4 class="form-section"><i class="ft-mail"></i> Usage Limits</h4>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput5">Usage minimum order value</label>
                                          <div class="col-md-9">
                                            <input class="form-control border-primary" type="text" placeholder="Enter min order value" id="min_order_val" name="min_order_val">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput6">Usage limit per user</label>
                                          <div class="col-md-9">
                                            <input name="limit_per_user" id="limit_per_user" class="form-control border-primary" type="text" placeholder="enter per user limit">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput5">User Type</label>
                                          <div class="col-md-9">
                                            <select onchange="usertype()" id="user_type" name="user_type" class="form-control">
                                              <option value="" selected="" >All</option>
                                              <option value="1">Selected User</option>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="usershow" class="col-md-6">
                                        <div class="form-group row">
                                          <label class="col-md-3 label-control" for="userinput3">Select the User</label>
                                          <div class="col-md-9">
                                            <select style="width:100% !imporatnt;" id="user_id" name="user_id[]" class="select2 form-control" multiple="multiple">
                                              <optgroup label="Select service">
                                              @foreach ($user as $user1)
                                                <option value="{{$user1->id}}">{{$user1->email}}</option>
                                              @endforeach
                                              </optgroup>
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                        
                        <hr>
                        </form>
                        <button class="btn btn-primary" onclick="Save()" type="button">Save</button>

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
    <!-- END: Page Vendor JS-->
    <script src="/app-assets/js/scripts/datatables/datatable.js"></script>

    
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>

<script src="/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="/app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
<script src="/app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>

    <script src="/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script src="/app-assets/js/scripts/forms/select/form-select2.js"></script>

<script type="text/javascript">
$('.coupon').addClass('active');


$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});


$("#serviceshow").hide();
$("#usershow").hide();
function discounttype(){
  var discount_type = $("#discount_type").val();
  // if(discount_type == "1" || discount_type == "2"){
  //   $("#serviceshow").show();
  //   $('input[name=service_id]').val('');
  // }
  // else{
  //   $("#serviceshow").hide();
  // }
  if(discount_type == '2' || discount_type == "4"){
    $("#maxshow").show();
    $('#per').html("Percentage");
  }
  else{
    $("#maxshow").hide();
    $('#per').html("Amount");
  }
}

function usertype(){
  var user_type = $("#user_type").val();
  if(user_type == '1'){
    $("#usershow").show();
  }
  else{
    $("#usershow").hide();
  }
}

  var id = $("#id").val();

  $.ajax({
        url : '/admin/CouponEdit/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('input[name=coupon_code]').val(data.coupon_code);
          $('textarea[name=description]').val(data.description);
          $('input[name=start_date]').val(data.start_date);
          $('input[name=end_date]').val(data.end_date);
          $('select[name=discount_type]').val(data.discount_type);
          $('select[name=user_type]').val(data.user_type);
          $('input[name=amount]').val(data.amount);
          //$('input[name=max_value]').val(data.max_value);
          $('input[name=limit_per_user]').val(data.limit_per_user);
          $('input[name=min_order_val]').val(data.min_order_val);
          $('input[name=id]').val(data.id);

  // if(data.discount_type == 1 || data.discount_type == 2){
  //   $("#serviceshow").show();
  //   get_coupon_service(data.id);
  // }
  // else{
  //   $("#serviceshow").hide();
  // }

  if(data.discount_type == 2 || data.discount_type == 4){
    $("#maxshow").show();
    $('#per').html("Percentage");
  }
  else{
    $("#maxshow").hide();
    $('#per').html("Amount");
  }

  if(data.user_type == 1){
    $("#usershow").show();
    get_coupon_user(data.id);
  }
  else{
    $("#usershow").hide();
  }

          $('#user_model').modal('show');
          action_type = 2;
        }
      });
function get_coupon_service(id)
{
    $.ajax({        
        url : '/admin/get_coupon_service/'+id,
        type: "GET",
        success: function(data)
        {
           $('#service_id').html(data);
        }
   });
}
function get_coupon_user(id)
{
    $.ajax({        
        url : '/admin/get_coupon_user/'+id,
        type: "GET",
        success: function(data)
        {
           $('#user_id').html(data);
        }
   });
}
  if(id==""){
    function Save(){
      
      var formData = new FormData($('#coupon_form')[0]);
      $.ajax({
          url : '/admin/CouponSave',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);                
            $("#coupon_form")[0].reset();
            //$('.table').load(location.href+' .table');
            toastr.success('Coupon Store Successfully', 'Successfully Save');
            window.location.href="/admin/coupon/";
          },
          error: function (data, errorThrown) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
            });
          }
      });
    }
  }
  else{
    function Save(){
      //alert($("#service_id").val());
      var formData = new FormData($('#coupon_form')[0]);
      $.ajax({
          url : '/admin/CouponUpdate',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);                
            $("#coupon_form")[0].reset();
            //$('.table').load(location.href+' .table');
            toastr.success('Coupon Updated Successfully', 'Successfully Update');
            window.location.href="/admin/coupon/";
          },
          error: function (data, errorThrown) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
            });
          }
      });
    }
  }


$('.singledate').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true
});
</script>
@endsection