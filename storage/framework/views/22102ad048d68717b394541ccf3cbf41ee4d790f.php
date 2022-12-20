<?php
$page_heading = 'Parent Dealer List';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.css')); ?>">
    <style>
        .dropdown-toggle::after {
            display: none;
        }

        fieldset {
            border: 1px solid #efefef;
            padding: 10px;
        }

        legend {
            font-size: 12px;
            margin-left: 11px;
            color: #343a40;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.admin.parent_dealers.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.parent_dealers.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                    <th>Logo</th>
                                    <th>Company</th>
                                    <th>Contact Person</th>
                                    <th>Contact Phone</th>
                                    <th>Type</th>
                                    <th>Check IMEI</th>
                                    <th>Active</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $parentDealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $parentDealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <img src="<?php echo e(asset('uploads/dealer-logo/photo/' . $parentDealer->logo)); ?>"
                                                width="30" height="20" alt="dealar-log">
                                        </td>

                                        <td><?php echo e($parentDealer->com_org_inst_name); ?></td>

                                        <td><?php echo e($parentDealer->contact_person_name); ?></td>
                                        <td><?php echo e($parentDealer->contact_person_phone); ?></td>

                                        <td><?php echo e($parentDealer->dealer_type); ?></td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($parentDealer->imei_check ? 'success' : 'secondary'); ?>">
                                                <?php if($parentDealer->imei_check): ?>
                                                    Yes
                                                <?php else: ?>
                                                    No
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-<?php echo e($parentDealer->active ? 'success' : 'secondary'); ?>">
                                                <?php if($parentDealer->active): ?>
                                                    Active
                                                <?php else: ?>
                                                    Inactive
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropleft">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="<?php echo e(route('admin.parent-dealers.show', $parentDealer->id)); ?>">
                                                        <i class="fa fa-eye text-success"></i> Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="<?php echo e(route('admin.parent-dealers.edit', $parentDealer->id)); ?>">
                                                        <i class="fa fa-edit text-info"></i> Edit
                                                    </a>

                                                    <a class="bg-dark dropdown-item btn_brand_mapping"
                                                        href="<?php echo e(route('admin.parent_dealers_brand_mapping', $parentDealer->id)); ?>">
                                                        <i class="fa fa-laptop text-danger"></i>
                                                        Brand Mapping
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
    <script src="<?php echo e(asset('backend/plugins/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/plugins/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script>
        /* Default ajax csrf token */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>

    <script>
        /* Dispaly edit modal using fetch API (ajax) */

        $(".btn_brand_mapping").on('click', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {

                    $('body').append(html);
                    $('#modal_brand_mapping').modal('show');
                })
        });

        /* End: Dispaly edit modal using fetch API (ajax) */

        /* Ajax post request for updating */
        $('body').on('submit', '#form_brand_mapping', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).serialize();

            $.ajax({
                url: url,
                method: 'post',
                data: data,
                dataType: 'json',
                success: function(result) {

                    if (result.success == true) {
                        /* Toast alert on success */
                        toastr.success(result.message);
                        /* End: Toast alert on success */

                    } else {
                        toastr.error(result.message);
                    }
                    /* Hide create modal form */
                    $("#parts_edit_modal").modal('hide');

                    /* Reload datatables */
                    $('#parts_table').DataTable().ajax.reload(null, true);
                    /* End: Reload datatables */
                },
                error: function(error) {
                    const err = error.responseJSON.errors;
                    for (const item in err) {
                        const message = err[item][0];
                        toastr.error(message.replace('id', ''));
                    }

                }
            });

        })
        /* Ajax post request for updating */
    </script>
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

        //today's deals
        function update_is_home(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('<?php echo e(route('admin.categories.is_home')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    toastr.success('success', 'Is Home updated successfully');
                } else {
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/parent_dealers/index.blade.php ENDPATH**/ ?>