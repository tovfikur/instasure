<?php $__env->startSection('title', 'Insurance Purchase History'); ?>
<?php $__env->startPush('css'); ?>
    <style>
        .single-pricing-box .pricing-header.bg2 {
            background-image: url(https://t4.ftcdn.net/jpg/01/19/11/55/360_F_119115529_mEnw3lGpLdlDkfLgRcVSbFRuVl6sMDty.jpg);
        }
        .ptb-100 {
            padding-top: 25px;
            padding-bottom: 100px;
        }
        .single-pricing-box {
            padding-bottom: 19px;
        }
        .single-pricing-box .pricing-header {
            background-color: #002e5b;
            border-radius: 5px 5px 0 0;
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding-top: 25px;
            padding-bottom: 25px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        @media  only screen and (max-width: 767px){
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
        }
        .src-image {
            display: none;
        }

        .card2 {
            overflow: hidden;
            position: relative;
            text-align: center;
            padding: 0;
            color: #fff;

        }

        .card2 .header-bg {
            /* This stretches the canvas across the entire hero unit */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            border-bottom: 1px #FFF solid;
            /* This positions the canvas under the text */
            z-index: 1;
        }
        .card2 .avatar {
            position: relative;
            z-index: 100;
        }

        .card2 .avatar img {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(0,0,30,0.8);
        }
        #hoverMe {
            border-bottom:1px dashed #e5e5e5;
            text-align: left;
            padding: 13px 20px 11px;
            font-size: 14px;
            font-weight: 600;
            color: #002e5b;

        }
        #hoverMe:hover {
            background-color: #ebebeb;
            color: #002e5b;
            border-left: 3px solid #002e5b;

        }
        .services-box .content {
            padding: 14px;
            border-radius: 0 0 5px 5px;
        }
        .services-box .content h3 {
            margin-bottom: 0px;
            position: relative;
            text-transform: uppercase;
            font-size: 18px;
            font-weight: 900;
        }
        .services-box {
            margin-bottom: 15px;
            border-radius: 5px;
            transition: 0.5s;
            background-color: #ffffff;
            box-shadow: 9.899px 9.899px 30px 0 rgb(0 0 0 / 10%);
        }
        .pl-50{
            padding-left: 50%;
        }

    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Insurance purchase history</h2>
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li>Insurance purchase history</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-20 pb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 ">
                    <?php echo $__env->make('frontend.partials.customer_dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 ">
                    <div class="row">

                        <?php $__currentLoopData = $travelOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travelOrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services-box">
                                <div class="content">
                                    <p><i class="fa fa-calendar"> <?php echo e(date('d F Y',strtotime($travelOrder->created_at))); ?></i> <span class="pl-50 "><span class="badge bg-<?php echo e($travelOrder->payment_status == 'paid'? 'success' : 'danger'); ?>"><?php echo e(ucfirst($travelOrder->payment_status)); ?></span></span></p>
                                    <h3><a href="<?php echo e(route('user.insurance.purchase.details',encrypt($travelOrder->id))); ?>"><?php echo e($travelOrder->travel_insurance_category_title); ?></a></h3>
                                    <a href="<?php echo e(route('user.insurance.purchase.details',encrypt($travelOrder->id))); ?>" class="read-more-btn">Details<i class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="">
                            <?php echo e($travelOrders->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/frontend/pages/insurance_purchase_history.blade.php ENDPATH**/ ?>