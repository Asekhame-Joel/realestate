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
                    <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                        <div class="card rounded">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="mb-2">
                                        <img class="wd-100 rounded-circle"
                                            src="{{ !empty($profileData->photo) ? Storage::url($profileData->photo) : url('upload/no_image.jpg') }}"
                                            alt="profile">
                                        <span class="h6 ms-2">{{ $profileData->username }}</span>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                                    <p class="text-muted">{{ $profileData->name }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Current Role:</label>
                                    <p class="text-muted">{{ $profileData->role }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Current Status:</label>
                                    <p class="text-muted">{{ $profileData->status }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined:</label>
                                    <p class="text-muted">{{ $profileData->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                                    <p class="text-muted">{{ $profileData->address }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                    <p class="text-muted">{{ $profileData->email }}</p>
                                </div>
                                <div class="mt-3">
                                    <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone Number:</label>
                                    <p class="text-muted">{{ $profileData->phone }}</p>
                                </div>
                                <div class="mt-3 d-flex social-links">
                                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                        <i data-feather="github"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                        <i data-feather="twitter"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                        <i data-feather="instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- left wrapper end -->
                    <!-- middle wrapper start -->
                    <div class="col-md-8 col-xl-8 middle-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card rounded">
                                    <div class="card-body">

                                        <h6 class="card-title">Change Password</h6>
                                        <form class="forms-sample" method="POST"
                                            action="{{ route('admin.UpdatePassword') }}" enctype="multipart/form-data">
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
                                                <label for="old_password" class="form-label">Old Password</label>
                                                <input type="password" name="old_password" class="form-control
                                                 @error('old_password') is-invalid @enderror"
                                                    id="old_password">
                                                    @error('old_password')
                                                    <span class="text-danger">
                                                        {{$message}}
                                                    </span>
                                                    @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">Password</label>
                                                <input type="password" name="new_password" class="form-control"
                                                    id="new_password">
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password_confirmation" class="form-label">Retype
                                                    Password</label>
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control" id="new_password_confirmation">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
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
