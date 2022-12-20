@extends('frontend.layouts.app')
@section('title', 'Dashboard')
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
            border-left: 3px solid #002e5b;
            background-color: #ebebeb;
            color: #002e5b;

        }

        .text-white a {
            color: #fff !important;
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
                        <h2>Dashboard</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-20 pb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 ">
                    @include(
                        'frontend.partials.customer_dashboard_sidebar'
                    )
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 ">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="services-box bg-primary text-white">
                                <div class="content">
                                    <h3 class="text-white"><a
                                            href="{{ route('user.insurance.purchase.history') }}">{{ $totalMediclaimOrder }}</a>
                                    </h3>
                                    <a href="{{ route('user.insurance.purchase.history') }}" class="read-more-btn">Total
                                        Medical Insurance<i class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="services-box bg-info text-white">
                                <div class="content">
                                    <h3 class="text-white"><a
                                            href="{{ route('user.device-insurance.history') }}">{{ $totalDeviceOrder }}</a>
                                    </h3>
                                    <a href="{{ route('user.device-insurance.history') }}" class="read-more-btn">Total
                                        Device Insurance<i class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="services-box bg-success text-white">
                                <div class="content">
                                    <h3><a
                                            href="{{ route('user.device-insurance.claim-requests') }}">{{ $totalDeviceClaim }}</a>
                                    </h3>
                                    <a href="{{ route('user.device-insurance.claim-requests') }}"
                                        class="read-more-btn">Total Device Claim<i class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services-box bg-warning text-white">
                                <div class="content">
                                    <h3><a
                                            href="{{ route('user.device-insurance.claim-requests') }}">{{ $totalDeviceClaimReq }}</a>
                                    </h3>
                                    <a href="{{ route('user.device-insurance.claim-requests') }}"
                                        class="read-more-btn">Total Device Claim Request<i
                                            class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services-box bg-dark text-white">
                                <div class="content">
                                    <h3><a href="{{ route('user.device-insurance.claim-requests') }}">Go Profile</a></h3>
                                    <a href="{{ route('user.profile') }}" class="read-more-btn">Click to go profile<i
                                            class="flaticon-right-chevron"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End Pricing Area -->



@stop
