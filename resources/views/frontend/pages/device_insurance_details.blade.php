@extends('frontend.layouts.app')
@section('title', 'Device Insurance Details')
@push('css')
    <style>
        .single-pricing-box .pricing-header.bg2 {
            background-image: url(https://t4.ftcdn.net/jpg/01/19/11/55/360_F_119115529_mEnw3lGpLdlDkfLgRcVSbFRuVl6sMDty.jpg);
        }

        .ptb-100 {
            padding-top: 25px;
            padding-bottom: 100px;
        }

        .single-pricing-box {
            padding-bottom: 19px;
        }

        .single-pricing-box .pricing-header {
            background-color: #002e5b;
            border-radius: 5px 5px 0 0;
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding-top: 25px;
            padding-bottom: 25px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 767px) {
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
        }

        .src-image {
            display: none;
        }

        .card2 {
            overflow: hidden;
            position: relative;
            text-align: center;
            padding: 0;
            color: #fff;

        }

        .card2 .header-bg {
            /* This stretches the canvas across the entire hero unit */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            border-bottom: 1px #FFF solid;
            /* This positions the canvas under the text */
            z-index: 1;
        }

        .card2 .avatar {
            position: relative;
            z-index: 100;
        }

        .card2 .avatar img {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 30, 0.8);
        }

        #hoverMe {
            border-bottom: 1px dashed #e5e5e5;
            text-align: left;
            padding: 13px 20px 11px;
            font-size: 14px;
            font-weight: 600;
            color: #002e5b;

        }

        #hoverMe:hover {
            background-color: #ebebeb;
            color: #002e5b;
            border-left: 3px solid #002e5b;

        }

        .services-box .content {
            padding: 14px;
            border-radius: 0 0 5px 5px;
        }

        .services-box .content h3 {
            margin-bottom: 0px;
            position: relative;
            text-transform: uppercase;
            font-size: 18px;
            font-weight: 900;
        }

        .services-box {
            margin-bottom: 15px;
            border-radius: 5px;
            transition: 0.5s;
            background-color: #ffffff;
            box-shadow: 9.899px 9.899px 30px 0 rgb(0 0 0 / 10%);
        }

        .quote-list-tab {
            margin-left: 5px;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgb(0 0 0 / 7%);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Device Insurance Details</h2>
                        <ul>
                            <li><a href="">Home</a></li>
                            <li>Device Insurance Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Events Details Area -->
    <section class="events-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 ">
                    @include('frontend.partials.customer_dashboard_sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 ">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 tab quote-list-tab">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Customer Info</h5>
                                    @php
                                        $customer_info = json_decode($deviceInsurance->customer_info);
                                    @endphp
                                    <ul>
                                        <li>
                                            <span>Your Name: </span>
                                            {{ $customer_info->customer_name }}
                                        </li>

                                        <li>
                                            <span>Your Phone:</span>
                                            {{ $customer_info->customer_phone }}
                                        </li>

                                        <li>
                                            <span>Your Email:</span>
                                            @if (!empty($customer_info->customer_email))
                                                {{ $customer_info->customer_email }}
                                            @else
                                                <del>You didn't set email yet</del>
                                            @endif

                                        </li>

                                        <li>
                                            <span>
                                                {{ strtolower($customer_info->inc_exc_type) == 'nid' ? 'Your NID Number' : 'Your Passport Number' }}:
                                            </span>
                                            {{ $customer_info->number }}
                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-5 col-md-5 tab quote-list-tab">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Device Info</h5>
                                    @php
                                        $device_info = json_decode($deviceInsurance->device_info);
                                    @endphp
                                    <ul>
                                        <li><span>Device Name:</span> {{ $device_info->device_name }}</li>
                                        <li><span>Device Brand:</span> {{ $device_info->brand_name }}</li>
                                        <li><span>Device Price:</span>
                                            {{ $device_info->device_price }}
                                            {{ config('settings.currency') }}
                                        </li>
                                        <li><span>IMEI 1:</span> {{ $deviceInsurance->imei_one }}</li>
                                        <li>
                                            <span>Policy No:</span>
                                            {{ $deviceInsurance->policy_number }}
                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-4 tab quote-list-tab mt-2">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Insurance Price Info</h5>
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr style="">
                                                <th>Insurance Type</th>
                                                <th>Price</th>
                                                <th>Insurance Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $insurance_infos = json_decode($deviceInsurance->insurance_type_value);
                                            @endphp
                                            @foreach ($insurance_infos as $insurance_info)
                                                <tr>
                                                    <td>{{ $insurance_info->parts_type }}</td>
                                                    <td>
                                                        {{ $insurance_info->price }}
                                                        {{ config('settings.currency') }}
                                                    </td>
                                                    <td>{{ $insurance_info->ins_type }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-4 col-md-4 tab quote-list-tab mt-2">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Remaining Claim</h5>
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                            <tr style="">
                                                <th>Insurance Type</th>
                                                <th>Remaining Claim</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($deviceInsuranceDetails as $insurance_info)
                                                <tr>
                                                    <td>{{ $insurance_info->parts_type }}</td>
                                                    @if ($insurance_info->parts_type == 'Screen Protection')
                                                        <td>
                                                            {{ $insurance_info->protection_times_for }} Times Remaining
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ $deviceInsurance->claimable_amount }}
                                                            {{ config('settings.currency') }} Remaining
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-md-3 tab quote-list-tab mt-2">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Price & Other Info</h5>
                                    <ul>
                                        <li><span>Sub Total:</span> {{ $deviceInsurance->sub_total }}
                                            {{ config('settings.currency') }}</li>
                                        <li><span>VAT:</span> {{ $deviceInsurance->total_vat }}
                                            {{ config('settings.currency') }}</li>
                                        <li><span>Total:</span> {{ $deviceInsurance->grand_total }}
                                        <li>
                                            <span>Payment Status:</span>
                                            {{ ucwords($deviceInsurance->payment_status) }}
                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        <div class="text-center pl-2  row">

                            @php
                                $claimRequest = \App\Model\DeviceClaimRequest::where('device_insurance_id', $deviceInsurance->id)
                                    ->where('status', 'pending')
                                    ->first();
                            @endphp
                            @if ($claimRequest)
                                <div class="col-md-6 col-lg-6">
                                    <a href="#" class="default-btn mt-4 w-100">Request Pending</a>
                                </div>
                            @else
                                @if (strtolower($deviceInsurance->payment_status) == 'paid')
                                    @if (dayCountCheckForClaim($deviceInsurance) >= $deviceInsurance->created_at->daysInMonth &&
                                        dayCountCheckForClaim($deviceInsurance) <= 365)
                                        <div class="col-md-6 col-lg-6">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="default-btn mt-4 w-100">Make Claim</a>
                                        </div>
                                    @else
                                        <div class="bg-danger p-1 card">Claim will Active after: <span
                                                class="badge badge-info">{{ dateFormat(claimWillActiveDate($deviceInsurance)) }}</span>
                                        </div>
                                    @endif
                                @else
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Unsuccessful Order</strong>
                                        </div>
                                    </div>
                                @endif


                            @endif

                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Select Insurance Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.device-insurance-claim') }}" method="post">
                                @csrf
                                <input type="hidden" name="device_insurance_id" value="{{ $deviceInsurance->id }}">
                                <div class="form-group">
                                    <label for="claim_type">Claim Type</label>
                                    <select name="claim_type" id="" class="form-control">
                                        @forelse($deviceInsuranceDetails as $deviceInsuranceDetail)
                                            <option value="{{ $deviceInsuranceDetail->parts_type }}">
                                                {{ $deviceInsuranceDetail->parts_type }}</option>
                                        @empty
                                            <p>Claim type does not found!</p>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @if ($deviceInsuranceDetails->count() > 0)
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @else
                                        <p class="text-danger">No claim available</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- End Events Details Area -->
@stop
