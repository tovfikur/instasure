@php
$page_heading = 'Claim Delivered List';
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
                <form action="{{ route('serviceCenter.insurance-claim.requestToPaymentFromParent') }}" method="post">
                    @csrf
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <div class="card-title float-left row">
                                <div class="form-group float-left col-md-9">
                                    <label for="">Select an action</label>
                                    <select name="select_action_type" id="select_action_type" class="form-control"
                                        required>
                                        <option value="request_to_pay">Request to pay</option>
                                    </select>

                                </div>
                                <div class="col-md-3 mt-2">
                                    <label for=""> </label>
                                    <button class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            <div class="float-right row">
                                <div class="col-md-3 mt-2">
                                    <a href="{{ route('serviceCenter.insurance-claim.list.delivered') }}"
                                        class="btn btn-primary"><i class="fa fa-refresh"></i></a>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <button data-toggle="modal" data-target="#searchModal" type="button"
                                        class="btn btn-warning">Advance Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example12" class="table table-bordered table-striped">

                                <tr>
                                    <th style="width: 5%">
                                        <input type="checkbox" name="claim_id_toggle" class="form-control selectall">
                                    </th>
                                    <th>#Id</th>
                                    <th>Date & Time</th>
                                    <th>Claim ID</th>
                                    <th>Total Amount</th>
                                    <th>Customer Will Pay</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>

                                @foreach ($deviceClaims as $key => $deviceClaim)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="claim_ids[]" value="{{ $deviceClaim->id }}"
                                                class="form-control individual">
                                        </td>
                                        {{-- <td>{{$key + 1}}</td> --}}
                                        <td>{{ $deviceClaim->id }}</td>
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
                                                class="badge badge-{{ $deviceClaim->status == 'pending' ? 'warning' : 'success' }}">{{ $deviceClaim->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-{{ $deviceClaim->payment_status == 'pending' ? 'danger' : 'success' }}">{{ $deviceClaim->payment_status }}
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
                                                    {{-- <a class="bg-dark dropdown-item" onclick="paymentStatusChange('{{$deviceClaim->id}}')" --}}
                                                    {{-- href="#"> --}}
                                                    {{-- <i class="fa fa-money text-danger" ></i> Payment Status --}}
                                                    {{-- </a> --}}
                                                    {{-- <a class="bg-dark dropdown-item" onclick="StatusChange('{{$deviceClaim->id}}')" --}}
                                                    {{-- href="#"> --}}
                                                    {{-- <i class="fa fa-stream text-info" onclick=""></i> Status --}}
                                                    {{-- </a> --}}
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('serviceCenter.claim-invoice-print', $deviceClaim->id) }}">
                                                        <i class="fa fa-print text-primary"></i> Print Invoice
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                @endforeach

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
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
                                <label for="">Select Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="On Processing">On Processing</option>
                                    <option value="On Delivered">On Delivered</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Cancel">Cancel</option>
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
        <!-- Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="get">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <div class="form-group col-md-6">
                                <label for="date_from">Date From</label>
                                <input type="date" name="date_from" id="date_from" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_to">Date To</label>
                                <input type="date" name="date_to" id="date_to" class="form-control">
                            </div>
                            <div class="form-group col-md-7">
                                <label for="search">Search</label>
                                <input type="search" name="search" id="search" placeholder="Search by claim ID"
                                    autocomplete="off" class="form-control">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="page">Showed</label>
                                <select name="page" id="page" class="form-control">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="400">400</option>
                                    <option value="500">500</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-right m-2">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
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

        $(".selectall").click(function() {
            $(".individual").prop("checked", $(this).prop("checked"));
        });
    </script>
@endpush
