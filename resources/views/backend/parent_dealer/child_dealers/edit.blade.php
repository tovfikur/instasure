@php
$page_heading = 'Edit Child dealers';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.parent_dealer.child_dealers.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12   ">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('parentDealer.child-dealers.update', $dealerDetails->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ $dealerDetails->user->name }}"
                                        name="name" id="name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone <small class="text-danger">(required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $dealerDetails->user->phone }}" id="name" required>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                                <div class="form-group col-md-6">
                                    <label for="phone">Company or Org. Industry name <small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="{{ $dealerDetails->com_org_inst_name }}" id="com_org_inst_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Category<small class="text-danger">(required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $dealerDetails->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="bin"
                                        value="{{ $dealerDetails->bin }}" id="bin" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="etin"
                                        value="{{ $dealerDetails->etin }}" id="etin" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact_person_name">Contact Person Name<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="{{ $dealerDetails->contact_person_name }}" id="contact_person_name"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="contact_person_phone">Contact Person Phone<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone"
                                        value="{{ $dealerDetails->contact_person_phone }}" id="contact_person_phone"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact_person_email">Contact Person Email<small
                                            class="text-danger">(required)</small></label>
                                    <input type="email" class="form-control" name="contact_person_email"
                                        value="{{ $dealerDetails->contact_person_email }}" id="contact_person_email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="commission_type">commission type<small
                                            class="text-danger">(required)</small></label>
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
                                    <label for="commission_amount">Commission amount<small
                                            class="text-danger">(required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="{{ $dealerDetails->commission_amount }}" id="com_org_inst_name"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger">(required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0" {{ $dealerDetails->is_api == 0 ? 'selected' : '' }}>False
                                        </option>
                                        <option value="1" {{ $dealerDetails->is_api == 1 ? 'selected' : '' }}>True
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dealer_type">Dealer Type<small
                                            class="text-danger">(required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid"
                                            {{ $dealerDetails->dealer_type == 'prepaid' ? 'selected' : '' }}>Prepaid
                                        </option>
                                        <option value="postpaid"
                                            {{ $dealerDetails->dealer_type == 'postpaid' ? 'selected' : '' }}>Post Paid
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    @if ($dealerDetails->tread_license)
                                        <img src="{{ asset('uploads/tread_license/photo/' . $dealerDetails->tread_license) }}"
                                            height="80" width="80">
                                    @endif
                                    <label for="tread_license">Tread License <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="tread_license" id="tread_license">
                                </div>

                                <div class="form-group col-md-3">
                                    @if ($dealerDetails->logo)
                                        <img src="{{ asset('uploads/dealer-logo/photo/' . $dealerDetails->logo) }}"
                                            height="80" width="80"><br>
                                    @endif
                                    <label for="logo">logo <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                </div>
                                <div class="form-group col-md-3">
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
                                <div class="form-group col-md-3">
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
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="city">City<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ $dealerDetails->city }}" id="city" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="area">Area<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area"
                                        value="{{ $dealerDetails->area }}" id="area" placeholder="Enter Area"
                                        required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="2">{!! $dealerDetails->com_address !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('parentDealer.child-dealers.show', $dealerDetails->id) }}"
                                class="pull-right btn btn-dark btn-sm" title="View Details">
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
