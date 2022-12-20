@php
$page_heading = 'Dashboard - Service Center';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <style>
        .small-box>.small-box-footer {
            font-size: 12px;
        }

    </style>
@endpush
@section('content')
    <section class="content">
        <!-- Breadcrumb -->
        @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
        <!-- End: Breadcrumb -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    @php
                        $icons = ['fa fa-question-circle', 'fa fa-inr', 'fa fa-rub', 'fa fa-jpy', 'fa fa-usd', 'fa fa-gbp', 'fa fa-eur'];
                    @endphp

                    @foreach ($total_amounts->getAttributes() as $key => $total_amount)
                        <div class="col-lg-4 col-sm-6 col-12">
                            <!-- small box -->
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h3>
                                        {{ number_format($total_amount, 1) }}
                                        @if ($loop->index != 0)
                                            {{ config('settings.currency') }}
                                        @endif

                                    </h3>
                                    <p> {{ ucwords(str_remove_dashes_custom($key)) }}</p>

                                </div>
                                <div class="icon">
                                    <i class="{{ $icons[$loop->index] }}"></i>
                                </div>
                            </div>
                            <!-- ./mall-box -->
                        </div>
                        <!-- ./col -->
                    @endforeach
                    <div class="col-lg-4 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>
                                    {{ number_format($total_device_price, 1) }}
                                    {{ config('settings.currency') }}
                                </h3>
                                <p> Total Device Price</p>
                            </div>
                            <div class="icon">
                                <i class="{{ $icons[count($icons) - 1] }}"></i>
                            </div>
                        </div>
                        <!-- ./small-box -->
                    </div>
                    <!-- ./col -->
                </div>
                <!-- ./row -->

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalClaimPaymentRequest }}</h3>
                                <h5>Total</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list"></i>
                            </div>
                            <a class="small-box-footer">CLaim Payment Request</a>
                        </div>
                        <!-- ./small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalClaimPaymentRequestPending }}</h3>
                                <h5>Pending</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-th-list "></i>
                            </div>
                            <a class="small-box-footer">CLaim Payment Request</a>
                        </div>
                        <!-- ./small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalClaimPaymentRequestProcessing }}</h3>
                                <h5>Processing</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-align-right"></i>
                            </div>
                            <a class="small-box-footer">CLaim Payment Request</a>
                        </div>
                        <!-- ./small-box -->
                    </div>
                    <!-- ./col -->

                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalClaimPaymentRequestPaid }}</h3>
                                <h5>Paid</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-ul"></i>
                            </div>
                            <a class="small-box-footer">CLaim Payment Request</a>
                        </div>
                        <!-- ./small-box -->
                    </div>
                    <!-- ./col -->

                </div>
                <!-- ./row -->


                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $totalPendingReq }}</h3>
                                <h5>Pending</h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-anchor"></i>
                            </div>
                            <a class="small-box-footer">CLaim Through Customer Panel</a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $totalAcceptedReq }}</h3>
                                <h5>Accepted</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-thumbs-up"></i>
                            </div>
                            <a class="small-box-footer">CLaim Through Customer Panel</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $totalCompletedReq }}</h3>
                                <h5>Completed</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <a class="small-box-footer">CLaim Through Customer Panel</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $totalCanceledReq }}</h3>
                                <h5>Canceled</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-times"></i>
                            </div>
                            <a class="small-box-footer">CLaim Through Customer Panel</a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimProcessing }}</h3>
                                <h5>Total On Processing</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-spinner"></i>
                            </div>
                            <a href="{{ route('serviceCenter.insurance-claim.list.processing') }}"
                                class="small-box-footer">Claim
                                Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimOnDelivered }}</h3>
                                <h5>Total On Delivered </h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <a href="{{ route('serviceCenter.insurance-claim.list.on-delivered') }}"
                                class="small-box-footer">Claim Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimDelivered }}</h3>
                                <h5>Total Delivered</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-handshake-o"></i>
                            </div>
                            <a href="{{ route('serviceCenter.insurance-claim.list.delivered') }}"
                                class="small-box-footer">Claim Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimComplete }}</h3>
                                <h5>Total Completed</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <a class="small-box-footer">Claim Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimClaimToPay }}</h3>
                                <h5>Total Claim To Pay</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="{{ route('serviceCenter.insurance-claim.claimPaymentRequestList') }}"
                                class="small-box-footer">Claim Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-3 col-sm-6 col-12">

                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $totalDeviceClaimCancel }}</h3>
                                <h5>Total Cancel</h5>
                            </div>
                            <div class="icon">
                                <i class="fa fa-times-circle"></i>
                            </div>
                            <a class="small-box-footer">Claim Through Service
                                Center </a>
                        </div>
                        <!-- /.small-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->


@stop
