<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
                <h3 class="text-white">Collection Center</h3>
            </div>
        </div>
        <!-- /.user-panel -->

        @if (Auth::check() && Auth::user()->user_type == 'collection_center')
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('collection_center.dashboard') }}"
                            class="nav-link {{ Request::is('collection-center') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item nav-header">Operations</li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('collection_center.device-collection.index') }}"
                            class="nav-link {{ Request::is('collection-center/device-collection*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('collection-center/device-collection*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Device Collection</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-header nav-item">System</li>
                    <!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="{{ route('collection_center.profile') }}"
                            class="nav-link {{ Request::is('collection-center/profile') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->
                    <li class="nav-item">
                        <a href="" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('sidebar-logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <!-- /.nav-item -->
                </ul>
                <!-- /.nav -->
            </nav>
            <!-- /nav -->
        @endif
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->
