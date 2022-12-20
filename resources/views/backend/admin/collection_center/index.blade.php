@php
$page_heading = 'Collection Center List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
    <style>
        .box:not(:last-child) {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .box .box_heading {
            text-transform: capitalize;
            font-size: 18px;
            font-weight: 600;
            color: #888;
            position: relative;
        }

        .box .box_heading::first-letter {
            font-size: 22px;
            color: #007bff;
        }

        .box .box_heading::after {
            content: "";
            position: absolute;
            width: 11px;
            height: 2px;
            background: #007bff;
            left: 0;
            top: 90%;
        }

        .box .logo {
            width: 100%;
            height: 50px;
            object-fit: contain;
            background: #c2c7d0;
        }

        .fa_icon {
            width: 15px;
            height: 15px;
            background: #ddd;
            text-align: center;
            font-size: 12px;
            display: inline-block;
            line-height: 11px;
            border-radius: 2px;
            padding: 2px;
        }
    </style>
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.admin.collection_center.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table id="collection_center_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="20%">Center Name</th>
                                    <th width="18%">Contact Person</th>
                                    <th width="10%">Phone</th>
                                    <th width="10%">Commission</th>
                                    <th width="17%">Address</th>
                                    <th width="8%">Status</th>
                                    <th width="10%">Action</th>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>

    <script>
        /* Dispaly details modal using fetch API (ajax) */

        $('body').on('click', '#view_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#view_modal').modal('show');
                })
        });

        /* End: Dispaly add modal using fetch API (ajax) */
    </script>


    <script>
        /* Collection center list on datatables using ajax request */
        $(function() {
            $('#collection_center_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500]
                ],
                'iDisplayLength': 10,
                ajax: '{{ route('admin.collection_center_datatable') }}',
                columns: [{
                        "title": "SL",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searching: false,
                        orderable: false,

                    },
                    {
                        data: 'center_name',
                        name: 'center_name'
                    },
                    {
                        data: 'contact_person_name',
                        name: 'contact_person_name'
                    },
                    {
                        data: 'contact_person_phone',
                        name: 'contact_person_phone'
                    },
                    {
                        data: 'commission_value',
                        name: 'commission_value',
                        searching: false,
                        orderable: false,
                    },
                    {
                        data: 'address',
                        name: 'address',
                        searching: false,
                        orderable: false,
                    },

                    {
                        data: 'status',
                        name: 'status'
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
        /* End: Collection center list on datatables using ajax request */
    </script>
@endpush
