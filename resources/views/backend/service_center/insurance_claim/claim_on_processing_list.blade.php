@php
$page_heading = 'Claim On Processing List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->

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
                                    <th>Date & Time</th>
                                    <th>Claim ID</th>
                                    <th>Total Amount</th>
                                    <th>Customer Will Pay</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviceClaims as $key => $deviceClaim)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ dateTimeFormat($deviceClaim->created_at) }}</td>
                                        <td>{{ $deviceClaim->claim_id }}</td>
                                        <td>
                                            {{ $deviceClaim->amount_will_pay_ins_provider }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            {{ $deviceClaim->user_will_pay }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ strtolower($deviceClaim->status) == 'pending' ? 'warning' : 'success' }}">{{ $deviceClaim->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ strtolower($deviceClaim->payment_status) != 'paid' ? 'danger' : 'success' }}">{{ $deviceClaim->payment_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('serviceCenter.insurance-claim.details', $deviceClaim->id) }}">
                                                        <i class="fa fa-eye text-primary"></i> Details
                                                    </a>
                                                    @if (strtolower($deviceClaim->payment_status) != 'paid')
                                                        <a class="bg-dark dropdown-item"
                                                            onclick="paymentStatusChange('{{ $deviceClaim->id }}')"
                                                            href="#">
                                                            <i class="fa fa-money text-danger"></i> Payment Status
                                                        </a>
                                                    @endif
                                                    <a class="bg-dark dropdown-item"
                                                        onclick="StatusChange('{{ $deviceClaim->id }}')" href="#">
                                                        <i class="fa fa-stream text-info" onclick=""></i> Status
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('serviceCenter.claim-invoice-print', $deviceClaim->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Print Invoice
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <!-- claim status change Modal -->
        <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Payment Status Manage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('serviceCenter.claim-payment-status-change') }}" method="post"
                            enctype="multipart/form">
                            @csrf
                            <input type="hidden" name="claim_id" id="claim_id" class="form-control">
                            <div class="form-group">
                                <label for="">Select Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control">
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="payment_details">Payment Details</label>
                                <textarea class="form-control" name="payment_details" id="payment_details" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="statusModel" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Status Manage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('serviceCenter.claim-status-change') }}" method="post"
                            enctype="multipart/form">
                            @csrf
                            <input type="hidden" name="claim_id" id="claim_id_2" class="form-control">
                            <div class="form-group">
                                <label for="">Select Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="On Delivered">On Delivered</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""> Note</label>
                                <textarea class="form-control" name="status_note" id="status_note" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
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
