@extends('frontend.layouts.app')
@section('title', 'Home')
<!-- Start Main Banner Area -->
@section('content')
    <div class="home-area home-slides owl-carousel owl-theme">
        @foreach ($sliders as $slider)
            <div class="main-banner " style="background-image: url({{ asset('/' . $slider->image) }})">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="main-banner-content" style="margin-top: -20%">
                                <span class="sub-title">{{ $slider->title }}</span>
                                <h2 style="color: #ffffff !important;">{{ $slider->content }}</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End Main Banner Area -->

    <!-- Start Services Boxes Area -->
    <section class="services-boxes-area bg-f8f8f8">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <div class="image">
                            <img src="{{ asset('frontend/assets/img/featured-services-image/1.jpg') }}" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Pricing</a></h3>
                            <p>Economical and cost-effective as the company is fully digital</p>

                            <div class="icon">
                                <img src="{{ asset('frontend/assets/img/icon1.png') }}" alt="image">
                            </div>
                            <div class="shape">
                                <img src="{{ asset('frontend/assets/img/umbrella.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-box">
                        <div class="image">
                            <img src="{{ asset('frontend/assets/img/featured-services-image/2.jpg') }}" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Buying process </a></h3>
                            <p>As simple as top up ur phone or buying a book online</p>

                            <div class="icon">
                                <img src="{{ asset('frontend/assets/img/icon2.png') }}" alt="image">
                            </div>
                            <div class="shape">
                                <img src="{{ asset('frontend/assets/img/umbrella.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                    <div class="single-box">
                        <div class="image">
                            <img src="{{ asset('frontend/assets/img/featured-services-image/3.jpg') }}" alt="image">
                        </div>

                        <div class="content">
                            <h3><a href="#">Claims</a></h3>
                            <p>Smooth sailing throughout the claiming process</p>

                            <div class="icon">
                                <img src="{{ asset('frontend/assets/img/icon3.png') }}" alt="image">
                            </div>
                            <div class="shape">
                                <img src="{{ asset('frontend/assets/img/umbrella.png') }}" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Boxes Area -->

    <!-- Start About Area -->
    <section class="about-area ptb-100 bg-f8f8f8">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="about-title">
                        <img src="{{ asset('frontend/assets/img/about-image/pexels-juan-mendez-1536619.jpg') }}"
                            alt="aamr-pay">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-text">
                        <h3>Touching Lives</h3>
                        <p class="text-justify" style="font-family: Georgia">
                            With the purpose of breaking the 0.4% insurance penetration barrier in Bangladesh, we built the first-ever 'insurance-as-a-service' platform in Bangladesh capable of meeting the rapidly evolving needs of today's Gen Z.  Using our API, Insurers can be in the right place at the right time by embedding in products or platforms with large customer bases, serving them relevant insurance products at point of sale or at other appropriate times in the customer life cycle. With the ability to access relevant data, perform real time risk assessments, and set prices accordingly, insurers can embed their products virtually anywhere there is risk.                        </p>

                        <a href="{{ route('about') }}" class="read-more-btn">More About Us <i
                                class="flaticon-right-chevron"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Area -->

    <!-- Start Services Area -->
    <section class="services-area pt-5 pb-70">
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-5">An Embedded Insurtech Platform</h2>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-home-insurance"></i>
                        </div>
                        <p>Partner-friendly API -Integrate insurance products into your technology system with ease.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-insurance"></i>
                        </div>
                        <p>Integrated Know-Your-Customer workflow - Reducing response time, and improving customer
                            satisfaction.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-medal"></i>
                        </div>
                        <p>Dynamic pricing model and real-time risk engine -Our dynamic pricing model and real-time risk
                            engine ensure that customers enjoy competitive rates on their insurance and get value-for-money.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="single-services-box">
                        <div class="icon">
                            <i class="flaticon-target"></i>
                        </div>
                        <p>Smart claims management system- Claims are the heart of an insurance product. Our smart claims
                            management system makes claims submission transparent, fair and fast.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Area -->


    <!-- Start Services Area -->
    {{-- <section class="services-area bg-f8f8f8 pb-70"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="services-slides owl-carousel owl-theme"> --}}
    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-travel-insurance"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Travel Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}
    {{-- </div> --}}
    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-call"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Gadget Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-car-insurance"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Car Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-home-insurance"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Home Appliances Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-health-insurance"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Health Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-agriculture"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Agri Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-services-box"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-life-insurance"></i> --}}

    {{-- <div class="icon-bg"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/icon-bg2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <h3><a href="#">Life Insurance</a></h3> --}}

    {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod incididunt ut incididunt labore et dolore.</p> --}}

    {{-- <a href="#" class="read-more-btn">Learn More</a> --}}

    {{-- <div class="box-shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape1.png')}}" alt="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/box-shape2.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Services Area -->

    <!-- Start Why Choose Us Area -->
    <section class="why-choose-us-area">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-5 col-md-12"> --}}
                {{-- <div class="why-choose-us-slides owl-carousel owl-theme"> --}}
                {{-- <div class="why-choose-us-image bg1"> --}}
                {{-- <img src="{{asset('frontend/assets/img/why-choose-img1.jpg')}}" alt="image"> --}}
                {{-- </div> --}}

                {{-- <div class="why-choose-us-image bg2"> --}}
                {{-- <img src="{{asset('frontend/assets/img/why-choose-img2.jpg')}}" alt="image"> --}}
                {{-- </div> --}}

                {{-- <div class="why-choose-us-image bg3"> --}}
                {{-- <img src="{{asset('frontend/assets/img/why-choose-img3.jpg')}}" alt="image"> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}

                <div class="col-lg-12 col-md-12">
                    <div class="why-choose-us-content">
                        <div class="content">
                            <div class="title">
                                <span class="sub-title">Your Benefits</span>
                                <h2>Why Choose Us</h2>
                                <p class="para">
                                    Traditional insurance companies make it hard for you to get anything out of them. That's
                                    because when you benefit, they lose out. We hate that, so we've reinvented insurance to
                                    align our interests with yours. Inspired by the origins of insurance, it is all powered
                                    by cutting edge tech that makes it feel like magic while pushing away the pesky
                                    fraudsters. At last, insurance that works like a dream instead of a nightmare.
                                </p>
                            </div>

                            <ul class="features-list">
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-like"></i>
                                    </div>
                                    <span>Fast & Easy </span>
                                    Sign-up and claims are effortless because our system's designed for you, not against
                                    you.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-customer-service"></i>
                                    </div>
                                    <span>Easy Communication </span>
                                    As simple as reading a comic book.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-care"></i>
                                    </div>
                                    <span>No Paperwork </span>
                                    No paperwork, Maximum convenience
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-team"></i>
                                    </div>
                                    <span>Fair & Transparent </span>
                                    You'll never feel uncertain; we have your back and will explain what's what in plain
                                    Bangla.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-policy"></i>
                                    </div>
                                    <span>Faster claim </span>
                                    Our simple, one-step process makes it very easy for you to lodge claims within 60
                                    seconds. 24x7 through our web site/ app /call center.
                                </li>

                                <li>
                                    <div class="icon">
                                        <i class="flaticon-education"></i>
                                    </div>
                                    <span>More TLC, Less T&C </span>
                                    No hidden clauses, jargon free documents in simple language.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Why Choose Us Area -->



    <!-- Start Blog Area -->
    {{-- <section class="blog-area ptb-100 pb-0"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="section-title"> --}}
    {{-- <span class="sub-title">Your Benefits</span> --}}
    {{-- <h2>WHY CHOOSE US</h2> --}}
    {{-- <p>Traditional insurance companies make it hard for you to get anything out of them. That's because when you benefit, they lose out. We hate that, so we've reinvented insurance to align our interests with yours. Inspired by the origins of insurance, it is all powered by cutting edge tech that makes it feel like magic while pushing away the pesky fraudsters. At last, insurance that works like a dream instead of a nightmare.</p> --}}
    {{-- </div> --}}

    {{-- <div class="row"> --}}
    {{-- <div class="col-lg-6 col-md-6"> --}}
    {{-- <div class="single-blog-post"> --}}
    {{-- <div class="why-choose-us-content"> --}}
    {{-- <div class="content"> --}}
    {{-- <ul class="features-list"> --}}
    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-like"></i> --}}
    {{-- </div> --}}
    {{-- <span>Fast & Easy </span> --}}
    {{-- Sign-up and claims are effortless because our system's designed for you, not against you. --}}
    {{-- </li> --}}

    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-customer-service"></i> --}}
    {{-- </div> --}}
    {{-- <span>Easy Communication </span> --}}
    {{-- As simple as reading a comic book. --}}
    {{-- </li> --}}

    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-care"></i> --}}
    {{-- </div> --}}
    {{-- <span>No Paperwork </span> --}}
    {{-- No paperwork, Maximum convenience --}}
    {{-- </li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- <div class="col-lg-6 col-md-6"> --}}
    {{-- <div class="single-blog-post"> --}}
    {{-- <div class="why-choose-us-content"> --}}
    {{-- <div class="content"> --}}
    {{-- <ul class="features-list"> --}}
    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-team"></i> --}}
    {{-- </div> --}}
    {{-- <span>Fair & Transparent </span> --}}
    {{-- You'll never feel uncertain; we have your back and will explain what's what in plain Bangla. --}}
    {{-- </li> --}}

    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-policy"></i> --}}
    {{-- </div> --}}
    {{-- <span>Faster claim </span> --}}
    {{-- Our simple, one-step process makes it very easy for you to lodge claims within 60 seconds. 24x7 through our web site/ app /call center. --}}
    {{-- </li> --}}

    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-education"></i> --}}
    {{-- </div> --}}
    {{-- <span>More TLC, Less T&C </span> --}}
    {{-- No hidden clauses, jargon free documents in simple language. --}}
    {{-- </li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Blog Area -->




    <!-- Start Partner Area -->
    <section class="partner-area">
        <div class="container">
            <div class="partner-title">
                <h2>Our trusted partners</h2>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    @php
                        $partner = \App\Model\Partner::where('name', 'Delta Life')->first();
                    @endphp
                    <img src="{{ asset('uploads/partners/' . $partner->image) }}" alt="aamr-pay">
                </div>
            </div>
        </div>
    </section>
    <!-- End Partner Area -->

    <!-- Start Quote Area -->
    {{-- <section class="quote-area ptb-100"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="row align-items-center"> --}}
    {{-- <div class="col-lg-6 col-md-12"> --}}
    {{-- <div class="quote-content"> --}}
    {{-- <h2>Get a free quote</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}

    {{-- <div class="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/img1.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-6 col-md-12"> --}}
    {{-- <div class="tab quote-list-tab"> --}}
    {{-- <ul class="tabs"> --}}
    {{-- <li><a href="index.html">Home</a></li> --}}
    {{-- <li><a href="#">Business</a></li> --}}
    {{-- <li><a href="#">Health</a></li> --}}
    {{-- <li><a href="#">Car</a></li> --}}
    {{-- <li><a href="#">Life</a></li> --}}
    {{-- </ul> --}}

    {{-- <div class="tab_content"> --}}
    {{-- <div class="tabs_item"> --}}
    {{-- <p>Our experts will reply you with a quote very soon</p> --}}
    {{-- <form> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Name"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="email" class="form-control" placeholder="Your Email"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Phone"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <select> --}}
    {{-- <option value="1">Property Used For</option> --}}
    {{-- <option value="2">Home Insurance</option> --}}
    {{-- <option value="0">Business Insurance</option> --}}
    {{-- <option value="3">Health Insurance</option> --}}
    {{-- <option value="4">Travel Insurance</option> --}}
    {{-- <option value="5">Car Insurance</option> --}}
    {{-- <option value="6">Life Insurance</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <button type="submit" class="default-btn">Get A Free Quote <span></span></button> --}}
    {{-- </form> --}}
    {{-- </div> --}}

    {{-- <div class="tabs_item"> --}}
    {{-- <p>Our experts will reply you with a quote very soon</p> --}}
    {{-- <form> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Name"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="email" class="form-control" placeholder="Your Email"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Phone"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <select> --}}
    {{-- <option value="1">Property Used For</option> --}}
    {{-- <option value="2">Home Insurance</option> --}}
    {{-- <option value="0">Business Insurance</option> --}}
    {{-- <option value="3">Health Insurance</option> --}}
    {{-- <option value="4">Travel Insurance</option> --}}
    {{-- <option value="5">Car Insurance</option> --}}
    {{-- <option value="6">Life Insurance</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <button type="submit" class="default-btn">Get A Free Quote <span></span></button> --}}
    {{-- </form> --}}
    {{-- </div> --}}

    {{-- <div class="tabs_item"> --}}
    {{-- <p>Our experts will reply you with a quote very soon</p> --}}
    {{-- <form> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Name"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="email" class="form-control" placeholder="Your Email"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Phone"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <select> --}}
    {{-- <option value="1">Property Used For</option> --}}
    {{-- <option value="2">Home Insurance</option> --}}
    {{-- <option value="0">Business Insurance</option> --}}
    {{-- <option value="3">Health Insurance</option> --}}
    {{-- <option value="4">Travel Insurance</option> --}}
    {{-- <option value="5">Car Insurance</option> --}}
    {{-- <option value="6">Life Insurance</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <button type="submit" class="default-btn">Get A Free Quote <span></span></button> --}}
    {{-- </form> --}}
    {{-- </div> --}}

    {{-- <div class="tabs_item"> --}}
    {{-- <p>Our experts will reply you with a quote very soon</p> --}}
    {{-- <form> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Name"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="email" class="form-control" placeholder="Your Email"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Phone"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <select> --}}
    {{-- <option value="1">Property Used For</option> --}}
    {{-- <option value="2">Home Insurance</option> --}}
    {{-- <option value="0">Business Insurance</option> --}}
    {{-- <option value="3">Health Insurance</option> --}}
    {{-- <option value="4">Travel Insurance</option> --}}
    {{-- <option value="5">Car Insurance</option> --}}
    {{-- <option value="6">Life Insurance</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <button type="submit" class="default-btn">Get A Free Quote <span></span></button> --}}
    {{-- </form> --}}
    {{-- </div> --}}

    {{-- <div class="tabs_item"> --}}
    {{-- <p>Our experts will reply you with a quote very soon</p> --}}
    {{-- <form> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Name"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="email" class="form-control" placeholder="Your Email"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <input type="text" class="form-control" placeholder="Your Phone"> --}}
    {{-- </div> --}}
    {{-- <div class="form-group"> --}}
    {{-- <select> --}}
    {{-- <option value="1">Property Used For</option> --}}
    {{-- <option value="2">Home Insurance</option> --}}
    {{-- <option value="0">Business Insurance</option> --}}
    {{-- <option value="3">Health Insurance</option> --}}
    {{-- <option value="4">Travel Insurance</option> --}}
    {{-- <option value="5">Car Insurance</option> --}}
    {{-- <option value="6">Life Insurance</option> --}}
    {{-- </select> --}}
    {{-- </div> --}}
    {{-- <button type="submit" class="default-btn">Get A Free Quote <span></span></button> --}}
    {{-- </form> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Quote Area -->

    <!-- Start CTR Area -->
    {{-- <section class="ctr-area"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="ctr-content"> --}}
    {{-- <h2>Insurances for mobile phone</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
    <a href="contact.html" class="default-btn">Get a Quote <i class="flaticon-right-chevron"></i><span></span></a>
</div> --}}
    {{-- <div class="ctr-image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/ctr-img.jpg')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- <div class="shape"> --}}
    {{-- <img src="{{asset('frontend/assets/img/bg-dot3.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End CTR Area -->

    <!-- Start Feedback Area -->
    <section class="feedback-area ptb-100">
        <div class="container">
            <div class="section-title">
                {{-- <span class="sub-title">Our Feedback</span> --}}
                <h3>Our Clients Feedback</h3>
                {{-- <p>I was able to easily file a claim online.</p> --}}
            </div>

            <div class="feedback-slides">
                <div class="client-feedback">
                    <div>
                        <div class="item">
                            <div class="single-feedback">
                                <p>“My phone arrived very quickly. Plus, the new phone works great! Service was
                                    exceptionally fast convenient and easy!!! Thank you very much awesome customer service
                                    !!!”</p>
                            </div>
                        </div>
                    </div>

                    <button class="prev-arrow slick-arrow">
                        <i class='flaticon-left-chevron'></i>
                    </button>

                    <button class="next-arrow slick-arrow">
                        <i class='flaticon-right-chevron'></i>
                    </button>
                </div>

                {{-- <div class="client-thumbnails">
                    <div>
                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/2.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>Jonus Nathan</h3>
                                <span>CEO at Envato</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/4.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>Sadio Finn</h3>
                                <span>CEO at FlatIcon</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/1.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>Tom Olivar</h3>
                                <span>CEO at ThemeForest</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/5.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>James Finn</h3>
                                <span>CEO at GitLab</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/1.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>John Lucy</h3>
                                <span>CEO at Linkedin</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/3.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>Sarah Taylor</h3>
                                <span>CEO at Twitter</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/5.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>James Anderson</h3>
                                <span>CEO at Facebook</span>
                            </div>
                        </div>

                        <div class="item">
                            <div class="img-fill"><img src="{{asset('frontend/assets/img/client-image/3.jpg')}}" alt="client"></div>

                            <div class="title">
                                <h3>Steven Smith</h3>
                                <span>CEO at EnvyTheme</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- End Feedback Area -->




    <!-- Start Our Mission Area -->
    {{-- <section class="our-mission-area"> --}}
    {{-- <div class="container-fluid p-0"> --}}
    {{-- <div class="row m-0"> --}}
    {{-- <div class="col-lg-6 col-md-6 p-0"> --}}
    {{-- <div class="mission-text"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-target"></i> --}}
    {{-- </div> --}}
    {{-- <h3>Our Mission</h3> --}}
    {{-- <p> --}}
    {{-- InstaSure is a part of DNS Group. A 30 years old IT conglomerate who always worked to bring new technology and services in Bangladesh from 1992. Read More (www.dnsgroup.net) --}}
    {{-- </p> --}}
    {{-- <a href="#" class="default-btn">Learn More <span></span></a> --}}
    {{-- <div class="shape"><img src="{{asset('frontend/assets/img/bg-dot2.png')}}" alt="image"></div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- <div class="col-lg-6 col-md-6 p-0"> --}}
    {{-- <div class="mission-text"> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-medal"></i> --}}
    {{-- </div> --}}
    {{-- <h3>Our History</h3> --}}
    {{-- <p> --}}
    {{-- instaSure is a part of DNS Group. A 30 years old IT conglomerate who always worked to bring new technology and services in Bangladesh from 1992. Read More (www.dnsgroup.net) --}}
    {{-- </p> --}}
    {{-- <a href="about.html" class="default-btn">Learn More <span></span></a> --}}
    {{-- <div class="shape"><img src="{{asset('frontend/assets/img/bg-dot2.png')}}" alt="image"></div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Our Mission Area -->

    <!-- Start Team Area -->
    {{-- <section class="team-area ptb-100 pb-70"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="section-title"> --}}
    {{-- <span class="sub-title">Our Agent</span> --}}
    {{-- <h2>Meet Our Experts</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}
    {{-- </div> --}}

    {{-- <div class="team-slides owl-carousel owl-theme"> --}}
    {{-- <div class="single-team-box"> --}}
    {{-- <div class="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/team-image/2.jpg')}}" alt="image"> --}}

    {{-- <ul class="social"> --}}
    {{-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-instagram"></i></a></li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}

    {{-- <div class="content"> --}}
    {{-- <h3>Lee Munroe</h3> --}}
    {{-- <span>CEO & Founder</span> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-team-box"> --}}
    {{-- <div class="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/team-image/3.jpg')}}" alt="image"> --}}

    {{-- <ul class="social"> --}}
    {{-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-instagram"></i></a></li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}

    {{-- <div class="content"> --}}
    {{-- <h3>Calvin Klein</h3> --}}
    {{-- <span>Underwriter</span> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-team-box"> --}}
    {{-- <div class="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/team-image/4.jpg')}}" alt="image"> --}}

    {{-- <ul class="social"> --}}
    {{-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-instagram"></i></a></li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}

    {{-- <div class="content"> --}}
    {{-- <h3>Sarah Taylor</h3> --}}
    {{-- <span>Agent</span> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="single-team-box"> --}}
    {{-- <div class="image"> --}}
    {{-- <img src="{{asset('frontend/assets/img/team-image/1.jpg')}}" alt="image"> --}}

    {{-- <ul class="social"> --}}
    {{-- <li><a href="#"><i class="fab fa-facebook-f"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-twitter"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li> --}}
    {{-- <li><a href="#"><i class="fab fa-instagram"></i></a></li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}

    {{-- <div class="content"> --}}
    {{-- <h3>Alastair Cook</h3> --}}
    {{-- <span>Risk Manager</span> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Team Area -->

    <!-- Start Our Achievements Area -->
    {{-- <section class="achievements-area"> --}}
    {{-- <div class="container-fluid"> --}}
    {{-- <div class="row"> --}}
    {{-- <div class="col-lg-6 col-md-12"> --}}
    {{-- <div class="achievements-content"> --}}
    {{-- <div class="title"> --}}
    {{-- <span class="sub-title">Number</span> --}}
    {{-- <h2>Our Achievements</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}
    {{-- </div> --}}

    {{-- <div class="row"> --}}
    {{-- <div class="col-lg-4 col-md-4 col-6 col-sm-4"> --}}
    {{-- <div class="single-funfact"> --}}
    {{-- <i class="flaticon-flag"></i> --}}
    {{-- <h3><span class="odometer" data-count="65">00</span></h3> --}}
    {{-- <p>Countries</p> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 col-md-4 col-6 col-sm-4"> --}}
    {{-- <div class="single-funfact"> --}}
    {{-- <i class="flaticon-group"></i> --}}
    {{-- <h3><span class="odometer" data-count="107">00</span> <span class="sign-icon">m</span></h3> --}}
    {{-- <p>Clients</p> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 col-md-4 col-12 col-sm-4"> --}}
    {{-- <div class="single-funfact"> --}}
    {{-- <i class="flaticon-medal"></i> --}}
    {{-- <h3><span class="odometer" data-count="150">00</span></h3> --}}
    {{-- <p>Wining Awards</p> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="bg-dot"><img src="{{asset('frontend/assets/img/bg-dot.png')}}" alt="image"></div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-6 col-md-12"> --}}
    {{-- <div class="divider"></div> --}}
    {{-- <div class="achievements-image-slides owl-carousel owl-theme"> --}}
    {{-- <div class="single-achievements-image bg1"> --}}
    {{-- <img src="{{asset('frontend/assets/img/achievements-img1.jpg')}}" alt="image"> --}}
    {{-- </div> --}}

    {{-- <div class="single-achievements-image bg2"> --}}
    {{-- <img src="{{asset('frontend/assets/img/achievements-img2.jpg')}}" alt="image"> --}}
    {{-- </div> --}}

    {{-- <div class="single-achievements-image bg3"> --}}
    {{-- <img src="{{asset('frontend/assets/img/achievements-img3.jpg')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Our Achievements Area -->

    <!-- Start Blog Area -->
    {{-- <section class="blog-area ptb-100 pb-0"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="section-title"> --}}
    {{-- <span class="sub-title">Our Blog</span> --}}
    {{-- <h2>News And Insights</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}
    {{-- </div> --}}

    {{-- <div class="row"> --}}
    {{-- <div class="col-lg-4 col-md-6"> --}}
    {{-- <div class="single-blog-post"> --}}
    {{-- <div class="post-image"> --}}
    {{-- <a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/1.jpg')}}" alt="image"></a> --}}

    {{-- <div class="date"><i class="flaticon-timetable"></i> Oct 14, 2021</div> --}}
    {{-- </div> --}}

    {{-- <div class="post-content"> --}}
    {{-- <h3><a href="single-blog.html">2021 Insurance Trends And Possible Challenges</a></h3> --}}
    {{-- <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p> --}}

    {{-- <a href="single-blog.html" class="default-btn">Read More <span></span></a> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 col-md-6"> --}}
    {{-- <div class="single-blog-post"> --}}
    {{-- <div class="post-image"> --}}
    {{-- <a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/2.jpg')}}" alt="image"></a> --}}

    {{-- <div class="date"><i class="flaticon-timetable"></i> Oct 10, 2021</div> --}}
    {{-- </div> --}}

    {{-- <div class="post-content"> --}}
    {{-- <h3><a href="single-blog.html">Global Trends in the Life Insurance Industry</a></h3> --}}
    {{-- <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p> --}}

    {{-- <a href="single-blog.html" class="default-btn">Read More <span></span></a> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0"> --}}
    {{-- <div class="single-blog-post"> --}}
    {{-- <div class="post-image"> --}}
    {{-- <a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/3.jpg')}}" alt="image"></a> --}}

    {{-- <div class="date"><i class="flaticon-timetable"></i> Sep 13, 2021</div> --}}
    {{-- </div> --}}

    {{-- <div class="post-content"> --}}
    {{-- <h3><a href="single-blog.html">The Best Car Insurance Companies in 2021</a></h3> --}}
    {{-- <p>Luis ipsum suspendisse ultrices. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p> --}}

    {{-- <a href="single-blog.html" class="default-btn">Read More <span></span></a> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-12 col-md-12"> --}}
    {{-- <div class="blog-notes"> --}}
    {{-- <p>Insights to help you do what you do better, faster and more profitably. <a href="#">Read Full Blog</a></p> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Blog Area -->

    <!-- Start Join Area -->
    {{-- <section class="join-area"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="row align-items-center"> --}}
    {{-- <div class="col-lg-5 col-md-12"> --}}
    {{-- <div class="join-image text-center"> --}}
    {{-- <img src="{{asset('frontend/assets/img/woman.png')}}" alt="image"> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-7 col-md-12"> --}}
    {{-- <div class="join-content"> --}}
    {{-- <h2>Great Place to Work</h2> --}}
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p> --}}

    {{-- <a href="contact.html" class="default-btn">Join Now <i class="flaticon-right-chevron"></i><span></span></a> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </section> --}}
    <!-- End Join Area -->
@stop()
