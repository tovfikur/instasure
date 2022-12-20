<?php
$page_heading = 'Policy Providers List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <?php if ($__env->exists('backend.admin.policy_providers.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.policy_providers.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End: Breadcrumb -->

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
                                    <th>Contact Person Name</th>
                                    <th>Company Name</th>
                                    <th>Contact Person Phone</th>
                                    <th>Contact Person Email</th>
                                    <th>Is Api</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $policyProviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $policyProvider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e($policyProvider->contact_person_name); ?></td>
                                        <td><?php echo e($policyProvider->company_name); ?></td>
                                        <td><?php echo e($policyProvider->contact_person_phone); ?></td>
                                        <td><?php echo e($policyProvider->contact_person_email); ?></td>
                                        <td>
                                            <span><?php echo e($policyProvider->is_api == 1 ? 'True' : 'False'); ?></span>

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="<?php echo e(route('admin.policy-providers.show', $policyProvider->id)); ?>">
                                                        <i class="fa fa-eye text-success"></i> Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="<?php echo e(route('admin.policy-providers.edit', $policyProvider->id)); ?>">
                                                        <i class="fa fa-edit text-info"></i> Edit
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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/policy_providers/index.blade.php ENDPATH**/ ?>