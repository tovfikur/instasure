@php
$page_heading = 'Device Insurance Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    @php
    $customerInfo = json_decode($insurance->customer_info);
    $deviceInfo = json_decode($insurance->device_info);
    $insTypeValue = json_decode($insurance->insurance_type_value);
    @endphp
    <!-- Main content -->
    <section class="content">
        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr class="table-active">
                                    <th>Customer Details</th>
                                    <th>Device Informations</th>
                                    <th>Insurance Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Customer Name: </b> {{ $customerInfo->customer_name }} <br>
                                        <b>Customer Phone: </b> {{ $customerInfo->customer_phone }} <br>
                                        <b>Customer Email: </b>
                                        {{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }} <br>
                                        <b>{{ $customerInfo->inc_exc_type == 'nid' ? 'Customer NID Number' : 'Customer Passport Number' }}:
                                        </b>
                                        {{ $customerInfo->number }}
                                    </td>
                                    <td>

                                        <b>Brand: </b> {{ $deviceInfo->brand_name }} <br>
                                        <b>Model: </b> {{ $deviceInfo->model_name }} <br>
                                        <b>Device Price: </b>
                                        {{ $deviceInfo->device_price }}
                                        {{ config('settings.currency') }}
                                        <br>
                                        <b>IMEI: </b> {{ $deviceInfo->imei_one }} <br>

                                    </td>
                                    <td>
                                        <b>Policy No: </b> {{ $insurance->policy_number }} <br>

                                        <b>Insurance Purchase Price: </b>
                                        {{ $insurance->sub_total }}
                                        {{ config('settings.currency') }}
                                        <br>
                                        <b>Insurance Purchase Price With Vat: </b>
                                        {{ $insurance->grand_total }}
                                        {{ config('settings.currency') }}
                                        <br>

                                        <b>Available Service: </b>
                                        @foreach ($insTypeValue as $data)
                                            @php
                                                $resultstr[] = $data->parts_type;
                                            @endphp
                                        @endforeach
                                        {{ implode(', ', $resultstr) }}
                                        <br>
                                    </td>



                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">

                        <table class="table table-bordered" id="spare_parts">
                            <thead>
                                <tr class="table-active">
                                    <th class="text-center">
                                        Insurance Type
                                    </th>
                                    <th class="text-center">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insTypeValue as $key => $data)
                                    <tr>
                                        <td>
                                            {{ $data->parts_type }}
                                            <input type="hidden" name="insuranceType_name[]"
                                                value="{{ $data->parts_type }}">
                                        </td>
                                        <td>{{ $data->price }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">

                        <table class="table table-bordered" id="spare_parts">
                            <thead>
                                <tr class="table-active">
                                    <th width="40%">Validity Info</th>
                                    <th width="60%">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>

                                        <div class="badge badge-primary">
                                            Total 365 Days
                                        </div>
                                        <br>
                                        <div class="badge badge-secondary">
                                            Activation Date: {{ date_format_custom($insurance->created_at, 'F d, Y') }}
                                        </div>
                                        <br>
                                        <div class="badge badge-primary">
                                            Expire Date: {{ dateFormat(insExpireDate($insurance)) }}
                                        </div>
                                        <br>
                                        <div class="badge badge-secondary">
                                            Remaining Days: {{ insRemainingDays($insurance) }}
                                        </div>
                                        <br>
                                        <div class="badge badge-primary">
                                            Claimable Amount:
                                            {{ $insurance->claimable_amount }}
                                            {{ config('settings.currency') }}
                                        </div>

                                    </td>
                                    <td>
                                        @if (dayCountCheckForClaim($insurance) >= $insurance->created_at->daysInMonth &&
                                            dayCountCheckForClaim($insurance) <= 365 &&
                                            $insurance->claimable_amount)
                                            <a class="btn btn-warning"
                                                href="{{ route('serviceCenter.insurance-claim-form', $insurance->id) }}">
                                                Claim Now
                                            </a>

                                            @if (!empty($lostCheck))
                                                <div class="mt-2">
                                                    <a class="btn btn-danger"
                                                        href="{{ route('serviceCenter.insurance-lost-claim-form', $insurance->id) }}">Claim
                                                        for Lost</a>
                                                </div>
                                            @endif
                                        @elseif($insurance->claimable_amount <= 0)
                                            <div class="bg-danger p-1 card text-center">
                                                <h4> Remaining Claimable Amount</h4>
                                                <h5>
                                                    {{ $insurance->claimable_amount }}
                                                    {{ config('settings.currency') }}
                                                </h5>
                                            </div>
                                        @else
                                            <div class="bg-danger p-1 card">Claim will Active after: <span
                                                    class="badge badge-info">{{ dateFormat(claimWillActiveDate($insurance)) }}</span>
                                            </div>
                                        @endif
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    @if (count($insurance->device_claims))
                        <div class="col-md-12">
                            <h6 class="mt-1 text-secondary bg-secondary p-1 pb-1">Previous Claims</h6>
                            <table class="table table-bordered" id="spare_parts">
                                <thead>
                                    <tr class="table-active">
                                        <th>SL</th>
                                        <th>Claim ID</th>
                                        <th>Provider will pay</th>
                                        <th>User will pay</th>
                                        <th>Device price</th>
                                        <th>Claimed amount</th>
                                        <th>Claimed at</th>
                                        <th>Payment status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $sl = 0;
                                    @endphp
                                    @foreach ($insurance->device_claims as $device_claim)
                                        <tr>
                                            <td>
                                                {{ ++$sl }}
                                            </td>
                                            <td>
                                                {{ $device_claim->claim_id }}
                                            </td>
                                            <td>
                                                {{ $device_claim->amount_will_pay_ins_provider }}
                                                {{ config('settings.currency') }}
                                            </td>
                                            <td>
                                                {{ $device_claim->user_will_pay }}
                                                {{ config('settings.currency') }}
                                            </td>
                                            <td>
                                                {{ $device_claim->device_value }}
                                                {{ config('settings.currency') }}
                                            </td>
                                            <td>
                                                {{ $device_claim->total_amount }}
                                                {{ config('settings.currency') }}
                                            </td>
                                            <td>
                                                {{ dateFormat($device_claim->created_at) }}
                                            </td>
                                            <td>
                                                {{ $device_claim->payment_status }}
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    @endif
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </section>
@stop
