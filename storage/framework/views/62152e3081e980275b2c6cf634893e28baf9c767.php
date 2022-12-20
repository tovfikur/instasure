<?php
$page_heading = 'Device Insurance Sale List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <?php if ($__env->exists('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End:Breadcrumb -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Invoice</th>
                                    <th>Insured Value</th>
                                    <th>Device Price</th>
                                    <th>Policy Number</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $deviceInsurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deviceInsurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $customerInfo = json_decode($deviceInsurance->customer_info);
                                        $deviceInfo = json_decode($deviceInsurance->device_info);
                                    ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e(ucwords($customerInfo->customer_name)); ?></td>
                                        <td><?php echo e($customerInfo->customer_phone); ?></td>
                                        <td><?php echo e($deviceInsurance->invoice_code); ?></td>
                                        <td>
                                            <?php echo e($deviceInsurance->totalAmountForCal); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td>
                                            <?php echo e($deviceInfo->device_price); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td><?php echo e($deviceInsurance->policy_number ? $deviceInsurance->policy_number : 'N/A'); ?>

                                        </td>
                                        <td><span
                                                class="badge badge-<?php echo e($deviceInsurance->payment_status == 'pending' ? 'warning' : 'success'); ?>"><?php echo e(ucwords($deviceInsurance->payment_status)); ?></span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    
                                                    
                                                    
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="<?php echo e(route('policy-invoice', $deviceInsurance->id)); ?>">
                                                        <i class="fa fa-print text-primary"></i> Invoice
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="<?php echo e(route('childDealer.device-insurance.order', encrypt($deviceInsurance->id))); ?>">
                                                        <i class="fa fa-eye text-success"></i> View Details
                                                    </a>

                                                    <?php if(strtolower($deviceInsurance->payment_status) == 'pending'): ?>
                                                        <a class="bg-dark dropdown-item" target="_blank"
                                                            href="<?php echo e(route('childDealer.device-insurance.order', encrypt($deviceInsurance->id))); ?>">
                                                            <i class="fa fa-money text-warning"></i> Go to pay
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(strtolower($deviceInsurance->payment_status) != 'pending'): ?>
                                                        <a class="bg-dark dropdown-item" target="_blank"
                                                            href="<?php echo e(route('policy-certificate', encrypt($deviceInsurance->id))); ?>">
                                                            <i class="fa fa-certificate text-success"></i> Certificate
                                                        </a>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/device_insurance/index.blade.php ENDPATH**/ ?>