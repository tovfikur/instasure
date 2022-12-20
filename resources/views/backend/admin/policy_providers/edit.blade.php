@php
$page_heading = 'Edit Policy Providers';
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
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.policy-providers.update', $policyProvider->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="company_name" class="col-md-5">Company Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="company_name" id="company_name"
                                                value="{{ $policyProvider->company_name }}" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->


                                    <div class="form-group row">
                                        <label for="contact_person_name" class="col-md-5">Contact Person Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="contact_person_name"
                                                id="contact_person_name" value="{{ $policyProvider->contact_person_name }}"
                                                required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->


                                    <div class="form-group row">
                                        <label for="contact_person_phone" class="col-md-5">Contact Person Phone<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="contact_person_phone"
                                                id="contact_person_phone"
                                                value="{{ $policyProvider->contact_person_phone }}" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="contact_person_email" class="col-md-5">Contact Person Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="email" class="form-control" name="contact_person_email"
                                                id="contact_person_email"
                                                value="{{ $policyProvider->contact_person_email }}" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->


                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @if ($policyProvider->logo)
                                                <img src="{{ asset('uploads/policy_provider/logo/' . $policyProvider->logo) }}"
                                                    width="80" height="80"><br>
                                            @endif
                                            <label for="logo">logo <small class="text-danger">(size: 300 * 300
                                                    pixel)</small></label>
                                            <input type="file" class="form-control" name="logo" id="logo">
                                        </div>
                                        <!-- /.col- -->
                                        <div class="form-group col-md-6">
                                            @if ($policyProvider->template_img)
                                                <img src="{{ asset('uploads/policy_provider/template_img/' . $policyProvider->template_img) }}"
                                                    width="80" height="80"><br>
                                            @endif
                                            <label for="template_img">Template Image <small class="text-danger">(size: 300 *
                                                    300
                                                    pixel)</small></label>
                                            <input type="file" class="form-control" name="template_img"
                                                id="template_img">
                                        </div>
                                        <!-- /.col- -->
                                    </div>
                                    <!-- /.row- -->

                                </div>
                                <!-- /.col- -->

                                {{-- <div class="col-6">


                                </div> --}}
                                <!-- /.col- -->

                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="is_api" class="col-md-5">Is API <small class="text-danger">
                                                (required)</small></label>
                                        <div class="col-md-7">
                                            <select name="is_api" id="is_api" class="form-control"
                                                onchange="showField()">
                                                <option value="0" {{ $policyProvider->is_api == 0 ? 'selected' : '' }}>
                                                    False
                                                </option>
                                                <option value="1" {{ $policyProvider->is_api == 1 ? 'selected' : '' }}>
                                                    True
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row api_filed">
                                        <label for="api_url" class="col-md-5">Api URL<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_url" id="api_url"
                                                value="{{ $policyProvider->api_url }}">
                                        </div>

                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row api_filed">
                                        <label for="api_key" class="col-md-5">Api Key<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_key" id="api_key"
                                                value="{{ $policyProvider->api_key }}">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row api_filed">
                                        <label for="api_secret" class="col-md-5">Api Secret<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_secret" id="api_secret"
                                                value="{{ $policyProvider->api_secret }}">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="status" class="col-md-5">Status<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0"
                                                    {{ $policyProvider->status == 0 ? 'selected' : '' }}>
                                                    False
                                                </option>
                                                <option value="1"
                                                    {{ $policyProvider->status == 1 ? 'selected' : '' }}>
                                                    True
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="claim_info" class="col-md-5">Claim Info<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <textarea class="form-control" name="claim_info" id="claim_info" rows="3">{{ $policyProvider->claim_info }}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                </div>
                                <!-- /.col- -->
                            </div>
                            <!-- /.row- -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary  pull-right">Save</button>
                            <a href="{{ route('admin.policy-providers.show', $policyProvider->id) }}"
                                class="btn btn-primary">
                                <i class="fa fa-eye"></i>
                                Details
                            </a>
                        </div>
                    </form>
                    <!-- /form -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        $(document).ready(function() {
            $('.api_filed').hide();
            showField();
        });

        function showField() {
            var is_api = $('#is_api').val();
            if (is_api == 1) {
                $('.api_filed').show();
            } else {
                $('.api_filed').hide();
            }

        }
    </script>
@endpush
