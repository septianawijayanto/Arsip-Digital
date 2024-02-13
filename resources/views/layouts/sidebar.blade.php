<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">


        <img src="{{ asset('/logo/default.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('DEV_URL') }}</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->getGambar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->role }})</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link" id="dash">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link" id="user">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                @endif

                <li class="nav-item has-treeview" id="liMaster">
                    <a href="#" class="nav-link" id="menuMaster">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cabang.index') }}" class="nav-link" id="cabang">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cabang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('config.index') }}" class="nav-link" id="config">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Config</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('menu.index') }}" class="nav-link " id="menu">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('storage.index') }}" class="nav-link" id="storage">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            File Storage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('profil') }}" class="nav-link" id="profil">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Profil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>