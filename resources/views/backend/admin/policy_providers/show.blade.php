@php
$page_heading = 'Policy Providers Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading . '-' . ucwords($policyProvider->contact_person_name))
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.admin.policy_providers.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('uploads/policy_provider/logo/' . $policyProvider->logo) }}"
                                    alt="Admin profile picture" width="300" height="300">

                            </div>

                            <h6 class="profile-username text-center text-muted">
                                {{ ucwords($policyProvider->company_name) }}</h6>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-info card-outline">
                        <div class="card-header p-2">
                            <h4>
                                {{ ucwords($policyProvider->company_name) }}
                                <a href="{{ route('admin.policy-providers.edit', $policyProvider) }}"
                                    class="pull-right btn btn-dark btn-sm" title="Edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                            </h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content row">
                                <div class="col-md-12" style="border-right: 1px solid #ddd; max-height:500px">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Contact Person Name: </b>
                                            <a class="float-right">{{ $policyProvider->contact_person_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Phone:</b> <a
                                                class="float-right badge badge-warning">{{ $policyProvider->contact_person_phone }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Email:</b> <a
                                                class="float-right">{{ $policyProvider->contact_person_email }}</a>
                                        </li>
                                        {{-- <li class="list-group-item">
                                            <b> Claim Info:</b>
                                            {!! $policyProvider->claim_info !!}
                                        </li> --}}
                                        <li class="list-group-item">
                                            <b>Is API:</b> <a
                                                class="float-right">{{ $policyProvider->is_api == 0 ? 'False' : 'True' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b> API URL:</b> <a
                                                class="float-right">{{ $policyProvider->api_url == 0 ? 'False' : 'True' }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>API Key:</b> <a class="float-right">{{ $policyProvider->api_key }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>API Secret:</b> <a class="float-right">{{ $policyProvider->api_secret }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b> Status:</b> <a
                                                class="float-right">{{ $policyProvider->status == 1 ? 'Active' : 'Inactive' }}</a>
                                        </li>



                                        <li class="list-group-item">
                                            <b>Template Image:</b>
                                            <a class="float-right">
                                                <img class=""
                                                    src="{{ asset('uploads/policy_provider/template_img/' . $policyProvider->template_img) }}"
                                                    alt="Tread Licence" width="50" height="50">
                                                <a href="{{ asset('uploads/policy_provider/template_img/' . $policyProvider->template_img) }}"
                                                    download><i class="fa fa-download"></i></a>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop
