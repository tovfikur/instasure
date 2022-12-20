<?php $__env->startSection('title', 'Device Insurance Support Tickets'); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css" />
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

        @media  only screen and (max-width: 767px) {
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
            border: 5px solid rgba(0, 0, 30, 0.8);
        }

        #hoverMe {
            border-bottom: 1px dashed #e5e5e5;
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

        .pl-50 {
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
                        <h2>Device Insurance Support Tickets</h2>
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li>Device Insurance Support Tickets</li>
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
                <div class="col-lg-9 col-md-9 col-sm-9 table-responsive">
                    <h3 class="text-center" style="text-transform: uppercase; text-decoration: underline">Support Tickets
                    </h3>

                    <?php if($claimRequests->count() > 0): ?>
                        <table class="table table-bordered table-responsive mt-5" id="example1">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Service Center Name</th>
                                    <th>Service Center Address</th>
                                    <th>Device Name</th>
                                    <th>Device Brand</th>
                                    <th>Device Model</th>
                                    <th>Claim For</th>
                                    <th>Claim Note</th>
                                    <th>Status Note</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $claimRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $claimRequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $device_info = json_decode($claimRequest->deviceInsurance->device_info);
                                        $serviceCenter = $claimRequest->service_center;

                                    ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e(!empty($serviceCenter) ? $serviceCenter->service_center_name : 'Instasure'); ?>

                                        </td>
                                        <td><?php echo e(!empty($serviceCenter) ? $serviceCenter->address : 'Instasure Address.'); ?>

                                        </td>
                                        <td><?php echo e(ucwords($device_info->brand_name . ' ' . $device_info->model_name)); ?></td>
                                        <td><?php echo e($device_info->brand_name); ?></td>
                                        <td><?php echo e($device_info->model_name); ?></td>
                                        <td><?php echo e($claimRequest->claim_type); ?></td>
                                        <td><?php echo e($claimRequest->claim_note); ?></td>
                                        <td><?php echo e($claimRequest->status_note); ?></td>
                                        <td>
                                            <?php if($claimRequest->status == 'completed'): ?>
                                                <span class="bg bg-success"><?php echo e($claimRequest->status); ?></span>
                                            <?php elseif($claimRequest->status == 'canceled'): ?>
                                                <span class="bg bg-danger"><?php echo e($claimRequest->status); ?></span>
                                            <?php else: ?>
                                                <span class="bg bg-warning"><?php echo e($claimRequest->status); ?></span>
                                            <?php endif; ?>

                                        </td>

                                        <td><?php echo e(dateTimeFormat($claimRequest->created_at)); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="text-center">
                            <img src="<?php echo e(asset('frontend/no-data-found.webp')); ?>" width="200" height="150">
                            <h3 style="color: black!important;">No Data Found!!!</h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/frontend/pages/device_insurance_claim_requests.blade.php ENDPATH**/ ?>