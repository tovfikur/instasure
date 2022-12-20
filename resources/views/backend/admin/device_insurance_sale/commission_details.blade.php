@php
$page_heading = 'Device Insurance Commission Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
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
                            <a href="{{ route('admin.device-insurance-sales') }}" class="btn btn-info btn-sm">
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <p class="pl-2 pb-0 mb-0 bg-info ">Customer Information</p>
            @php
                $customerInfo = json_decode($deviceOrderDetails->customer_info);
                $deviceInfo = json_decode($deviceOrderDetails->device_info);
                $insTypeValue = json_decode($deviceOrderDetails->insurance_type_value);
            @endphp
            <table class="table table-bordered mt-3">
                <thead>
                    <tr style="">
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $customerInfo->customer_name }}</td>
                        <td>{{ $customerInfo->customer_phone }}</td>
                        <td>{{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
            <p class="pl-2 pb-0 mb-0 bg-info">Device Information</p>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Device Brand</th>
                        <th>Device Model</th>
                        <th>Device Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $deviceInfo->brand_name }}</td>
                        <td>{{ $deviceInfo->model_name }}</td>
                        <td>{{ $deviceInfo->device_price }}{{ config('settings.currency') }}</td>
                    </tr>
                </tbody>
            </table>

            <p class="pl-2 pb-0 mb-0 bg-info">Insurance Price Information</p>
            <table class="table table-bordered mt-3 mb-0">
                <thead>
                    <tr style="">
                        <th>Insurance Type</th>
                        <th>Price</th>
                        <th>Insurance Type</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($insTypeValue) --}}
                    @foreach ($insTypeValue as $key => $data)
                        <tr>
                            <td>{{ $data->parts_type }}</td>
                            <td>{{ $data->price }}</td>
                            <td>{{ ucfirst($data->ins_type) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col-md-8 ">
                    <table class="table table-bordered mt-3 mb-2 ml-2">
                        <thead>
                            <tr class="bg-info" style="">
                                <th>Commission Type</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Included Package Commission for Child</td>
                                <td>{{ $deviceOrderDetails->parent_will_pay_to_child }}
                                    {{ config('settings.currency') }}</td>
                            </tr>
                            <tr>
                                <td>Excluded Package Commission for Child</td>
                                <td>{{ $deviceOrderDetails->child_dealer_commission - $deviceOrderDetails->parent_will_pay_to_child }}
                                    {{ config('settings.currency') }}</td>
                            </tr>
                            <tr style="">
                                <td>Child Dealer Total Commission</td>
                                <td>{{ $deviceOrderDetails->child_dealer_commission }}
                                    {{ config('settings.currency') }}</td>

                            </tr>
                            <tr>
                                <td>Parent Dealer Commission</td>
                                <td>{{ $deviceOrderDetails->parent_dealer_commission }}
                                    {{ config('settings.currency') }}</td>
                            </tr>
                            <tr>
                                <td>Other Party Commission</td>
                                <td>{{ $deviceOrderDetails->other_dealer_commission }}
                                    {{ config('settings.currency') }}</td>
                            </tr>
                            <tr>
                                <td>Instasure Amount</td>
                                <td>{{ $deviceOrderDetails->instasure_amount }} {{ config('settings.currency') }}
                                </td>
                            </tr>

                            <tr>
                                <td>Parent Will Pay Instasure</td>
                                <td>{{ $deviceOrderDetails->parent_will_pay_to_admin }}
                                    {{ config('settings.currency') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered mt-0 pt-0">
                        <tr>

                            <td>Sub Total Price</td>
                            <td>{{ $deviceOrderDetails->sub_total }} {{ config('settings.currency') }}</td>

                        </tr>
                        <tr>
                            <td>Total Vat</td>
                            <td>{{ $deviceOrderDetails->total_vat }} {{ config('settings.currency') }}</td>
                        </tr>
                        <tr>

                            <td>Total Price</td>
                            <td>{{ $deviceOrderDetails->grand_total }} {{ config('settings.currency') }}</td>
                        </tr>
                    </table>
                </div>
            </div>


        </div>


    </section>

@stop
@push('js')
@endpush
