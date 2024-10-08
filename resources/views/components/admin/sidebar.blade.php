<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        Real<span>Estate</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('admin.index')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category">web apps</li>

@if(Auth::user()->can('type.menu'))
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="home"></i>

            <span class="link-title">Property Type</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              
              @if(Auth::user()->can('type.all'))
              <li class="nav-item">
                <a href="{{route('all.types')}}" class="nav-link">All Types</a>
              </li>
              @endif

              @if(Auth::user()->can('type.add'))
              <li class="nav-item">
                <a href="{{route('add.types')}}" class="nav-link">Add Type</a>
              </li>
              @endif

              {{-- <li class="nav-item">
                <a href="pages/email/compose.html" class="nav-link">Compose</a>
              </li> --}}
            </ul>
          </div>
        </li>
@endif

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="package"></i>
            <span class="link-title">Amenities</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.amenities')}}" class="nav-link">All Amenities</a>
              </li>
              <li class="nav-item">
                <a href="pages/email/read.html" class="nav-link">Add Amenities</a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/email/compose.html" class="nav-link">Compose</a>
              </li> --}}
            </ul>
          </div>
        </li>
     
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
            <i class="link-icon" data-feather="package"></i>
            <span class="link-title">Admin</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="emails">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('alladmin')}}" class="nav-link">All Admin</a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">Add Admin</a>
              </li>
              {{-- <li class="nav-item">
                <a href="pages/email/compose.html" class="nav-link">Compose</a>
              </li> --}}
            </ul>
          </div>
        </li> 
  
        <li class="nav-item">
          <a href="pages/apps/calendar.html" class="nav-link">
            <i class="link-icon" data-feather="calendar"></i>
            <span class="link-title">Calendar</span>
          </a>
        </li>
        <li class="nav-item nav-category">Components</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">UI Kit</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
              </li>
              <li class="nav-item">
                <a href="pages/ui-components/alerts.html" class="nav-link">Alerts</a>
              </li>
             
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Advanced UI</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="pages/advanced-ui/cropper.html" class="nav-link">Cropper</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/owl-carousel.html" class="nav-link">Owl carousel</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/sortablejs.html" class="nav-link">SortableJs</a>
              </li>
              <li class="nav-item">
                <a href="pages/advanced-ui/sweet-alert.html" class="nav-link">Sweet Alert</a>
              </li>
            </ul>
          </div>
        </li>
      
        
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#authPages" role="button" aria-expanded="false" aria-controls="authPages">
            <i class="link-icon" data-feather="unlock"></i>
            <span class="link-title">Permission and Roles</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="authPages">
            <ul class="nav sub-menu">
              <li class="nav-item">
                <a href="{{route('all.permission')}}" class="nav-link">All Permission</a>
              </li>
              <li class="nav-item">
                <a href="{{route('all.roles')}}" class="nav-link">All Roles</a>
              </li>
            </li>
            <li class="nav-item">
              <a href="{{route('role.permission')}}" class="nav-link">Roles Permission</a>
            </li>
            <li class="nav-item">
              <a href="{{route('allrole.permission')}}" class="nav-link">All Roles Permission</a>
            </li>
             
            </ul>
          </div>
          
          

      
        <li class="nav-item nav-category">Docs</li>
        <li class="nav-item">
          <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
            <i class="link-icon" data-feather="hash"></i>
            <span class="link-title">Documentation</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>