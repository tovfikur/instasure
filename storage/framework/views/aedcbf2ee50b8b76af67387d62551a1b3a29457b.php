<?php
$page_heading = 'Parent Due Balance';
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

    <?php if ($__env->exists('backend.admin.parent_due_balance.breadcrumb', [
        'page_heading' => $page_heading,
    ])) echo $__env->make('backend.admin.parent_due_balance.breadcrumb', [
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
                                    <th width="15%">Due balance</th>
                                    <th width="20%">Dealer name</th>
                                    <th width="15%">Dealer type</th>
                                    <th width="22%">Contact person phone</th>
                                    <th width="23%">Contact person name</th>
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
        /* Datatable */
        $(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500]
                ],
                'iDisplayLength': 10,
                ajax: '<?php echo e(route('admin.parent_due_balance_ajax')); ?>',
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
                        data: 'due_balance',
                        name: 'due_balance'
                    },
                    {
                        data: 'com_org_inst_name',
                        name: 'com_org_inst_name'
                    },
                    {
                        data: 'dealer_type',
                        name: 'dealer_type'
                    },
                    {
                        data: 'contact_person_phone',
                        name: 'contact_person_phone'
                    },
                    {
                        data: 'contact_person_name',
                        name: 'contact_person_name'
                    }

                ]
            });
        });
        /* End: Datatable */
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/parent_due_balance/index.blade.php ENDPATH**/ ?>