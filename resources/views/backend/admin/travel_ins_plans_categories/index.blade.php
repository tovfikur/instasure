@php
$page_heading = 'Travel Ins Plan Category List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.travel_ins_plans_categories.breadcrumb', ['page_heading' => $page_heading])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Plan Title</th>
                                    <th>Country Details</th>
                                    <th>Country Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($TIPCategories as $key => $TIPCategory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $TIPCategory->plan_title }}</td>
                                        <td>{{ $TIPCategory->county_details }}</td>
                                        <td>{{ $TIPCategory->country_type }}</td>
                                        <td>
                                            <a class="btn btn-info waves-effect"
                                                href="{{ route('admin.travel-ins-plans-categories.edit', $TIPCategory->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#Id</th>
                                    <th>Plan Title</th>
                                    <th>Country Details</th>
                                    <th>Country Type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
