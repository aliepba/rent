    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Hitachi</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('pinjam.create')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Peminjaman</span></a>
        </li> 

        <li class="nav-item">
            <a class="nav-link" href="{{route('list.peminjaman')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>List Peminjaman</span></a>
        </li>

        @if (Auth::user()->is_admin == false)
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Profile</span></a>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">

        @if (Auth::user()->is_admin == true)
        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('barang.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Barang</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('department.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Departments</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('pegawai.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Employees</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('head-department.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Head Office</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-fw fa-table"></i>
                <span>Users</span></a>
        </li>
        @endif


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->