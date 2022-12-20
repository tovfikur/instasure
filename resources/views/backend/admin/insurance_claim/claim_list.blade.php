@php
$page_heading = 'Device Claim List';
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Claim ID</th>
                                    <th>Total Amount</th>
                                    <th>Provider Pay</th>
                                    <th>Customer Pay</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviceClaims as $key => $deviceClaim)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date_format_custom($deviceClaim->created_at, 'd M, Y') }}</td>
                                        <td>{{ $deviceClaim->claim_id }}</td>
                                        <td>
                                            {{ $deviceClaim->total_amount }}
                                            {{ config('settings.currency') }}
                                        </td>
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
                                                class="badge badge-{{ $deviceClaim->status_admin == 'pending' ? 'warning' : ($deviceClaim->status_admin == 'approved' ? 'success' : 'danger') }}">{{ ucwords($deviceClaim->status_admin) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropleft">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item" target="_blank"
                                                        href="{{ route('admin.insurance-claim.details', $deviceClaim->id) }}">
                                                        <i class="fa fa-eye text-primary"></i>
                                                        Claim Details
                                                    </a>

                                                    <a class="bg-dark dropdown-item"
                                                        onclick="StatusChange('{{ $deviceClaim->id }}')"
                                                        href="javascript:void(0)">
                                                        <i class="fa fa-stream text-info" onclick=""></i> Claim Status
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('admin.claim-invoice-print', $deviceClaim->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Print Invoice
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
        <!-- /.row -->

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
                        <form action="{{ route('admin.claim-status-change') }}" method="post" enctype="multipart/form">
                            @csrf
                            <input type="hidden" name="claim_id" id="claim_id_2" class="form-control">
                            <div class="form-group">
                                <label for="">Select Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="denied">Denied</option>
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
    <!-- /.content -->

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
