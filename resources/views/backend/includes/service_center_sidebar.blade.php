<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
                <h3 class="text-white">Service Center</h3>
            </div>
        </div>

        @if (Auth::check() && Auth::user()->user_type == 'service_center')
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.dashboard') }}"
                            class="nav-link {{ Request::is('serviceCenter') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item nav-header">Operations</li>
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.claim-requests') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim-requests*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim-requests*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Device Support Requests</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.policy-search') }}"
                            class="nav-link {{ Request::is('serviceCenter/policy-search*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/policy-search*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Make Claim</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.insurance-claim.list') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim-list*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim-list*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Claim Pending List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.insurance-claim.list.processing') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim-on-processing') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim-on-processing') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Claim Processing List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.insurance-claim.list.on-delivered') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim-on-delivered') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim-on-delivered') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Claim Ready To Delivered List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.insurance-claim.list.delivered') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim-delivered') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim-delivered') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Claim Delivered List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('serviceCenter.insurance-claim.claimPaymentRequestList') }}"
                            class="nav-link {{ Request::is('serviceCenter/claim/claim-payment-request-list*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('serviceCenter/claim/claim-payment-request-list*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Claim Payment Req List</p>
                        </a>
                    </li>
                    <li class="nav-header">System</li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('childDealer.parent-dealer.profile') }}"
                            class="nav-link {{ Request::is('childDealer/parent-dealer-profile') ? 'active' : '' }}">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Parent Profile</p>
                        </a>
                    </li> --}}
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
