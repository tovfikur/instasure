@php
$page_heading = 'Service Charge Withdraw Request - Claim List';
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
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card  card-secondary card-outline">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr class="table-active">
                                    <th scope="col">SL</th>
                                    <th scope="col">Service center</th>
                                    <th scope="col">Claim ID</th>
                                    <th scope="col">Provider pay</th>
                                    <th scope="col">Settled amount</th>
                                    <th scope="col">Device price</th>
                                    <th scope="col">Claim Date</th>
                                    <th scope="col" class="Payment status">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($payment_request_to_admin)
                                    @foreach ($payment_request_to_admin->payment_request_to_admin_details as $payment_request_to_admin_details_single)
                                        @foreach ($payment_request_to_admin_details_single->claim_payment_requests->claim_payment_request_details as $claim_payment_request_details_single)
                                            @php
                                                $device_claim = $claim_payment_request_details_single->device_claims;
                                                $service_center = $payment_request_to_admin_details_single->claim_payment_requests->service_center->service_center_name;

                                                // dd();

                                            @endphp
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $service_center }}</td>
                                                <td>{{ $device_claim->claim_id }}</td>
                                                <td>
                                                    {{ $device_claim->amount_will_pay_ins_provider }}
                                                    {{ config('settings.currency') }}
                                                </td>
                                                <td>
                                                    {{ $device_claim->settlement_amount }}
                                                    {{ config('settings.currency') }}
                                                </td>
                                                <td>
                                                    {{ $device_claim->device_value }}
                                                    {{ config('settings.currency') }}
                                                </td>
                                                <td>
                                                    {{ date_format_custom($device_claim->created_at, 'd M, Y') }}
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge badge-{{ $device_claim->payment_status_admin == 'approved' ? 'success' : ($device_claim->payment_status_admin == 'rejected' ? 'danger' : 'warning') }}"
                                                        title="Payment Status - {{ ucfirst($device_claim->payment_status_admin) }}">
                                                        {{ ucfirst($device_claim->payment_status_admin) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="dropleft">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" x-placement="left-start"
                                                            x-out-of-boundaries=""
                                                            style="position: absolute; transform: translate3d(-245px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <a class="dropdown-item details_btn"
                                                                href="{{ route('admin.claimDetails', [$payment_request_to_admin, $device_claim]) }}">
                                                                <i class="fa fa-eye text-primary"></i> Claim Details
                                                            </a>
                                                            <a class="dropdown-item status_change_btn"
                                                                href="{{ route('admin.claimStatusChange', [$payment_request_to_admin, $device_claim]) }}"
                                                                id="edit" data-id="2">
                                                                <i class="fa fa-stream text-info"></i>
                                                                Change Status
                                                            </a>
                                                            @if ($device_claim->payment_status_admin == 'rejected')
                                                                <a class="dropdown-item status_change_btn"
                                                                    href="{{ route('admin.claimMakeSettlement', [$payment_request_to_admin, $device_claim]) }}"
                                                                    id="edit" data-id="2">
                                                                    <i class="fa fa-handshake-o text-success"></i>
                                                                    Make Settlement
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endisset
                            </tbody>
                            <!-- /tbody -->
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

        $('body').on('hide.bs.modal', '.modal', function(event) {
            $(this).remove();
        });

        /* End: Remove edit modal from dom when it hides from window */
    </script>

    <script>
        /* Dispaly edit modal using fetch API (ajax) */

        $('body').on('click', '.status_change_btn', function(event) {

            event.preventDefault();
            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#statusChangeModal').modal('show');
                })
        });

        /* End: Dispaly edit modal using fetch API (ajax) */
    </script>

    <script>
        /* Dispaly edit modal using fetch API (ajax) */

        $('body').on('click', '.details_btn', function(event) {

            event.preventDefault();
            let url = $(this).attr('href');

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    $('body').append(html);
                    $('#claimDetailsModal').modal('show');
                })
        });
    </script>
@endpush
