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
                                            action="{{route('update.permission', $permissions->id)}}" >
                                            @csrf
                                            @method('PATCH')

                                        
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
                                                <label for="name" class="form-label">Permission Name</label>
                                                <input type="text" name="name" class="form-control
                                                 @error('name') is-invalid @enderror" id="name" value="{{ old('name', $permissions->name) }}">
                                                    
                                                    @error('name')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="group_name" class="form-label">Group Name</label>
                                                <select name="group_name" class="form-select" aria-label="Default select example">
                                                    <option selected="" disabled=""> {{old('name', $permissions->group_name)}}</option>
                                                    <option value="type">Property Type</option>
                                                    <option value="state">state</option>
                                                    <option value="amenities">Amenities</option>
                                                    <option value="property">Property</option>
                                                    <option value="history">Package History</option>
                                                    <option value="message">Property Message</option>  
                                                    <option value="testimonials">Testimonials</option>
                                                    <option value="agent">Manage Agent</option>
                                                    <option value="category">Blog Category</option>
                                                    <option value="post">Blog Post</option>
                                                    <option value="smtp_setting">SMTP Setting</option>
                                                    <option value="site_setting">Site Setting</option>
                                                    <option value="role">Role Permission</option>
                                                  </select>
                                            </div>


                                            <button type="submit" class="btn btn-primary me-2">Save</button>
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
