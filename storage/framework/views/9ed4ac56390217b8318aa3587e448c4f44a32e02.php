<?php
$page_heading = 'Due Balance Collection';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            margin: 0;
            white-space: nowrap;
            text-align: right;
            display: flex;
            flex-direction: row;
            gap: 5px;
            align-items: center;
            justify-content: end;
        }

        .dataTables_paginate.paging_input .paginate_button {
            border: 1px solid #ddd;
            padding: 2px 5px;
            cursor: pointer;
            transition: all .2s linear;
        }

        .dataTables_paginate.paging_input .paginate_button:hover {
            background: rgba(50, 50, 50, 1);
            color: #fff;
        }

        .dataTables_paginate.paging_input .paginate_input {
            width: 80px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <?php if ($__env->exists('backend.admin.due_balance_collection.breadcrumb', [
        'page_heading' => $page_heading,
    ])) echo $__env->make('backend.admin.due_balance_collection.breadcrumb', [
        'page_heading' => $page_heading,
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Claim Request to payment -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="20%">Dealer</th>
                                    <th width="20%">Collected amount</th>
                                    <th width="20%">Previous due balance</th>
                                    <th width="20%">Current due balance</th>
                                    <th width="15%">Collection date</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <!-- End Claim Request to payment -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <!-- Scripts on page -->
    <script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });
        /* End: Remove modal from dom when it hides from window */

        /* Initialize Select2 Elements */
        $('body').on('show.bs.modal', '.modal', function(event) {
            $('.select2').select2()
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        /* Dispaly edit modal using fetch API (ajax) */

        $('body').on('click', '#create_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#create_modal').modal('show');
                })
        });

        /* End: Dispaly edit modal using fetch API (ajax) */

        /* Ajax post request for updating */
        $('body').on('submit', '#create_form', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            let formData = new FormData(this);
            let serializeData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url: url,
                method: 'post',
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {

                    if (result.success == true) {
                        /* Toast alert on success */
                        toastr.success(result.message);
                        /* End: Toast alert on success */

                        /* Hide create modal form */
                        $("#create_modal").modal('hide');

                        /* Reload datatables */
                        $('#datatable').DataTable().ajax.reload(null, true);
                        /* End: Reload datatables */

                    } else {
                        toastr.error(result.message);
                    }

                },
                error: function(error) {
                    const err = error.responseJSON.errors;
                    for (const item in err) {
                        const message = err[item][0];
                        toastr.error(message.replace('id', ''));
                    }

                }
            });

            /* End: Ajax post request */


        });
        /* End: Add script */
    </script>

    <script>
        /* Dispaly edit modal using fetch API (ajax) */

        $('body').on('click', '#parts_edit_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#parts_edit_modal').modal('show');
                })
        });

        /* End: Dispaly edit modal using fetch API (ajax) */

        $('body').on('submit', '#parts_edit_form', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            /* Ajax post request for updating */
            $.ajax({
                url: url,
                method: 'post',
                data: $(this).serialize(),
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

            /* End: Ajax post request */


        });
        /* End: edit script */
    </script>


    <script>
        /* Datatable */
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: false,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500]
                ],
                'iDisplayLength': 10,
                ajax: '<?php echo e(route('admin.due_balance_collection_ajax')); ?>',
                columns: [

                    {
                        "title": "SL",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searching: false,
                        orderable: false,

                    },
                    {
                        data: 'dealer_id',
                        name: 'dealer_id'
                    },
                    {
                        data: 'collected_amount',
                        name: 'collected_amount'
                    },
                    {
                        data: 'previous_due_balance',
                        name: 'previous_due_balance'
                    },
                    {
                        data: 'current_due_balance',
                        name: 'current_due_balance'
                    },
                    {
                        data: 'collection_date',
                        name: 'collection_date'
                    }

                ]
            });
        });
        /* End: Datatable */
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/due_balance_collection/index.blade.php ENDPATH**/ ?>