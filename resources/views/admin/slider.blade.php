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
                            <h5 class="content-header-title float-left pr-1 mb-0">Slider List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Slider
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
        <!-- new task button -->
        <button id="add_new" style="width: 200px;" type="button" class="btn btn-primary add-task-btn btn-block my-1">
          <i class="bx bx-plus"></i>
          <span>New Slider</span>
        </button>
        </div>
        <div class="card-content">
            <div class="card-body card-dashboard">
                <!-- <p class="card-text">In this Table Show All type of Salon Information, Booking Details and Payment Details.</p> -->
                                        
            <div class="table-responsive">
               
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                              <th>Text</th>
                              <th>Image Fit</th>
                              <th>Slider Image</th>
                              <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($slider as $key => $row)
                        <tr>
                            <td>{{$row->order}}</td>
                            <td>{{$row->text}}</td>
                            <td>{{$row->image_fit}}</td>
                            <td><img src="{{ asset("upload_files/$row->slider_image")}}" alt="" style="width:80px"></td>
                            
                <td><div class="dropdown">
                <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </span>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-125px, 19px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a onclick="Edit({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-edit-alt mr-1"></i> edit</a>
                  <a onclick="Delete({{$row->id}})" class="dropdown-item" href="#"><i class="bx bx-trash mr-1"></i> delete</a>
                </div>
              </div></td>
                            </tr>

                         @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>#</th>
                              <th>Text</th>
                              <th>Image Fit</th>
                              <th>Slider Image</th>
                              <th>Action</th>
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


 
<!-- Bootstrap Modal -->
<div class="modal fade" id="popup_modal" tabindex="-1" role="dialog" aria-labelledby="popup_modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-grey-dark-5">
                <h6 class="modal-title text-white" id="modal-title">Add New</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
<form id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">

    <div class="form-group row ">
        <label for="order" class="col-3 control-label text-right">Order</label>
        <div class="col-9">
            <input class="form-control" placeholder="Insert Order" name="order" type="number" id="order">
        </div>
    </div>

    <!-- Text Field -->
    <div class="form-group row ">
        <label for="text" class="col-3 control-label text-right">Text</label>
        <div class="col-9">
            <input class="form-control" placeholder="Insert Text" name="text" type="text" id="text">
        </div>
    </div>

    <!-- Button Field -->
    <div class="form-group row ">
        <label for="button" class="col-3 control-label text-right">Button</label>
        <div class="col-9">
            <input class="form-control" placeholder="Insert Button" name="button" type="text" id="button">
        </div>
    </div>

    <!-- Text Position Field -->
    <div class="form-group row ">
        <label for="text_position" class="col-3 control-label text-right">Text Position</label>
        <div class="col-9">
            <select class="select2 form-control" id="text_position" name="text_position"><option value="top_start">Top Start</option><option value="top_center">Top Center</option><option value="top_end">Top End</option><option value="center_start">Center Start</option><option value="center">Center</option><option value="center_end">Center End</option><option value="bottom_start">Bottom Start</option><option value="bottom_center">Bottom Center</option><option value="bottom_end"> Bottom End</option></select>
        </div>
    </div>

    <!-- Main Color Field -->
    <div class="form-group row">
        <label for="text_color" class="col-3 control-label text-right">Text Color</label>
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                <input class="form-control" placeholder="Insert Text Color" autocomplete="off" name="text_color" type="text" id="text_color">
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Button Color Field -->
    <div class="form-group row">
        <label for="button_color" class="col-3 control-label text-right">Button Color</label>
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                <input class="form-control" placeholder="Insert Button Color" autocomplete="off" name="button_color" type="text" id="button_color">
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Color Field -->
    <div class="form-group row">
        <label for="background_color" class="col-3 control-label text-right">Background Color</label>
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                <input class="form-control" placeholder="Insert Background Color" autocomplete="off" name="background_color" type="text" id="background_color">
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
        </div>
    </div>


    <!-- Indicator Color Field -->
    <div class="form-group row">
        <label for="indicator_color" class="col-3 control-label text-right">Indicator Color</label>
        <div class="col-9">
            <div id="main-colorpicker" class="input-group colorpicker-component">
                <input class="form-control" placeholder="Insert Indicator Color" autocomplete="off" name="indicator_color" type="text" id="indicator_color">
                <div class=" input-group-append ">
                    <span class="input-group-addon input-group-text"><i></i></span>
                </div>
            </div>
        </div>
    </div>

    
<!-- Image Fit Field -->
    <div class="form-group row ">
        <label for="image_fit" class="col-3 control-label text-right">Image Fit</label>
        <div class="col-9">
            <select class="select2 form-control" id="image_fit" name="image_fit"><option value="cover">Cover</option><option value="fill">Fill</option><option value="contain">Contain</option><option value="fit_height">Fit Height</option><option value="fit_width">Fit Width</option><option value="none">None</option><option value="scale_down">Scale Down</option></select>
        </div>
    </div>

    <!-- Food Id Field -->
    <div class="form-group row ">
        <label for="food_id" class="col-3 control-label text-right">Service</label>
        <div class="col-9">
          <select data-empty="Insert Food Id" class="select2 not-required form-control" id="service_id" name="service_id">
          <option value="">SELECT</option>
          @foreach($service as $ser)
          <option value="{{$ser->id}}">{{$ser->service_name_english}}</option>
          @endforeach
          </select>
        </div>
    </div>

    <!-- Restaurant Id Field -->
    <div class="form-group row ">
        <label for="restaurant_id" data-empty="Insert Restaurant Id" class="col-3 control-label text-right">Salon</label>
        <div class="col-9">
            <select class="select2 not-required form-control" id="salon_id" name="salon_id">
            <option value="">SELECT</option>
            @foreach($salon as $sal)
            @if($sal->salon_name != '')
            <option value="{{$sal->id}}">{{$sal->salon_name}}</option>
            @else 
            <option value="{{$sal->id}}">{{$sal->name}}</option>
            @endif
            @endforeach
            </select>
        </div>
    </div>

          <div class="form-group row">
            <label class="col-3 control-label text-right">Slider Image</label>
            <div class="col-9">
              <input id="slider_image" type="file" class="form-control" accept="image/*" name="slider_image" />
              <div id="preview"><img id="prevImage" style="width: 240px;
                padding-top: 20px;" src="" /></div><br>
            </div>
          </div>

        </div>
        </form>                    
                    <div class="form-group">
                        <button onclick="Save()" id="saveButton" class="btn btn-primary btn-block mr-10" type="button">Add</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- /Bootstrap Modal -->
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
$('.slider').addClass('active');

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    $('#prevImage').attr('src', '');
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Slider');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-slider',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {                
          $("#form")[0].reset();
          $('#popup_modal').modal('hide');
          $('.zero-configuration').load(location.href+' .zero-configuration');
          toastr.success(data, 'Successfully Save');
        },error: function (data) {
          var errorData = data.responseJSON.errors;
          $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
      });
    }
    });
  }else{
    $.ajax({
      url : '/admin/update-slider',
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      dataType: "JSON",
      success: function(data)
      {
        console.log(data);
        $("#form")[0].reset();
        $('#popup_modal').modal('hide');
        $('.zero-configuration').load(location.href+' .zero-configuration');
        toastr.success(data, 'Successfully Update');
      },error: function (data) {
        var errorData = data.responseJSON.errors;
        $.each(errorData, function(i, obj) {
          toastr.error(obj[0]);
        });
      }
    });
  }
}

function Edit(id){
  $.ajax({
    url : '/admin/slider/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Slider');
      $('#save').text('Save Change');
      $('input[name=order]').val(data.order);
      $('input[name=text]').val(data.text);
      $('input[name=button]').val(data.button);
      $('input[name=text_position]').val(data.text_position);
      $('input[name=text_color  ]').val(data.text_color );
      $('input[name=button_color]').val(data. button_color);
      $('input[name=background_color]').val(data.background_color);
      $('input[name=indicator_color]').val(data.indicator_color);
      $('input[name=image_fit]').val(data.image_fit);
      $('select[name=service_id]').val(data.service_id);
      $('select[name=salon_id]').val(data.salon_id);
      $('#prevImage').attr('src', '/upload_files/'+data.slider_image);
      $('input[name=id]').val(id);
      $('#popup_modal').modal('show');
      action_type = 2;
    }
  });
}

function Delete(id){
    var r = confirm("Are you sure");
    if (r == true) {
      $.ajax({
        url : '/admin/slider-delete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data, 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
}
</script>
@endsection