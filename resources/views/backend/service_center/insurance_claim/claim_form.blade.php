@php
$page_heading = 'Insurance Claim Form';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @php
    $customerInfo = json_decode($insurance->customer_info);
    $deviceInfo = json_decode($insurance->device_info);
    $insTypeValue = json_decode($insurance->insurance_type_value);
    @endphp
    <!-- Breadcrumb -->
    @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->

    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr class="table-active">
                                    <th>Customer Details</th>
                                    <th>Device Informations</th>
                                    <th>Insurance Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Customer Name: </b> {{ $customerInfo->customer_name }} <br>
                                        <b>Customer Phone: </b> {{ $customerInfo->customer_phone }} <br>
                                        <b>Customer Email: </b>
                                        {{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }} <br>
                                        <b>{{ $customerInfo->inc_exc_type == 'nid' ? 'Customer NID Number' : 'Customer Passport Number' }}:
                                        </b>
                                        {{ $customerInfo->number }}
                                    </td>
                                    <td>

                                        <b>Brand: </b> {{ $deviceInfo->brand_name }} <br>
                                        <b>Model: </b> {{ $deviceInfo->model_name }} <br>
                                        <b>Device Price: </b>
                                        {{ $deviceInfo->device_price }}
                                        {{ config('settings.currency') }}
                                        <br>
                                        <b>IMEI: </b> {{ $deviceInfo->imei_one }} <br>

                                    </td>
                                    <td>
                                        <b>Policy No: </b> {{ $insurance->policy_number }} <br>

                                        <b>Insurance Purchase Price: </b>
                                        {{ $insurance->sub_total }}
                                        {{ config('settings.currency') }}
                                        <br>
                                        <b>Insurance Purchase Price With Vat: </b>
                                        {{ $insurance->grand_total }}
                                        {{ config('settings.currency') }}
                                        <br>

                                        <b>Available Service: </b>
                                        @foreach ($insTypeValue as $data)
                                            @php
                                                $resultstr[] = $data->parts_type;
                                            @endphp
                                        @endforeach
                                        {{ implode(', ', $resultstr) }}
                                        <br>
                                        <b>Claimable Amount: </b>
                                        {{ $insurance->claimable_amount }}
                                        {{ config('settings.currency') }}
                                        <br>

                                    </td>



                                </tr>
                            </tbody>
                        </table>

                        <livewire:service-center.claim-form-parts-add-component :insurance="$insurance" :details="$details"
                            :deviceInfo="$deviceInfo" />

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <!-- /#overlay -->
    </section>
@stop
@push('js')
    <script>
        window.addEventListener('item_exist', function() {
            alert("Item already exist");
        })
    </script>
    <script>
        $(document).ready(function() {
            var i = 1;
            var j = 1;
            $('#add').click(function() {
                i++;

                $('#more_field').append(`
                                <div class="row" id="row_${i}">
                                    <div class="form-group col-md-6">
                                        <label for="full_name">Upload Pic of Damaged Phone</label>
                                        <input type="file" class="form-control" name="document[]">
                                    </div>
                                    <div class="col-md-1" style="margin-top: 40px;">
                                    <a class="btn btn-sm btn-danger text-white remove" id="${i}"><i class=" fa fa-minus-circle"></i> Cancel<a>
                                </div></div>`);
            });
            $(document).on('click', '.remove', function() {
                var button_id = $(this).attr("id");
                $('#row_' + button_id + '').remove();
            });
            //parts area start...............
            $('#add_parts').click(function() {
                j++;

                $('#more_field_for_parts').append(`
                    <div class="row" id="row2_${j}">
                         <div class="form-group col-md-3">
                        <label for="parts_name">Spare Parts Name</label>
                        <input type="text" class="form-control" name="parts_name[]">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="parts_price">Spare Parts Price</label>
                        <input type="number" class="form-control" name="parts_price[]">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="full_name">Spare Parts Serial No</label>
                        <input type="text" class="form-control" name="parts_identity_number[]">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="full_name">Spare Parts Serial Details</label>
                        <input type="text" class="form-control" name="parts_details[]">
                    </div>
                        <div class="col-md-1" style="margin-top: 40px;">
                        <a class="btn btn-sm btn-danger text-white remove2" id="${j}"><i class=" fa fa-minus-circle"></i> Cancel<a>
                    </div></div>`);
            });
            $(document).on('click', '.remove2', function() {
                var button_id = $(this).attr("id");
                $('#row2_' + button_id + '').remove();
            });

            //protection check
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: "/serviceCenter/insurance-protection_check/" + $('#protection_type').val(),
                success: function(data) {
                    /// alert(data.response.parts_type)
                    if (data.response.parts_type == 'Screen Protection') {
                        $('#claim_info').empty()
                        $('#claim_info').html(` <div class="">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <p>Your selected claim type is: ${data.response.parts_type}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>You Have Remaining Claim: ${data.response.protection_times_for} Times</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
                        if (data.response.protection_times_for > 0) {
                            $("#total_amount").attr({
                                "max": data.response.claim_amount, // substitute your own
                            });
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                        }
                    } else if (data.response.parts_type == 'Damage') {
                        $('#apply_button').empty();
                        $('#claim_info').html(` <div class="">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <p>Your selected claim type is: ${data.response.parts_type}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>You Have Remaining : ${data.response.claim_amount} Tk Claim</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
                        if (data.response.claim_amount > 0) {
                            $("#total_amount").attr("max", data.response.claim_amount);
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                        } else {
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <p>Your Claim already taken.</p>
                            </div>`);
                        }
                    } else {
                        $('#apply_button').empty();
                        $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                    }

                }
            })
        });
        $('#protection_type').change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: "/serviceCenter/insurance-protection_check/" + $('#protection_type').val(),
                success: function(data) {
                    /// alert(data.response.parts_type)
                    if (data.response.parts_type == 'Screen Protection') {
                        $('#claim_info').empty()
                        $('#claim_info').html(` <div class="">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <p>Your selected claim type is: ${data.response.parts_type}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>You Have Remaining Claim: ${data.response.protection_times_for} Times</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
                        if (data.response.protection_times_for > 0) {
                            $("#total_amount").attr("max", data.response.claim_amount);
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                        }
                    } else if (data.response.parts_type == 'Damage') {
                        $('#apply_button').empty();
                        $('#claim_info').html(` <div class="">
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <p>Your selected claim type is: ${data.response.parts_type}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>You Have Remaining : ${data.response.claim_amount} Tk Claim</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
                        if (data.response.claim_amount > 0) {
                            $("#total_amount").attr("max", data.response.claim_amount);
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                        } else {
                            $('#apply_button').empty();
                            $('#apply_button').html(`<div class="">
                                <p>Your Claim already taken.</p>
                            </div>`);
                        }
                    } else {
                        $('#apply_button').empty();
                        $('#apply_button').html(`<div class="">
                                <button type="submit" class="btn btn-success">Apply</button>
                            </div>`);
                    }

                }
            })
        })
    </script>
@endpush
