@extends('frontend.layouts.app')
@section('title', 'Mobile Phone Protection')
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

        .step-count {
            text-transform: capitalize;
            font-weight: 700;
            color: #999;
        }

        /*.step-heading {
                    !*font-size: 20px;*!
                    !*font-weight: 600;*!
                    !*color: #444;*!
                    !*line-height: 24px;*!
                }

                .step-content {
                    !*font-size: 1.2rem;*!
                    !*line-height: 1.1;*!

                }
                .clam-process-img {
                    width: 85px;
                    height: 140px;
                }*/
        .paymentBox {
            border: 1px solid rgb(253 186 19 / 30%);
            padding: 10px;
            min-height: 500px;
        }

        .paymentBox img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
        }

        .sectionTitle {
            text-align: center;
            color: #002e5b;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 26px;
            position: relative;
            padding-top: 2rem;
        }

        .sectionTitle::after {
            content: "";
            width: 50px;
            border-bottom: 3px solid #002e5b;
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translateX(-50%);
        }

        .box .icon {
            font-size: 65px;
            transition: 0.5s;
            position: relative;
            z-index: 1;
            margin-top: -15px;
            margin-bottom: 12px;
            width: 100px;
            height: 100px;
            line-height: 100px;
            display: inline-block;
            background: #e9ecef;
            border-radius: 50%;
        }

        .box .icon i {
            border: 0px solid;
            padding: 10px;
            border-radius: 0;
            width: 80%;
            height: 80%;
            text-align: center;
        }

        .single-services-box figure {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .single-services-box figure img {
            width: 30%;
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
                        <h2>Mobile Phone Protection</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Mobile Phone Protection</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->




    <!-- Start Insurance Details Area -->
    <section class="insurance-details-area mt-5 mb-5">
        <div class="container">
            <div class="insurance-details-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="content">

                            <blockquote class="blockquote">
                                <h6>
                                    You're Gonna Drop Your Phone either on Floor or in Water
                                </h6>
                            </blockquote>



                            <p class="text-justify">
                                When you do, instasure covers the cost to fix your phone. No hidden fees. No Hassles.
                            </p>
                            <p class="text-justify">
                                Traditional Device Protection Programs are expensive, full of hidden fees, complicated, and
                                overly
                                time consuming.
                            </p>
                            <p class="text-justify">
                                So, we decided to turn the old model on its head and created a Device Protection Program
                                that is low cost, simple to understand, and provides Bangladeshi's the coverage they really
                                need. We cover whatever breaks or damage including theft.
                            </p>

                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <h4 class="text-center">
                            Insurance Coverage for your Phones
                        </h4>
                        <div class="image text-center">
                            <img src="{{ asset('frontend/assets/img/products/phone-1.jpg') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="insurance-details-desc">

            </div>
        </div>
    </section>
    <!-- End Insurance Details Area -->
    <!--  Our Protection Plans -->
    <div class="container">
        <div class="row">
            <h2 class="sectionTitle">
                Our Protection Plans
            </h2>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon">
                        <i class="flaticon-home-insurance"></i>
                    </div>
                    <h3>SCREEN PROTECTION</h3>
                    <p>12 months Validity - 1 or 2 Times</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon">
                        <i class="flaticon-insurance"></i>
                    </div>
                    <h3>DAMAGE</h3>
                    <p>12 months validity - multiple times</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <div class="icon">
                        <i class="flaticon-health-insurance"></i>
                    </div>
                    <h3>THEFT</h3>
                    <p>12 months validity - Depreciated Value.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Protection Plans -->

    <!-- Our Claim Conditions -->

    <div class="container">
        <div class="row">
            <h2 class="sectionTitle">
                Our Claim Conditions
            </h2>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <figure>
                        <img src="{{ asset('frontend/assets/img/products/approved.png') }}" alt="approved.png">
                    </figure>
                    <h3>APPROVAL</h3>
                    <p>Typical Claim approval time is max 24 hours</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <figure>
                        <img src="{{ asset('frontend/assets/img/products/deductibles.png') }}" alt="deductibles.png">
                    </figure>
                    <h3>DEDUCTIBLES</h3>
                    <p>500 tk or 10% of the claim value (whichever is lower)</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-services-box">
                    <figure>
                        <img src="{{ asset('frontend/assets/img/products/service-center.png') }}" alt="service-center.png">
                    </figure>
                    <h3>SERVICE CENTER</h3>
                    <p>Only authorized service center is allowed to provide service</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Claim Conditions -->

    <div class="container">
        <div class="insurance-details-header">

            <div class="row align-items-center">

                <div class="col-lg-5 col-md-5 mt-5">
                    <div class="image text-center">
                        <img src="{{ asset('frontend/assets/img/products/dropped-my-mobile-1.jpg') }}" alt="image">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mt-5">
                    <div class="content">
                        <div class="">
                            <h3>What's great about Mobile Phone Insurance by InstaSure?
                            </h3>
                        </div>
                        <div class="content-list">
                            <div>
                                <ul class="list-menu list-menu--check">
                                    <li class="list-menu__item"><b>New &amp; Used phones</b> - Now mobile insurance for
                                        brand new phones as well as old/used ones (max 13 months).
                                    </li>
                                    <li class="list-menu__item">
                                        <b>
                                            Screen/Physical and Liquid Damage/Theft covered
                                        </b>
                                        - Screen damages are the most common of all heartbreaks! All screen damages due to
                                        accidental or liquid damage are covered! Also any other physical or liquid damage to
                                        phone set and theft is also covered under different protection plan.
                                    </li>
                                    <li class="list-menu__item">
                                        <b>
                                            Low prices
                                        </b>
                                        - Buy this mobile insurance cover at almost the cost of a Screen Guard !
                                    </li>
                                    <li class="list-menu__item">
                                        <b>
                                            Country wide cover
                                        </b>
                                        - Travel around the country worry-free. Our mobile insurance policy is valid
                                        everywhere.
                                    </li>
                                    <li class="list-menu__item">
                                        <b>
                                            IMEI and NID linked cover
                                        </b>
                                        - Whether you use the phone or your family or friend does, this mobile insurance
                                        policy will be valid for all. It is linked to the IMEI of the phone & NID of a
                                        family member.
                                    </li>
                                    <li class="list-menu__item">
                                        <b>
                                            Protection up to Sum Insured
                                        </b>
                                        - At the time of buying, we will show you an amount, called Sum Insured. Post claim
                                        approval, you can get your repair costs reimbursed up to your respective sum
                                        insured.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 mt-5">
                    <div class="content text-center">
                        <h3>Buying is as easy as 1-2-3</h3>
                    </div>
                </div>
                <div class="row mt-3">

                    <div class="col-lg-4 col-md-4">
                        <div class="paymentBox">
                            <img src="{{ asset('frontend/assets/img/products/android-mobile-phone-details-menu.jpg') }}"
                                alt="image" style="height: 54%;">
                            <p class="step-count text-center">STEP 1</p>
                            <div class="step-heading">
                                <strong>
                                    A quick 'Screen Test' of your phone
                                </strong>
                            </div>
                            <p class="step-content">
                                For new phone, ask your seller for insurance while buying the phone.
                            </p>
                            <p class="step-content">
                                For old phone (upto 13 months) download our app using.
                                <a href="https://prod-digitapp.godigit.com/S_DigitApp/mobile/Reinspection?policyNumber="
                                    target="_blank" title="Download Digit Insurance App" rel="nofollow">this link</a>.
                                This will allow us to check for any internal or external damages on your mobile screen.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="paymentBox">
                            <img src="{{ asset('frontend/assets/img/products/external-check.jpg') }}" alt="image">
                            <p class="step-count text-center">STEP 2</p>
                            <div class="step-heading"><strong>An External Check</strong></div>
                            <p class="step-content">Go to nearest authorized sales agent for external check. He will also
                                give you cost to buy different type of insurance.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="paymentBox">
                            <img src="{{ asset('frontend/assets/img/products/complete-payment.jpg') }}" alt="image">
                            <p class="step-count text-center">STEP 3</p>
                            <div class="step-heading"><strong>Complete Payment</strong></div>
                            <p class="step-content">Choose the type of protection you want to buy and make payment to
                                seller. We will email your mobile insurance policy document to you, as soon as you've
                                completed your payment.</p>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 mt-5">
                        <div class="image text-center">
                            <img src="{{ asset('frontend/assets/img/products/claims.jpg') }}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mt-5">
                        <div class="content">
                            <div class="">
                                <h3>And, how to Claim for your Mobile Insurance?</h3>
                            </div>
                            <div class="content-list">
                                <div>
                                    <ul class="list-menu ">
                                        <li class="list-menu__item">
                                            <b>
                                                Step 1 - Tell us about your heartbreak:
                                            </b>
                                            <span></span>
                                            Call us at 096 06 252525 within 24 hours of the accident or fill up the claim
                                            form on our web site www.instasure.xyz
                                            </span>

                                        </li>
                                        <li class="list-menu__item">
                                            <b>
                                                Step 2 - Go to Nearest Service center:
                                            </b>
                                            <span>
                                                You can also raise claim by visiting nearest authorized service center.
                                            </span>
                                        </li>
                                        <li class="list-menu__item">
                                            <b>
                                                Step 3 - Pay Deductibles:

                                            </b>
                                            <span>
                                                Once your claim is approved, pay deductibles and get your phone repaired.
                                                Service Center will bill us directly for rest 90%.
                                            </span>
                                        </li>
                                        <li class="list-menu__item">
                                            <b>
                                                Step 4 - For Theft:
                                            </b>
                                            <span>
                                                Go to our web site, fill up the claim form and attach scan copy of FIR and
                                                sim replacement copy. Once approved, send original FIR and SIM replacement
                                                copy to our address. You will get payment according to depreciated value
                                                within 20 working days.
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
