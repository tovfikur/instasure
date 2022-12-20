@extends('backend.layouts.master')
@section('title', 'Parent Dealer Device Inc Withdraw Request Details')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Device Inc Withdraw Request details
                    </h1>
                </div>
                <!-- /.container-fluid -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Device Inc Withdraw Request Details
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


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-body">
                        @if (count($claim_payment_request_details))

                            <div class="card-deck">
                                <!-- Loop this card -->
                                @foreach ($claim_payment_request_details as $request_details)
                                    <div class="card bg-info">

                                        <div class="card-body ">
                                            <!-- Customer imformations -->
                                            <h3 class="card-title">
                                                Customer informations
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
