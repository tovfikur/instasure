@php
$page_heading = 'Commission Withdraw Request to Admin';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush
@section('content')

    <!-- Breadcrumb -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right mt-1">

                        @if ($due_amount)
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#make_commission_withdraw_request_modal" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Make Withdraw Request
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a href="{{ route('parentDealer.commission_withdraw_request') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                All
                            </a>
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- End:Breadcrumb -->

    <section class="content">
        <div class="card card-info ">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $due_amount . ' ' . config('settings.currency') }}</h3>
                                <p>Available For Withdraw</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-12 col-md">
                        <div class="small-box  bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ $pending_amount . ' ' . config('settings.currency') }}
                                </h3>
                                <p>Pending To Admin </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-eur"></i>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-12 col-md">

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{ $paid_amount . ' ' . config('settings.currency') }}
                                </h3>
                                <p>Paid By Admin </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-gbp "></i>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->


                    <div class="col-sm-12 col-md">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{ $received_amount . ' ' . config('settings.currency') }}
                                </h3>
                                <p>Received Amount </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-jpy "></i>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-12 col-md">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>
                                    {{ $total_amount . ' ' . config('settings.currency') }}
                                </h3>
                                <p>Total Amount </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-rub "></i>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Amount</th>
                                    <th width="13%">Type</th>
                                    <th width="18%">Provider</th>
                                    <th width="19%">Account number</th>
                                    <th width="10%">Status</th>
                                    <th width="12%">Date</th>
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

    <!-- Modal -->
    <div class="modal fade" id="make_commission_withdraw_request_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make A Withdraw Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('parentDealer.commission_withdraw_request_store') }}" method="post">
                    @csrf
                    <div class="row" style="padding: 10px 0px 0px 150px;">
                        <div class="col-lg-6 col-6">
                            <div class="small-box border-info" style="border: 1px solid #17a2b8;">
                                <div class="inner text-center">
                                    @if ($dealer->dealer_balance > 0)
                                        <h4>
                                            {{ $dealer->dealer_balance }}
                                            {{ config('settings.currency') }}
                                        </h4>
                                    @else
                                        <h4>Insufficient Amount</h4>
                                    @endif
                                    <p>Available For Withdraw</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="amount" title="Required">
                                    Amount
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="number" name="amount" class="form-control"
                                    max="{{ $dealer->dealer_balance }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleFormControlInput1" title="Required">
                                    Payment Type
                                    <sup class="text-danger">*</sup>
                                </label>
                                <select class="form-control" name="type" id="type" onchange="getInfos()" required>
                                    <option selected disabled>Select</option>
                                    <option value="bank_info">Bank</option>
                                    <option value="mob_banking">Mobile Banking</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="bank_input">

                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
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
        /* Display payment request and its details from service center on datatables using ajax request */
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
                ajax: '{{ route('parentDealer.child_commission_withdraw_request_ajax', ['parent_to_admin']) }}',
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
        /* End: Display payment request and its details from service center on datatables using ajax request */
    </script>
    <script>
        function getInfos() {
            $('#bank_input').html(null);
            var type = $('#type').val();
            if (type == 'bank_info') {
                $('#bank_input').append(`
          <div class="form-group col-6">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control" >
                            </div>
                            <div class="form-group col-6">
                                <label for="acc_holder_name">Account Holder Name</label>
                                <input type="text" name="acc_holder_name" class="form-control" >
                            </div>
                            <div class="form-group col-6">
                                <label for="account_number">Account Number</label>
                                <input type="text" name="account_number" class="form-control" >
                            </div>
                            <div class="form-group col-6">
                                <label for="branch_name">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control" >
                            </div>
                            <div class="form-group col-6">
                                <label for="routing_number">Routing Number</label>
                                <input type="text" name="routing_number" class="form-control" >
                            </div>
                `)
            }
            if (type == 'mob_banking') {
                $('#bank_input').append(`
  <div class="form-group col-6">
                                <label for="provider_name">Provider Name</label>
                                <select name="provider_name" class="form-control">
                                    <option value="bKash">bKash</option>
                                    <option value="Rocket">Rocket</option>
                                <option value="Nagad">Nagad</option>
                                    <option value="Ukash">Ukash</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Phone Number</label>
                                <input type="number" name="phone" class="form-control" >
                            </div>
                `)
            }
        }
    </script>
@endpush
