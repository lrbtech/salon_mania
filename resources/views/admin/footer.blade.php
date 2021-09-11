<!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">{{date('Y')}} &copy; Salon Mania</span><span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="https://lrbinfotech.com" target="_blank">LRB INFO TECH</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/swiper.min.js"></script> -->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/js/scripts/components.js"></script>
    <script src="/app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="/app-assets/js/scripts/pages/dashboard-ecommerce.js"></script> -->
          <script src="/app-assets/js/scripts/pages/app-chat.js"></script>
    <script src="{{ asset('toastr/toastr.min.js')}}" type="text/javascript"></script>
    <!-- END: Page JS-->
    @yield('js')
</body>
<!-- END: Body-->

</html>