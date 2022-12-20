@extends('backend.layouts.master')
@section("title","Add Travel Ins Plans Chart")
@push('css')
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
                        <li class="breadcrumb-item active">Add Travel Ins Plans Chart</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-10">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Add Travel Ins Plans Chart</h3>
                        <div class="float-right">
                            <a href="{{route('admin.travel-ins-plans-charts.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.travel-ins-plans-charts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="travel_ins_plans_category_id">Travel Plan Category Type <span class="text-danger">*</span></label>
                                    <select class="form-control demo-select2" name="travel_ins_plans_category_id" id="travel_ins_plans_category_id" required>
                                        <option>Select</option>
                                        @foreach(\App\Model\TravelInsPlansCategory::all() as $category)
                                        <option value="{{$category->id}}">{{$category->plan_title}} ({{$category->county_details}}) {{$category->country_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="policy_provider_id">Policy Provider <span class="text-danger">*</span></label>
                                    <select class="form-control demo-select2" name="policy_provider_id" id="policy_provider_id" required>
                                        <option>Select</option>
                                        @foreach(\App\Model\PolicyProvider::all() as $provider)
                                            <option value="{{$provider->id}}">{{$provider->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="age_from">Age From <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="age_from" id="age_from" placeholder="Enter Age From" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="age_to">Age To <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="age_to" id="age_to" placeholder="Enter Age To" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="period_from">Period Days From <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="period_from" id="period_from" placeholder="Enter Period Days From" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="period_to">Period Days To <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="period_to" id="period_to" placeholder="Enter Period Days To" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="ins_price">Insurance Price<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="ins_price" id="ins_price" placeholder="Enter Insurance Price" required>
                                </div>
                                <div class="form-group col-4">
                                    <label for="validate_till">Validate Till<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="validate_till" id="validate_till" required>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')

@endpush
