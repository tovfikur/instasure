<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">

    <div class="sidebar">

        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
                <h3 class="text-white">Parent Dealer</h3>

            </div>
        </div>
        <!-- /.user-panel -->

        @if (Auth::check() && Auth::user()->user_type == 'parent_dealer')
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.dashboard') }}"
                            class="nav-link {{ Request::is('parentDealer') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.child-dealers.index') }}"
                            class="nav-link {{ Request::is('parentDealer/child-dealers*') ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>Child Dealer List</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.insurance-packages') }}"
                            class="nav-link {{ Request::is('parentDealer/insurance-packages*') ? 'active' : '' }}">
                            <i class="fa fa-gift nav-icon"></i>
                            <p>Insurance Packages</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-header text-muted">Insurance Sales Commission</li>

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.deviceInsSaleHistory') }}"
                            class="nav-link {{ Request::is('parentDealer/device-sale-commission-log*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('parentDealer/device-sale-commission-log*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>My Commission Log</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.child_commission_withdraw_request') }}"
                            class="nav-link {{ Request::is('parentDealer/child-commission-withdraw-request*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('parentDealer/child-commission-withdraw-request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Child Commission Withdraw</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.commission_withdraw_request') }}"
                            class="nav-link {{ Request::is('parentDealer/commission-withdraw-request*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('parentDealer/commission-withdraw-request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Commission Withdraw To Admin</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-header text-muted">Service Charge Withdraw Request</li>

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.device-insurance.withdraw-request') }}"
                            class="nav-link {{ Request::is('parentDealer/device-insurance/withdraw-request*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('parentDealer/device-insurance/withdraw-request*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Service Center Withdraw Req</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-item">
                        <a href="{{ route('parentDealer.device_insurance_withdraw_request_to_admin_list') }}"
                            class="nav-link {{ Request::is('parentDealer/device-insurance/payment-request-to-admin*') ? 'active' : '' }}">
                            <i
                                class="fa fa-{{ Request::is('parentDealer/device-insurance/payment-request-to-admin*') ? 'folder-open' : 'folder' }} nav-icon"></i>
                            <p>Withdraw Request To Admin</p>
                        </a>
                    </li>
                    <!-- /.nav-item -->

                    <li class="nav-header text-muted">System</li>
                    <li class="nav-item">
                        <a href="{{ route('parentDealer.profile') }}"
                            class="nav-link {{ Request::is('parentDealer/profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                @yield('parent_dealer_name') Profile
                            </p>
                        </a>
                    </li>
                    <!-- /.nav-item -->
                    <li class="nav-item">
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
                    <!-- /.nav-item -->


                </ul>
                <!-- /.nav -->
            </nav>
            <!-- /nav -->
        @endif
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar  -->
