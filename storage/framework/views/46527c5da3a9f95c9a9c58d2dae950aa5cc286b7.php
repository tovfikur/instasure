<?php
$page_heading = 'Mobile Diagnosis Report';
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

        .diagnosis_images {
            position: relative;
            width: 100%;
            min-height: 100px;
            overflow: hidden;
            padding: 5px;
            background: transparent;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-sizing: border-box;
        }

        .diagnosis_images figure {
            margin: 0 0 1rem;
            width: 100%;
            height: 100px;
            background: #eee;
            padding: 3px;
            position: relative;
            border-radius: 10px;
        }

        .diagnosis_images img {
            width: 100%;
            height: 100%;
            object-fit: fill;
            border-radius: 20px;
        }

        .diagnosis_images figcaption {
            position: absolute;
            bottom: 10px;
            left: 10%;
            background: #ad1;
            color: #555;
            font-size: 14px;
            padding: 0 5px;
            border-radius: 5px;
        }

        .diagnosis_images .icon {
            position: absolute;
            bottom: 10px;
            right: 10%;
            background: rgb(150 163 225);
            color: rgb(14, 5, 5);
            font-size: 14px;
            padding: 0 5px;
            border-radius: 5px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        <?php echo e($page_heading); ?>

                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('admin.reports.mobile_diagnosis_report', ['status' => 'all'])); ?>">
                                <span class="badge badge-secondary">All</span>
                            </a>
                        </li>
                        <!-- /.breadcrumb-item -->

                    </ol>
                    <!-- /.breadcrumb -->
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
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Customer Info</th>
                                    <th>Brand Info</th>
                                    <th>Device Info</th>
                                    <th>Parts Status</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>

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
    <!-- Scripts on page -->
    <script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End: Scripts on page -->

    <script>
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>

    <!-- Dispaly edit modal using fetch API (ajax) -->
    <script>
        $('body').on('click', '.edit_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#edit_modal').modal('show');
                })
        });

        /* End: Dispaly edit modal using fetch API (ajax) */

        /* Ajax post request for updating */
        $('body').on('submit', '#edit_form', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
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
                    $("#edit_modal").modal('hide');

                    /* Reload datatables */
                    $('#datatable').DataTable().ajax.reload(null, true);
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
    </script>
    <!-- End: Edit script -->

    <script>
        /* Imei data list using ajax call */
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500, "All"]
                ],
                'iDisplayLength': 10,
                ajax: "<?php echo e(route('admin.reports.mobile_diagnosis_report_ajax')); ?>",
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
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'device_model_id',
                        name: 'device_model_id'
                    },
                    {
                        data: 'serial_number',
                        name: 'serial_number'
                    },
                    {
                        data: 'parts_status',
                        name: 'parts_status'
                    },

                    {
                        data: 'actions',
                        name: 'actions',
                        searching: false,
                        orderable: false,
                        class: 'text-center'
                    }
                ]
            });
        });
        /* End: Imei data list using ajax call */
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/reports/mobile_diagnosis_report/index.blade.php ENDPATH**/ ?>