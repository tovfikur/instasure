<?php
$page_heading = 'Device Insurance Commission Log';
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
                                    <th>Commission</th>
                                    <th>Insured Value</th>
                                    <th>Policy Number</th>
                                    <th>Sold At</th>
                                    <th>Invoice</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <tbody>
                                <?php $__currentLoopData = $deviceInsurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deviceInsurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td>
                                            <?php echo e($deviceInsurance->child_dealer_commission); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td>
                                            <?php echo e($deviceInsurance->totalAmountForCal); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td><?php echo e($deviceInsurance->policy_number ? $deviceInsurance->policy_number : 'N/A'); ?>

                                        </td>

                                        <td>
                                            <?php echo e(date_format_custom($deviceInsurance->created_at, ' d M, Y')); ?>

                                            <span class="badge badge-info">
                                                <?php echo e(date_format_custom($deviceInsurance->created_at, 'H:i A')); ?>

                                            </span>
                                        </td>
                                        <td><?php echo e($deviceInsurance->invoice_code); ?></td>
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
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="<?php echo e(route('policy-certificate', encrypt($deviceInsurance->id))); ?>">
                                                        <i class="fa fa-certificate text-success"></i> Certificate
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/device_insurance/sale_history.blade.php ENDPATH**/ ?>