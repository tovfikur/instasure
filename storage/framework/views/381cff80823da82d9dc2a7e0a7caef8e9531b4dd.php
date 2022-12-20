<!-- Start Header Area -->
<header class="header-area">

    <!-- Start Top Header -->
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- End Top Header -->

    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="pearo-responsive-nav">
            <div class="container">
                <div class="pearo-responsive-menu">
                    <div class="logo">
                        <a href="<?php echo e(url('/')); ?>">
                            
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pearo-nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <img src="<?php echo e(asset('frontend/logo-instasure-2.png')); ?>" alt="logo" width="142" height="47">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="<?php echo e(url('/')); ?>"
                                    class="nav-link  <?php echo e(request()->is('/') ? 'active' : ''); ?>">Home </a></li>
                            <li class="nav-item"><a href="<?php echo e(route('about')); ?>"
                                    class="nav-link <?php echo e(request()->is('about-us') ? 'active' : ''); ?>">About Us</a></li>
                            <li class="nav-item"><a href="<?php echo e(route('partner-program')); ?>"
                                    class="nav-link <?php echo e(request()->is('partner-program') ? 'active' : ''); ?>">Partner
                                    Program</a></li>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link
                                    <?php echo e(request()->is('mobile-phone-protection') || request()->is('international-travel-insurance') ? 'active' : ''); ?>">Products
                                    <i class="flaticon-down-arrow"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('mobile-phone-protection')); ?>"
                                            class="nav-link">Mobile
                                            Phone protection plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('international-travel-insurance')); ?>"
                                            class="nav-link">International Travel Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('health-insurance')); ?>" class="nav-link">Health
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('life-insurance')); ?>" class="nav-link">Life
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('agriculture-insurance')); ?>"
                                            class="nav-link">Agriculture Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('car-insurance')); ?>" class="nav-link">Car
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('home-insurance')); ?>" class="nav-link">Home
                                            Insurance</a>
                                    </li>
                                </ul>
                            </li>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <li class="nav-item">
                                <a href="<?php echo e(route('blogs')); ?>"
                                    class="nav-link <?php if(request()->is('blogs*')): ?> active <?php endif; ?>">Blogs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('press_releases')); ?>"
                                    class="nav-link <?php if(request()->is('press-releases*')): ?> active <?php endif; ?>">Press Releases
                                </a>
                            </li>
                            <li class="nav-item"><a href="<?php echo e(route('contact-us')); ?>"
                                    class="nav-link <?php echo e(request()->is('contact-us') ? 'active' : ''); ?>">Contact</a>
                            </li>
                            <li class="nav-item">
                                
                                
                                
                                
                                
                                <a href="<?php echo e(route('claim-form')); ?>"
                                    class="nav-link <?php echo e(request()->is('claim-form') ? 'active' : ''); ?>">CLAIM</a>
                            </li>
                            <li class="nav-item">
                                <?php if(Auth::check()): ?>
                                    <?php if(Auth::user()->user_type == 'customer'): ?>
                                        <a href="<?php echo e(route('user.dashboard')); ?>" class="nav-link">Dashboard</a>
                                    <?php elseif(Auth::user()->user_type == 'service_center'): ?>
                                        <a href="<?php echo e(route('serviceCenter.dashboard')); ?>"
                                            class="nav-link">Dashboard</a>
                                    <?php elseif(Auth::user()->user_type == 'parent_dealer'): ?>
                                        <a href="<?php echo e(route('parentDealer.dashboard')); ?>"
                                            class="nav-link">Dashboard</a>
                                    <?php elseif(Auth::user()->user_type == 'child_dealer'): ?>
                                        <a href="<?php echo e(route('childDealer.dashboard')); ?>"
                                            class="nav-link">Dashboard</a>
                                    <?php elseif(Auth::user()->user_type == 'admin'): ?>
                                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">Dashboard</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>"
                                        class="nav-link <?php echo e(request()->is('login') ? 'active' : ''); ?>">Sign In</a>
                                <?php endif; ?>
                            </li>
                        </ul>

                        
                        
                        
                        

                        
                        
                        
                        

                        
                        
                        
                        
                        
                        

                        
                        
                        
                        
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->

</header>
<!-- End Header Area -->


















































<?php /**PATH /var/www/html/instaweb/resources/views/frontend/includes/header.blade.php ENDPATH**/ ?>