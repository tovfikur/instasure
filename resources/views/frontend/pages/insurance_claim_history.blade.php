@extends('frontend.layouts.app')
@section('title', 'Insurance Claim History')
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
        @media only screen and (max-width: 767px){
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
            border: 5px solid rgba(0,0,30,0.8);
        }
        #hoverMe {
            border-bottom:1px dashed #e5e5e5;
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

    </style>
@endpush
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Insurance Claim History</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>Insurance Claim History</li>
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
                    @include('frontend.partials.customer_dashboard_sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 ">
                    <div class="row">
                        @forelse($deviceClaim as $deviceClaimData)
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services-box">
                                <div class="content">
                                    <p><i class="fa fa-calendar"> {{dateFormat($deviceClaimData->created_at)}}</i></p>
                                    <h3><a href="#">Claim Type: {{$deviceClaimData->claim_on}}</a></h3>
                                    <p class="mb-0"><span style="font-weight: bold;">Claim Status:</span> {{$deviceClaimData->status}}</p>
                                    <p><span style="font-weight: bold;">Claim Status Note:</span> {{$deviceClaimData->status_note}}</p>
                                    <p><span style="font-weight: bold;">Payment Status:</span> {{$deviceClaimData->payment_status}}</p>
                                    <p><span style="font-weight: bold;">Payment Details:</span> {{$deviceClaimData->payment_details}}</p>
                                    <p><span style="font-weight: bold;">Amount:</span> {{$deviceClaimData->user_will_pay}}</p>
                                    <div class="row">
                                        <div class="text-left col-lg-5 col-md-5 col-sm-5">
                                            <a href="{{route('user.device-insurance-claim-details', encrypt($deviceClaimData->id))}}" class="read-more-btn">Details<i class="flaticon-right-chevron"></i></a>
                                        </div>
                                        <div class="text-right col-lg-7 col-md-7 col-sm-7">
                                            <a target="_blank" href="{{route('user.device-insurance-claim-download',encrypt($deviceClaimData->id))}}" class="read-more-btn"><i class="fa fa-print"></i> Download Claim Invoice</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @empty
                            <h3>No Data Found!</h3>
                       @endforelse
                       <div class="">
                           {{$deviceClaim->links()}}
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->



@stop
