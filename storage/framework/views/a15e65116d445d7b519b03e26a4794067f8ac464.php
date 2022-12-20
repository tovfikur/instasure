<?php $__env->startSection('title', 'Home'); ?>
<!-- Start Main Banner Area -->
<?php $__env->startSection('content'); ?>
    <div class="home-area home-slides owl-carousel owl-theme">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="main-banner " style="background-image: url(<?php echo e(asset('/' . $slider->image)); ?>)">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="main-banner-content" style="margin-top: -20%">
                                <span class="sub-title"><?php echo e($slider->title); ?></span>
                                <h2 style="color: #ffffff !important;"><?php echo e($slider->content); ?></h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- End Main Banner Area -->

    <!-- Start Services Boxes Area -->
    <section class="services-boxes-area bg-f8f8f8">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <div class="image">
                            <img src="<?php echo e(asset('frontend/assets/img/featured-services-image/1.jpg')); ?>" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Pricing</a></h3>
                            <p>Economical and cost-effective as the company is fully digital</p>

                            <div class="icon">
                                <img src="<?php echo e(asset('frontend/assets/img/icon1.png')); ?>" alt="image">
                            </div>
                            <div class="shape">
                                <img src="<?php echo e(asset('frontend/assets/img/umbrella.png')); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <div class="image">
                            <img src="<?php echo e(asset('frontend/assets/img/featured-services-image/2.jpg')); ?>" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Buying process </a></h3>
                            <p>As simple as top up ur phone or buying a book online</p>

                            <div class="icon">
                                <img src="<?php echo e(asset('frontend/assets/img/icon2.png')); ?>" alt="image">
                            </div>
                            <div class="shape">
                                <img src="<?php echo e(asset('frontend/assets/img/umbrella.png')); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                    <div class="single-box">
                        <div class="image">
                            <img src="<?php echo e(asset('frontend/assets/img/featured-services-image/3.jpg')); ?>" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Claims</a></h3>
                            <p>Smooth sailing throughout the claiming process</p>

                            <div class="icon">
                                <img src="<?php echo e(asset('frontend/assets/img/icon3.png')); ?>" alt="image">
                            </div>
                            <div class="shape">
                                <img src="<?php echo e(asset('frontend/assets/img/umbrella.png')); ?>" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Boxes Area -->

    <!-- Start About Area -->
    <section class="about-area ptb-100 bg-f8f8f8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-title">
                        <img src="<?php echo e(asset('frontend/assets/img/about-image/pexels-juan-mendez-1536619.jpg')); ?>"
                            alt="aamr-pay">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-text">
                        <h3>Touching Lives</h3>
                        <p class="text-justify" style="font-family: Georgia">
                            With the purpose of breaking the 0.4% insurance penetration barrier in Bangladesh, we built the first-ever 'insurance-as-a-service' platform in Bangladesh capable of meeting the rapidly evolving needs of today's Gen Z.  Using our API, Insurers can be in the right place at the right time by embedding in products or platforms with large customer bases, serving them relevant insurance products at point of sale or at other appropriate times in the customer life cycle. With the ability to access relevant data, perform real time risk assessments, and set prices accordingly, insurers can embed their products virtually anywhere there is risk.                        </p>

                        <a href="<?php echo e(route('about')); ?>" class="read-more-btn">More About Us <i
                                class="flaticon-right-chevron"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Services Area -->
    <section class="services-area pt-5 pb-70">
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-5">An Embedded Insurtech Platform</h2>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-home-insurance"></i>
                        </div>
                        <p>Partner-friendly API -Integrate insurance products into your technology system with ease.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-insurance"></i>
                        </div>
                        <p>Integrated Know-Your-Customer workflow - Reducing response time, and improving customer
                            satisfaction.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-medal"></i>
                        </div>
                        <p>Dynamic pricing model and real-time risk engine -Our dynamic pricing model and real-time risk
                            engine ensure that customers enjoy competitive rates on their insurance and get value-for-money.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-target"></i>
                        </div>
                        <p>Smart claims management system- Claims are the heart of an insurance product. Our smart claims
                            management system makes claims submission transparent, fair and fast.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->


    <!-- Start Services Area -->
    
    
    
    
    
    

    
    
    
    
    

    

    

    
    
    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    
    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    

    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    
    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    

    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    

    
    
    

    
    
    
    
    

    

    

    

    
    
    
    
    

    
    
    
    <!-- End Services Area -->

    <!-- Start Why Choose Us Area -->
    <section class="why-choose-us-area">
        <div class="container">
            <div class="row">
                
                
                
                
                

                
                
                

                
                
                
                
                

                <div class="col-lg-12 col-md-12">
                    <div class="why-choose-us-content">
                        <div class="content">
                            <div class="title">
                                <span class="sub-title">Your Benefits</span>
                                <h2>Why Choose Us</h2>
                                <p class="para">
                                    Traditional insurance companies make it hard for you to get anything out of them. That's
                                    because when you benefit, they lose out. We hate that, so we've reinvented insurance to
                                    align our interests with yours. Inspired by the origins of insurance, it is all powered
                                    by cutting edge tech that makes it feel like magic while pushing away the pesky
                                    fraudsters. At last, insurance that works like a dream instead of a nightmare.
                                </p>
                            </div>

                            <ul class="features-list">
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-like"></i>
                                    </div>
                                    <span>Fast & Easy </span>
                                    Sign-up and claims are effortless because our system's designed for you, not against
                                    you.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-customer-service"></i>
                                    </div>
                                    <span>Easy Communication </span>
                                    As simple as reading a comic book.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-care"></i>
                                    </div>
                                    <span>No Paperwork </span>
                                    No paperwork, Maximum convenience
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-team"></i>
                                    </div>
                                    <span>Fair & Transparent </span>
                                    You'll never feel uncertain; we have your back and will explain what's what in plain
                                    Bangla.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-policy"></i>
                                    </div>
                                    <span>Faster claim </span>
                                    Our simple, one-step process makes it very easy for you to lodge claims within 60
                                    seconds. 24x7 through our web site/ app /call center.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-education"></i>
                                    </div>
                                    <span>More TLC, Less T&C </span>
                                    No hidden clauses, jargon free documents in simple language.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->



    <!-- Start Blog Area -->
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- End Blog Area -->




    <!-- Start Partner Area -->
    <section class="partner-area">
        <div class="container">
            <div class="partner-title">
                <h2>Our trusted partners</h2>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <?php
                        $partner = \App\Model\Partner::where('name', 'Delta Life')->first();
                    ?>
                    <img src="<?php echo e(asset('uploads/partners/' . $partner->image)); ?>" alt="aamr-pay">
                </div>
            </div>
        </div>
    </section>
    <!-- End Partner Area -->

    <!-- Start Quote Area -->
    
    
    
    
    
    
    

    
    
    
    
    

    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- End Quote Area -->

    <!-- Start CTR Area -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- End CTR Area -->

    <!-- Start Feedback Area -->
    <section class="feedback-area ptb-100">
        <div class="container">
            <div class="section-title">
                
                <h3>Our Clients Feedback</h3>
                
            </div>

            <div class="feedback-slides">
                <div class="client-feedback">
                    <div>
                        <div class="item">
                            <div class="single-feedback">
                                <p>“My phone arrived very quickly. Plus, the new phone works great! Service was
                                    exceptionally fast convenient and easy!!! Thank you very much awesome customer service
                                    !!!”</p>
                            </div>
                        </div>
                    </div>

                    <button class="prev-arrow slick-arrow">
                        <i class='flaticon-left-chevron'></i>
                    </button>

                    <button class="next-arrow slick-arrow">
                        <i class='flaticon-right-chevron'></i>
                    </button>
                </div>

                
            </div>
        </div>
    </section>
    <!-- End Feedback Area -->




    <!-- Start Our Mission Area -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- End Our Mission Area -->

    <!-- Start Team Area -->
    
    
    
    
    
    
    

    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    

    
    
    

    
    
    
    
    
    
    

    
    
    
    
    

    
    
    

    
    
    
    
    
    
    

    
    
    
    
    

    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    
    
    <!-- End Team Area -->

    <!-- Start Our Achievements Area -->
    
    
    
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    

    
    
    
    
    
    
    

    
    
    
    
    
    
    
    

    
    
    

    
    
    
    
    
    

    
    
    

    
    
    
    
    
    
    
    
    <!-- End Our Achievements Area -->

    <!-- Start Blog Area -->
    
    
    
    
    
    
    

    
    
    
    
    

    
    

    
    
    

    
    
    
    

    
    
    
    

    
    

    
    
    

    
    
    
    

    
    
    
    

    
    

    
    
    

    
    
    
    

    
    
    
    
    
    
    
    
    <!-- End Blog Area -->

    <!-- Start Join Area -->
    
    
    
    
    
    
    
    

    
    
    
    

    
    
    
    
    
    
    <!-- End Join Area -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/frontend/index.blade.php ENDPATH**/ ?>