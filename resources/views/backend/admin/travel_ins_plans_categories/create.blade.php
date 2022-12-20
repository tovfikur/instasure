@php
$page_heading = 'Travel Ins Plan Category Create';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.travel_ins_plans_categories.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <!-- form start -->
            <form role="form" action="{{ route('admin.travel-ins-plans-categories.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group">
                                <label for="plan_title">Plan Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="plan_title" id="plan_title"
                                    placeholder="Enter Plan Title" required>
                            </div>
                            <div class="form-group">
                                <label for="county_details">Country Details<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="county_details" id="county_details"
                                    placeholder="Enter Country Details" required>
                            </div>
                            <div class="form-group">
                                <label for="country_type">Country Type <span class="text-danger">*</span></label>
                                <select class="form-control demo-select2" name="country_type" id="country_type" required>
                                    <option>Select</option>
                                    <option value="Schengen">Schengen Country</option>
                                    <option value="Non Schengen">Non Schengen Country</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

            </form>
        </div>

    </section>

@stop
@push('js')
@endpush
