<?php
$page_heading = 'Dashboard - Admin';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.admin.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body table-responsive">
                    <div class="row">
                        <?php if($parentDueBalance): ?>
                            <div class="col-md-4 col-lg-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>
                                            <?php echo e($parentDueBalance); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </h3>
                                        <p>Parent Due Balance Total Pending</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        <?php endif; ?>
                        <?php if($dueBalanceCollection): ?>
                            <div class="col-md-4 col-lg-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>
                                            <?php echo e($dueBalanceCollection); ?>

                                            <?php echo e(config('settings.currency')); ?>

                                        </h3>
                                        <p>Parent Due Balance Total Collection </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        <?php endif; ?>
                        <?php if(isset($counts) && count($counts)): ?>
                            <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 col-lg-3">
                                    <div class="small-box <?php echo e($styles[$loop->index]['bg']); ?>">
                                        <div class="inner">
                                            <h3><?php echo e($counter); ?></h3>
                                            <p><?php echo e(ucwords(str_remove_dashes_custom($title))); ?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="<?php echo e($styles[$loop->index]['icon']); ?>"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.col -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/dashboard.blade.php ENDPATH**/ ?>