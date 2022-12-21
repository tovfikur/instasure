@php
$page_heading = 'Edit Parent Dealer';
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
            <div class="col-12   ">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.parent-dealers.update', $dealerDetails->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name <small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control"
                                        value="{{ userObj($dealerDetails->user_id)->name }}" name="name" id="name"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Phone <small class="text-danger"> (required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ userObj($dealerDetails->user_id)->phone }}" id="phone" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password"
                                        value="{{ old('password') }}" id="password" placeholder="Enter password">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">Company/Industry Name <small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="{{ $dealerDetails->com_org_inst_name }}" id="com_org_inst_name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Category<small class="text-danger"> (required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $dealerDetails->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="bin"
                                        value="{{ $dealerDetails->bin }}" id="bin" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="etin"
                                        value="{{ $dealerDetails->etin }}" id="etin" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_name">Contact Person Name<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="{{ $dealerDetails->contact_person_name }}" id="contact_person_name"
                                        required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="contact_person_phone">Contact Person Phone<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone"
                                        value="{{ $dealerDetails->contact_person_phone }}" id="contact_person_phone"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_email">Contact Person Email<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_email"
                                        value="{{ $dealerDetails->contact_person_email }}" id="contact_person_email"
                                        required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="commission_type">Commission Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="commission_type" id="commission_type" class="form-control">
                                        <option value="flat"
                                            {{ $dealerDetails->commission_type == 'flat' ? 'selected' : '' }}>Flat
                                        </option>
                                        <option value="percentage"
                                            {{ $dealerDetails->commission_type == 'percentage' ? 'selected' : '' }}>
                                            Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="commission_amount">Commission Amount<small class="text-danger">
                                            (required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="{{ $dealerDetails->commission_amount }}" id="com_org_inst_name"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger"> (required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0" {{ $dealerDetails->is_api == 0 ? 'selected' : '' }}>False
                                        </option>
                                        <option value="1" {{ $dealerDetails->is_api == 1 ? 'selected' : '' }}>True
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dealer_type">ParentDealer Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid"
                                            {{ $dealerDetails->dealer_type == 'prepaid' ? 'selected' : '' }}>Prepaid
                                        </option>
                                        <option value="postpaid"
                                            {{ $dealerDetails->dealer_type == 'postpaid' ? 'selected' : '' }}>Post Paid
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="city">City<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ $dealerDetails->city }}" id="city">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="area">Area<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area"
                                        value="{{ $dealerDetails->area }}" id="area">
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="@if ($dealerDetails->tread_license) col-md-8 @else col-md-12 @endif">
                                            <label for="email">Tread License <small class="text-danger">(size: 300 *
                                                    300
                                                    pixel)</small></label>
                                            <input type="file" class="form-control" name="tread_license"
                                                id="tread_license">
                                        </div>
                                        @if ($dealerDetails->tread_license)
                                            <div class="col-md-4">
                                                <img src="{{ asset('uploads/tread_license/photo/' . $dealerDetails->tread_license) }}"
                                                    height="80" width="80">
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="@if ($dealerDetails->logo) col-md-8 @else col-md-12 @endif">
                                            <label for="email">Logo <small class="text-danger">(size: 300 * 300
                                                    pixel)</small></label>
                                            <input type="file" class="form-control" name="logo" id="logo">
                                        </div>
                                        @if ($dealerDetails->logo)
                                            <div class="col-md-4">
                                                <img src="{{ asset('uploads/dealer-logo/photo/' . $dealerDetails->logo) }}"
                                                    height="80" width="80"><br>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    @if ($dealerDetails->other_business_id)
                                        <div class="row">
                                            @foreach (json_decode($dealerDetails->other_business_id) as $id)
                                                <div class="col-4">
                                                    <img src="{{ asset('uploads/other_business_id/' . $id) }}"
                                                        height="80" width="80"><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <label for="other_business_id">Other Business ID <small
                                            class="text-danger">(Multiple)</small></label>
                                    <input type="file" class="form-control" name="other_business_id[]"
                                        id="other_business_id" multiple>
                                </div>
                                <div class="form-group col-md-6">
                                    @if ($dealerDetails->nid)
                                        <div class="row">
                                            @foreach (json_decode($dealerDetails->nid) as $nid)
                                                <div class="col-4">
                                                    <img src="{{ asset('uploads/nid/' . $nid) }}" height="80"
                                                        width="80"><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <label for="nid">NID <small class="text-danger">(Back & Front
                                            part.)</small></label>
                                    <input type="file" class="form-control" name="nid[]" id="nid" multiple>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="imei_check">
                                        Need IMEI Check
                                    </label>
                                    <select name="imei_check" id="imei_check" class="form-control">
                                        <option value="1" @if ($dealerDetails->imei_check == 1) selected @endif>Yes
                                        </option>
                                        <option value="0" @if ($dealerDetails->imei_check == 0) selected @endif>No
                                        </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="active">
                                        Is Active
                                    </label>
                                    <select name="active" id="active" class="form-control">
                                        <option value="1" @if ($dealerDetails->active == 1) selected @endif>Yes
                                        </option>
                                        <option value="0" @if ($dealerDetails->active == 0) selected @endif>No
                                        </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

<!-- Need to work on here -->
<!-- Added by Tovfikur -->
                                <div class="form-group col-md-3">
                                    <label for="terms_and_condition">
                                        Show terms and condition
                                    </label>
                                    <select name="terms_and_condition" id="terms_and_condition" class="form-control">
                                        <option value="1" @if ($dealerDetails->terms_and_condition == 1) selected @endif>Yes
                                        </option>
                                        <option value="0" @if ($dealerDetails->terms_and_condition == 0) selected @endif>No
                                        </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="signature">
                                        Get signature on terms and condition
                                    </label>
                                    <select name="signature" id="signature" class="form-control">
                                        <option value="1" @if ($dealerDetails->signature == 1) selected @endif>Yes
                                        </option>
                                        <option value="0" @if ($dealerDetails->signature == 0) selected @endif>No
                                        </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-6">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="1">{!! $dealerDetails->com_address !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>

                            <a href="{{ route('admin.parent-dealers.show', $dealerDetails->id) }}"
                                class="pull-right btn btn-dark btn-sm" title="View">
                                <i class="fa fa-eye" aria-hidden="true"></i> View Details
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
