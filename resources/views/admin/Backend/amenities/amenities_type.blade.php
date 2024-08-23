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
					<td><a href="{{route('add.amenities')}}" class="btn btn-inverse-info">Add Amenities</a></td>
					</ol>
				</nav>
				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Data Table</h6>
                <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>Amenities Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($amenities as $key => $item)    
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->amenities_name}}</td>
                        <td>
                          <a href="{{route('edit.amenities', $item->id)}}" class="btn btn-success">Edit</a>    
                                               
                  
                            <!-- Inline form for delete button -->
                            <form action="{{ route('destroy.amenities', $item->id) }}" method="POST" class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-button">Delete</button>
                            </form>
                        </td>
                                
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
