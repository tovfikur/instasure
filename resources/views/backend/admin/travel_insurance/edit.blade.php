@php
$page_heading = 'Edit Travel Insurance';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.travel_insurance.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <!-- form start -->
            <form role="form" action="{{ route('admin.travel_insurance_orders.update', $model->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>Customer Name: </b>

                                    <a class="d-inline-block">
                                        {{ ucwords($model->full_name) }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Customer Phone: </b>
                                    {{ $model->phone }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Customer Email: </b>

                                    <a class="d-inline-block">
                                        {{ $model->email }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Date of Birth: </b>

                                    <a class="d-inline-block">
                                        {{ date_format_custom($model->dob, 'd M, Y') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Age: </b>

                                    <a class="d-inline-block">
                                        {{ $model->age }} Years
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Passport Number: </b>

                                    <a class="d-inline-block">
                                        {{ ucwords($model->passport_number) }}
                                    </a>
                                </li>

                                <!-- <li class="list-group-item">
                                    <b>Bank Name: </b>

                                    <a class="d-inline-block">
                                        {{ ucwords($model->bank_name) }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Issue Date: </b>

                                    <a class="d-inline-block">
                                        {{ ucwords($model->issue_date) }}
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Check Number: </b>

                                    <a class="d-inline-block">
                                        {{ ucwords($model->check_number) }}
                                    </a>
                                </li> -->
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Passport Expire Date: </b>

                                    <a class="d-inline-block">
                                        {{ date_format_custom($model->passport_expire_till, 'd M, Y') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Payment Status: </b>

                                    <a class="d-inline-block">
                                        @if (strtolower($model->payment_status) == 'unpaid')
                                            <span class="badge badge-secondary">Unpaid</span>
                                        @else
                                            <span class="badge badge-success">Paid</span>
                                        @endif
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Order Status: </b>

                                    <a class="d-inline-block">
                                        @if (strtolower($model->status) == 'pending')
                                            <span class="badge badge-secondary">Pending</span>
                                        @elseif (strtolower($model->status) == 'processing')
                                            <span class="badge badge-primary">Processing</span>
                                        @elseif (strtolower($model->status) == 'canceled')
                                            <span class="badge badge-danger">Canceled</span>
                                        @else
                                            <span class="badge badge-success">Completed</span>
                                        @endif
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                                                <!-- Next 2 list item added by Tovfikur -->
                                                                <li class="list-group-item">
                                    <b>Payment Method: </b>

                                    <a class="d-inline-block">
                                        {{ $model->payment_method}}
                                    </a>
                                </li>
                                
                                <li class="list-group-item">
                                    <b>Check Details: </b>

                                    <a class="d-inline-block">
                                    <i class="fas fa-money-check-alt"></i> <b>{{ $model->check_number }}</b> &nbsp &nbsp
                                        <i class="fas fa-university"></i> {{$model->bank_name}} &nbsp &nbsp
                                        <i class="far fa-calendar-check"></i> {{$model->issue_date}} &nbsp &nbsp
                                    </a>
                                </li>

                                <li class="list-group-item">
                                    <b>Travel Insurance Category Title: </b>

                                    <a class="d-inline-block">
                                        {{ $model->travel_insurance_category_title }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                            </ul>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <b>Flight Number: </b>

                                    <a class="d-inline-block">
                                        {{ $model->flight_number }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Flight Date: </b>

                                    <a class="d-inline-block">
                                        {{ date_format_custom($model->flight_date, 'd M, Y') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->
                                <li class="list-group-item">
                                    <b>Return Date: </b>

                                    <a class="d-inline-block">
                                        {{ date_format_custom($model->return_date, 'd M, Y') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Total Days: </b>

                                    <a class="d-inline-block">
                                        {{ $model->total_date }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Insurance Price: </b>

                                    <a class="d-inline-block">
                                        {{ $model->ins_price . ' ' . config('settings.currency') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Total Vat: </b>

                                    <a class="d-inline-block">
                                        {{ $model->total_vat . ' ' . config('settings.currency') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Service Amount: </b>

                                    <a class="d-inline-block">
                                        {{ $model->service_total_amount . ' ' . config('settings.currency') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Grand Ttotal: </b>

                                    <a class="d-inline-block">
                                        {{ $model->grand_total . ' ' . config('settings.currency') }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Policy Provider: </b>

                                    <a class="d-inline-block">
                                        {{ $model->policy_provider->company_name }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <b>Shipping Address: </b>

                                    <a class="d-inline-block">
                                        @if (!empty($model->shipping_address))
                                            {{ $model->shipping_address }}
                                        @else
                                            <del>No Address Found</del>
                                        @endif
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                            </ul>
                            <!-- /.list-group -->

                        </div>
                        <!-- /.col -->

                        <div class="col-md-5">
                            <ul class="list-group">

                                @if (!empty($model->policy_certificate))
                                    <li class="list-group-item">
                                        <b>Policy Certificate (PDF): </b>

                                        <a class="d-inline-block badge badge-info"
                                            href="{{ $model->policy_certificate_path }}" target="_blank">
                                            <i class="fa fa-download"></i>
                                            Download
                                        </a>
                                    </li>
                                    <!-- /.list-group-item -->
                                @endif


                                <li class="list-group-item">
                                    <b>Policy Number: </b>

                                    <a class="d-inline-block">
                                        {{ strtoupper($model->policy_number) }}
                                    </a>
                                </li>
                                <!-- /.list-group-item -->


                                <li class="list-group-item">
                                    <b>Order Date: </b>

                                    <a class="d-inline-block">
                                        <span class="badge badge-warning">
                                            {{ date_format_custom($model->created_at, 'd M, Y (h:m A)') }}
                                        </span>
                                    </a>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item bg-secondary">
                                    <h5 class="text-center text-light">Update Order Info</h5>
                                </li>
                                <!-- /.list-group-item -->

                                <li class="list-group-item">
                                    <div class="form-group row">
                                        <label for="policy_certificate" class="col-md-5 col-form-label">Upload
                                            Certificate</label>
                                        <div class="col-md-7">
                                            <input type="file" class="form-control" id="policy_certificate"
                                                name="policy_certificate" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="policy_number" class="col-md-5 col-form-label">Policy Number</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="policy_number"
                                                name="policy_number" value="{{ $model->policy_number }}" />
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="status" class="col-md-5  col-form-label">Order
                                            Status</label>
                                        <div class="col-md-7">
                                            @php
                                                $order_status = strtolower($model->status);
                                            @endphp
                                            <select class="form-control" id="status" name="status">
                                                <option value="0" selected disabled>Change Order Status</option>
                                                @if ($order_status == 'pending')
                                                    <option value="pending"
                                                        @if ($order_status == 'pending') selected @endif>
                                                        Pending</option>
                                                @endif
                                                @if ($order_status != 'canceled')
                                                    <option value="processing"
                                                        @if ($order_status == 'processing') selected @endif>
                                                        Processing</option>
                                                    <option value="completed"
                                                        @if ($order_status == 'completed') selected @endif>
                                                        Completed</option>
                                                @endif
                                                @if ($order_status == 'pending' || $order_status == 'canceled')
                                                    <option value="canceled"
                                                        @if ($order_status == 'canceled') selected @endif>
                                                        Canceled</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Next form group added by Tovfikur -->

                                    <div class="form-group row">
                                        <label for="status" class="col-md-5  col-form-label">Payment Status</label>
                                        <div class="col-md-7">
                                            @php
                                                $payment_status = strtolower($model->status);
                                            @endphp
                                            <select class="form-control" id="status" name="payment_status">
                                                <option value="0" selected disabled>Change Payment Status</option>
                                                    <option value="unpaid"
                                                        @if ($order_status == 'unpaid') selected @endif>
                                                        unpaid</option>
                                                    <option value="paid"
                                                        @if ($order_status == 'paid') selected @endif>
                                                        paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn btn-secondary "
                                                id="save">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </li>
                                <!-- /.list-group-item -->
                            </ul>
                            <!-- /.list-group-->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </form>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@stop
@push('js')
@endpush
