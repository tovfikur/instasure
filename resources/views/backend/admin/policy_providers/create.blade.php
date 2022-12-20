@php
$page_heading = 'Add New Policy Provider';
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
                    <form role="form" action="{{ route('admin.policy-providers.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="company_name" class="col-md-5">Company Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="company_name" id="company_name"
                                                placeholder="Ex: Americal Life Insurance" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="contact_person_name" class="col-md-5">Contact Person Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="contact_person_name"
                                                id="contact_person_name" placeholder="EX: Mr Hasan Ali" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="contact_person_phone" class="col-md-5">Contact Person Phone<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="contact_person_phone"
                                                id="contact_person_phone" placeholder="Ex: 01945123654" required>
                                        </div>

                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="contact_person_email" class="col-md-5">Contact Person Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="email" class="form-control" name="contact_person_email"
                                                id="contact_person_email" placeholder="domain@exampl.com" required>
                                        </div>

                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group row">
                                        <label for="logo" class="col-md-5">Logo <small class="text-danger">(size: 300 *
                                                300
                                                pixel)</small></label>
                                        <div class="col-md-7">
                                            <input type="file" class="form-control" name="logo" id="logo">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group  row">
                                        <label for="template_img" class="col-md-5">Template Image <small
                                                class="text-danger">(size: 300 * 300
                                                pixel)</small></label>
                                        <div class="col-md-7">
                                            <input type="file" class="form-control" name="template_img"
                                                id="template_img">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                </div>
                                <!-- /.col- -->


                                <div class="col-6">


                                    <div class="form-group row">
                                        <label for="is_api" class="col-md-5">Is API<small class="text-danger">
                                                (required)</small></label>
                                        <div class="col-md-7">
                                            <select name="is_api" id="is_api" class="form-control"
                                                onchange="showField()">
                                                <option value="0">False</option>
                                                <option value="1">True</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group  row api_filed">
                                        <label for="api_url" class="col-md-5">Api URl<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_url" id="api_url"
                                                placeholder="Enter Api URL">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group  row api_filed">
                                        <label for="api_key" class="col-md-5">Api Key<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_key" id="api_key"
                                                placeholder="Enter Api Key">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group  row api_filed">
                                        <label for="api_secret" class="col-md-5">Api Secret<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="api_secret" id="api_secret"
                                                placeholder="Enter Api Secret">
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->

                                    <div class="form-group  row api_filed">
                                        <label for="status" class="col-md-5">Status<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">False</option>
                                                <option value="1">True</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group- -->


                                    <div class="form-group row">
                                        <label for="claim_info" class="col-md-5">Claim Info<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-7">
                                            <textarea class="form-control" name="claim_info" id="claim_info" rows="3"></textarea>
                                        </div>

                                    </div>
                                    <!-- /.form-group- -->

                                </div>
                                <!-- /.col- -->
                            </div>
                            <!-- /.row- -->

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-secondary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        $(document).ready(function() {
            $('.api_filed').hide();
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
