@php
$page_heading = 'Claim Payment Request Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <style>
        ul {
            list-style: none;
        }
    </style>
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

                        <li class="breadcrumb-item">
                            <a href="{{ route('serviceCenter.policy-search') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Make Claim
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('serviceCenter.insurance-claim.claimPaymentRequestList') }}"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                Payment Request List
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
    <!-- /.content-header -->

    <!-- End: Breadcrumb -->


    <!-- Main content -->
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $claimPaymentRequest->requestId }}</h3>
                                <p>Payment Request ID</p>
                            </div>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-md-3">

                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ $claimPaymentRequest->total_amount }}
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

                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{ $final_settlement_amount }}
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
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ ucwords($claimPaymentRequest->status) }}</h3>
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

        <!-- general form elements -->
        <div class="card card-secondary card-outline">
            <div class="card-body">
                <div class="card-deck">
                    <!-- Loop this card -->
                    @foreach ($claim_payment_request_details as $key => $request_details)
                        <div class="card  @if ($key % 2 == 0) bg-secondary @else bg-dark @endif">

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6">
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
                                                <strong>Policy No: </strong>
                                                {{ $request_details->device_claims->device_insurance->policy_number }}
                                            </li>
                                            @php
                                                $device_info = json_decode($request_details->device_claims->device_insurance->device_info);
                                            @endphp
                                            <li>
                                                <strong>Device Name: </strong>
                                                {{ $device_info->model_name }}
                                            </li>
                                            <li>
                                                <strong>Device Price: </strong>
                                                {{ $device_info->device_price }}
                                                {{ config('settings.currency') }}
                                            </li>
                                            <li>
                                                <strong>IMEI No: </strong>
                                                {{ $device_info->imei_one }}
                                            </li>
                                        </ul>
                                        <!-- Emd Customer imformations -->
                                    </div>
                                    <div class="col-md-6">
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
                                                <strong>Claimed Amount: </strong>
                                                {{ $request_details->device_claims->total_amount }}
                                                {{ config('settings.currency') }}

                                            </li>
                                            <li>
                                                <strong>Customer Pay: </strong>
                                                {{ $request_details->device_claims->user_will_pay }}
                                                {{ config('settings.currency') }}

                                            </li>
                                            <li>
                                                <strong>Provider pay: </strong>
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
                                                <strong>Claim Payment Status by Admin: </strong>
                                                @php
                                                    $status = strtolower($request_details->device_claims->payment_status_admin);

                                                @endphp
                                                <span
                                                    class="badge @if ($status == 'rejected' || $status == 'pending') badge-danger @else badge-success @endif">
                                                    {{ ucfirst($status) }}
                                                </span>
                                            </li>

                                            <li>
                                                <strong>Customer Payment Status: </strong>
                                                <span
                                                    class="badge @if (strtolower($request_details->device_claims->payment_status) == 'paid') badge-success @else badge-warning @endif">
                                                    {{ $request_details->device_claims->payment_status }}
                                                </span>
                                            </li>


                                        </ul>
                                        <!-- Emd Claim details -->
                                    </div>
                                    <div class="col-12">

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
                                                            <td>{{ $parts->parts_price }}
                                                                {{ config('settings.currency') }}</td>
                                                            <td>{{ $parts->parts_identity_number }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Parts details -->
                                    </div>
                                </div>


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
                    <!-- /.card -->
                </div>
                <!-- /.card-deck -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

    <!-- End Main content -->
@stop
