<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('admin.headlink');
<!-- END: Head-->
<style>
.modal .modal-content .modal-header .close {
    background-color: #000000 !important;
}
</style>
<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

 @include('admin.header')


    @include('admin.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content">
     @yield('body-section')
    </div>
    
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('admin.footer')