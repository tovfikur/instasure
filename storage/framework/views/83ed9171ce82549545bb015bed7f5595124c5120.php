<?php
$page_heading = 'Device Insurance Sale List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        <?php echo e($page_heading); ?>

                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer', ['status' => 'all'])); ?>">
                                <span class="badge badge-secondary">All</span>
                            </a>
                        </li>
                        <!-- /.breadcrumb-item -->

                    </ol>
                    <!-- /.breadcrumb -->
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
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Parent</th>
                                    <th>Customer Phone</th>
                                    <th>Device</th>
                                    <th>Policy Number</th>
                                    <th>Insurance Value</th>
                                    <th>Device Price</th>
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
                                        <td><?php echo e($deviceInsurance->parent->com_org_inst_name); ?></td>
                                        <td><?php echo e($customerInfo->customer_phone); ?></td>
                                        <td><?php echo e(ucwords($deviceInfo->brand_name . ' ' . $deviceInfo->model_name)); ?>

                                        </td>
                                        <td>
                                            <?php if($deviceInsurance->policy_number): ?>
                                                <?php echo e($deviceInsurance->policy_number); ?>

                                            <?php else: ?>
                                                <del class="text-secondary">Not set yet</del>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($deviceInsurance->grand_total); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td>
                                            <?php echo e($deviceInfo->device_price); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </td>
                                        <td>
                                            <div class="dropleft">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="<?php echo e(route('admin.device-sale-commission', $deviceInsurance->id)); ?>">
                                                        <i class="fa fa-eye text-success"></i> Commission Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="<?php echo e(route('policy-invoice', $deviceInsurance->id)); ?>">
                                                        <i class="fa fa-print text-primary"></i> Invoice
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="<?php echo e(route('policy-certificate', encrypt($deviceInsurance->id))); ?>">
                                                        <i class="fa fa-certificate text-warning"></i> Certificate
                                                    </a>

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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/device_insurance_sale/index.blade.php ENDPATH**/ ?>