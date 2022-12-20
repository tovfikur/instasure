@extends('frontend.layouts.app')
@section('title', 'About Us')
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
                        <h2>About Us</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>About Us</li>
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
                            <div class="row">
{{--                                <div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 offset-sm-3 col-sm-6">--}}
{{--                                    <div class="about-text-box">--}}
{{--                                        --}}{{-- <h3>Who we are</h3> --}}
{{--                                        <h3>ABOUT US</h3>--}}
{{--                                        <p>Traditional insurance companies make it hard for you to get anything out of them.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                                    <div class="about-text-box">--}}
{{--                                        <h3>Our Mission</h3>--}}
{{--                                        <p>Better cover for less cost and fast claim processing using technology.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                                    <div class="about-text-box">--}}
{{--                                        <h3>Our History</h3>--}}
{{--                                        <p>Better cover for less cost and fast claim processing using technology.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-lg-12 col-md-12 offset-lg-0 offset-md-0 offset-sm-0 col-sm-12">
                                    <div class="about-text-box">
                                        <h3>What is Instasure</h3>
                                        <p class="para">
                                            Insurance sector is often characterized as traditional and conservative with limited capacities for a profound transformation. However, Instasure believe digitally-enhanced services are no longer a nice-to-have and it's a shift no industry can ignore. The sector of insurance shouldn't be an exception. With the purpose of breaking the 0.4% insurance penetration barrier in Bangladesh, we built the first-ever 'insurance-as-a-service' platform in Bangladesh capable of meeting the rapidly evolving needs of today's Gen Z. Better cover for less cost and fast claim processing using technology. If this wasn't enough, Instasure is removing all excess on claims and allowing you to switch your cover off and back on with the push of a button. 
<br/>
Instasure distributes insurance products through the 'ecosystem partners', and this ecosystem is vast. From ecommerce portals selling a multitude of products to travel sites selling air tickets and tour plans, and MFIs selling small-ticket loans, everyone is a part of the ecosystem for Instasure. We thus enables large insurance companies to reach out to ecosystem partners at zero marginal cost using its proprietary embedded insurance API suite. It allows the insurance companies to help assess the risk better, streamline partner and customer interaction, enhance claim settlement as well as make transactions smooth.                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 offset-lg-0 offset-md-0 offset-sm-0 col-sm-12">
                                    <div class="about-text-box">
                                        <h3>Why Instasure</h3>
                                        <p class="para">Insurance penetration in Bangladesh in GDP percentage declined to 0.40% in 2020, from 0.49% a year ago, according to a recent sigma report by Swiss Re Institute. The number is the lowest among reported South Asian countries. India has 4.2% while Sri Lanka 1.2% of their GDP. This 0.4% penetration  rate put Bangladesh in 86th position in insurance market in the world. Bangladesh's economy is projected to reach $516.24 billion in the fiscal 2024-25, outperforming advanced economies such as Denmark, Singapore and Hong Kong along the way, says the International Monetary Fund (IMF). It is suppose to reach 1.2 Trillion USD in 2030 to become the 28th largest economy of the world.</p>
                                        <p class="para">
                                            The average insurance penetration in emerging markets increased to 3.3% in 2017 (2016: 3.2%), as premium growth continued to outpace GDP growth within these economies. Bangladesh, is one
of the countries featured on Goldman Sachs’ Next Eleven (N-11), and has been implementing regulatory reforms to reach that average number by 2030. Low insurance uptake in Bangladesh is somewhat due to the traditional distribution of insurance policies. They customarily rely on brick-and-mortar channels to sell and process policies. This takes a long processing cycle and has poor customer satisfaction and higher distribution costs.
                                        </p>
                                        <p class="para">
                                            99% of Bangladeshi's don’t buy insurance, although there are more than 52 insurance companies. We felt that building the technological infrastructure to facilitate the distribution of insurance was the best way to increase the penetration level in Bangladesh. But selling directly to consumers would be a meticulous process as they rarely buy insurance from trusted organizations, let alone a third-party company. So Instasure adopted a B2B2C approach to leverage the trust already built by platforms that converse with customers daily and innovate around it.
                                        </p>
					<p class="para">
						Instasure as an Embedded insurance company is all about distributing insurance solutions (traditional or innovative)  through third-party businesses. It is embedded within the purchasing journey of an underlying product or service it is related to and could be packaged as an add-on, a bundle, or a transaction-triggered offer.  The embedded insurance opportunity delivers the advantage of lower distribution costs through third-party ecosystem integration, relying on partner distribution capacity and customer relationships. This way, the customer is offered relevant and fully customized coverage at the point of sale, putting them in control and improving their overall experience. While in claim part ,typically it takes about 90 days for claims to be processed for an average Bangladesh insurer. Instasure is committed to reduce it to a week.
					</p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 offset-lg-0 offset-md-0 offset-sm-0 col-sm-12">
                                    <div class="about-text-box">
                                        <h3>Primary features of our Tech Platform</h3>
                                        <p class="para">
                                            Flexible Product Design - Setup any quote-offer-bind-pay flow customer  like.<br/>

Customer Journey Builder - Create user-friendly and flexible mobile-first customer journeys. <br/>

OMNI-Channel Ready -  Online shop, OEM, Fintech, Banking-app or physical shop – Integrate into any distribution channel via  web app or REST API.<br/>

Policy & Claims Admin - Manage policies and customers on our platform and process claims (FNOL).<br/>
<br/>
Instasure distributes insurance products through the 'ecosystem partners', and this ecosystem is vast. From ecommerce portals selling a multitude of products to travel sites selling air tickets and tour plans, and MFIs selling small-ticket loans, everyone is a part of the ecosystem for Instasure. We thus enables large insurance companies to reach out to ecosystem partners at zero marginal cost using its proprietary embedded insurance API suite. It allows the insurance companies to help assess the risk better, streamline partner and customer interaction, enhance claim settlement as well as make transactions smooth.                                        
					</p>

				    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 offset-lg-0 offset-md-0 offset-sm-0 col-sm-12">
                                    <div class="about-text-box">
                                        <h3>For insurance companies, we ensure -</h3>
                                        <p class="para">
                                        	End-to-End Platform- Insurance platform with pre- and after sales, white-label front-end and a product engine including payment, policy issuance, mid-term adjustment, claims, and more.<br/><br/>

Open Architecture - Micro service architecture, allowing modular service selection and flexible integration of best-in-class third-party technologies.<br/><br/>

Flexible Integration - Different operational and integration options with legacy IT, to meet your needs and match your infrastructure capabilities, from sand boxing solutions to full integration.<br/><br/>

Ongoing Optimization - Usage of analytics and real customer feedback to improve service performances and cost-effectively expand functional offering.<br/><br/>

PMO & Implementation - Guidance and advice along the entire process, from idea conceptualization all the way through product creation, testing, and launch.<br/><br/>

					</p>

				    </div>
                                </div>




                                <div class="col-lg-12 col-md-12 offset-lg-0 offset-md-0 offset-sm-0 col-sm-12">
                                    <div class="about-text-box">
                                        <h3>For Distribution business partners, we provide :</h3>
                                        <p class="para">
                                            Product design -Working with distribution partner and  insurer to design the insurance product that’s just right, for partner and her customers.<br/>

REST API - State-of-the-art REST API to seamlessly connect workflows and checkouts at the relevant customer touch points.<br/><br/>

Mobile-First UI - Plug & play customer journey that matches partner's style, complies with regulations and allows for easy A/B testing.<br/><br/>

Payments & Policy - Flexible payment and collection methods with real-time issuance of digital policies and customer notifications.<br/><br/>

Reporting & Analytics - Comprehensive reporting of transactions, commissions, conversions and A/B tests results for ongoing optimization.<br/><br/>

Security - With auditing, support and constant improvements in the protection of our technological environment, we ensures  operations and data are equipped with the best security measures, complying with all international standards including RGPD.<br/><br/>

Scalability - So that the increase in customers and operations is backed by auto scaling of our cloud infrastructure.<br/>

					</p>

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
