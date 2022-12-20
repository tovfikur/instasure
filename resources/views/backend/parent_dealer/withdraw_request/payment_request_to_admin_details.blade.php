@extends('backend.layouts.master')
@section('title', ' Payment Request to Admin Details')
@push('css')
    <style>
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

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        Payment Request to Admin Details
                    </h5>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Widgets content -->
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $payment_request_to_admin->requests_id }}</h3>
                                <p>Requests ID</p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-md-4">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>
                                    {{ $payment_request_to_admin->grand_total }}
                                    {{ config('settings.currency') }}
                                </h3>
                                <p>
                                    Total Amount
                                </p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->
                    <div class="col-md-4">

                        <div class="small-box bg-warning    ">
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
        <!-- /.row -->
        <!-- End: Widgets content -->
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card  card-secondary card-outline">
                    <div class="card-body">
                        @if (count($payment_request_to_admin->payment_request_to_admin_details))
                            <div class="card-deck">
                                <!-- Loop this card -->
                                @foreach ($payment_request_to_admin->payment_request_to_admin_details as $request_to_admin)
                                    @foreach ($request_to_admin->claim_payment_requests->claim_payment_request_details as $request_details)
                                        <div class="card bg-info card-columns">

                                            <div class="card-body ">
                                                <!-- Customer imformations -->
                                                <h3 class="card-title">
                                                    Customer imformations
                                                </h3>
                                                <hr>
                                                <ul>
                                                    <li>
                                                        <strong>Name: </strong>
                                                        {{ $request_details->device_claims->user->name }}
                                                    </li>
                                                    <li>
                                                        <strong>Phone: </strong>
                                                        {{ $request_details->device_claims->user->phone }}
                                                    </li>
                                                    <li>
                                                        <strong>Email: </strong>
                                                        {{ $request_details->device_claims->user->email }}
                                                    </li>
                                                </ul>
                                                <!-- Emd Customer imformations -->
                                                <!-- Claim details -->
                                                <h3 class="card-title">
                                                    Claim details
                                                </h3>
                                                <hr>
                                                <ul>
                                                    <li>
                                                        <strong>Claim ID: </strong>
                                                        {{ $request_details->device_claims->claim_id }}

                                                    </li>
                                                    <li>
                                                        <strong>Device Value: </strong>
                                                        {{ $request_details->device_claims->device_value }}
                                                        {{ config('settings.currency') }}
                                                    </li>
                                                    <li>
                                                        <strong>Provider will pay: </strong>
                                                        {{ $request_details->device_claims->amount_will_pay_ins_provider }}
                                                        {{ config('settings.currency') }}
                                                    </li>
                                                    <li>
                                                        <strong>Claimed On: </strong>
                                                        {{ $request_details->device_claims->claim_on }}
                                                    </li>
                                                </ul>
                                                <!-- Emd Claim details -->
                                                <h5 class="card-title">Parts Details</h5>
                                                <hr />

                                                <!-- Parts details -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th scope="col">#</th>
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
                                                                    <td>{{ $parts->parts_price }}</td>
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
                                                <small class="text-light">
                                                    <em>
                                                        <strong>Claimed At: </strong>

                                                        {{ dateFormat($request_details->device_claims->created_at) }}
                                                    </em>
                                                </small>
                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
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
