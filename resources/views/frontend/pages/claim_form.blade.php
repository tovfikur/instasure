@extends('frontend.layouts.app')
@section('title', 'Buy Or Claim')
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
                        <h2>Buy Or Claim</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>Buy Or Claim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start About Area -->
    <section class="about-area ptb-100 bg-f8f8f8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-title">
                        <h2>How to claim?</h2>
                    </div>
                </div>
            </div>

            <div class="about-boxes-area">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-about-box">
                            <img src="{{asset('frontend/assets/img/claim-image/1.png')}}" alt="claim">
                            <h3>Step 1:</h3>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-about-box">
                            {{--                            <div class="icon">--}}
                            {{--                                <i class="flaticon-care"></i>--}}
                            <img src="{{asset('frontend/assets/img/claim-image/2.png')}}" alt="claim">
                            {{--                            </div>--}}

                            <h3>Step 2:</h3>
                            {{--                            <p>Lorem ipsum dolor sit amet,  adipiscing consectetur gravida elit</p>--}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-about-box">
                            {{--                            <div class="icon">--}}
                            {{--                                <i class="flaticon-care"></i>--}}
                            <img src="{{asset('frontend/assets/img/claim-image/3.png')}}" alt="claim">
                            {{--                            </div>--}}

                            <h3>Step 3:</h3>
                            {{--                            <p>Lorem ipsum dolor sit amet,  adipiscing consectetur gravida elit</p>--}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-about-box">
                            {{--                            <div class="icon">--}}
                            {{--                                <i class="flaticon-care"></i>--}}
                            <img src="{{asset('frontend/assets/img/claim-image/4.png')}}" alt="claim">
                            {{--                            </div>--}}

                            <h3>Step 4:</h3>
                            {{--                            <p>Lorem ipsum dolor sit amet,  adipiscing consectetur gravida elit</p>--}}
                        </div>
                    </div>
                </div>

            </div>
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-lg-12 col-md-12 text-center">
                    <a href="{{route('login')}}" class="btn default-btn">Sign In</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->



@stop
