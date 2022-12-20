@php
$page_heading = 'Device Sale Commission Log';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
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
                            <a href="{{ route('parentDealer.deviceInsSaleHistory') }}" class="btn btn-info btn-sm">
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
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Commission</th>
                                    <th>Insured Value</th>
                                    <th>Policy Number</th>
                                    <th>Sold At</th>
                                    <th>Invoice</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <tbody>
                                @foreach ($deviceInsurances as $key => $deviceInsurance)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $deviceInsurance->child_dealer_commission }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            {{ $deviceInsurance->totalAmountForCal }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>{{ $deviceInsurance->policy_number ? $deviceInsurance->policy_number : 'N/A' }}
                                        </td>

                                        <td>
                                            {{ date_format_custom($deviceInsurance->created_at, ' d M, Y') }}
                                            <span class="badge badge-info">
                                                {{ date_format_custom($deviceInsurance->created_at, 'H:i A') }}
                                            </span>
                                        </td>
                                        <td>{{ $deviceInsurance->invoice_code }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('policy-invoice', $deviceInsurance->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Invoice
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('parentDealer.device-insurance.order', $deviceInsurance->id) }}">
                                                        <i class="fa fa-eye text-success"></i> Order Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('policy-certificate', encrypt($deviceInsurance->id)) }}">
                                                        <i class="fa fa-certificate text-success"></i> Certificate
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
