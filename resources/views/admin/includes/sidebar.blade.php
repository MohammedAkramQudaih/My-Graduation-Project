<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            {{-- <img src="" alt=""> --}}
            <img class="logo rounded-circle img-fluid d-block mx-auto my-auto" src="{{ asset('adminstyle/img/logo_diabetes.jpeg') }}"alt=""width="100" height="100">

        </div>
        {{-- <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }} </div> --}}
        <div class="sidebar-brand-text mx-3">{{ 'diabetes Admin' }} </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>

        <!-- Nav Item - Pages Users Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Users"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-light fa-users fa-lg fa-2x"></i>
                <span>Users</span>
            </a>
            <div id="Users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Operations:</h6>
                    <a class="collapse-item" href="{{ route('admin.users.list') }}">Show All Users</a>
                    {{-- <a class="collapse-item" href="{{ route('admin.user.create') }}">Add new User</a> --}}
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
            Doctors
        </div>
    
        <!-- Nav Item - Pages Tasks Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#doctors" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-regular fa-stethoscope fa-lg fa-2x"></i>
                <span>Doctors</span>
            </a>
            <div id="doctors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Operations:</h6>
                    <a class="collapse-item" href="{{ route('admin.doctors.list') }}">Show All doctors</a>
                    <a class="collapse-item" href="{{ route('admin.doctor.create') }}">Add new doctor</a>
                </div>
            </div>
        </li>
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
            Patients
        </div>
    
        <!-- Nav Item - Pages Banners Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#patients" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-solid fa-hospital-user fa-lg fa-2x"></i>
                <span>Patients</span>
            </a>
            <div id="patients" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Operations:</h6>
                    <a class="collapse-item" href="{{ route('admin.patients.list') }}">Show All patients</a>
                    <a class="collapse-item" href="{{ route('admin.patient.create') }}">Add new patient</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        <!-- Heading -->
        <div class="sidebar-heading">
            Admins
        </div>
    
        <!-- Nav Item - Pages Banners Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admins" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-sharp fa-solid fa-user-tie fa-lg fa-2x"></i>
                <span>Admins</span>
            </a>
            <div id="admins" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Operations:</h6>
                    <a class="collapse-item" href="{{ route('admins.list') }}">Show All Admins</a>
                    <a class="collapse-item" href="{{ route('admin.create') }}">Add new Admin</a>
                </div>
            </div>
        </li>
    
        <!-- Nav Item - Utilities Collapse Menu -->
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html">Colors</a>
                    <a class="collapse-item" href="utilities-border.html">Borders</a>
                    <a class="collapse-item" href="utilities-animation.html">Animations</a>
                    <a class="collapse-item" href="utilities-other.html">Other</a>
                </div>
            </div>
        </li> --}}
    
        <!-- Divider -->
        <hr class="sidebar-divider">
    
        {{-- <!-- Heading -->
        <div class="sidebar-heading">
            Tasks
        </div> --}}
    
        <!-- Nav Item - Pages Collapse Menu -->
        {{-- <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Tasks</span>
            </a>
            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item active" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li> --}}
    
        {{-- <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span></a>
        </li> --}}
    
        {{-- <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li> --}}
    
        <!-- Divider -->
        {{-- <hr class="sidebar-divider d-none d-md-block"> --}}
    
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    
    </ul>
    <!-- End of Sidebar -->
    