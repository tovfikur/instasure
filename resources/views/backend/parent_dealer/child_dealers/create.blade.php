@php
$page_heading = 'Add New Child dealer';
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
                    <form role="form" action="{{ route('parentDealer.child-dealers.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $parent->id }}">

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        id="name" placeholder="Ex: Mr Sakil Mahmud" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Phone <small class="text-danger">(required & should be
                                            unique)</small></label>
                                    <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"
                                        id="name" required placeholder="Ex: 01720092787">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="password">Password<small class="text-danger">(required)</small></label>
                                    <input type="password" class="form-control" name="password" id="password" required
                                        placeholder="******">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">Company/Industry name <small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="{{ old('com_org_inst_name') }}" id="com_org_inst_name"
                                        placeholder="Ex: Star IT Ltd" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Category<small class="text-danger">(required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="bin" value="{{ old('bin') }}"
                                        id="bin" placeholder="Ex: 1234567890123" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="etin" value="{{ old('etin') }}"
                                        id="etin" placeholder="Ex: 12345" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_name">Contact Person Name<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="{{ old('contact_person_name') }}" id="contact_person_name"
                                        placeholder="Ex: Mr Sakil Mahmud" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="contact_person_phone">Contact Person Phone<small
                                            class="text-danger">(required)</small></label>
                                    <input type="number" class="form-control" name="contact_person_phone"
                                        value="{{ old('contact_person_phone') }}" id="contact_person_phone"
                                        placeholder="Ex: 01720092787" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_email">Contact Person Email<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_email"
                                        value="{{ old('contact_person_email') }}" id="contact_person_email"
                                        placeholder="Ex: sakil.staritltd@gmail.com" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="commission_type">Commission Type<small
                                            class="text-danger">(required)</small></label>
                                    <select name="commission_type" id="commission_type" class="form-control">
                                        <option value="flat"
                                            {{ getBusinessSettingValue('child_dealer_commission') == 'flat' ? 'selected' : '' }}>
                                            Flat</option>
                                        <option value="percentage"
                                            {{ getBusinessSettingValue('child_dealer_commission') == 'percentage' ? 'selected' : '' }}>
                                            Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="commission_amount">Commission Amount<small
                                            class="text-danger">(required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="{{ getBusinessSettingValue('child_dealer_commission') }}"
                                        id="com_org_inst_name" placeholder="Commission amount" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger">(required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dealer_type">Dealer Type<small
                                            class="text-danger">(required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid">Prepaid</option>
                                        <option value="postpaid">Post Paid</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="city">City<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city') }}"
                                        id="city" placeholder="Ex: Dhaka" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="area">Area<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area" value="{{ old('area') }}"
                                        id="area" placeholder="Ex: Dhanmondi" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="email">Tread License <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="tread_license" id="tread_license">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="email">logo <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="other_business_id">Other Business ID <small
                                            class="text-danger">(Multiple)</small></label>
                                    <input type="file" class="form-control" name="other_business_id[]"
                                        id="other_business_id" multiple>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nid">NID <small class="text-danger">(Back & Front part.)</small></label>
                                    <input type="file" class="form-control" name="nid[]" id="nid" multiple>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="2" required
                                        placeholder="Ex: 2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh">{{ old('com_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
