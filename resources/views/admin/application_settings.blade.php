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
                            <h5 class="content-header-title float-left pr-1 mb-0">Master</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Application Settings
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
        
        				<form id="form" action="/admin/update-application-settings" method="POST" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	<input value="{{ $data['id'] }}" type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Name</label>
                                <input value="{{$data['name']}}" class="form-control" type="text" name="name" id="name">
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 form-group">
                                <label>Email</label>
                                <input value="{{$data['email']}}" class="form-control" type="email" name="email" id="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Phone</label>
                                <input value="{{$data['phone']}}" class="form-control" type="text" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Address</label>
                                <textarea class="form-control" type="text" name="address" id="address">
                               	{{$data['address']}}
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input value="{{$data['city']}}" class="form-control" type="text" name="city" id="city">
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label>Area</label>
                                <input value="{{$data['area']}}" class="form-control" type="text" name="area" id="area">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Map Iframe</label>
                                <input value="{{$data['map_iframe']}}" class="form-control" type="text" name="map_iframe" id="map_iframe">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>latitude</label>
                                <input value="{{$data['latitude']}}" class="form-control" type="text" name="latitude" id="latitude">
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label>longitude</label>
                                <input value="{{$data['longitude']}}" class="form-control" type="text" name="longitude" id="longitude">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>License</label>
                                <input class="form-control" type="file" name="license" id="license">
                                <input value="{{$data['license']}}" type="hidden" name="license1" id="license1">
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label>Logo</label>
                                <input class="form-control" type="file" name="logo" id="logo">
                                <input value="{{$data['logo']}}" type="hidden" name="logo1" id="logo1">
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
$('.application-settings').addClass('active');
</script>
@endsection