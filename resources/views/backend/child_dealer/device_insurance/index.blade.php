@php
$page_heading = 'Device Insurance Sale List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])
    <!-- End:Breadcrumb -->

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
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Invoice</th>
                                    <th>Insured Value</th>
                                    <th>Device Price</th>
                                    <th>Policy Number</th>
                                    <th>Payment Status</th>
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
                                        <td>{{ ucwords($customerInfo->customer_name) }}</td>
                                        <td>{{ $customerInfo->customer_phone }}</td>
                                        <td>{{ $deviceInsurance->invoice_code }}</td>
                                        <td>
                                            {{ $deviceInsurance->totalAmountForCal }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            {{ $deviceInfo->device_price }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>{{ $deviceInsurance->policy_number ? $deviceInsurance->policy_number : 'N/A' }}
                                        </td>
                                        <td><span
                                                class="badge badge-{{ $deviceInsurance->payment_status == 'pending' ? 'warning' : 'success' }}">{{ ucwords($deviceInsurance->payment_status) }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    {{-- <a class="bg-dark dropdown-item" href="{{route('childDealer.device-insurance.show',$deviceInsurance->id)}}"> --}}
                                                    {{-- <i class="fa fa-eye text-success"></i> Details --}}
                                                    {{-- </a> --}}
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('policy-invoice', $deviceInsurance->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Invoice
                                                    </a>
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('childDealer.device-insurance.order', encrypt($deviceInsurance->id)) }}">
                                                        <i class="fa fa-eye text-success"></i> View Details
                                                    </a>

                                                    @if (strtolower($deviceInsurance->payment_status) == 'pending')
                                                        <a class="bg-dark dropdown-item" target="_blank"
                                                            href="{{ route('childDealer.device-insurance.order', encrypt($deviceInsurance->id)) }}">
                                                            <i class="fa fa-money text-warning"></i> Go to pay
                                                        </a>
                                                    @endif
                                                    @if (strtolower($deviceInsurance->payment_status) != 'pending')
                                                        <a class="bg-dark dropdown-item" target="_blank"
                                                            href="{{ route('policy-certificate', encrypt($deviceInsurance->id)) }}">
                                                            <i class="fa fa-certificate text-success"></i> Certificate
                                                        </a>
                                                    @endif

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
