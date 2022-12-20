@php
$page_heading = 'Payment Request To Admin Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <style>
        ul {
            list-style: none;
        }

        @media (min-width: 768px) {
            .card-deck .card {
                flex: 1 1 45%;
            }
        }

        @media (max-width: 768px) {
            .card-deck .card {
                flex: 1 1 95%;
            }
        }

    </style>
@endpush
@section('content')
    @includeIf('backend.admin.payment_request_to_admin.breadcrumb', ['page_heading' => $page_heading])
    <!-- Widgets content -->
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $payment_request_to_admin->requests_id }}</h3>
                                <p>Payment Request ID</p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-md-3">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>
                                    {{ $payment_request_to_admin->grand_total }}
                                    {{ config('settings.currency') }}
                                </h3>
                                <p>
                                    Requested Amount
                                </p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->


                    <div class="col-md-3">

                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{ $settlement_amount }}
                                    {{ config('settings.currency') }}
                                </h3>
                                <p>
                                    Final Amount
                                </p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->


                    <div class="col-md-2">
                        <div class="small-box @if (strtolower($payment_request_to_admin->status) != 'paid') bg-danger @else bg-success @endif ">
                            <div class="inner">
                                <h3>{{ ucwords($payment_request_to_admin->status) }}</h3>
                                <p>Status</p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.card -->
        <!-- End: Widgets content -->
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card  card-secondary card-outline">
                    <div class="card-body">
                        @if (count($payment_request_to_admin->payment_request_to_admin_details))
                            <div class="card-deck">
                                <!-- Loop this card -->
                                @php
                                    $loop_index = 0;
                                @endphp
                                @foreach ($payment_request_to_admin->payment_request_to_admin_details as $request_to_admin)
                                    @foreach ($request_to_admin->claim_payment_requests->claim_payment_request_details as $request_details)
                                        <div
                                            class="card @if ($loop_index % 2 == 0) bg-secondary @else bg-dark @endif card-columns">

                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- Customer imformations -->
                                                        <h3 class="card-title">
                                                            Basic imformations
                                                        </h3>
                                                        <hr>
                                                        <ul class="list-group">
                                                            <li>
                                                                <strong>Customer Name: </strong>
                                                                {{ $request_details->device_claims->user->name }}
                                                            </li>
                                                            <li>
                                                                <strong>Customer Phone: </strong>
                                                                {{ $request_details->device_claims->user->phone }}
                                                            </li>
                                                            <li>
                                                                <strong>Customer Email: </strong>
                                                                {{ $request_details->device_claims->user->email }}
                                                            </li>
                                                            <li>
                                                                <strong>Claimed At: </strong>
                                                                {{ dateFormat($request_details->device_claims->created_at) }}
                                                            </li>
                                                        </ul>
                                                        <!-- Emd Customer imformations -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <!-- Claim details -->
                                                        <h3 class="card-title">
                                                            Claim details
                                                        </h3>
                                                        <hr>
                                                        <ul class="list-group">
                                                            <li>
                                                                <strong>Claim ID: </strong>
                                                                {{ $request_details->device_claims->claim_id }}

                                                            </li>
                                                            <li>
                                                                <strong>Device Price: </strong>
                                                                {{ $request_details->device_claims->device_value }}
                                                                {{ config('settings.currency') }}
                                                            </li>
                                                            <li>
                                                                <strong>Provider will pay: </strong>
                                                                {{ $request_details->device_claims->amount_will_pay_ins_provider }}
                                                                {{ config('settings.currency') }}
                                                            </li>
                                                            @if ($request_details->device_claims->settlement_amount != 0 && $request_details->device_claims->settlement_amount != $request_details->device_claims->amount_will_pay_ins_provider)
                                                                <li>
                                                                    <strong>Settlement amount: </strong>
                                                                    <span class="badge badge-primary">
                                                                        {{ $request_details->device_claims->settlement_amount }}
                                                                        {{ config('settings.currency') }}
                                                                    </span>
                                                                </li>
                                                            @endif

                                                            @if ($request_details->device_claims->status_note)
                                                                <li>
                                                                    <strong>Settlement note: </strong>
                                                                    <span class="badge badge-primary">
                                                                        {{ $request_details->device_claims->status_note }}
                                                                        {{ config('settings.currency') }}
                                                                    </span>
                                                                </li>
                                                            @endif

                                                            <li>
                                                                <strong>Claimed On: </strong>
                                                                {{ $request_details->device_claims->claim_on }}
                                                            </li>
                                                            <li>
                                                                <strong>Payment Status: </strong>
                                                                {{ $request_details->device_claims->status }}

                                                            </li>
                                                        </ul>
                                                        <!-- Emd Claim details -->
                                                    </div>
                                                </div>


                                                <h6 class="text-center bg-info p-1 mt-2">Parts Details</h6>

                                                <!-- Parts details -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">SL</th>
                                                                <th scope="col">Parts name</th>
                                                                <th scope="col">Parts Price </th>
                                                                <th scope="col">Identity Number</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @php
                                                                $serial = 1;
                                                            @endphp
                                                            @foreach ($request_details->device_claims->device_claimed_parts as $parts)
                                                                <tr>
                                                                    <th scope="row">{{ $serial++ }}</th>
                                                                    <td>{{ $parts->parts_name }}</td>
                                                                    <td>
                                                                        {{ $parts->parts_price }}
                                                                        {{ config('settings.currency') }}
                                                                    </td>
                                                                    <td>{{ $parts->parts_identity_number }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- End Parts details -->
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">

                                                @if ($payment_request_to_admin->status == 'paid')
                                                    <button type="button"
                                                        class="btn btn-success pull-right">Approved</button>
                                                @else
                                                    <div class="btn-toolbar pull-right"
                                                        id="btn_actions_{{ $request_details->device_claims->id }}">


                                                        @if (!$request_details->device_claims->settlement_amount)
                                                            <div class="btn-group mr-2">
                                                                <button type="button" class="btn btn-warning btn_settlement"
                                                                    data-url="{{ route('admin.partial_payment_by_admin_with_settlement_form', $request_details->device_claims->id) }}">Settlement</button>
                                                            </div>
                                                            <div class="btn-group mr-2">
                                                                @if (strtolower($request_details->device_claims->status) != 'rejected')
                                                                    <button type="button" class="btn btn-danger btn_reject"
                                                                        data-prta_id="{{ $payment_request_to_admin->id }}"
                                                                        data-cpr_id="{{ $request_details->claim_payment_requests_id }}"
                                                                        data-id="{{ $request_details->device_claims->id }}"
                                                                        data-url="{{ route('admin.reject_individual_claim', $payment_request_to_admin->id) }}">Reject</button>
                                                                @endif

                                                            </div>
                                                            <div class="btn-group mr-2">
                                                                <button
                                                                    data-id="{{ $request_details->device_claims->id }}"
                                                                    data-settlement_amount="{{ $request_details->device_claims->amount_will_pay_ins_provider }}"
                                                                    data-url="{{ route('admin.partial_payment_by_admin', $request_details->device_claims->id) }}"
                                                                    type="button"
                                                                    class="btn btn-primary btn_partial_approve">Approve</button>
                                                            </div>
                                                        @else
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-success">Approved</button>

                                                            </div>
                                                        @endif

                                                    </div>
                                                @endif

                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
                                        @php
                                            ++$loop_index;
                                        @endphp
                                    @endforeach
                                @endforeach
                                <!-- /.card -->
                            </div>
                            <!-- /.card-deck -->
                        @else
                            <div class="alert alert-warning">
                                <strong>OPS!</strong> No Data Found
                            </div>
                        @endif
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

    <!-- End Main content -->
@stop
@push('js')
    <!-- Scripts on page -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- End: Scripts on page -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        /* Remove edit modal from dom when it hides from window */

        $('body').on('hide.bs.modal', '#settlement_modal', function(event) {
            $(this).remove();
        });

        /* End: Remove edit modal from dom when it hides from window */
    </script>


    <script>
        /*  Dispaly claim reject  modal using fetch API (ajax) */
        $('body').on('click', '.btn_reject', function(event) {

            event.preventDefault();
            let url = $(this).data('url');
            let device_claim_id = $(this).data('id');
            let claim_payment_request_id = $(this).data('cpr_id');


            /* Sure alert */
            Swal.fire({
                title: 'Are you sure?',
                text: "You are going to reject payment with service center for this device claims",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {

                if (result.isConfirmed) {
                    /* Ajax post request */
                    $.post(url, {
                        device_claim_id,
                        claim_payment_request_id

                    }, function(result) {


                        if (result.success == true) {

                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */
                            $('#btn_actions_' + device_claim_id + ' .btn_reject').remove();
                            $('#btn_actions_' + device_claim_id + ' .btn_partial_approve').remove();


                        } else {

                            toastr.error(result.message);
                        }

                    }, 'json');

                    /* End: Ajax post request */
                }
            })
            /* End: Sure alert */


        });

        /* End: Dispaly edit modal using fetch API (ajax) */
    </script>

    <script>
        /* Ajax post request for updating */
        $('body').on('submit', '#edit_form', function(event) {
            event.preventDefault();
            let url = $(this).attr('action');
            let device_claim_id = $(this).data('device_claim_id');
            let form_data = $(this).serialize();

            $.ajax({
                url: url,
                method: 'post',
                data: form_data,
                dataType: 'json',
                success: function(result) {

                    if (result.success == true) {
                        /* Toast alert on success */
                        toastr.success(result.message);
                        /* End: Toast alert on success */
                        $('#btn_actions_' + device_claim_id + ' .btn_settlement').remove();
                        $('#btn_actions_' + device_claim_id + ' .btn_partial_approve').removeClass(
                            'btn-danger btn_partial_approve').addClass('btn-success').removeData(
                            'url');

                    } else {
                        toastr.error(result.message);
                    }
                    /* Hide create modal form */
                    $("#settlement_modal").modal('hide');

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

    <script>
        /*  Dispaly edit modal using fetch API (ajax) */
        $('body').on('click', '.btn_settlement', function(event) {

            event.preventDefault();
            let url = $(this).data('url');

            /* Sure alert */
            Swal.fire({
                title: 'Are you sure?',
                text: "You are going to make a settlement with service center for this device claims",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {

                if (result.isConfirmed) {
                    /* Ajax post request */
                    $.post(url, {

                    }, function(html) {
                        $('body').append(html);
                        $('#settlement_modal').modal('show');

                    }, 'html');

                    /* End: Ajax post request */
                }
            })
            /* End: Sure alert */


        });

        /* End: Dispaly edit modal using fetch API (ajax) */
    </script>

    <script>
        /* Partial payemnt by admin for individual device claims */
        $(document).on('click', '.btn_partial_approve', function(event) {
            let btn_partial_approve = $(this);
            let device_claim_id = $(this).data("id");
            let settlement_amount = $(this).data("settlement_amount");
            let url = $(this).data("url");

            /* Sure alert */
            Swal.fire({
                title: 'Are you sure?',
                text: "You are going to partially approve to this device claims",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {

                if (result.isConfirmed) {
                    /* Ajax post request */
                    $.post(url, {
                        settlement_amount: settlement_amount,
                    }, function(result) {
                        if (result.success == true) {
                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */
                            btn_partial_approve.html('Approved')
                                .removeClass('btn-danger btn_partial_approve')
                                .addClass('btn-success')
                                .removeData('url');
                            $('#btn_actions_' + device_claim_id + ' .btn_settlement').remove();
                            $('#btn_actions_' + device_claim_id + ' .btn_reject').remove();

                        } else {
                            toastr.error(result.message);
                        }

                    }, 'json');

                    /* End: Ajax post request */
                }
            })
            /* End: Sure alert */

        });
        /* End: Partial payemnt by admin for individual device claims */
    </script>
@endpush
