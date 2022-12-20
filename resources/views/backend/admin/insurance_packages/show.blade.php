@extends('backend.layouts.master')
@section("title","Details Insurance Package")
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
                        <li class="breadcrumb-item active">{{$package->package_name}}</li>
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
                        <h3 class="card-title float-left">Insurance Package Details</h3>
                        <div class="float-right">
                            <a href="{{route('admin.insurance-packages.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 p-4" style=" border: 1px solid #f3f3f3;">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Package Name: </b> <a
                                        class="float-right">{{$package->package_name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Category: </b> <a
                                        class="float-right">{{$package->deviceCategory->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Subcategory: </b> <a
                                        class="float-right">{{$package->deviceSubcategory->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Brand: </b> <a
                                        class="float-right">
                                        @if($package->brand_id != 0)
                                            {{$package->deviceBrand->name}}
                                        @else
                                            All Brand
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Model: </b> <a class="float-right">
                                        @if($package->device_model_id != 0)
                                            {{$package->deviceModel->name}}
                                        @else
                                            All Model
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Package Type: </b> <a
                                        class="float-right">
                                        {{$package->inc_exc_type}}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Customer Will Pay: </b> <a
                                        class="float-right">
                                        {{$package->customer_will_pay_charge == 0 ? 'No' : 'Yes'}}
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-4 p-4" style=" border: 1px solid #f3f3f3;">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>Insurance Type</td>
                                    <td>Price Type</td>
                                    <td>Value</td>
                                    <td>Parts Type</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($insurancePrices as $insurancePrice)
                                    <tr>
                                        <td>{{$insurancePrice->insuranceType->name}}</td>
                                        <td>{{$insurancePrice->type}}</td>
                                        <td>{{$insurancePrice->value}}</td>
                                        <td>{{$insurancePrice->include_type}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="col-4 p-4" style=" border: 1px solid #f3f3f3;">
                            @if(!empty($parentDetails) && $package->parent_id != 0)
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a
                                            class="float-right">{{$package->parentDealer->com_org_inst_name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Child Dealer Name: </b>
                                    </li>
                                    @foreach($parentDetails as $parentDetail)
                                    <li class="list-group-item">
                                        <a class="">{{$parentDetail->childDealer->com_org_inst_name}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a
                                            class="float-right">All Parent Dealer</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Child Dealer Name: </b> <a
                                            class="float-right">All Child Dealer</a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')

@endpush
