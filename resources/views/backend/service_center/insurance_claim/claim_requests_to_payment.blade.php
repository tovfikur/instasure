@php
$page_heading = 'Claim Payment Request list';
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

            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date & Time</th>
                            <th>Request ID</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($claimPaymentRequest as $key => $claimPaymentData)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ dateTimeFormat($claimPaymentData->created_at) }}</td>
                                <td>{{ $claimPaymentData->requestId }}</td>
                                <td>{{ $claimPaymentData->total_amount }} {{ config('settings.currency') }}</td>
                                <td>
                                    @php
                                        $status = strtolower($claimPaymentData->status);
                                    @endphp
                                    <span
                                        class="badge badge-{{ $status == 'pending' ? 'warning' : ($status == 'rejected' ? 'danger' : 'success') }}">{{ $claimPaymentData->status }}
                                    </span>
                                </td>
                                <td>
                                    <a class="bg-dark dropdown-item"
                                        href="{{ route('serviceCenter.insurance-claim.claimPaymentRequestDetails', $claimPaymentData->id) }}">
                                        <i class="fa fa-eye text-primary"></i> Details
                                    </a>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </section>

@stop
@push('js')
    <script>
        function paymentStatusChange(id) {
            $('#claim_id').val(id)
            $('#paymentMethodModal').modal('show');
        }

        function StatusChange(id) {
            $('#claim_id_2').val(id)
            $('#statusModel').modal('show');
        }
    </script>
@endpush
