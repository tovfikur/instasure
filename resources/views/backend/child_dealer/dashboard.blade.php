@php
$page_heading = 'Dashboard';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
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
                            <a href="{{ route('childDealer.select-customer') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Sale Insurance
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


    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalInsSale }}</h3>
                                <p>Total Device Insurance Sale</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                            <a href="{{ route('childDealer.deviceInsSaleHistory') }}" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ $totalEarn }}
                                    {{ config('settings.currency') }}
                                </h3>
                                <p>Total Earned Commission </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-money"></i>
                            </div>
                            <a href="{{ route('childDealer.deviceInsSaleHistory') }}" class="small-box-footer">
                                More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md ">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{ $childDealer->dealer_balance }}
                                    {{ config('settings.currency') }}
                                </h3>

                                <p>Current Commission Balance </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                            <a href="{{ route('childDealer.deviceInsSaleHistory') }}" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <!-- /.content -->
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
