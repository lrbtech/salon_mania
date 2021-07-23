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
                            <h5 class="content-header-title float-left pr-1 mb-0">Apps</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">App Privacy Policy
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
        
        				<form id="form" action="/admin/update-app-privacy" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input value="{{ $data->id }}" type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>App Privacy Policy English</label>
                                <textarea rows="10" class="form-control" type="text" name="app_privacy_english" id="app_privacy_english">{{$data->app_privacy_english}}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>App Privacy Policy Arabic</label>
                                <textarea rows="10" class="form-control" type="text" name="app_privacy_arabic" id="app_privacy_arabic">{{$data->app_privacy_arabic}}</textarea>
                            </div>
                        </div>
                        
                        <hr>
                        <button class="btn btn-primary" type="submit">Save</button>
                        </form>

        						</div>
      
                            </div>
                        </div>
                    </div>
                </section>
                
            </div>
            
        </div>


@endsection
@section('js')

<script type="text/javascript">
$('.app-privacy').addClass('active');
</script>
@endsection