@extends('frontend.layouts.app')
@section('title', 'Partner Program')
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
    </style>
@endpush
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Partner Program</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Partner Program</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Insurance Details Area -->
    <section class="insurance-details-area ptb-100">
        <div class="container">
            <div class="insurance-details-header">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="content mb-5">

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h3>Ready for a new take on insurance distribution?</h3>
                                        <p class="para">
                                            Are you an insurance provider that wants to get your products in the hands of
                                            more customers, in the fast-growing digital world?
                                            Are you a company who would like to offer insurance products to your customers,
                                            but don’t know how to start?
                                            Are you a customer seeking multiple insurance solutions to suit your lifestyle
                                            needs, without having to apply to them all individually?
                                            Meet Instasure. Instasure is a technology platform that streamlines insurance
                                            distribution and enables businesses to offer a range of insurance products
                                            through a single channel.
                                            Want early access to Instasure? Please Contact Us.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/international-1.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/international-2.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h2>Affiliate and Partner Program:</h2>
                                        <p class="para">
                                            Do we partner with awesome businesses in our community? You bet we do. Whether
                                            you're in the mobile phone business, mobile phone repair shop, connecting with a
                                            customer base or providing a benefit to your employees, we are here to make that
                                            happen. Our process is as easy as breaking your phone and we have multiple ways
                                            to work with your customers and/or employees.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h3>End-to-end insurance, powerful APIs</h3>
                                        <p class="para">
                                        Revolutionizing insurance for underwriters and businesses in Africa via a single platform.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/pic-1.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/2.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h2>One solution for the entire insurance ecosystem</h2>
                                        <p class="para">
                                        We help businesses sell the coverage customers need.
                                        </p>
                                    </div>
                                </div>
                            </div>



                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="content mb-5">

                        <div class="row align-items-center">                           

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h3>Insurance management for businesses</h3>
                                        <p class="para">
                                        Take control of your insurance by tailoring risk to your priorities and budget.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/5.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/4.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h2>A solution for insurers and brokers</h2>
                                        <p class="para">
                                        Transform your business by leveraging our automated ecosystem. Tap into unprecedented growth and innovation potential.
                                        </p>
                                    </div>
                                </div>
                            </div>



                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h3>Plug and play insurance for any type of platform</h3>
                                        <p class="para">
                                        Expand your value proposition, monetise your customers and improve their lifetime value by offering insurance products that suit their needs.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <img src="{{ asset('frontend/assets/img/products/6.jpg') }}"
                                            alt="aamr-pay">
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                        <!--img src="{{ asset('frontend/assets/img/products/x.jpg') }}"
                                            alt="aamr-pay"-->
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                        <h2></h2>
                                        <p class="para">
                                        
                                        </p>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="content mb-5">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-md-12">
                                    <p>&nbsp;</p>
                                    <div class="about-tex t">
                                        <h3 align="center">Insurance is good for your business</h3>
                                        <p align="center">
                                            <strong>Democratize access to tailored, flexible cover.</strong>
                                        </p>
                                    </div>
                                </div>                               
                            </div>
                            

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                    <p>&nbsp;</p>
                                        <img src="{{ asset('frontend/assets/img/products/22.png') }}"
                                            alt="">
                                        <h3>Satisfied customers</h3>
                                        <p class="para">
                                        Insurance purchase rates go up when you put people first. We work with you to create attractive policies and benefits that your customers want.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                    <p>&nbsp;</p>
                                        <img src="{{ asset('frontend/assets/img/products/33.png') }}"
                                            alt="">
                                            <h3>More revenue</h3>
                                        <p class="para">
                                        Enjoy a major new source of income as your customers benefit from an insurance experience that delivers exceptional value in real-time.
                                        </p>                                            
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>

                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-12">
                                    <div class="about-text">
                                    <p>&nbsp;</p>
                                        <img src="{{ asset('frontend/assets/img/products/44.png') }}"
                                            alt="">
                                        <h3>Optimized products</h3>
                                        <p class="para">
                                        Solve the problem of overlapping or too much insurance cover by leveraging our tailor-made solution for any business type.
                                        </p>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="about-title">
                                    <p>&nbsp;</p>
                                        <img src="{{ asset('frontend/assets/img/products/55.png') }}"
                                            alt="">
                                            <h3>Digital ready</h3>
                                        <p class="para">
                                        Whatever your business you can integrate dozens of policies instantly with our powerful API.
                                        </p>                                            
                                    </div>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                        


                        </div>
                    </div>
                </div>

                                


            </div>
        </div>
    </section>
    <!-- End Insurance Details Area -->







    <!-- Start Insurance Details Area -->
    <section class="insurance-details-area ptb-100">
        <div class="container">
            <div class="insurance-details-header">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 ">
                        <div class="content mb-5">
                            <h3>So what are you waiting for?</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div class="contact-form">
                                        <form id="contactForm_" action="{{ route('contact_us_send_email') }}"
                                            method="post">
                                            @csrf
                                            @method('post')
                                            <input type="hidden" name="type" value="partner" />
                                            <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" value="{{ old('name') }}"
                                                            placeholder="Your Full Name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" value="{{ old('email') }}"
                                                            placeholder="Email">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="phone_number" id="phone_number"
                                                            value="{{ old('phone_number') }}" class="form-control"
                                                            placeholder="Phone">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="business_name" id="business_name"
                                                            class="form-control" value="{{ old('business_name') }}"
                                                            placeholder="Business Name">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Your Message">{{ old('message') }}</textarea>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        {!! htmlFormSnippet() !!}
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <button type="submit" class="default-btn">Submit
                                                        <span></span></button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Insurance Details Area -->



@stop
