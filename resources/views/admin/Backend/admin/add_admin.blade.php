<!DOCTYPE html>
<html lang="en">
<!--header---->
<x-admin.header :profileData="$profileData" />


<body>
    <div class="main-wrapper">

        <!--sidebar---->
        <x-admin.sidebar :profileData="$profileData" />


        <div class="page-wrapper">

            <!---Navbar--->
            <x-admin.navbar :profileData="$profileData" />

            <!---main----->
            {{-- <x-admin.main /> --}}
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

                                        <h6 class="card-title">Add New Admin</h6>

                                        <form class="forms-sample" method="POST" action="{{route('storeadmin')}}" enctype="multipart/form-data">
                                            @csrf
                                            {{-- <div class="mb-4">
                                             
                                           <input class="mt-5" type="file" name="photo" class="form-control" id="photo"
                                                autocomplete="off"> 
                                            </div> --}}
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"  id="name"
                                                    >
                                            </div>

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control" id="username"
                                                    autocomplete="off">
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                   >
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                   >
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="address" class="form-control" id="address"
                                                    >
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="number" name="phone" class="form-control" id="phone"
                                                   >
                                            </div>
                                           
                                            <div class="mb-3">
                                                <label for="roles" class="form-label">Role</label>
                                                <select name="roles" id="roles" class="form-select">
                                                    <option selected="" disabled="">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                       
                        
                                            {{-- <div class="mb-3">
                                                <label for="group_name" class="form-label">Group Name</label>
                                                <select name="group_name" class="form-select" aria-label="Default select example">
                                                    <option selected="" disabled=""> {{old('name')}}</option>
                                                    <option value="type"></option>
                        
                                                  </select>
                                            </div> --}}
                                          
                                  
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   
    <script>
         @if(Session::has('message'))
         var type = "{{ Session::get('alert-type','info') }}"
         switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
         }
         @endif 
        </script>
 
    <!-- core:js -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->

</body>

</html>
