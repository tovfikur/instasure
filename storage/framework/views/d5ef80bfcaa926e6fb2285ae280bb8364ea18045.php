<?php
$page_heading = 'Dashboard';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startSection('content'); ?>

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
                            <a href="<?php echo e(route('childDealer.select-customer')); ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Sale Insurance
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


    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo e($totalInsSale); ?></h3>
                                <p>Total Device Insurance Sale</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <a href="<?php echo e(route('childDealer.deviceInsSaleHistory')); ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php echo e($totalEarn); ?>

                                    <?php echo e(config('settings.currency')); ?>

                                </h3>
                                <p>Total Earned Commission </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="<?php echo e(route('childDealer.deviceInsSaleHistory')); ?>" class="small-box-footer">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php echo e($childDealer->dealer_balance); ?>

                                    <?php echo e(config('settings.currency')); ?>

                                </h3>

                                <p>Current Commission Balance </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                            <a href="<?php echo e(route('childDealer.deviceInsSaleHistory')); ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/dashboard.blade.php ENDPATH**/ ?>