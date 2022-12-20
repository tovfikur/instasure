<?php
$page_heading = 'Insurance Types List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.admin.insurance_types.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.insurance_types.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                    <th>Name</th>
                                    <th>Device Subcategory Name</th>
                                    <th>Priority</th>
                                    <th>Check Ins Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $insuranceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $insuranceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + 1); ?></td>
                                        <td><?php echo e(ucfirst($insuranceType->name)); ?></td>
                                        <td><?php echo e(ucfirst($insuranceType->deviceSubcategory->name)); ?></td>
                                        <td><?php echo e($insuranceType->set_priority); ?></td>
                                        <td><?php echo e($insuranceType->check_inc_type); ?></td>
                                        <td>

                                            <span title="Click to change status"
                                                class="badge  <?php if($insuranceType->status): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                <a class="text-light"
                                                    href="<?php echo e(route('admin.insurance-types.change_status', $insuranceType->id)); ?>">
                                                    <?php if($insuranceType->status): ?>
                                                        Active
                                                    <?php else: ?>
                                                        Inactive
                                                    <?php endif; ?>
                                                </a>
                                            </span>

                                        </td>
                                        <td>
                                            <a class="btn btn-info waves-effect"
                                                href="<?php echo e(route('admin.insurance-types.edit', $insuranceType->id)); ?>">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
    <script src="<?php echo e(asset('backend/plugins/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/insurance_types/index.blade.php ENDPATH**/ ?>