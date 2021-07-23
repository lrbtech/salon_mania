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
                            <h5 class="content-header-title float-left pr-1 mb-0">Banner List</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Banner
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
          <span>New Banner</span>
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
                            <th>Banner Title Name</th>
                            <th>SubTitle</th>
                            <th>Banner Position</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($banner as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->sub_title}}</td>
                            <td>{{$row->banner_position}}</td>
                            <td><img src="{{ asset("upload_files/$row->banner_image")}}" alt="" style="width:80px"></td>
                            
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
                              <th>Banner Title Name</th>
                              <th>SubTitle</th>
                              <th>Banner Position</th>
                              <th>Banner Image</th>
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
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Title</label>

              <input type="text" id="title" class="form-control" placeholder="Enter your banner Title"
              name="title">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Title Color</label>

              <input type="text" id="title_color" class="form-control" placeholder="#000000"
              name="title_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Title Y Position</label>

              <input type="text" id="title_y" class="form-control" placeholder="100"
              name="title_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Sub Title</label>

              <input type="text" id="sub_title" class="form-control" placeholder="Enter your banner sub title"
              name="sub_title">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Sub Title Color</label>

              <input type="text" id="sub_color" class="form-control" placeholder="#000000"
              name="sub_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="sub_y" class="form-control" placeholder="100"
              name="sub_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Description</label>

              <input type="text" id="desc" class="form-control" placeholder="Enter your Banner Description"
              name="desc">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Description Color</label>

              <input type="text" id="desc_color" class="form-control" placeholder="#000000"
              name="desc_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="desc_y" class="form-control" placeholder="100"
              name="desc_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Button Text</label>

              <input type="text" id="button_text" class="form-control" placeholder="Enter your button text"
              name="button_text">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Button Color</label>

              <input type="text" id="button_color" class="form-control" placeholder="#000000"
              name="button_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="button_y" class="form-control" placeholder="100"
              name="button_y">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Button URL</label>
            <div class="col-md-9">
              <input type="text" id="button_url" class="form-control" placeholder="http://" name="button_url">
            </div>
          </div>

          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Select Banner Position</label>
                <div class="col-md-9">
                  <select id="banner_position" name="banner_position" class="form-control">
                    <option selected="" value="0" disabled>select</option>
                    <option value="right">Right</option>
                    <option value="left">Left</option>
                    <option value="center">Center</option>
                  </select>
                </div>
              </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Banner Image</label>
            <div class="col-md-9">
                <input id="banner_image" type="file" class="form-control" accept="image/*" name="banner_image" />
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
$('.banner').addClass('active');

var action_type;
$('#add_new').click(function(){
    $('#popup_modal').modal('show');
    $("#form")[0].reset();
    $('#prevImage').attr('src', '');
    action_type = 1;
    $('#saveButton').text('Save');
    $('#modal-title').text('Add Banner');
});

function Save(){
  var formData = new FormData($('#form')[0]);
  if(action_type == 1){
    $.ajax({
        url : '/admin/save-banner',
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
      url : '/admin/update-banner',
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
    url : '/admin/banner/'+id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('#modal-title').text('Update Banner');
      $('#save').text('Save Change');
      $('input[name=title]').val(data.title);
      $('input[name=sub_title]').val(data.sub_title);
      $('input[name=desc]').val(data.desc);
      $('input[name=button_text]').val(data.button_text);
      $('input[name=button_url  ]').val(data.button_url );
      $('input[name=button_color]').val(data. button_color);
      $('input[name=button_y]').val(data.button_y);
      $('select[name=banner_position]').val(data.banner_position);
      $('input[name=title_color]').val(data.title_color);
      $('input[name=title_y]').val(data.title_y);
      $('input[name=sub_color]').val(data.sub_color);
      $('input[name=sub_y]').val(data.sub_y);
      $('input[name=desc_color]').val(data.desc_color);
      $('input[name=desc_y]').val(data.desc_y);
      $('input[name=category_name]').val(data.category_name);
      $('#prevImage').attr('src', '/upload_files/'+data.banner_image);
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
        url : '/admin/banner-delete/'+id,
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