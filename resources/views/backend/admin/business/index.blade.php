@php
$page_heading = 'Business Settings';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/custom-datepicker.css') }}">
    <style>

    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">


        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>
                            Vat
                            <small class="text-info">
                                (Vat amount will be percent {{ $vat->value }}(%) for
                                all.)
                            </small>
                        </label>
                        <form id="vat">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id" value="{{ $vat->id }}">
                                <input type="number" class="form-control" name="value" value="{{ $vat->value }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                            <!-- /.input-group -->
                        </form>
                        <!-- /form -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <label>Service Charge<small class="text-info">(Service Charge amount will be percent
                                {{ $serviceCharge->value }}(%) for
                                all.)</small></label>
                        <form id="service_charge">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id" value="{{ $serviceCharge->id }}">
                                <input type="number" class="form-control" name="value"
                                    value="{{ $serviceCharge->value }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">

                        <label>Commission Type<small class="text-info">(Commission Type will be
                                {{ $commissionType->value }} )</small></label>
                        <form id="commission_type">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id" value="{{ $commissionType->id }}">
                                <select name="value" id="value" class="form-control" required>
                                    <option value="flat" {{ $commissionType->value == 'flat' ? 'selected' : '' }}>
                                        Flat
                                    </option>
                                    <option value="percentage"
                                        {{ $commissionType->value == 'percentage' ? 'selected' : '' }}>
                                        Percentage
                                    </option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">


                        <label>Parent Dealer Commission<small class="text-info">(Parent Dealer Commission will be
                                {{ $parentDealerCommission->value }} ({{ $commissionType->value }})
                                )</small></label>
                        <form id="parent_dealer_commission">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id"
                                    value="{{ $parentDealerCommission->id }}">
                                <input type="number" class="form-control" name="value"
                                    value="{{ $parentDealerCommission->value }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">

                        <label>Child Dealer Commission
                            <small class="text-info">
                                (Child Dealer Commission will be
                                {{ $childDealerCommission->value }} ({{ $commissionType->value }})
                                )
                            </small>
                        </label>
                        <form id="child_dealer_commission">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id"
                                    value="{{ $childDealerCommission->id }}">
                                <input type="number" class="form-control" name="value"
                                    value="{{ $childDealerCommission->value }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                        <label>
                            Collection Center Commission
                            <small class="text-info">
                                (Set a fixed amount)
                            </small>
                        </label>
                        <form id="collection_center_commission">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id"
                                    value="{{ $collection_center_commission->id }}">

                                <input type="text" class="form-control" name="value"
                                    value="{{ $collection_center_commission->value ?? 0 }}" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-12">
                        <label>Service Center Default Address</label>
                        <form id="default_address_form">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="id" value="{{ $default_address->id }}">

                                <input type="text" class="form-control" name="value"
                                    value="{{ $default_address->value ?? '2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh' }}" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@stop
@push('js')
    <script src="{{ asset('backend/plugins/custom-datepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.timepicker').mdtimepicker();

        });

        /* Default address update */
        $("#collection_center_commission").submit(function(event) {
            event.preventDefault();
            var serializedData = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('admin.business.settings.update') }}",
                data: serializedData,
                success: function(data) {

                    if (data == 1) {
                        toastr.success('Updated Successfully');
                        location.reload();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
        })
        /* End: Default address update */

        /* Default address update */
        $("#default_address_form").submit(function(event) {
            event.preventDefault();
            var serializedData = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: serializedData,
                success: function(data) {

                    if (data == 1) {
                        toastr.success('Updated Successfully');
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
        })
        /* End: Default address update */

        //for vat update
        $("#vat").submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: $('#vat').serialize(),
                success: function(data) {
                    //console.log(data);
                    if (data == 1) {
                        toastr.success('Vat Value Updated Successfully');
                    } else {
                        toastr.error('something went wrong');
                    }
                }
            });
        })

        //for service_charge update
        $("#service_charge").submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: $('#service_charge').serialize(),
                success: function(data) {
                    if (data == 1) {
                        toastr.success('Service Charge Value Updated Successfully');
                    } else {
                        toastr.error('something went wrong');
                    }
                }
            });
        })

        //for commission_type update
        $("#commission_type").submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: $('#commission_type').serialize(),
                success: function(data) {
                    if (data == 1) {
                        toastr.success('Commission Type Updated Successfully');
                    } else {
                        toastr.error('something went wrong');
                    }
                }
            });
        })

        //for parent_dealer_commission update
        $("#parent_dealer_commission").submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: $('#parent_dealer_commission').serialize(),
                success: function(data) {
                    if (data == 1) {
                        toastr.success('Parent Dealer Commission Updated Successfully');
                    } else {
                        toastr.error('something went wrong');
                    }
                }
            });
        })

        //for child_dealer_commission update
        $("#child_dealer_commission").submit(function(event) {
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ url('/admin/business/settings/update') }}',
                data: $('#child_dealer_commission').serialize(),
                success: function(data) {
                    if (data == 1) {
                        toastr.success('Child Dealer Commission Updated Successfully');
                    } else {
                        toastr.error('something went wrong');
                    }
                }
            });
        })
    </script>
@endpush
