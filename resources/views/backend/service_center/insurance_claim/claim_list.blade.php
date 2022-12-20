@php
$page_heading = 'Claim Pending List';
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

                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date & Time</th>
                                    <th>Identifires</th>
                                    <th>Amount Info</th>
                                    <th>Status Info</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviceClaims as $key => $deviceClaim)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div>
                                                <strong>
                                                    Purchase Date:
                                                </strong>
                                                {{ date_format_custom($deviceClaim->device_insurance->created_at, 'd M, Y') }}
                                            </div>

                                            <div>
                                                <strong>
                                                    Claim Date:
                                                </strong>
                                                {{ date_format_custom($deviceClaim->created_at, 'd M, Y') }}
                                            </div>

                                            @if (strtolower($deviceClaim->status) == 'cancel')
                                                <div>
                                                    <strong>
                                                        Cancel Date:
                                                    </strong>
                                                    {{ date_format_custom($deviceClaim->updated_at, 'd M, Y') }}
                                                </div>
                                            @endif

                                        </td>
                                        <td>
                                            <div>
                                                <strong>
                                                    Claim ID:
                                                </strong>
                                                {{ $deviceClaim->claim_id }}
                                            </div>

                                            <div>
                                                <strong>
                                                    Policy Number:
                                                </strong>
                                                {{ $deviceClaim->device_insurance->policy_number }}
                                            </div>

                                            <div>
                                                <strong>
                                                    Device Name:
                                                </strong>
                                                @php
                                                    $device_info = json_decode($deviceClaim->device_insurance->device_info);
                                                    $device_name = ucwords($device_info->brand_name . ' ' . $device_info->model_name);
                                                @endphp
                                                {{ $device_name }}
                                            </div>

                                        </td>
                                        <td>
                                            <div>
                                                <strong>
                                                    Claim Amount:
                                                </strong>
                                                {{ $deviceClaim->total_amount }}
                                                {{ config('settings.currency') }}
                                            </div>
                                            <div>
                                                <strong>
                                                    Provider Pay:
                                                </strong>
                                                {{ $deviceClaim->amount_will_pay_ins_provider }}
                                                {{ config('settings.currency') }}
                                            </div>
                                            <div>
                                                <strong>
                                                    Customer Pay:
                                                </strong>
                                                {{ $deviceClaim->user_will_pay }}
                                                {{ config('settings.currency') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                @php
                                                    $status = strtolower($deviceClaim->status);
                                                @endphp
                                                <strong>Claim Status: </strong>
                                                <span
                                                    class="badge badge-{{ $status == 'pending' ? 'warning' : ($status == 'cancel' ? 'danger' : 'success') }}">{{ ucfirst($status) }}
                                                </span>
                                            </div>
                                            <div>
                                                @php
                                                    $status = $deviceClaim->status_admin;
                                                @endphp
                                                <strong>Admin Status: </strong>
                                                <span
                                                    class="badge badge-{{ $status == 'pending' ? 'warning' : ($status == 'approved' ? 'success' : 'danger') }}">{{ ucfirst($status) }}
                                                </span>
                                            </div>
                                            <div>
                                                @php
                                                    $status = strtolower($deviceClaim->payment_status);
                                                @endphp
                                                <strong>Payment Status: </strong>
                                                <span
                                                    class="badge badge-{{ strtolower($status) == 'pending' ? 'danger' : 'success' }}">{{ ucfirst($status) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropleft">
                                                <button class="btn btn-secondary dropdown" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('serviceCenter.insurance-claim.details', $deviceClaim->id) }}">
                                                        <i class="fa fa-eye text-info"></i> Details
                                                    </a>
                                                    @if (strtolower($deviceClaim->payment_status) != 'paid')
                                                        <a class="bg-dark dropdown-item"
                                                            onclick="paymentStatusChange('{{ $deviceClaim->id }}')"
                                                            href="javascript:void(0)">
                                                            <i class="fa fa-money text-danger"></i> Payment Status
                                                        </a>
                                                    @endif
                                                    @if (strtolower($deviceClaim->status_admin) == 'approved' && strtolower($deviceClaim->status) != 'cancel')
                                                        <a class="bg-dark dropdown-item"
                                                            onclick="StatusChange('{{ $deviceClaim->id }}')"
                                                            href="javascript:void(0)">
                                                            <i class="fa fa-stream text-info" onclick=""></i>
                                                            Change Status
                                                        </a>
                                                    @endif
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('serviceCenter.claim-invoice-print', $deviceClaim->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Print Invoice
                                                    </a>
                                                    @if ($deviceClaim->status_admin != 'approved')
                                                        <a class="bg-dark dropdown-item"
                                                            href="{{ route('serviceCenter.insuranceClaimEdit', $deviceClaim->id) }}">
                                                            <i class="fa fa-pencil-square  text-warning"></i> Edit Claim
                                                        </a>
                                                    @endif

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
                                <label for=""> Payment Details</label>
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
                                <label for="">Select Status </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="on processing" selected>On Processing</option>
                                    <option value="on delivered">Ready To Delivered</option>
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
