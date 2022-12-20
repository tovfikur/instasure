@extends('backend.layouts.master')
@section('title', 'Parts List')
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
    @includeIf('backend.admin.parts.breadcrumb', ['page_heading' => 'Parts List'])

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="parts_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Parts Name</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Dealer</th>
                                    <th>Added On</th>
                                    <th>Is Used?</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-->
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

        $('body').on('hide.bs.modal', '.modal_window', function(event) {
            $(this).remove();
        });

        /* End: Remove modal from dom when it hides from window */
    </script>

    <!-- Delete individual parts script -->
    <script>
        $('body').on('click', '#parts_delete_btn', function(event) {
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
                    $('#parts_table').DataTable().ajax.reload(null, true);
                }).catch(err => {
                    toastr.error("Delete Faild");
                });

        });
    </script>
    <!-- End: Delete individual parts script -->
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

        /* Ajax post request for updating */
        $('body').on('submit', '#parts_edit_form', function(event) {
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
    </script>
    <!-- End: Edit script -->
    <script>
        /* Parts list on datatables using ajax request */
        $(function() {
            $('#parts_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                pagingType: "input",
                aLengthMenu: [
                    [5, 10, 25, 50, 100, 200, 400, 500, -1],
                    [5, 10, 25, 50, 100, 200, 400, 500]
                ],
                'iDisplayLength': 10,
                ajax: '{{ route('admin.parts_list_ajax') }}',
                columns: [{
                        "title": "SL",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        searching: false,
                        orderable: false,

                    },
                    {
                        data: 'parts_name',
                        name: 'parts_name'
                    },
                    {
                        data: 'parts_price',
                        name: 'parts_price'
                    },
                    {
                        data: 'brand_id',
                        name: 'brand_id'
                    },
                    {
                        data: 'model_id',
                        name: 'model_id'
                    },
                    {
                        data: 'dealer',
                        name: 'dealer'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'is_used',
                        name: 'is_used'
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
        /* End: Parts list on datatables using ajax request */
    </script>
    <script>
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.brands.status-update') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                console.log(data)
                if (data == 1) {
                    toastr.success('success', 'Brand Published updated successfully');
                } else {
                    toastr.error('danger', 'Something went wrong');
                }
            });
        }
    </script>
    <script>
        $('body').on('change', '#brand_id', function(event) {
            const brand_id = $('#brand_id').val();
            var csrfToken = $("input[name='_token']").val();

            return get_brand_wise_model("{{ route('admin.parts.get_brand_wise_model_ajax') }}", {
                    brand_id: brand_id
                }, csrfToken)
                .then(data => {
                    $('#brand_wise_model_list').children().remove();
                    $('#save').fadeIn().removeClass('d-none');
                    document.body.style.marginBottom = "0px";
                    $('#brand_wise_model_list').append(data);

                });
        });


        async function get_brand_wise_model(url = '', data = {}, csrfToken = null) {
            const response = await fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: JSON.stringify(data)

            });
            return response.text();
        };
    </script>
@endpush
