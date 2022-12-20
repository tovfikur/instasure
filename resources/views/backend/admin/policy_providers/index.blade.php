@php
$page_heading = 'Policy Providers List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.admin.policy_providers.breadcrumb', ['page_heading' => $page_heading])
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
                                    <th>Contact Person Name</th>
                                    <th>Company Name</th>
                                    <th>Contact Person Phone</th>
                                    <th>Contact Person Email</th>
                                    <th>Is Api</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($policyProviders as $key => $policyProvider)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $policyProvider->contact_person_name }}</td>
                                        <td>{{ $policyProvider->company_name }}</td>
                                        <td>{{ $policyProvider->contact_person_phone }}</td>
                                        <td>{{ $policyProvider->contact_person_email }}</td>
                                        <td>
                                            <span>{{ $policyProvider->is_api == 1 ? 'True' : 'False' }}</span>

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('admin.policy-providers.show', $policyProvider->id) }}">
                                                        <i class="fa fa-eye text-success"></i> Details
                                                    </a>
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('admin.policy-providers.edit', $policyProvider->id) }}">
                                                        <i class="fa fa-edit text-info"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
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
