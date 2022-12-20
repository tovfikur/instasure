<?php
$page_heading = 'Parent Dealer Information';
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if($parent->logo): ?>
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="<?php echo e(asset('uploads/dealer-logo/photo/' . $parent->logo)); ?>"
                                        alt="Admin profile picture" width="300" height="300">
                                <?php endif; ?>
                            </div>

                            <h3 class="profile-username text-center"><?php echo e($parent->com_org_inst_name); ?></h3>

                            <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                    <b>Auth Type:</b>
                                    <a class="float-right"><?php echo e(ucwords(str_remove_dashes_custom($parent->user_type))); ?></a>
                                </li>


                                <li class="list-group-item">
                                    <b>Dealer Type:</b>
                                    <a class="float-right"><?php echo e($parent->dealer_type); ?></a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card  card-info card-outline">
                        <div class="card-header p-2">
                            <h4><?php echo e($parent->com_org_inst_name); ?></h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content row">
                                <div class="col-md-8 offset-2" style="border: 1px solid #ddd; max-height:500px">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Contact Person Name: </b> <a
                                                class="float-right"><?php echo e($parent->contact_person_name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Phone:</b> <a
                                                class="float-right badge badge-warning"><?php echo e($parent->contact_person_phone); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Email:</b> <a
                                                class="float-right"><?php echo e($parent->contact_person_email); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Category:</b> <a class="float-right"><?php echo e($parent->category->name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>City:</b> <a class="float-right "><?php echo e(ucwords($parent->city)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Area:</b> <a class="float-right"><?php echo e(ucwords($parent->area)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address:</b> <a class="float-right"><?php echo e(ucfirst($parent->com_address)); ?></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/profile/parent_profile.blade.php ENDPATH**/ ?>