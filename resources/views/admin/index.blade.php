<!DOCTYPE html>
<html lang="en">
<!--header---->
<x-admin.header />


<body>
    <div class="main-wrapper">

        <!--sidebar---->
        <x-admin.sidebar />


        <div class="page-wrapper">

            <!---Navbar--->
            <x-admin.navbar :profileData="$profileData" />

            <!---main----->
            <x-admin.main :profileData="$profileData" />
            

            <!---footer--->
            <x-admin.footer />




        </div>
    </div>
  
    <!-- core:js -->
    <script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{asset('backend/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{asset('backend/assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/template.js')}}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{asset('backend/assets/js/dashboard-dark.js')}}"></script>
    <!-- End custom js for this page -->
   
</body>

</html>
