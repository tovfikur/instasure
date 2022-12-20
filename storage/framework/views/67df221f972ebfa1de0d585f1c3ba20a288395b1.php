<?php
$page_heading = 'Users';
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
    <?php if ($__env->exists('backend.admin.users.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.users.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                                    <th>User type</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
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
    <!-- End: Scripts on page -->
    <script>
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>
    <script>
        /* Users password change form submit using ajax call */
        $('body').on('submit', '#change_password_form', function(event) {
            event.preventDefault();
            const url = $(this).attr('action');
            const form_data = $(this).serialize();
            var csrfToken = $("input[name='_token']").val();

            fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                body: JSON.stringify({
                    'password': $('body #password').val()
                })
            }).then(response => response.json()).then(json => {

                if (json.success) {
                    toastr.success(json.message);
                } else {
                    toastr.error(json.message);
                }
            });
        })
        /* Users password change form submit using ajax call */

        /* Users password change on modal using ajax call */
        $('body').on('click', '.btn_change_password', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            fetch(url).then(response => response.text()).then(html => {
                $('body').append(html);
                $('#password_change_modal').modal('show');
            });
        })
        /* Users password change on modal using ajax call */
    </script>
    <script>
        /* Users details on modal using ajax call */
        $('body').on('click', '.btn_view', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            fetch(url).then(response => response.text()).then(html => {

                $('body').append(html);
                $('#view_details_modal').modal('show');
            });
        })
        /* Users details on modal using ajax call */
    </script>

    <script>
        /* Users list using ajax call */
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
                ajax: "<?php echo e(route('admin.users_ajax')); ?>",
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
                        data: 'user_type',
                        name: 'user_type'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'banned',
                        name: 'banned'
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
        /* End: Users list using ajax call */
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/users/index.blade.php ENDPATH**/ ?>