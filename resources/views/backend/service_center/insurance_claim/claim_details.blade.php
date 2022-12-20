@php
$page_heading = 'Claim Details';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    @php
    $customerInfo = json_decode($insurance->customer_info);
    $deviceInfo = json_decode($insurance->device_info);
    $insTypeValue = json_decode($insurance->insurance_type_value);
    @endphp
    <!-- Main content -->
    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered ">
                            <thead>
                                <tr class="table-active">
                                    <th>Customer Details</th>
                                    <th>Device Informations</th>
                                    <th>Insurance Details</th>
                                    <th>Validity Info</th>
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


                                    </td>
                                    <td>
                                        <div class="badge badge-info">Total 365 Days</div> <br>
                                        <div class="badge badge-primary">
                                            Expire Date: {{ dateFormat(insExpireDate($insurance)) }}
                                        </div>
                                        <br>
                                        <div class="badge badge-warning">
                                            Remaining Days: {{ insRemainingDays($insurance) }}
                                        </div>
                                        <br>
                                        <div class="badge badge-success">
                                            Claimable Amount:
                                            {{ $insurance->claimable_amount }}
                                            {{ config('settings.currency') }}
                                        </div>
                                    </td>



                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-active">
                                    <th width="30%">Claim Details</th>

                                    <th width="25%">
                                        Payment status
                                    </th>
                                    <th width="45%">
                                        Parts Details

                                        @if ($deviceClaim->status_admin != 'approved')
                                            <a href="{{ route('serviceCenter.insuranceClaimEdit', $deviceClaim->id) }}"
                                                class="pull-right badge badge-danger" title="Edit Claim">
                                                <i class="fa fa-pencil-square"></i> Edit Claim
                                            </a>
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Claim Number:</b> {{ $deviceClaim->claim_id }} <br />
                                        <b>Claim Date:</b> {{ date_format_custom($deviceClaim->created_at, 'd M, Y') }}
                                        <br />

                                        <b>Claimed on: </b>
                                        {{ $deviceClaim->claim_on }}
                                        <br>

                                        <b>Total claim amount:</b> {{ $deviceClaim->total_amount }}
                                        {{ config('settings.currency') }}<br />


                                        <b>Customer Will Pay:</b>
                                        @php
                                            $customerWillPay = $deviceClaim->user_will_pay;
                                        @endphp
                                        {{ $customerWillPay }}
                                        {{ config('settings.currency') }}
                                        <br />

                                        <b>Provider will pay :</b>
                                        {{ $deviceClaim->total_amount - $customerWillPay }}
                                        {{ config('settings.currency') }}
                                        <br />

                                        <b>Claimable amount:</b>
                                        {{ $insurance->claimable_amount }}
                                        {{ config('settings.currency') }}
                                        <br />
                                        <b>Claim Status:</b>
                                        @php
                                            $status = strtolower($deviceClaim->status);
                                        @endphp
                                        <span
                                            class="badge badge-{{ $status == 'pending' ? 'warning' : ($status == 'cancel' ? 'danger' : 'success') }}">
                                            {{ ucfirst($deviceClaim->status) }}
                                        </span>
                                        <br>
                                        <b>Admin Status:</b>
                                        @php
                                            $status = $deviceClaim->status_admin;
                                        @endphp

                                        <span
                                            class="badge badge-{{ $status == 'pending' ? 'warning' : ($status == 'approved' ? 'success' : 'danger') }}">
                                            {{ ucfirst($deviceClaim->status_admin) }}
                                        </span>
                                        <br>

                                    </td>
                                    <td class="d-flex justify-content-center align-items-center flex-column p-3">
                                        <!-- Pay now btn -->
                                        @if ($deviceClaim->payment_status != 'Paid')
                                            <div class="alert alert-warning" role="alert">
                                                <h4>Pay Attention</h4>
                                                <h6>
                                                    Customer still not paid yet. Please ask customer for payment and click
                                                    'Pay Now' button below.
                                                </h6>
                                                <a href="{{ route('serviceCenter.claim-payment-status-change') }}"
                                                    id="pay_now_btn" data-claim_id="{{ $deviceClaim->id }}"
                                                    class="btn btn-danger"
                                                    style="text-decoration: none; color:#fff !important">Pay Now</a>
                                            </div>
                                        @else
                                            <div class="alert alert-secondary" role="alert">
                                                <h4>Pay Attention</h4>
                                                <p>
                                                    Customer has been paid
                                                    <strong>
                                                        {{ $deviceClaim->user_will_pay }}
                                                        {{ config('settings.currency') }}
                                                    </strong>
                                                    for this claim.
                                                </p>
                                                <p>
                                                    <strong>Paid at: </strong>
                                                    {{ $deviceClaim->updated_at->diffForHumans() }}
                                                </p>
                                                <a href="javascript:void(0)" class="btn btn-success"
                                                    style="text-decoration: none; color:#fff !important">Payment
                                                    Successful</a>
                                            </div>
                                        @endif

                                        <!-- End: Pay now btn -->
                                    </td>
                                    <td>
                                        <table class="table table-bordered table-hover table-md table-striped ">
                                            <thead>
                                                <tr class="bg-secondary">
                                                    <th>
                                                        Parts Name
                                                    </th>
                                                    <th>
                                                        Price
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($deviceClaimDetails as $key => $data)
                                                    <tr>
                                                        <td>
                                                            {{ $data->parts_name }}
                                                        </td>
                                                        <td>
                                                            {{ $data->parts_price }} {{ config('settings.currency') }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>

                                </tr>
                                <!-- /tr -->
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-12">
                        <h5 class="mt-1 text-secondary">Dammaged Gallery</h5>
                        <div class="row">

                            @foreach (json_decode($deviceClaim->document) as $key => $data)
                                <div class="col-sm-3 col-md-2 d-flex flex-column">
                                    <img src="{{ asset('uploads/claim/document/' . $data) }}"
                                        alt="damaged_images_{{ $key }}" style="width: 70%; object-fit:contain;">
                                    <a href="{{ asset('uploads/claim/document/' . $data) }}" download>
                                        <i class="fa fa-download ml-3"> Download</i>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-->
    </section>
@stop
@push('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* Pay now operation */
            $('#pay_now_btn').on('click', function(event) {
                let isConfirm = confirm("Are you sure");
                if (!isConfirm) return false;
                event.preventDefault();
                let url = $(this).attr('href');
                let claim_id = $(this).data('claim_id');
                let data = {
                    payment_status: 'paid',
                    payment_details: 'paid',
                    claim_id

                }
                /* Ajax request for updating */
                $.ajax({
                    url: url,
                    method: 'post',
                    data: data,
                    dataType: 'json',
                    success: function(result) {

                        if (result.success == true) {
                            /* Toast alert on success */
                            toastr.success(result.message);
                            /* End: Toast alert on success */

                        } else {
                            toastr.error(result.message);
                        }

                        /* Reload page */
                        setTimeout(() => {
                            location.href = result.redirect_to;
                        }, 1000);
                        /* End: Reload page */
                    },
                    error: function(error) {
                        const err = error.responseJSON.errors;
                        for (const item in err) {
                            const message = err[item][0];
                            toastr.error(message.replace('id', ''));
                        }

                    }
                });

                /* End: Ajax request for updating */

            })
            /* End: Pay now operation */
        });
    </script>
@endpush
