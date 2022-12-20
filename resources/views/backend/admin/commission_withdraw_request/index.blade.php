@php
$page_heading = 'Commission Withdraw Request By Parent';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
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
@endpush
@section('content')

    @includeIf('backend.admin.commission_withdraw_request.breadcrumb', [
        'page_heading' => $page_heading,
    ])

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Parent</th>
                                    <th width="10%">Amount</th>
                                    <th width="13%">Type</th>
                                    <th width="15%">Provider</th>
                                    <th width="15%">Account number</th>
                                    <th width="10%">Status</th>
                                    <th width="11%">Date</th>
                                    <th width="8%">Action</th>
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


@stop
@push('js')
    <!-- Scripts on page -->
    <script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>

    <script>
        /* Users password change form submit using ajax call */
        $('body').on('submit', '#edit_form', function(event) {
            event.preventDefault();
            const url = $(this).attr('action');
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
                    'status': $('body #status').val(),
                    'message': $('body #message').val()
                })
            }).then(response => response.json()).then(json => {

                if (json.success) {

                    $('document .modal').modal('hide');
                    toastr.success(json.message);
                    /* Hide create modal form */
                    $("#edit_modal").modal('hide');

                    /* Reload datatables */
                    $('#datatable').DataTable().ajax.reload(null, true);
                    /* End: Reload datatables */

                } else {
                    toastr.error(json.message);
                }
            });
        })
        /* Users password change form submit using ajax call */

        /* Users password change on modal using ajax call */
        $('body').on('click', '.btn_edit', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');

            fetch(url).then(response => response.text()).then(html => {
                $('body').append(html);
                $('#edit_modal').modal('show');
            });
        })
        /* Users password change on modal using ajax call */
    </script>

    <script>
        /* Commission withdraw request using ajax call */
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
                ajax: '{{ route('admin.commission_withdraw_request_ajax') }}',
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
                        data: 'parent_id',
                        name: 'parent_id'
                    }, {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'provider_name',
                        name: 'provider_name'
                    },
                    {
                        data: 'account_number',
                        name: 'account_number',
                        orderable: false,
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
        /* End: Commission withdraw request using ajax call */
    </script>
@endpush
