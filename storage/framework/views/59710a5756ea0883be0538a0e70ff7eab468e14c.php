<?php
$page_heading = 'Service Charge Withdraw Request';
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

    <?php if ($__env->exists('backend.admin.payment_request_to_admin.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.payment_request_to_admin.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Claim Request to payment -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="claim_request_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>SL</th>
                                    <th>Request ID</th>
                                    <th>Claimed Amount</th>
                                    <th>Payable Amount</th>
                                    <th>
                                        <span class="text-secondary" style="font-size: 10px">
                                            Service Center Payment Request

                                        </span>
                                        <br>
                                        Claime Count
                                    </th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Message</th>
                                    <th>Actions</th>
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



    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('parentDealer.device-insurance.withdraw-request')); ?>" method="get">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>x</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="date_from">Date From</label>
                            <input type="date" name="date_from" id="date_from" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_to">Date To</label>
                            <input type="date" name="date_to" id="date_to" class="form-control"
                                value="<?php echo e(date('Y-m-d')); ?>">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="claim_id">Claim ID</label>
                            <input type="text" name="claim_id" id="claim_id" placeholder="Search by claim ID"
                                autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="display_length">Showed</label>
                            <select name="display_length" id="display_length" class="form-control">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="400">400</option>
                                <option value="500">500</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right m-2">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <!-- Scripts on page -->
    <script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End: Scripts on page -->

    <script>
        /* Display payment request and its details from service center on datatables using ajax request */
        $(function() {
            $('#claim_request_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500]
                ],
                'iDisplayLength': 10,
                ajax: '<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer_ajax', $status)); ?>',
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
                        data: 'requests_id',
                        name: 'requests_id'
                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total'
                    },
                    {
                        data: 'payable_amount',
                        name: 'payable_amount'
                    },
                    {
                        data: 'count_claimed_request',
                        name: 'count_claimed_request'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searching: false,
                        orderable: false,
                        class: 'text-center'
                    }
                ]
            }).on('draw', function() {
                $('input[name="checkbox_row"]').each(function() {
                    this.checked = false;
                });
                $('#parent_checkbox').prop('checked', false);
            });
        });
        /* End: Display payment request and its details from service center on datatables using ajax request */
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* Dispaly edit modal using fetch API (ajax) */

            $('body').on('click', '.edit', function(event) {

                event.preventDefault();
                let id = $(this).data('id');
                let url = $(this).attr('href');

                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        $('body').append(html);
                        $('#changeStatusModal').modal('show');
                    })
            });

            /* End: Dispaly edit modal using fetch API (ajax) */

            /* Remove edit modal from dom when it hides from window */

            $('body').on('hide.bs.modal', '#changeStatusModal', function(event) {
                $(this).remove();
            });

            /* End: Remove edit modal from dom when it hides from window */

            /* Select/check all row  if parent checkbox selected */

            $(document).on('change', '#parent_checkbox', function(event) {
                if (this.checked) {
                    $('input[name="checkbox_row"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="checkbox_row"]').each(function() {
                        this.checked = false;
                    });
                }
            });

            /* End: Select/check all row if parent checkbox selected */

            /* Select/check parent checkbox if all rox  selected */

            $(document.body).on('change', 'input[name="checkbox_row"]', function(event) {

                if ($('input[name="checkbox_row"]').length == $('input[name="checkbox_row"]:checked')
                    .length) {
                    $('#parent_checkbox').prop('checked', true);

                } else {
                    $('#parent_checkbox').prop('checked', false);
                }
            });

            /* End: Select/check parent checkbox if all rox  selected */

            /* Uncheck parent checkbox when DataTable pagination changed to another page  */
            $(document).on('click', '.pagination', function(event) {
                $('#parent_checkbox').prop('checked', false);
            });
            /* End: Uncheck parent checkbox when DataTable pagination changed to another page  */

            /* Payment request to admin by parent dealer */
            $(document).on('click', '#btn_payment_request', function(event) {
                const request_ids = [];
                $('input[name="checkbox_row"]:checked').each(function() {
                    request_ids.push($(this).data('id'));
                });
                /* Sweet alert confirmation if checked any table row */
                if (request_ids.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You are going to request payemnt from admin.  You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, proceed'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            /* Ajax post request */
                            $.post("<?php echo e(route('parentDealer.device_insurance_withdraw_request_to_admin_using_ajax_by_parent_dealer')); ?>", {
                                request_ids: request_ids
                            }, function(result) {
                                if (result.status == 200) {
                                    /* Toast alert on success */
                                    toastr.success(result.message);
                                    /* End: Toast alert on success */

                                } else {
                                    toastr.error(result.message);
                                }
                                /* Reload datatables */
                                $('#claim_request_table').DataTable().ajax.reload(null,
                                    true);
                                /* End: Reload datatables */
                            }, 'json');

                            /* End: Ajax post request */
                        }
                    })
                } else {
                    toastr.error("Please check any rows from table");
                }
                /* End: Sweet alert confirmation if checked any table row */
            });
            /* End: Payment request to admin by parent dealer */


        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/payment_request_to_admin/index.blade.php ENDPATH**/ ?>