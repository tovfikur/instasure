<style>
    .count {
        color: #1065a0;
        font-size: 20px;
        font-weight: bold;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        color: #16181b;
        text-decoration: none;
        background-color: #0773bb;
    }

    @media (max-width: 575px) {
        .mobile_view {
            margin-left: 50px;
        }
    }

</style>

<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="<?php echo e(url('/')); ?>" class="nav-link" data-toggle="frontend"
                data-placement="bottom" data-original-title="Browse Frontend">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        
    </ul>

    <!-- SEARCH FORM -->
    
    
    
    
    
    
    
    
    
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo e(asset('backend/dist/img/user1-128x128.jpg')); ?>" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo e(asset('backend/dist/img/user8-128x128.jpg')); ?>" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?php echo e(asset('backend/dist/img/user3-128x128.jpg')); ?>" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <?php if(Auth::user()->user_type == 'service_center'): ?>
            <?php echo $__env->make('backend.partials.serviceCenterNotification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::user()->user_type == 'admin'): ?>
            <?php echo $__env->make('backend.partials.adminNotification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php elseif(Auth::user()->user_type == 'admin'): ?>
        <?php endif; ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user-circle"></i> <strong><?php echo e(Auth::user()->name); ?></strong>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="image text-center">
                    <img src="<?php echo e(asset('backend/images/logo.png')); ?>" width="60px" height="60px"
                        class="img-circle elevation-2 mt-2" alt="User Image">
                </div>
                <span class="dropdown-item dropdown-header">
                    <strong><?php echo e(Auth::user()->name); ?></strong><br>
                    <small><?php echo e(Auth::user()->created_at->diffForHumans()); ?></small>
                </span>
                <div class="dropdown-divider"></div>
                <div class="float-left">
                    <?php if(Auth::user()->user_type == 'child_dealer'): ?>
                        <a href="<?php echo e(route('childDealer.profile')); ?>" class="dropdown-item">
                            <i class="fa fa-user-circle-o mr-2"></i> Profile
                        </a>
                    <?php elseif(Auth::user()->user_type == 'admin'): ?>
                        <a href="<?php echo e(route('admin.profile.index')); ?>" class="dropdown-item">
                            <i class="fa fa-user-circle-o mr-2"></i> Profile
                        </a>
                    <?php endif; ?>

                </div>
                <div class="float-right">
                    <a href="#" class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        
        
        
        
    </ul>
</nav>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/includes/header.blade.php ENDPATH**/ ?>