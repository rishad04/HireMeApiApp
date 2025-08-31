 <nav
   class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
   id="layout-navbar">
   <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
     <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
       <i class="bx bx-menu bx-sm"></i>
     </a>
   </div>

   <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
     <!-- Search -->


       <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>

              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
              </a>
     <!-- /Search -->
   </div>
 </nav>
