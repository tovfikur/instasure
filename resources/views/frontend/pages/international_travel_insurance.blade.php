@extends('frontend.layouts.app')
@section('title', 'International Travel Insurance')
@push('css')
    <style>
        p {
            text-align: justify;
        }


        .page-title-bg1 {
            background-image: url({{ asset('frontend/assets/img/bradcum/breadcum3.jpg') }});
        }


        .hero {
            padding: 50px 75px;
            background: rgb(233 236 239);
            margin-top: 25px;
            transition: all .3s linear;
        }

        .hero:hover {

            background: rgba(233, 236, 239, .5);

        }

        .hero .title {
            font-size: 24px;
            color: #747a7e;
            line-height: 35px;
            margin-bottom: 15px;
        }

        .hero .description {
            margin-bottom: 20px;

        }

        .hero .btn_animate {
            font-size: 14px;
            padding: 15px;
            text-align: center;
            background: #fc8465;
            border: none;
            color: #fff;
            font-stretch: expanded;
            transition: all .2s linear;
            width: 150px;
            position: relative;
        }



        .alignCenter {
            position: absolute;
            left: 50%;
            top: 70%;
            transform: translateX(-50%);
        }

        .hero figure {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;

        }

        .hero figure img {
            height: 350px;
            width: 100%;
            border: 1px solid #decfce;
            border-radius: 3px;
            padding: 5px;
        }

        .imgThumb {
            border: 1px solid #e9ecef;
            background: #f9fafb;
            padding: 10px;
            border-radius: 5px;
            height: 400px;
            object-fit: cover;
            object-position: center;
            width: 100%;

        }

        .box {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 3rem;
            align-items: stretch;
            transition: .5s linear;
        }

        .box .content {
            flex: 1 1 50%;
        }

        .box .figure {
            flex: 1 1 50%;
        }


        @media only screen and (max-width: 767px) {
            .hero {
                padding: 50px 15px;
            }

            .hero figure {
                margin-bottom: 20px;

            }

            .box {
                flex-direction: column;
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
                        <h2>International Travel Insurance</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>International Travel Insurance</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <div class="container ">
        <div class="hero">
            <div class="row">
                <div class="col-md-6">
                    <figure>
                        <img src="{{ asset('frontend/assets/img/products/international-main-sm.jpg') }}" alt="aamr-pay" />
                    </figure>
                </div>

                <div class="col-md-6"
                    style="position: relative;
                                                                                                                                                display: flex;
                                                                                                                                                flex-direction: column;
                                                                                                                                                align-items: center;
                                                                                                                                                justify-content: center;">
                    <h2 class="">
                        Online travel insurance is so simple you can get it while waiting to your gate.
                    </h2>
                    <p class="description">
                        Emergency medical expcenses, flight delay reimbursement, adventure sports covers, and much more. And
                        the best part? Emergency medical expenses, flight delay reimbursement, adventure sports covers, and
                        much much more. And the best part is - with COVID Medical Coverage!!!
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-warning btn_animate ">
                        BUY NOW
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Medical coverage -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="content">
                        <p>
                            Travel Medical Insurance protects you in the event of an illness or injury when traveling
                            outside of your country of residence. It provides key medical benefits in case of an emergency.
                            Traveling abroad is an exciting experience, but unpredictable illnesses and accidents can
                            happen. Even worse, the resulting medical bills can be overwhelming. The level of international
                            medical coverage provided by your domestic insurance provider can vary greatly depending on your
                            plan, so you may have very limited coverage or no coverage at all. A travel medical insurance
                            plan can provide the coverage you need.
                        </p>
                        <p><strong>Travel medical coverage is ideal for:</strong></p>
                        <ul>
                            <li>International vacationers</li>
                            <li>Relatives visiting from overseas</li>
                            <li>People going on cruises, safaris or guided tours</li>
                            <li>International business travelers</li>
                            <li>Students studying abroad</li>

                        </ul>

                    </div>
                    <figure class="figure">
                        <img src="{{ asset('frontend/assets/img/products/travel-ins.jpg') }}" alt="travel-ins"
                            class="imgThumb">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- End Medical coverage -->


    <!-- Features Of International Travel Insurance -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <div class="figure">
                        <img src="{{ asset('frontend/assets/img/products/international-1.jpg') }}" alt="travel-ins"
                            class="imgThumb">
                    </div>
                    <div class="content">
                        <h4>
                            Features Of International Travel Insurance
                        </h4>
                        <p class="para">
                            Your International Travel Insurance Policy Provides You With Safety And Comfort While You're
                            Abroad. Here's A Look At The Features You Can Enjoy When You Purchase An International
                            Travel Insurance from InstaSure:
                        </p>
                        <p><strong>Cover For Accidents And Sickness</strong></p>
                        <p class="para">
                            Falling sick is always a terrible experience, but falling ill abroad is overwhelming. Our
                            policy will help take care of the costs associated with getting treatment when you're ill.
                            But that isn't all. An accident could lead to a short hospitalisation or could end up being
                            fatal. Whatever happens, our international travel insurance plan will help you deal with the
                            costs. From emergency medical treatment to medical evacuation and the repatriation of the
                            insured's remains, we'll take care of everything.
                        </p>

                    </div>
                </div>
                <div class="box mt-5">
                    <div class="content">
                        <p><strong>Travel Assistance</strong></p>
                        <p class="para">
                            Exploring a foreign country can be thrilling. But if something goes wrong, it can be
                            downright scary. If you need any help to identify where you can get medical treatment or how
                            to go about applying for a new passport if yours is lost or stolen, our international travel
                            insurance plan will be there for you.
                        </p>
                        <p><strong>Baggage Loss Or Delay</strong></p>
                        <p class="para">
                            If your bag is stolen, lost or delayed because it was sent to another location or
                            unintentionally left behind, you don't need to break a sweat. Our international travel
                            insurance policy will help you deal with the cost of purchasing necessary personal items or
                            reimburse you for the cost of your lost luggage.
                        </p>


                        <p><strong>Automatic Extensions </strong></p>
                        <p class="para">
                            If you happen to be hospitalised abroad when your international travel insurance policy is
                            set to expire, we'll extend it for another 60 days or until you're discharged. If your
                            flight home is delayed and there's no other way for you to get back home, we'll
                            automatically extend our cover for another 7 days, so you don't have to worry about
                            travelling without insurance.
                        </p>
                    </div>
                    <div class="figure">
                        <img src="{{ asset('frontend/assets/img/products/international-2.png') }}" alt="travel-ins"
                            class="imgThumb">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Features Of International Travel Insurance -->

    <!-- Advantages Of InstaSure International Travel Insurance -->
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <div class="figure">
                        <img src="{{ asset('frontend/assets/img/products/international-3.jpg') }}" alt="international-pay"
                            class="imgThumb">
                    </div>
                    <div class="content">
                        <h4>Advantages Of InstaSure International Travel Insurance</h4>
                        <p><strong> 1. COVID-19 Covered</strong></p>
                        <p class="para">
                            When you're travelling abroad, we'll help you take care of the cost of treatment for COVID-19 if
                            you test positive in the middle of your trip & require hospitalization
                        </p>

                        <p><strong>2. Pay In Taka Get Cover In Dollars</strong></p>
                        <p class="para">
                            When you opt for an international travel insurance policy, your premiums are in Bangladeshi
                            Taka, but you're covered in USD. So, you can rest easy knowing you'll get the cover you need at
                            an affordable cost.
                        </p>
                        <p><strong> 3. Affordable Policies</strong></p>

                        <p class="para">
                            Our international travel insurance policies start at just BDTK 50 per day! That's a small price
                            to pay for care-free travel!
                        </p>
                        <p><strong> 4. Instant Policy Purchase</strong></p>
                        <p class="para">
                            You can buy an InstaSure international travel insurance policy online with just a few easy
                            clicks. We don't need extensive paperwork on a health check-up!
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Advantages Of InstaSure International Travel Insurance -->


@stop
