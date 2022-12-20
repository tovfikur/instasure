@php
$page_heading = 'Insurance Package List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.parent_dealer.device_insurances.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Package Name</th>
                                    <th>Category Name</th>
                                    <th>Subcategory Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insurancePackages as $key => $insurancePackage)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $insurancePackage->package_name }}</td>
                                        <td>{{ $insurancePackage->deviceCategory->name }}</td>
                                        <td>{{ $insurancePackage->deviceSubcategory->name }}</td>

                                        <td>
                                            <a class="btn btn-info waves-effect"
                                                href="{{ route('parentDealer.insurance-packages.show', encrypt($insurancePackage->id)) }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

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
