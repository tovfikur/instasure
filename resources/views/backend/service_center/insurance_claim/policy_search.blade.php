@php
$page_heading = 'Make Claim';
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
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <!-- form start -->
                        <form role="form" action="{{ route('serviceCenter.policy-search-submit') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <label for="name">Policy Number/ IMEI 1</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search_value" id="search_value"
                                    placeholder="Enter Policy Number or IMEI 1" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-info" type="submit" id="button-addon2">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@stop
@push('js')
@endpush
