<?php
$page_heading = 'Our Details';
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
                                <?php if($child->logo): ?>
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="<?php echo e(asset('uploads/dealer-logo/photo/' . $child->logo)); ?>"
                                        alt="Admin profile picture" width="300" height="300">
                                <?php endif; ?>
                            </div>

                            <h3 class="profile-username text-center"><?php echo e($child->com_org_inst_name); ?></h3>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Auth Number:</b>
                                    <a class="float-right badge badge-secondary text-light"><?php echo e($child->user->phone); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Auth Type:</b>
                                    <a class="float-right"><?php echo e(ucwords(str_remove_dashes_custom($child->user_type))); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Receivable Amount:</b>
                                    <a class="float-right">
                                        <?php echo e($child->dealer_balance); ?>

                                        <?php echo e(config('settings.currency')); ?>

                                    </a>
                                </li>


                                <li class="list-group-item">
                                    <b>Dealer Type:</b>
                                    <a class="float-right"><?php echo e($child->dealer_type); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Agreement Status:</b> <a
                                        class="float-right badge badge-warning"><?php echo e(ucfirst($child->agreement_status)); ?></a>
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
                            <h4><?php echo e($child->com_org_inst_name); ?></h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content row">
                                <div class="col-md-6" style="border-right: 1px solid #ddd; max-height:500px">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Contact Person Name: </b> <a
                                                class="float-right"><?php echo e($child->contact_person_name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Phone:</b> <a
                                                class="float-right badge badge-warning"><?php echo e($child->contact_person_phone); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Email:</b> <a
                                                class="float-right"><?php echo e($child->contact_person_email); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Category:</b> <a class="float-right"><?php echo e($child->category->name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>BIN:</b> <a class="float-right"><?php echo e($child->bin); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>eTIN:</b> <a class="float-right"><?php echo e($child->etin); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Is API:</b> <a
                                                class="float-right"><?php echo e($child->is_api == 0 ? 'False' : 'True'); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Need IMEI Check:</b> <a class="float-right">
                                                <?php if($child->imei_check): ?>
                                                    <span class="badge badge-success">Yes</span>
                                                <?php else: ?>
                                                    <span class="badge badge-info">No</span>
                                                <?php endif; ?>

                                            </a>
                                        </li>
                                        <?php if(!empty($child->tread_license)): ?>
                                            <li class="list-group-item">
                                                <b>Tread Licence:</b>
                                                <a class="float-right">
                                                    <img class=""
                                                        src="<?php echo e(asset('uploads/tread_license/photo/' . $child->tread_license)); ?>"
                                                        alt="Tread Licence" width="40" height="40">
                                                    <a href="<?php echo e(asset('uploads/tread_license/photo/' . $child->tread_license)); ?>"
                                                        download><i class="fa fa-download"></i></a>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(!empty($child->nid)): ?>
                                            <li class="list-group-item">
                                                <b>NID:</b>
                                                <a class="">
                                                    <?php $__currentLoopData = json_decode($child->nid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <img class="" src="<?php echo e(asset('uploads/nid/' . $nid)); ?>"
                                                            alt="Tread Licence" width="40" height="40">
                                                        <a href="<?php echo e(asset('uploads/nid/' . $nid)); ?>" download
                                                            class="mr-2"><i class="fa fa-download"></i></a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class=" col-md-6">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>User name: </b> <a class="float-right"><?php echo e($child->user->name); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>User phone: </b> <a class="float-right"><?php echo e($child->user->phone); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Commission Type: </b> <a
                                                class="float-right"><?php echo e(ucwords($child->commission_type)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Commission Value: </b> <a
                                                class="float-right"><?php echo e(ucwords($child->commission_amount)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>City:</b> <a class="float-right "><?php echo e(ucwords($child->city)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Area:</b> <a class="float-right"><?php echo e(ucwords($child->area)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address:</b> <a class="float-right"><?php echo e(ucfirst($child->com_address)); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Submit Date:</b> <a
                                                class="float-right"><?php echo e(date('d F Y H:i:s', strtotime($child->app_submit_date_time))); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Insert By:</b> <a
                                                class="float-right"><?php echo e(userObj($child->insert_by_id)->name); ?></a>
                                        </li>
                                        <?php if($child->app_approve_date_time != null): ?>
                                            <li class="list-group-item">
                                                <b>Approve Date:</b> <a
                                                    class="float-right"><?php echo e(date('d F Y H:i:s', strtotime($child->app_approve_date_time))); ?></a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/profile/my_profile.blade.php ENDPATH**/ ?>