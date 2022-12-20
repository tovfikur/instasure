@extends('backend.layouts.master')
@section('title', 'Claim Details')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Claim Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        @php
            $customerInfo = json_decode($insurance->customer_info);
            $deviceInfo = json_decode($insurance->device_info);
            $insTypeValue = json_decode($insurance->insurance_type_value);
        @endphp
        <div class="row">
            <div class="col-10 offset-1">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Claim Details</h3>
                        <div class="float-right">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <p class="pl-2 pb-0 mb-0 bg-info">Customer Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr style="">
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th>{{ $customerInfo->inc_exc_type == 'nid' ? 'Customer NID Number' : 'Customer Passport Number' }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $customerInfo->customer_name }}</td>
                                <td>{{ $customerInfo->customer_phone }}</td>
                                <td>{{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }}</td>
                                <td>{{ $customerInfo->number }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-info">Device Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Policy No.</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Available Service</th>
                                <th>Validity Info</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $insurance->policy_number }}</td>
                                <td>{{ $deviceInfo->brand_name }}</td>
                                <td>{{ $deviceInfo->model_name }}</td>
                                <td>
                                    @foreach ($insTypeValue as $data)
                                        @php
                                            $resultstr[] = $data->parts_type;
                                        @endphp
                                    @endforeach
                                    {{ implode(',', $resultstr) }}
                                </td>
                                <td>
                                    <div class="badge badge-info">Total 365 Days</div>
                                    <div class="badge badge-danger">Expire
                                        Date: {{ dateFormat(insExpireDate($insurance)) }}</div>
                                    <div class="badge badge-warning">Remaining Days: {{ insRemainingDays($insurance) }}
                                    </div>
                                </td>
                                <td>{{ $deviceInfo->device_price }} {{ config('settings.currency') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-warning">Claim Details</p>
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item">Claim Number: {{ $deviceClaim->claim_id }}</li>
                                    <li class="list-group-item">Total Amount:
                                        {{ $deviceClaim->total_amount }} {{ config('settings.currency') }}</li>
                                    <li class="list-group-item">Customer Will Pay:
                                        {{ $deviceClaim->user_will_pay }} {{ config('settings.currency') }}</li>
                                    <li class="list-group-item">Provider Will Pay:
                                        {{ $deviceClaim->amount_will_pay_ins_provider }} {{ config('settings.currency') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                    @foreach (json_decode($deviceClaim->document) as $key => $data)
                                        <li class="list-group-item"><img width="50" height="50"
                                                src="{{ asset('uploads/claim/document/' . $data) }}" alt="">
                                            <a href="{{ asset('uploads/claim/document/' . $data) }}" download><i
                                                    class="fa fa-download ml-3"> Download</i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="spare_parts">
                        <thead>
                            <tr style="background-color: #17a2b8!important">
                                <th class="text-center">
                                    Parts Name
                                </th>
                                <th class="text-center">
                                    Price
                                </th>
                                <th class="text-center">
                                    Parts Identity No.
                                </th>

                                <th class="text-center">
                                    Parts Details.
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deviceClaimDetails as $key => $data)
                                <tr>
                                    <td>
                                        {{ $data->parts_name }}
                                    </td>
                                    <td>
                                        {{ $data->parts_price }} {{ config('settings.currency') }}
                                    </td>
                                    {{-- <td>{{ucfirst($data->ins_type)}}</td> --}}
                                    <td>
                                        {{ $data->parts_identity_number }}
                                    </td>
                                    <td>
                                        {{ $data->parts_details }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
@endpush
