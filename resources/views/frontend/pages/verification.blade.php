@extends('frontend.layouts.app')
@section('title', 'OTP Verification')
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
        .single-pricing-box {
             text-align: left;
        }
        @media only screen and (max-width: 767px){
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
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
                        <h2>OTP Verification</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>OTP Verification</li>
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
{{--@dd($verCode)--}}
                <div class="col-lg-4 col-md-6 col-sm-4 offset-lg-4 offset-md-4 offset-sm-4">
                    <div class="single-pricing-box">
                        <div class="pricing-header bg2">
                            <h3 class="text-center">OTP Verification</h3>
                        </div>
                        <div class="tab_content m-4">
                            <div class="tabs_item">
                                <form class="" action="{{route('get-verification-code.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="phone" value="{{$verCode->phone}}">

                                    <div class="form-group mb-2">
                                        <label for="email" class="c-form-label">Verification Code</label>
                                        <input type="number" class="form-control" name="code" id="code" aria-describedby="emailHelp">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="default-btn mt-4">Verify<span></span></button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->
@stop
