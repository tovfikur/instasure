@php
$page_heading = 'Device Insurance Sale List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.withdraw_payment_request_from_parent_dealer', ['status' => 'all']) }}">
                                <span class="badge badge-secondary">All</span>
                            </a>
                        </li>
                        <!-- /.breadcrumb-item -->

                    </ol>
                    <!-- /.breadcrumb -->
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
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Parent</th>
                                    <th>Customer Phone</th>
                                    <th>Device</th>
                                    <th>Policy Number</th>
                                    <th>Insurance Value</th>
                                    <th>Device Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviceInsurances as $key => $deviceInsurance)
                                    @php
                                        $customerInfo = json_decode($deviceInsurance->customer_info);
                                        $deviceInfo = json_decode($deviceInsurance->device_info);
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $deviceInsurance->parent->com_org_inst_name }}</td>
                                        <td>{{ $customerInfo->customer_phone }}</td>
                                        <td>{{ ucwords($deviceInfo->brand_name . ' ' . $deviceInfo->model_name) }}
                                        </td>
                                        <td>
                                            @if ($deviceInsurance->policy_number)
                                                {{ $deviceInsurance->policy_number }}
                                            @else
                                                <del class="text-secondary">Not set yet</del>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $deviceInsurance->grand_total }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            {{ $deviceInfo->device_price }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            <div class="dropleft">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('admin.device-sale-commission', $deviceInsurance->id) }}">
                                                        <i class="fa fa-eye text-success"></i> Commission Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('policy-invoice', $deviceInsurance->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Invoice
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('policy-certificate', encrypt($deviceInsurance->id)) }}">
                                                        <i class="fa fa-certificate text-warning"></i> Certificate
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
