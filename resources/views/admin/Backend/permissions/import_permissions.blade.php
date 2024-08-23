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
            <x-admin.navbar :profileData="$profileData"/>
            <!---main----->
            <div class="page-content">

                <div class="row">
                    <div class="col-12 grid-margin">

                    </div>
                </div>
                <div class="row profile-body">
                    <!-- left wrapper start -->
                    <!-- left wrapper end -->
                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card rounded">
                                    <div class="card-body">

                                        <form class="forms-sample" method="POST"
                                            action="{{route('import')}}" enctype="multipart/form-data">
                                            @csrf
                                        
                                            @if ($errors->any())
                                                <div>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="import_file" class="form-label">Import Excel</label>
                                                <input type="file" name="import_file" class="form-control
                                                 @error('import_file') is-invalid @enderror"
                                                    id="import_file">
                                                    @error('import_file')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary me-2">Upload</button>
                                        </form>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- middle wrapper end -->
                    <!-- right wrapper start -->

                    <!-- right wrapper end -->
                </div>

            </div>
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

    <!-- Plugin js for this page -->
    <script src="{{asset('backend/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{asset('backend/assets/js/dashboard-dark.js')}}"></script>
    <!-- End custom js for this page -->
    <script>
      // $(document).ready(function() {
      //     $('#dataTableExample').DataTable();
      // });
      let table = new DataTable('#dataTableExample');
  </script> 
 
  </body>

</html>
