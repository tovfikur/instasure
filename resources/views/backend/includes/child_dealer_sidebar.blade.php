<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
                <h2 class="text-white">Child Dealer</h2>

            </div>
        </div>

        @if (Auth::check() && Auth::user()->user_type == 'child_dealer')
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('childDealer.dashboard') }}"
                            class="nav-link {{ Request::is('childDealer') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header text-secondary">Operations</li>

                    <li class="nav-item">
                        <a href="{{ route('childDealer.device-insurance.index') }}"
                            class="nav-link {{ Request::is('childDealer/device-insurance*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('childDealer/device-insurance*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Device Insurance Sale</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('childDealer.deviceInsSaleHistory') }}"
                            class="nav-link {{ Request::is('childDealer/device-sale-commission-log*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('childDealer/device-sale-commission-log*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Device Insurance Commission Log</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('childDealer.device-insurance.withdraw-request') }}"
                            class="nav-link {{ Request::is('childDealer/commission-withdraw-request*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('childDealer/commission-withdraw-request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Commission Withdraw Request</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('childDealer.travel-ins-order.index') }}"
                            class="nav-link {{ Request::is('childDealer/travel-ins-order*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('childDealer/travel-ins-order*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Travel Insurance Orders</p>
                        </a>
                    </li> 

                    <li class="nav-header text-muted">System</li>
                    <li class="nav-item">
                        <a href="{{ route('childDealer.parent-dealer.profile') }}"
                            class="nav-link {{ Request::is('childDealer/parent-dealer-profile') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Parent Profile</p>
                        </a>
                    </li>
                    <li class="
                                nav-item">
                        <a href="" class="dropdown-item"
                            onclick="event.preventDefault();
                        document.getElementById('sidebar-logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        @endif
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->
