<!DOCTYPE html>
<html lang="en">
<!--header---->
<x-admin.header />
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<body>
    <div class="main-wrapper">
        <!--sidebar---->
        <x-admin.sidebar />
        <div class="page-wrapper">
            <!---Navbar--->
            <x-admin.navbar :profileData="$profileData" />
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

                                        <form class="forms-sample" method="POST" action="{{route('store.role.permission')}}">
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
                                                <label for="role_id" class="form-label">Role Permission</label>
                                                <select name="role_id" class="form-select"
                                                    aria-label="Default select example">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-check mb-2">


                                                <input type="checkbox" class="form-check-input" id="checkDefaultMain">
                                                <label class="form-check-label" for="checkChecked">
                                                    All Permission
                                                </label>
                                            </div>

                                            @foreach ($permissiongroup as $pg)
                                                <hr>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-check mb-2">
                                                            {{-- <input type="checkbox" class="form-check-input"> --}}
                                                            <input type="checkbox"
                                                                class="form-check-input master-checkbox"
                                                                id="checkDefaultMain{{ $pg->group_name }}"
                                                                name="checkDefaultGroup">
                                                            <label class="form-check-label"
                                                                for="checkDefaultGroup{{ $pg->group_name }}">
                                                                {{ $pg->group_name }}
                                                            </label>
                                                        </div>

                                                    </div>



                                                    <div class="col-9">
                                                        {{-- <div class="checkbox-group" data-group-name="{{ $pg->group_name }}"> --}}

                                                        @php

                                                            $permissionName = App\Models\User::getPermissionName(
                                                                $pg->group_name,
                                                            );

                                                        @endphp
                                                        @foreach ($permissionName as $pn)
                                                            <div class="form-check mb-2 checkbox-group"
                                                                data-group-name="{{ $pg->group_name }}">
                                                                {{-- <input type="checkbox" class="form-check-input"
                                                                    id="checkChecked{{ $pn->id }}" name="pn[]"
                                                                    value="{{ $pn->id }}"> --}}
                                                                <input type="checkbox"
                                                                    class="form-check-input group-checkbox"
                                                                    data-group-name="{{ $pg->group_name }}"
                                                                    id="pn-{{ $pn->id }}" name="pn[]" value="{{ $pn->id }}"/>

                                                                <label class="form-check-label"
                                                                    for="pn-{{ $pn->id }}">
                                                                    {{ $pn->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            @endforeach

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



    <script type="text/javascript">
        $('#checkDefaultMain').click(function() {
            if ($(this).is(':checked')) {
                $('input[ type= checkbox]').prop('checked', true);
            } else {
                $('input[type= checkbox]').prop('checked', false);

            }
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            // Event listener for each master checkbox
            $('.master-checkbox').click(function() {
                const isChecked = $(this).is(':checked');
                const groupName = $(this).attr('id').replace('checkDefaultMain', '');

                // Toggle checkboxes only in the specific group
                $(`.checkbox-group[data-group-name="${groupName}"] .group-checkbox`).prop('checked',
                    isChecked);
            });
        });
    </script>




    <!-- core:js -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}">
        < /scrip> <
        !--endinject-- >

        <
        !--Plugin js
        for this page-- >
        <
        script src = "{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}" >
    </script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->
    <script>
        // $(document).ready(function() {
        //     $('#dataTableExample').DataTable();
        // });
        let table = new DataTable('#dataTableExample');
    </script>

</body>

</html>
