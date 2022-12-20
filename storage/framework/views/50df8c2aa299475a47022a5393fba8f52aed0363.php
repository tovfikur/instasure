<?php
$page_heading = 'Device Insurance Commission Details';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        <?php echo e($page_heading); ?>

                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right mt-1">

                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.device-insurance-sales')); ?>" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                All
                            </a>
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <p class="pl-2 pb-0 mb-0 bg-info ">Customer Information</p>
            <?php
                $customerInfo = json_decode($deviceOrderDetails->customer_info);
                $deviceInfo = json_decode($deviceOrderDetails->device_info);
                $insTypeValue = json_decode($deviceOrderDetails->insurance_type_value);
            ?>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr style="">
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($customerInfo->customer_name); ?></td>
                        <td><?php echo e($customerInfo->customer_phone); ?></td>
                        <td><?php echo e($customerInfo->customer_email ? $customerInfo->customer_email : 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
            <p class="pl-2 pb-0 mb-0 bg-info">Device Information</p>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Device Brand</th>
                        <th>Device Model</th>
                        <th>Device Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($deviceInfo->brand_name); ?></td>
                        <td><?php echo e($deviceInfo->model_name); ?></td>
                        <td><?php echo e($deviceInfo->device_price); ?><?php echo e(config('settings.currency')); ?></td>
                    </tr>
                </tbody>
            </table>

            <p class="pl-2 pb-0 mb-0 bg-info">Insurance Price Information</p>
            <table class="table table-bordered mt-3 mb-0">
                <thead>
                    <tr style="">
                        <th>Insurance Type</th>
                        <th>Price</th>
                        <th>Insurance Type</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php $__currentLoopData = $insTypeValue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($data->parts_type); ?></td>
                            <td><?php echo e($data->price); ?></td>
                            <td><?php echo e(ucfirst($data->ins_type)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
            <div class="row">
                <div class="col-md-8 ">
                    <table class="table table-bordered mt-3 mb-2 ml-2">
                        <thead>
                            <tr class="bg-info" style="">
                                <th>Commission Type</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Included Package Commission for Child</td>
                                <td><?php echo e($deviceOrderDetails->parent_will_pay_to_child); ?>

                                    <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr>
                                <td>Excluded Package Commission for Child</td>
                                <td><?php echo e($deviceOrderDetails->child_dealer_commission - $deviceOrderDetails->parent_will_pay_to_child); ?>

                                    <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr style="">
                                <td>Child Dealer Total Commission</td>
                                <td><?php echo e($deviceOrderDetails->child_dealer_commission); ?>

                                    <?php echo e(config('settings.currency')); ?></td>

                            </tr>
                            <tr>
                                <td>Parent Dealer Commission</td>
                                <td><?php echo e($deviceOrderDetails->parent_dealer_commission); ?>

                                    <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr>
                                <td>Other Party Commission</td>
                                <td><?php echo e($deviceOrderDetails->other_dealer_commission); ?>

                                    <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr>
                                <td>Instasure Amount</td>
                                <td><?php echo e($deviceOrderDetails->instasure_amount); ?> <?php echo e(config('settings.currency')); ?>

                                </td>
                            </tr>

                            <tr>
                                <td>Parent Will Pay Instasure</td>
                                <td><?php echo e($deviceOrderDetails->parent_will_pay_to_admin); ?>

                                    <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered mt-0 pt-0">
                        <tr>

                            <td>Sub Total Price</td>
                            <td><?php echo e($deviceOrderDetails->sub_total); ?> <?php echo e(config('settings.currency')); ?></td>

                        </tr>
                        <tr>
                            <td>Total Vat</td>
                            <td><?php echo e($deviceOrderDetails->total_vat); ?> <?php echo e(config('settings.currency')); ?></td>
                        </tr>
                        <tr>

                            <td>Total Price</td>
                            <td><?php echo e($deviceOrderDetails->grand_total); ?> <?php echo e(config('settings.currency')); ?></td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>


    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/device_insurance_sale/commission_details.blade.php ENDPATH**/ ?>