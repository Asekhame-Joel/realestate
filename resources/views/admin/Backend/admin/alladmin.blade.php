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
				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
					<td><a href="{{route('addadmin')}}" class="btn btn-inverse-info">Add Admin</a></td>
					</ol>
				</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Admin Name</th>
                        <th>Phone</th>
                        <th>email</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($alladmin as $key => $item)    
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>
          <img src="{{ !empty($item->photo) ? asset('upload/admin_images/'.$item->photo) : asset('upload/admin_images/no_image.jpg') }}">
                          <p>{{ $item->photo }}</p> <!-- Display the photo filename for debugging -->
                      </td>
                      {{-- <p>{{ asset('upload/admin_images/'.$item->photo) }}</p> --}}

                        
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->address}}</td>
                        <td>
                        @foreach ($item->roles as $role)

                    <span class="badge bg-danger">{{$role->name}}</span>

                        @endforeach
                      </td>
                        {{-- <td>{{$item->roles}}</td> --}}
                        
                        <td>
                          <a href="{{route('editAdmin', $item->id)}}" class="btn btn-success">Edit</a>    
                                               
                  
                            <!-- Inline form for delete button -->
                            <form action="{{route('destroyadmin', $item->id)}}" method="POST" class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button">Delete</button>
                            </form>
                        </td>
                                
                      </tr>
                      @endforeach
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
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
    <script src="{{asset('backend/assets/vendors/core/core.js')}}"></script>
    <!-- endinject -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/assets/js/alert.js')}}"></script>

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
