@php
$page_heading = 'Insurance Package Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.parent_dealer.device_insurances.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <div class="row">
                        <div class="col-4 p-4" style=" border: 1px solid #f3f3f3;">
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Package Name: </b> <a class="float-right">{{ $package->package_name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Category: </b> <a
                                        class="float-right">{{ $package->deviceCategory->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Subcategory: </b> <a
                                        class="float-right">{{ $package->deviceSubcategory->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Brand: </b>
                                    <a class="float-right">
                                        @if ($package->brand_id != 0)
                                            {{ $package->deviceBrand->name }}
                                        @else
                                            All Brand
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Device Model: </b>
                                    <a class="float-right">
                                        @if ($package->device_model_id != 0)
                                            {{ $package->deviceModel->name }}
                                        @else
                                            All Model
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Package Type: </b> <a class="float-right">
                                        {{ $package->inc_exc_type }}
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
                                    @foreach ($insurancePrices as $insurancePrice)
                                        <tr>
                                            <td>{{ $insurancePrice->insuranceType->name }}</td>
                                            <td>{{ $insurancePrice->type }}</td>
                                            <td>{{ $insurancePrice->value }}</td>
                                            <td>{{ $insurancePrice->include_type }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="col-4 p-4" style=" border: 1px solid #f3f3f3;">
                            @if (!empty($parentDetails) && $package->parent_id != 0)
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a
                                            class="float-right">{{ $package->parentDealer->com_org_inst_name }}</a>
                                    </li>
                                </ul>
                                <form role="form"
                                    action="{{ route('parentDealer.insurance-packages.child-dealer-update') }}"
                                    method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <h5 class="text-info">child List</h5>
                                            <p class="bg-info pl-3">
                                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $package->parent_id }}">
                                                <input type="checkbox" id="checkAll"> By a click you can select all
                                            </p>
                                            <ul class="list-group" style="max-height: 415px; overflow-y: scroll;">
                                                @php
                                                    $childDealers = \App\Model\Dealer::where('parent_id', $package->parent_id)->get();
                                                @endphp
                                                @foreach ($childDealers as $childDealer)
                                                    <li class="list-group-item m-0 mr-2 mb-1">
                                                        <label for="" class="m-0 p-0"> </label>
                                                        <input type="checkbox" class="child_id" name="child_id[]"
                                                            id="child_id" value="{{ $childDealer->id }}"
                                                            {{ in_array($childDealer->id, $packageChilds) ? 'checked' : '' }}>
                                                        {{ $childDealer->com_org_inst_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                    </div>
                                </form>
                            @else
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Parent Dealer Name: </b> <a class="float-right">All Parent Dealer</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Child Dealer Name: </b> <a class="float-right">All Child Dealer</a>
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
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
