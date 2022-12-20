@php
$page_heading = 'Add Parent dealer';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.parent_dealers.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.parent-dealers.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Credential Name <small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        id="name" placeholder="Ex: Abdullah Ibn Omar" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="phone">Credential Phone <small class="text-danger">
                                            (unique & required)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                        id="name" placeholder="Ex: 01712345678" pattern="(01)[0-9]{9}" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="password">Credential Password<small class="text-danger">
                                            (required)</small></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter password" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="phone">Company/Industry name <small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="{{ old('com_org_inst_name') }}" id="com_org_inst_name"
                                        placeholder="Ex: Star IT" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Category<small class="text-danger"> (required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="bin" value="{{ old('bin') }}"
                                        id="bin" placeholder="Ex: 0123456789123" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="etin" value="{{ old('etin') }}"
                                        id="etin" placeholder="Ex: 54123" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="contact_person_name">Contact Person Name<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="{{ old('contact_person_name') }}" id="contact_person_name"
                                        placeholder="Ex: Jabir ibn Hayyan" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="contact_person_phone">Contact Person Phone<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone"
                                        value="{{ old('contact_person_phone') }}" id="contact_person_phone"
                                        placeholder="Ex: 01712345678" pattern="(01)[0-9]{9}" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="contact_person_email">Contact Person Email<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_email"
                                        value="{{ old('contact_person_email') }}" id="contact_person_email"
                                        placeholder="Ex: email@domain.com" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="commission_type">Commission Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="commission_type" id="commission_type" class="form-control">
                                        <option value="flat"
                                            {{ getBusinessSettingValue('commission_type') == 'flat' ? 'selected' : '' }}>
                                            Flat</option>
                                        <option value="percentage"
                                            {{ getBusinessSettingValue('commission_type') == 'percentage' ? 'selected' : '' }}>
                                            Percentage</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="commission_amount">Commission Amount<small class="text-danger">
                                            (required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="{{ getBusinessSettingValue('parent_dealer_commission') }}"
                                        id="com_org_inst_name" placeholder="Ex: 10" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger"> (required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="dealer_type">Parent Dealer Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid">Prepaid</option>
                                        <option value="postpaid">Post Paid</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="city">City <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ old('city') }}" id="city" placeholder="Ex: Dhaka">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="area">Area <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area"
                                        value="{{ old('area') }}" id="area" placeholder="Ex: Dhanmondi">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Tread License <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="tread_license" id="tread_license">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Logo <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo" required />
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="other_business_id">Other Business ID <small
                                            class="text-danger">(Multiple)</small></label>
                                    <input type="file" class="form-control" name="other_business_id[]"
                                        id="other_business_id" multiple>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="nid">NID <small class="text-danger">(Back & Front
                                            part.)</small></label>
                                    <input type="file" class="form-control" name="nid[]" id="nid" multiple>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="brand_id">
                                        Need IMEI Check
                                        <small class="text-danger"> (required)</small>
                                    </label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="0" selected disabled>Please select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-9">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="1"
                                        placeholder="Ex: 2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh" required>{{ old('com_address') }}</textarea>
                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@stop
@push('js')
@endpush
