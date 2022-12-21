<?php
$page_heading = 'Child Dealer List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.parent_dealer.child_dealers.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.parent_dealer.child_dealers.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content">
        <div class="card card-info card-outline">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Logo</th>
                            <th>C.P.Name</th>
                            <th>C.P.Phone</th>
                            <th>Company</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $childDealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $childDealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key + 1); ?></td>
                                <td><img src="<?php echo e(asset('uploads/dealer-logo/photo/' . $childDealer->logo)); ?>" width="30"
                                        height="20" alt=""></td>
                                <td><?php echo e($childDealer->contact_person_name); ?></td>
                                <td><?php echo e($childDealer->contact_person_phone); ?></td>
                                <td><?php echo e($childDealer->com_org_inst_name); ?></td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="bg-dark dropdown-item"
                                                href="<?php echo e(route('parentDealer.child-dealers.show', $childDealer->id)); ?>">
                                                <i class="fa fa-eye text-success"></i> Details
                                            </a>
                                            <a class="bg-dark dropdown-item"
                                                href="<?php echo e(route('parentDealer.child-dealers.edit', $childDealer->id)); ?>">
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
        <!-- /.card -->
    </section>
    <!-- /.content -->

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

        //sweet alert
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/parent_dealer/child_dealers/index.blade.php ENDPATH**/ ?>