@extends('backend.layouts.master')
@section('title', 'Blog Categories')
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
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        Blog Categories
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mt-1">
                        <li class="breadcrumb-item">
                            <a id="add_new" href="{{ route('admin.blog-categories.create') }}"
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Add New
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                All
                            </a>
                        </li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="blog_categories_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">SL</th>
                                    <th width="25%">Name</th>
                                    <th width="20%">Slug</th>
                                    <th width="15%">Status</th>
                                    <th width="15%">Date</th>
                                    <th width="15%">Actions</th>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('keyup', '#name', function() {
            $('#slug').val($('#name').val());
        });

        /* Remove modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '.modal_window', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>
    <!-- End: Scripts on page -->

    <!-- Delete script -->
    <script>
        $('body').on('click', '#blog_category_delete_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this delete action",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((data) => {
                    if (!data) throw null;
                    return fetch(url);

                }).then(results => {
                    return results.json();
                }).then(json => {
                    toastr.success(json.message);
                    $('#blog_categories_table').DataTable().ajax.reload(null,
                        true);
                }).catch(err => {

                    toastr.error("Delete Faild");
                });

        });
    </script>
    <!-- End: Delete script -->
    <!-- Edit script -->
    <script>
        /* Dispaly add modal using fetch API (ajax) */

        $('body').on('click', '#blog_category_edit_btn', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#blog_category_edit_modal').modal('show');
                })
        });

        /* End: Dispaly add modal using fetch API (ajax) */

        /* Ajax post request */
        $('body').on('submit', '#blog_category_edit_form', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            const form_data = {};
            form_data.name = $('#name').val();
            form_data.slug = $('#slug').val();
            form_data.status = $('#status').val();

            if (Object.keys(form_data).length == 3) {

                $.ajax({
                    url: url,
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(result) {

                        if (result.status == 'success') {
                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */

                        } else {
                            toastr.error(result.message);
                        }
                        /* Hide create modal form */
                        $("#blog_category_edit_modal").modal('hide');

                        /* Reload datatables */
                        $('#blog_categories_table').DataTable().ajax.reload(null,
                            true);
                        /* End: Reload datatables */
                    },
                    error: function(error) {

                        const err = error.responseJSON.errors;

                        if (err.slug) {
                            $('#slug_help_block').removeClass('d-none');
                        } else {
                            $('#slug_help_block').addClass('d-none');
                        }
                        if (err.name) {
                            $('#name_help_block').removeClass('d-none');
                        } else {
                            $('#name_help_block').addClass('d-none');
                        }

                    }
                });

                /* End: Ajax post request */
            }

        });
    </script>
    <!-- End: Edit script -->
    <!-- Creat new script -->
    <script>
        /* Dispaly add modal using fetch API (ajax) */

        $('body').on('click', '#add_new', function(event) {
            event.preventDefault();

            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#blog_category_create_modal').modal('show');
                })
        });

        /* End: Dispaly add modal using fetch API (ajax) */


        /* Ajax post request */
        $('body').on('submit', '#form_create', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            const form_data = {};
            form_data.name = $('#name').val();
            form_data.slug = $('#slug').val();
            form_data.status = $('#status').val();

            if (Object.keys(form_data).length == 3) {

                $.ajax({
                    url: url,
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(result) {

                        if (result.status == 'success') {
                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */

                        } else {
                            toastr.error(result.message);
                        }
                        /* Hide create modal form */
                        $("#blog_category_create_modal").modal('hide');

                        /* Reload datatables */
                        $('#blog_categories_table').DataTable().ajax.reload(null,
                            true);
                        /* End: Reload datatables */
                    },
                    error: function(error) {
                        const err = error.responseJSON.errors;

                        if (err.slug) {
                            $('#slug_help_block').removeClass('d-none');
                        } else {
                            $('#slug_help_block').addClass('d-none');
                        }
                        if (err.name) {
                            $('#name_help_block').removeClass('d-none');
                        } else {
                            $('#name_help_block').addClass('d-none');
                        }

                    }
                });

                /* End: Ajax post request */
            }

        });
    </script>
    <!-- End: Creat new script -->
    <script>
        /* Display payment request and its details from service center on datatables using ajax request */
        $(function() {
            $('#blog_categories_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500, "All"]
                ],
                'iDisplayLength': 10,
                ajax: '{{ route('admin.blog-categories.ajax') }}',
                columns: [{
                        "title": "SL",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searching: false,
                        orderable: false,

                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
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
            });
        });
        /* End: Display payment request and its details from service center on datatables using ajax request */
    </script>
@endpush
