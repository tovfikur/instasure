<?php
$page_heading = 'Dashboard - Parent Dealer';
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

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo e($totalInsSale); ?></h3>
                                <p>Total Device Insurance Sale</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.deviceInsSaleHistory')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php echo e($totalEarn . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Total Commission Earn</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.deviceInsSaleHistory')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php echo e($dealerBalance . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Available Balance For Withdraw</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-gbp"></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.commission_withdraw_request')); ?>" class="small-box-footer">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php echo e($dueBalance . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Payable to Admin</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-eur"></i>
                            </div>
                            <a href="javascript:void(0)" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    <?php echo e($paid_by_admin . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Paid by Admin</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.commission_withdraw_request')); ?>" class="small-box-footer">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->


                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php echo e($received_amount . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Received Amount</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-rub "></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.commission_withdraw_request')); ?>" class="small-box-footer">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php echo e($pending_amount . ' ' . config('settings.currency')); ?>

                                </h3>

                                <p>Pending to Admin</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-jpy "></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.commission_withdraw_request')); ?>" class="small-box-footer">More
                                info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    <?php echo e($childDealers); ?>

                                </h3>

                                <p>Child Dealers</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="<?php echo e(route('parentDealer.child-dealers.index')); ?>" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/parent_dealer/dashboard.blade.php ENDPATH**/ ?>