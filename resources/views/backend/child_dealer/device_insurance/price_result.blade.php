@php
$page_heading = 'Device Insurance Sale Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])
    <!-- End:Breadcrumb -->
    @php
        $customerInfo = json_decode($deviceOrderDetails->customer_info);
        $deviceInfo = json_decode($deviceOrderDetails->device_info);
        $insTypeValue = json_decode($deviceOrderDetails->insurance_type_value);
    @endphp
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="card-body table-responsive">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="table-active">
                            <th width="20%">Customer Details</th>
                            <th width="20%">Device Informations</th>
                            <th width="30%">Insurance Details</th>
                            <th width="30%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <b>Name: </b> {{ $customerInfo->customer_name }} <br>
                                <b>Phone: </b> {{ $customerInfo->customer_phone }} <br>
                                <b>Email: </b>
                                {{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }} <br>
                                <b>{{ $customerInfo->inc_exc_type == 'nid' ? 'NID Number' : 'Passport Number' }}:
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
                                <b>Policy No: </b> {{ $deviceOrderDetails->policy_number }} <br>


                                <b>Status: </b>
                                @php
                                    $resultstr = [];
                                @endphp
                                @foreach ($insTypeValue as $data)
                                    @php
                                        $resultstr[] = $data->parts_type;
                                    @endphp
                                @endforeach
                                {{ implode(', ', $resultstr) }}
                                <br>

                                <b>Claimable Amount: </b>
                                @if ($deviceOrderDetails->policy_number)
                                    {{ $deviceOrderDetails->claimable_amount }}
                                    {{ config('settings.currency') }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif
                                <br>

                                <b>Claimed Amount: </b>
                                @if ($deviceOrderDetails->policy_number)
                                    {{ $deviceOrderDetails->claimed_amount }}
                                    {{ config('settings.currency') }}
                                @else
                                    <span class="badge badge-danger">N/A</span>
                                @endif



                                <br>

                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="tac_agreed"
                                        @if ($deviceOrderDetails->payment_status == 'paid') disabled @endif>
                                    <label class="form-check-label" for="tac_agreed">
                                        I confirm that I have read and agreed to the terms and conditions available at
                                        <a href="https://instasure.xyz/terms-and-condition" target="_blank"
                                            title="Terms and condition">
                                            instasure.xyz/terms-and-condition
                                        </a>
                                    </label>

                                    <!-- Added by Tovfikur -->
<!-- start -->
<div class="text-center payment-method-div">
</div>
<!-- end -->


                                </div>

                                @if ($deviceOrderDetails->payment_status == 'paid')
                                    <div class="text-center mt-2">
                                        <a class="btn btn-success btn-sm text-light mb-1">Paid</a>
                                        <a href="{{ route('policy-certificate', encrypt($deviceOrderDetails->id)) }}"
                                            class="btn btn-warning btn-sm text-dark" target="_blank">Download
                                            Certificate</a>
                                    </div>
                                @else
                                    @if ($deviceOrderDetails->grand_total > 0)
                                    <!-- classs added by Tovfiklur -->
                                        <a class="btn btn-warning btn-sm pull-right pay-btn" payid="{{$deviceOrderDetails->id}}" paytype="device"
                                            id="payNow">
                                            Pay Now
                                        </a>
                                    @else
                                        <div id="disbursedDiv">
                                            <a href="#" id="disbursed" class="btn btn-info">Disbursed Now</a>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr class="table-active">
                            <th>Insurance Price Information</th>
                            <th>Price Calculations</th>
                            <th>Validity Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="">
                                            <th>Insurance Type</th>
                                            <th>Insurance Price</th>
                                            <th>Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($insTypeValue) --}}
                                        @foreach ($insTypeValue as $key => $data)
                                            <tr>
                                                <td>{{ $data->parts_type }}</td>
                                                <td>{{ $data->price }} {{ config('settings.currency') }}</td>
                                                <td>{{ ucfirst($data->ins_type) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table class="table table-bordered">
                                    <tr>

                                        <td>Sub Total Price</td>
                                        <td>{{ $deviceOrderDetails->sub_total }}
                                            {{ config('settings.currency') }}</td>

                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>{{ $deviceOrderDetails->total_vat }}
                                            {{ config('settings.currency') }}</td>
                                    </tr>
                                    @if ($deviceOrderDetails->total_discount > 0)
                                        <tr>
                                            <td>Total Discount</td>
                                            <td>{{ $deviceOrderDetails->total_discount }}
                                                {{ config('settings.currency') }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Grand Total</strong> </td>
                                        <td>
                                            <strong>
                                                <span class="badge badge-danger">
                                                    {{ $deviceOrderDetails->grand_total }}
                                                    {{ config('settings.currency') }}
                                                </span>
                                            </strong>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>

                                <div class="badge badge-primary">
                                    Total 365 Days
                                </div>
                                <br>
                                <div class="badge badge-secondary">
                                    Activation Date: {{ date_format_custom($deviceOrderDetails->created_at, 'F d, Y') }}
                                </div>
                                <br>
                                <div class="badge badge-primary">
                                    Expire Date: {{ dateFormat(insExpireDate($deviceOrderDetails)) }}
                                </div>
                                <br>
                                <div class="badge badge-secondary">
                                    Remaining Days: {{ insRemainingDays($deviceOrderDetails) }}
                                </div>
                                <br>
                                <div class="badge badge-primary">
                                    Claimable Amount:
                                    @if ($deviceOrderDetails->policy_number)
                                        {{ $deviceOrderDetails->claimable_amount }}
                                        {{ config('settings.currency') }}
                                    @else
                                        <del class="text-warning">N/A</del>
                                    @endif
                                </div>

                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>
    </section>

@stop
@push('js')


<script>

// script written by Tovfikur

$('.payment-method-div').append(
    `
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="method" id="method1" value="cash ">
    <label class="form-check-label" for="method1">CASH</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="method" id="method2" value="check">
        <label class="form-check-label" for="method2">CHECK</label>
    </div>  
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="method" id="method3" value="aamarpay">
        <label class="form-check-label" for="method3">ONLINE</label>
</div>
`
)
$('.pay-btn').hide();
    $('[name="method"]').change(
        ()=>{
            $('.pay-btn').show();
            if($('[name="method"]:checked').val() != 'aamarpay'){
                $('.pay-btn').removeAttr("type").attr("type", "button");
                $('.pay-btn').click(()=>{
                    window.location.href='/pay/cash/'+$('.pay-btn').attr('payid')+'?paytype='+$('.pay-btn').attr('paytype')+'&method='+$('[name="method"]:checked').val();
                }) 
            } else {
                $('.pay-btn').removeAttr("type").attr("type", "submit");
            }
        }
    )
</script>

    <script>
        $('#tac_agreed').on('change', function() {
            let paymentUrl =
                "{{ route('childDealer.device-insurance.paynow', encrypt($deviceOrderDetails->id)) }}";

            if ($('#tac_agreed').prop('checked')) {
                $('#payNow').attr({
                    'href': paymentUrl
                });
            } else {
                $('#payNow').attr({
                    'href': null
                });
            }
        })

        /* Disbursed */
        $(function() {
            $('#disbursed').click(function() {

                $(document).ajaxSend(function() {
                    $("#overlay").fadeIn(300);
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "/childDealer/device-insurance/disbursed/now/{{ encrypt($deviceOrderDetails->id) }}",
                    success: function(data) {
                        if (data.response == 1) {
                            toastr.success('Commission Successfully Disbursed!', 'Success')
                            $('#disbursedDiv').empty();
                            $('#disbursedDiv').html(
                                `<h3 class="badge badge-success">Disbursed Completed</h3>`);
                        } else {
                            toastr.error('Something went wrong!', 'Error')
                        }
                        console.log(data.response);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $("#overlay").fadeOut(300);
                    }, 500);
                });
            });
        });
    </script>
@endpush
