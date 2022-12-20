@extends('backend.layouts.master')
@section("title","Promo Code Details")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Promo Code Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Promo Code Details</h3>
                        <div class="float-right">
                            <a href="{{route('admin.promo-codes.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-4" style=" border: 1px solid #f3f3f3;">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Device Category: </b> <a
                                        class="float-right">{{$promoCode->deviceCategory->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Subcategory: </b> <a
                                        class="float-right">{{$promoCode->deviceSubcategory->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Brand: </b> <a
                                        class="float-right">
                                        @if($promoCode->brand_id != 0)
                                            {{$promoCode->deviceBrand->name}}
                                        @else
                                            All Brand
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Model: </b> <a
                                        class="float-right">
                                        @if($promoCode->device_model_id != 0)
                                            {{$promoCode->deviceModel->name}}
                                        @else
                                            All Model
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Package Type: </b> <a
                                        class="float-right">
                                        {{$promoCode->inc_exc_type}}
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-6 p-4" style=" border: 1px solid #f3f3f3;">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Promo Code: </b> <a
                                        class="float-right">{{$promoCode->code}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Discount Type: </b> <a
                                        class="float-right">{{$promoCode->discount_type}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Discount Price: </b> <a
                                        class="float-right">{{$promoCode->discount_price}}</a>
                                </li>
                                @if($promoCode->parent_id != 0)
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a
                                            class="float-right">{{$promoCode->parentDealer->com_org_inst_name}}</a>
                                    </li>
                                @else
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a class="float-right">All Parent Dealer</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')

@endpush
