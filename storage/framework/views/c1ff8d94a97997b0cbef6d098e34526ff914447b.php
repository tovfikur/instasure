<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="">
                <h2 class="text-white">Child Dealer</h2>

            </div>
        </div>

        <?php if(Auth::check() && Auth::user()->user_type == 'child_dealer'): ?>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.dashboard')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-header text-secondary">Operations</li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.device-insurance.index')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer/device-insurance*') ? 'active' : ''); ?>">
                            <i
                                class="fa fa-<?php echo e(Request::is('childDealer/device-insurance*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                            <p>Device Insurance Sale</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.deviceInsSaleHistory')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer/device-sale-commission-log*') ? 'active' : ''); ?>">
                            <i
                                class="fa fa-<?php echo e(Request::is('childDealer/device-sale-commission-log*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                            <p>Device Insurance Commission Log</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.device-insurance.withdraw-request')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer/commission-withdraw-request*') ? 'active' : ''); ?>">
                            <i
                                class="fa fa-<?php echo e(Request::is('childDealer/commission-withdraw-request*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                            <p>Commission Withdraw Request</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.travel-ins-order.index')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer/travel-ins-order*') ? 'active' : ''); ?>">
                            <i
                                class="fa fa-<?php echo e(Request::is('childDealer/travel-ins-order*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                            <p>Travel Insurance Orders</p>
                        </a>
                    </li> 

                    <li class="nav-header text-muted">System</li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('childDealer.parent-dealer.profile')); ?>"
                            class="nav-link <?php echo e(Request::is('childDealer/parent-dealer-profile') ? 'active' : ''); ?>">
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
                        <form id="sidebar-logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                            style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        <?php endif; ?>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->
<?php /**PATH /var/www/html/instaweb/resources/views/backend/includes/child_dealer_sidebar.blade.php ENDPATH**/ ?>