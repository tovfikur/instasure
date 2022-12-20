<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex">
            <div class="text-center">
                <img src="<?php echo e(asset('frontend/logo-instasure.png')); ?>" style="max-height:50px;" alt="">

            </div>
        </div>

        <?php if(Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')): ?>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.dashboard')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview <?php echo e(Request::is('admin/reports*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-laptop-code"></i>
                            <p>
                                Reports
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.reports.mobile_diagnosis_report')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/reports/mobile-diagnosis-report*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/reports/mobile-diagnosis-report*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Mobile Diagnosis Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.reports.device_insurance_sales')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/reports/device-insurance-sales*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/reports/device-insurance-sales*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Insurance Sales</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/service-charge-withdraw-request*') ||
                        Request::is('admin/commission-withdraw-request*') ||
                        Request::is('admin/due-balance-collection*') ||
                        Request::is('admin/parent-due-balance*')
                            ? 'menu-open'
                            : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-money"></i>
                            <p>
                                Withdraw Requests
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/service-charge-withdraw-request*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/service-charge-withdraw-request*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Service Charge Withdraw Request</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.commission_withdraw_request')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/commission-withdraw-request*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/commission-withdraw-request*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Commission Withdraw Request</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.parent_due_balance')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/parent-due-balance*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/parent-due-balance*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Parent Due Balance</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.due_balance_collection')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/due-balance-collection*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/due-balance-collection*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Due Balance Collection</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/parent-dealers*') || Request::is('admin/parent-dealer/withdraw-history*') || Request::is('admin/child-dealers*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-robot"></i>
                            <p>
                                Dealer Manage
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.parent-dealers.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/parent-dealers*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/parent-dealers*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Parent Dealers list</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.child-dealers.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/child-dealers*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/child-dealers*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Child Dealers List</p>
                                </a>
                            </li>


                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.policy-providers.index')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/policy-providers*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Policy Providers
                            </p>
                        </a>
                    </li>

                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/device-insurance-sales*') ||
                        Request::is('admin/device-sale-commission*') ||
                        Request::is('admin/insurance-types*') ||
                        Request::is('admin/insurance-discount*') ||
                        Request::is('admin/categories*') ||
                        Request::is('admin/insurance-packages*')
                            ? 'menu-open'
                            : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-laptop-code"></i>
                            <p>
                                Device Insurance
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.device-insurance-sales')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/device-insurance-sales*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/device-insurance-sales*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Insurance Sales</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.insurance-types.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/insurance-types*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/insurance-types*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Insurance Types</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.insurance-packages.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/insurance-packages*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/insurance-packages*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Insurance Packages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.insurance-discount.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/insurance-discount*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/insurance-discount*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Insurance Discount</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.categories.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/categories') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/categories*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>
                                        Insurance Category
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/travel-insurance-orders*') ||
                        Request::is('admin/travel-ins-plans-categories*') ||
                        Request::is('admin/travel-ins-plans-charts*')
                            ? 'menu-open'
                            : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Travel Insurance
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <!-- /.nav-link -->
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.travel_insurance_orders')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/travel-insurance-orders*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/travel-insurance-orders*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Travel Insurance Orders</p>
                                </a>
                            </li>
                            <!-- /.nav-item -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.travel-ins-plans-categories.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/travel-ins-plans-categories*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/travel-ins-plans-categories*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Plan Categories</p>
                                </a>
                            </li>
                            <!-- /.nav-item -->
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.travel-ins-plans-charts.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/travel-ins-plans-charts*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/travel-ins-plans-charts*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Plan Chart</p>
                                </a>
                            </li>
                            <!-- /.nav-item -->
                        </ul>
                        <!-- /.nav-treeview -->
                    </li>
                    <!-- /.nav-item .has-treeview  -->

                    <li class="nav-item has-treeview <?php echo e(Request::is('admin/claim-management*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                Claim Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.insurance-claim.list')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/claim-management/claim-list') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/claim-management/claim-list') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Insurance Claim Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.claim-management.device-claim-request')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/claim-management/device-claim-request') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/claim-management/device-claim-request') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Support Tickets</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.claim-management.device-lost-claim-request')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/claim-management/device-lost-claim-request') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/claim-management/device-lost-claim-request') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Lost Claim Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/device-categories*') ||
                        Request::is('admin/device-subcategories*') ||
                        Request::is('admin/brands*') ||
                        Request::is('admin/device-models*') ||
                        Request::is('admin/promo-codes*') ||
                        Request::is('admin/parts*') ||
                        Request::is('admin/imei-data*')
                            ? 'menu-open'
                            : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-laptop-house"></i>
                            <p>
                                Device Managements
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.device-categories.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/device-categories*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/device-categories*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.device-subcategories.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/device-subcategories*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/device-subcategories*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Subcategory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.brands.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/brands*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/brands*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Brands</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.device-models.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/device-models*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/device-models*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Device Models</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.parts.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/parts') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/parts*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>
                                        Parts
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="<?php echo e(route('admin.imei-data.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/imei-data*') ? 'active' : ''); ?> ">

                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/imei-data*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>
                                        IMEI Data
                                    </p>
                                </a>
                            </li>

                            
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.collection-center.index')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/collection-center*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-hands-helping"></i>
                            <p>
                                Collection Center
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.service-center.index')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/service-center') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                Service Center
                            </p>
                        </a>
                    </li>
                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/roles*') || Request::is('admin/staffs*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Role & permission
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.staffs.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/staffs*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/staffs*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Staff Manage</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.roles.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/role*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/roles*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Role Manage</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/profile*') || Request::is('admin/users*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Admin
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.profile.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/profile') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/profile') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.users')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/users') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/users') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item has-treeview <?php echo e(Request::is('admin/sliders*') || Request::is('admin/blogs*') || Request::is('admin/partners*') || Request::is('admin/pages*') ? 'menu-open' : ''); ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Frontend Settings
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.sliders.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/sliders*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/sliders*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Sliders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.blogs.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/blogs*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/blogs*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Blogs</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.blog-categories.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/blog-categories*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/blog-categories*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Blog Categories</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.partners.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/partners*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/partners*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Partners</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.pages.index')); ?>"
                                    class="nav-link <?php echo e(Request::is('admin/pages*') ? 'active' : ''); ?>">
                                    <i
                                        class="fa fa-<?php echo e(Request::is('admin/pages*') ? 'folder-open' : 'folder'); ?> nav-icon"></i>
                                    <p>Dynamic Pages</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    

                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    
                    
                    
                    <li class="nav-item ">

                        <a href="<?php echo e(route('admin.business.index')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/site-optimize*') ? 'active' : ''); ?>">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Business Settings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="<?php echo e(route('admin.site.optimize')); ?>"
                            class="nav-link <?php echo e(Request::is('admin/site-optimize*') ? 'active' : ''); ?>">
                            <i class="nav-icon fa fa-anchor"></i>
                            <p>
                                Site Optimize
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        <?php endif; ?>
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/includes/admin_sidebar.blade.php ENDPATH**/ ?>