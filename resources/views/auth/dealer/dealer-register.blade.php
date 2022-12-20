@extends('frontend.layouts.app')
@section('title', 'Sign In')
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
        .nice-select.open .list {
            opacity: 1;
            pointer-events: auto;
            -webkit-transform: scale(1) translateY(0);
            -ms-transform: scale(1) translateY(0);
            transform: scale(1) translateY(0);
            width: 100%;
        }

        @media only screen and (max-width: 767px) {
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
                        <h2>ParentDealer Sign Up</h2>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>ParentDealer Sign up</li>
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

                <div class="col-lg-8 col-md-8 col-sm-8 offset-lg-2 offset-md-2 offset-sm-2">
                    <div class="single-pricing-box">
                        <div class="pt-4">
                            <h3 class="text-center">ParentDealer Sign Up</h3>
                        </div>

                        <div class="tab_content m-4 row">
                            <div class="tabs_item col-lg-6 col-md-6 col-sm-6">
                                {{-- <p>Our experts will reply you with a quote very soon</p>--}}
                                <form method="post" action="{{route('dealer.register.store')}}">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label for="email" class="c-form-label">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                               placeholder="Your full name">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="c-form-label">Phone</label>
                                        <input type="number" name="phone" value="{{ old('phone') }}"
                                               class="form-control" placeholder="Your phone">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="c-form-label">Phone</label>
                                        <select name="parent_dealer_id" class="form-control" id="">
                                            @foreach($parentDealers as $dealer)
                                                <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email" class="c-form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Enter Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="default-btn mt-4 w-100">Sign Up<span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <svg class="animated" id="freepik_stories-sign-up" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xmlns:svgjs="http://svgjs.com/svgjs">
                                    <style>svg#freepik_stories-sign-up:not(.animated) .animable {
                                            opacity: 0;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--background-simple--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Checklists--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Envelopes--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedLeft;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Floor--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomOut;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Plants--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideLeft;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Screen--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Bricks--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedLeft;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Information--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Mail--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) zoomIn;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--Character--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) lightSpeedRight;
                                            animation-delay: 0s;
                                        }

                                        svg#freepik_stories-sign-up.animated #freepik--speech-bubble--inject-7 {
                                            animation: 1s 1 forwards cubic-bezier(.36, -0.01, .5, 1.38) slideRight;
                                            animation-delay: 0s;
                                        }

                                        @keyframes lightSpeedRight {
                                            from {
                                                transform: translate3d(50%, 0, 0) skewX(-20deg);
                                                opacity: 0;
                                            }
                                            60% {
                                                transform: skewX(10deg);
                                                opacity: 1;
                                            }
                                            80% {
                                                transform: skewX(-2deg);
                                            }
                                            to {
                                                opacity: 1;
                                                transform: translate3d(0, 0, 0);
                                            }
                                        }

                                        @keyframes zoomOut {
                                            0% {
                                                opacity: 0;
                                                transform: scale(1.5);
                                            }
                                            100% {
                                                opacity: 1;
                                                transform: scale(1);
                                            }
                                        }

                                        @keyframes lightSpeedLeft {
                                            from {
                                                transform: translate3d(-50%, 0, 0) skewX(20deg);
                                                opacity: 0;
                                            }
                                            60% {
                                                transform: skewX(-10deg);
                                                opacity: 1;
                                            }
                                            80% {
                                                transform: skewX(2deg);
                                            }
                                            to {
                                                opacity: 1;
                                                transform: translate3d(0, 0, 0);
                                            }
                                        }

                                        @keyframes slideLeft {
                                            0% {
                                                opacity: 0;
                                                transform: translateX(-30px);
                                            }
                                            100% {
                                                opacity: 1;
                                                transform: translateX(0);
                                            }
                                        }

                                        @keyframes slideRight {
                                            0% {
                                                opacity: 0;
                                                transform: translateX(30px);
                                            }
                                            100% {
                                                opacity: 1;
                                                transform: translateX(0);
                                            }
                                        }

                                        @keyframes zoomIn {
                                            0% {
                                                opacity: 0;
                                                transform: scale(0.5);
                                            }
                                            100% {
                                                opacity: 1;
                                                transform: scale(1);
                                            }
                                        }        </style>
                                    <g id="freepik--background-simple--inject-7" class="animable"
                                       style="transform-origin: 250.426px 237.131px;">
                                        <path
                                            d="M475.79,277.05c-13.49,40.89-42.56,85.72-85.35,100.31C325.8,399.42,320,452.43,202.71,452.07a236.91,236.91,0,0,1-50.94-5.47,197.3,197.3,0,0,1-24.12-7c-69.5-25.07-107.55-84.69-113-148.4-7.15-83.8,49.87-126.07,87-151s79.53-117.45,194.87-118a228.73,228.73,0,0,1,52.35,5.59c39.16,9,79.46,30.67,103.67,63.7,1.81,2.48,3.55,5,5.23,7.62C490.46,149.94,494.19,221.29,475.79,277.05Z"
                                            style="fill: #3AADE1; transform-origin: 250.426px 237.131px;"
                                            id="el84i7belc8q2" class="animable"></path>
                                        <g id="elie8y5dzrvvi">
                                            <path
                                                d="M475.79,277.05c-13.49,40.89-42.56,85.72-85.35,100.31C325.8,399.42,320,452.43,202.71,452.07a236.91,236.91,0,0,1-50.94-5.47,197.3,197.3,0,0,1-24.12-7c-69.5-25.07-107.55-84.69-113-148.4-7.15-83.8,49.87-126.07,87-151s79.53-117.45,194.87-118a228.73,228.73,0,0,1,52.35,5.59c39.16,9,79.46,30.67,103.67,63.7,1.81,2.48,3.55,5,5.23,7.62C490.46,149.94,494.19,221.29,475.79,277.05Z"
                                                style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 250.426px 237.131px;"
                                                class="animable" id="eldun2kobkqjm"></path>
                                        </g>
                                    </g>
                                    <g id="freepik--Checklists--inject-7" class="animable"
                                       style="transform-origin: 262.865px 224.33px;">
                                        <path
                                            d="M55.29,80H41.6a.5.5,0,0,1-.5-.5V65.84a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.7A.5.5,0,0,1,55.29,80ZM42.1,79H54.79V66.34H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.445px 72.67px;"
                                            id="elxcr9nclo4s" class="animable"></path>
                                        <path
                                            d="M121,73.19H60.77a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5H121a.5.5,0,0,1,.5.5A.5.5,0,0,1,121,73.19Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 90.885px 72.69px;"
                                            id="elc5ipkvonxk" class="animable"></path>
                                        <path
                                            d="M55.29,99.21H41.6a.5.5,0,0,1-.5-.5V85a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.7A.5.5,0,0,1,55.29,99.21Zm-13.19-1H54.79V85.51H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.4451px 91.855px;"
                                            id="elw0zu19p8ion" class="animable"></path>
                                        <path d="M121,92.36H60.77a.5.5,0,1,1,0-1H121a.5.5,0,0,1,0,1Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 90.885px 91.86px;"
                                              id="el54m5dd7wxv9" class="animable"></path>
                                        <path
                                            d="M55.29,118.38H41.6a.5.5,0,0,1-.5-.5v-13.7a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.7A.5.5,0,0,1,55.29,118.38Zm-13.19-1H54.79v-12.7H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.445px 111.03px;"
                                            id="el8ounweewyta" class="animable"></path>
                                        <path d="M121,111.53H60.77a.5.5,0,0,1,0-1H121a.5.5,0,1,1,0,1Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 90.885px 111.03px;"
                                              id="elvwx70asz6ck" class="animable"></path>
                                        <path
                                            d="M55.29,137.55H41.6a.5.5,0,0,1-.5-.5v-13.7a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.7A.5.5,0,0,1,55.29,137.55Zm-13.19-1H54.79v-12.7H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.445px 130.2px;"
                                            id="elmpzkz4p62pp" class="animable"></path>
                                        <path
                                            d="M121,130.7H60.77a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5H121a.5.5,0,0,1,.5.5A.5.5,0,0,1,121,130.7Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 90.885px 130.2px;"
                                            id="elfwc31e5v4pw" class="animable"></path>
                                        <path
                                            d="M55.29,156.72H41.6a.5.5,0,0,1-.5-.5V142.53a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.69A.5.5,0,0,1,55.29,156.72Zm-13.19-1H54.79V143H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.445px 149.375px;"
                                            id="el808xq008yu7" class="animable"></path>
                                        <path
                                            d="M121,149.87H60.77a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5H121a.5.5,0,0,1,.5.5A.5.5,0,0,1,121,149.87Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 90.885px 149.37px;"
                                            id="el83u8ofi2c3c" class="animable"></path>
                                        <path
                                            d="M55.29,175.89H41.6a.5.5,0,0,1-.5-.5V161.7a.5.5,0,0,1,.5-.5H55.29a.5.5,0,0,1,.5.5v13.69A.5.5,0,0,1,55.29,175.89Zm-13.19-1H54.79V162.2H42.1Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 48.445px 168.545px;"
                                            id="elr3u8yq6kmi" class="animable"></path>
                                        <path
                                            d="M121,169H60.77a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5H121a.5.5,0,0,1,.5.5A.5.5,0,0,1,121,169Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 90.885px 168.5px;"
                                            id="elrbgkzy4qgy7" class="animable"></path>
                                        <path
                                            d="M438.92,317.38H429.5a.5.5,0,0,1-.5-.5v-9.42a.5.5,0,0,1,.5-.5h9.42a.5.5,0,0,1,.5.5v9.42A.5.5,0,0,1,438.92,317.38Zm-8.92-1h8.42V308H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 312.17px;"
                                            id="elie5qzxa5pg" class="animable"></path>
                                        <path d="M484.13,312.67H442.68a.5.5,0,0,1,0-1h41.45a.5.5,0,0,1,0,1Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 463.405px 312.17px;"
                                              id="elj0wx44zdsx8" class="animable"></path>
                                        <path
                                            d="M438.92,330.57H429.5a.5.5,0,0,1-.5-.5v-9.42a.5.5,0,0,1,.5-.5h9.42a.5.5,0,0,1,.5.5v9.42A.51.51,0,0,1,438.92,330.57Zm-8.92-1h8.42v-8.42H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 325.36px;"
                                            id="elyeq0nxborrs" class="animable"></path>
                                        <path
                                            d="M484.13,325.86H442.68a.51.51,0,0,1-.5-.5.5.5,0,0,1,.5-.5h41.45a.5.5,0,0,1,.5.5A.5.5,0,0,1,484.13,325.86Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 463.405px 325.36px;"
                                            id="elur1l4oihd7n" class="animable"></path>
                                        <path
                                            d="M438.92,343.76H429.5a.5.5,0,0,1-.5-.5v-9.42a.5.5,0,0,1,.5-.5h9.42a.5.5,0,0,1,.5.5v9.42A.51.51,0,0,1,438.92,343.76Zm-8.92-1h8.42v-8.42H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 338.55px;"
                                            id="elziuzif0wyjm" class="animable"></path>
                                        <path
                                            d="M484.13,339.05H442.68a.51.51,0,0,1-.5-.5.5.5,0,0,1,.5-.5h41.45a.5.5,0,0,1,.5.5A.5.5,0,0,1,484.13,339.05Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 463.405px 338.55px;"
                                            id="elgv5u64i9lo" class="animable"></path>
                                        <path
                                            d="M438.92,356.94H429.5a.5.5,0,0,1-.5-.5V347a.5.5,0,0,1,.5-.5h9.42a.51.51,0,0,1,.5.5v9.42A.5.5,0,0,1,438.92,356.94Zm-8.92-1h8.42v-8.42H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 351.72px;"
                                            id="eljc9p5q6ys6" class="animable"></path>
                                        <path
                                            d="M484.13,352.23H442.68a.5.5,0,0,1-.5-.5.51.51,0,0,1,.5-.5h41.45a.5.5,0,0,1,.5.5A.5.5,0,0,1,484.13,352.23Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 463.405px 351.73px;"
                                            id="el1xzphzekxz3" class="animable"></path>
                                        <path
                                            d="M438.92,370.13H429.5a.5.5,0,0,1-.5-.5v-9.42a.5.5,0,0,1,.5-.5h9.42a.51.51,0,0,1,.5.5v9.42A.5.5,0,0,1,438.92,370.13Zm-8.92-1h8.42v-8.42H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 364.92px;"
                                            id="elwb9o9buw0c" class="animable"></path>
                                        <path
                                            d="M484.13,365.42H442.68a.5.5,0,0,1-.5-.5.51.51,0,0,1,.5-.5h41.45a.5.5,0,0,1,.5.5A.5.5,0,0,1,484.13,365.42Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 463.405px 364.92px;"
                                            id="el7qdr3ckrcqi" class="animable"></path>
                                        <path
                                            d="M438.92,383.32H429.5a.5.5,0,0,1-.5-.5V373.4a.5.5,0,0,1,.5-.5h9.42a.5.5,0,0,1,.5.5v9.42A.5.5,0,0,1,438.92,383.32Zm-8.92-1h8.42V373.9H430Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 434.21px 378.11px;"
                                            id="elbmxuofd0bqo" class="animable"></path>
                                        <path d="M484.13,378.61H442.68a.5.5,0,1,1,0-1h41.45a.5.5,0,0,1,0,1Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 463.405px 378.11px;"
                                              id="elvqigjpu1h1" class="animable"></path>
                                    </g>
                                    <g id="freepik--Envelopes--inject-7" class="animable"
                                       style="transform-origin: 174.52px 239.12px;">
                                        <path
                                            d="M267.23,107.47h-59.3a.5.5,0,0,1-.5-.5V64.52a.5.5,0,0,1,.5-.5h59.3a.5.5,0,0,1,.5.5V107A.5.5,0,0,1,267.23,107.47Zm-58.8-1h58.3V65h-58.3Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 237.58px 85.745px;"
                                            id="el742sf0sfvec" class="animable"></path>
                                        <path
                                            d="M237.58,86.25a.5.5,0,0,1-.29-.09L207.64,64.93a.5.5,0,0,1-.12-.7.51.51,0,0,1,.7-.11l29.36,21,29.36-21a.5.5,0,1,1,.58.81L237.87,86.16A.52.52,0,0,1,237.58,86.25Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 237.596px 75.1249px;"
                                            id="elesc7hau58mh" class="animable"></path>
                                        <path
                                            d="M308.32,78H272a.5.5,0,0,1-.5-.5v-26a.5.5,0,0,1,.5-.5h36.34a.5.5,0,0,1,.5.5v26A.5.5,0,0,1,308.32,78Zm-35.84-1h35.34V52H272.48Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 290.17px 64.5002px;"
                                            id="elfv8ifcn8u17" class="animable"></path>
                                        <path
                                            d="M290.15,65a.46.46,0,0,1-.29-.1l-18.17-13a.5.5,0,0,1-.12-.7.51.51,0,0,1,.7-.12l17.88,12.8L308,51.1a.51.51,0,0,1,.7.12.5.5,0,0,1-.12.7l-18.17,13A.46.46,0,0,1,290.15,65Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 290.135px 57.9954px;"
                                            id="el3d6sk0gcfjr" class="animable"></path>
                                        <path
                                            d="M77,427.25H40.7a.51.51,0,0,1-.5-.5v-26a.51.51,0,0,1,.5-.5H77a.5.5,0,0,1,.5.5v26A.5.5,0,0,1,77,427.25Zm-35.84-1H76.54v-25H41.2Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 58.85px 413.75px;"
                                            id="el7o4coe45424" class="animable"></path>
                                        <path
                                            d="M58.87,414.24a.52.52,0,0,1-.29-.09l-18.17-13a.51.51,0,0,1-.11-.7.5.5,0,0,1,.69-.11l17.88,12.8,17.88-12.8a.51.51,0,0,1,.7.11.5.5,0,0,1-.12.7l-18.17,13A.5.5,0,0,1,58.87,414.24Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 58.8752px 407.244px;"
                                            id="el5v5lgilii03" class="animable"></path>
                                    </g>
                                    <g id="freepik--Floor--inject-7" class="animable"
                                       style="transform-origin: 251.47px 459.45px;">
                                        <rect x="19.35" y="458.95" width="464.24" height="1"
                                              style="fill: rgb(38, 50, 56); transform-origin: 251.47px 459.45px;"
                                              id="elv840ao54va" class="animable"></rect>
                                    </g>
                                    <g id="freepik--Plants--inject-7" class="animable"
                                       style="transform-origin: 248.991px 219.803px;">
                                        <path
                                            d="M17.63,332.22c3.26-.53,9.39-4.69,9.4-4.69s-4-3.21-4.25-3.38c-3.21-2-10.57-3.9-13.77-1.16a5,5,0,0,0,0,7.43C11.19,332.48,14.85,332.67,17.63,332.22Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 17.1932px 327.022px;"
                                            id="elrdqr4oqcrt" class="animable"></path>
                                        <path
                                            d="M31.41,348.85c2.89-1.32,7.4-6.51,7.76-6.92a88.27,88.27,0,0,0,9.38,7.14c1.9,1.27,3.86,2.5,5.84,3.7-1-.41-1.87-.78-2-.81-3.61-1.06-11.22-1-13.59,2.51a5,5,0,0,0,2,7.16c2.62,1.42,6.21.64,8.76-.53s6.54-5.54,7.56-6.7l2.29,1.36c3.68,2.17,7.35,4.31,10.89,6.52,1.25.78,2.45,1.59,3.66,2.4-.88-.36-1.62-.67-1.74-.7-3.61-1.06-11.22-1-13.59,2.52a5,5,0,0,0,2,7.16c2.62,1.41,6.2.63,8.76-.54s6.15-5.11,7.38-6.49c1.21.86,2.42,1.73,3.55,2.62.76.63,1.53,1.18,2.26,1.85L84.74,373c1.34,1.28,2.73,2.59,4,3.87.89.89,1.73,1.74,2.57,2.61-1.23-.79-3.68-2.29-3.89-2.39-3.42-1.59-11-2.66-13.82.43a5,5,0,0,0,.88,7.38c2.38,1.79,6,1.57,8.74.8,3-.85,8-5.1,8.67-5.64,1.4,1.44,2.74,2.85,4,4.19,2.76,3,5.14,5.69,7.12,8l2.33-1.5c-2.11-2.37-4.66-5.16-7.63-8.22-1.41-1.47-2.94-3-4.53-4.56a55.66,55.66,0,0,0,3.37-5.41c3.08.8,9.21.1,10,0,.37,2,.71,3.88,1,5.69.63,3.79,1.1,7.2,1.46,10.12l2.52-1.62c-.41-2.65-.9-5.65-1.51-8.93-.37-2-.81-4.13-1.27-6.3.75-.29,6.92-2.71,9.09-4.92,2-2,3.92-5.12,3.49-8.07a5,5,0,0,0-6.06-4.3c-4.09,1-6.75,8.17-7,11.93,0,.22.1,2.64.2,4.17-.19-.89-.37-1.75-.58-2.67-.41-1.8-.87-3.6-1.36-5.52l-.81-2.8c-.25-.94-.64-1.9-1-2.87-.78-2.21-1.68-4.41-2.64-6.62,1.58-.36,7.18-1.72,9.44-3.41s4.65-4.47,4.66-7.44a5,5,0,0,0-5.33-5.18c-4.2.41-7.91,7.05-8.72,10.73,0,.23-.32,2.94-.45,4.43-.58-1.32-1.16-2.64-1.8-3.95-1.83-3.8-3.8-7.58-5.75-11.37-.6-1.16-1.18-2.32-1.77-3.48.56-.12,7.25-1.6,9.79-3.5,2.25-1.68,4.65-4.46,4.66-7.44a5,5,0,0,0-5.34-5.17c-4.19.41-7.91,7.05-8.71,10.73-.06.28-.46,4.17-.51,5.17-1.29-2.56-2.56-5.12-3.7-7.69a89.11,89.11,0,0,1-4-10.68c.26-.06,7.25-1.57,9.85-3.51,2.25-1.69,4.65-4.47,4.66-7.44a5,5,0,0,0-5.34-5.17c-4.19.41-7.91,7.05-8.71,10.73-.06.28-.49,4.47-.51,5.24-.06-.21-.15-.42-.21-.64a64.73,64.73,0,0,1-2-11.25c-.21-2.09-.3-4.11-.33-6.08,1.33-.14,7.4-.88,9.93-2.37s5.11-3.93,5.45-6.89a5,5,0,0,0-4.74-5.72c-4.21-.06-8.63,6.13-9.84,9.7-.06.2-.51,2.24-.81,3.74,0-.89,0-1.8,0-2.65,0-3.19.27-6.11.5-8.69.14-1.47.3-2.79.46-4,1.23-.83,6.15-4.22,7.68-6.66s2.72-5.84,1.66-8.62a5,5,0,0,0-6.84-2.9c-3.77,1.89-4.84,9.42-4.26,13.15,0,.32,1.41,5.26,1.48,5.22l.07-.05c-.18,1.19-.35,2.46-.52,3.86-.29,2.58-.58,5.5-.69,8.7a88.36,88.36,0,0,0,.13,10.35,64.35,64.35,0,0,0,1.79,11.44s0,.08,0,.13c-.65-1.05-2.58-3.93-2.75-4.13-2.43-2.88-8.82-7-12.72-5.4a5,5,0,0,0-2.29,7.07c1.4,2.63,4.82,4,7.6,4.39,3.13.49,9.76-1.35,10.29-1.5a88.83,88.83,0,0,0,3.88,11.14c.89,2.11,1.85,4.21,2.84,6.31-.6-.89-1.13-1.68-1.22-1.79-2.43-2.87-8.83-7-12.73-5.39A5,5,0,0,0,74.1,329c1.41,2.63,4.83,4,7.61,4.4s8.5-1,10-1.43c.39.8.76,1.61,1.15,2.41,1.87,3.83,3.76,7.64,5.49,11.44.61,1.34,1.17,2.68,1.72,4-.52-.79-1-1.45-1-1.54-2.44-2.88-8.83-7-12.73-5.4A5,5,0,0,0,84,350c1.41,2.62,4.83,3.95,7.61,4.39s7.94-.88,9.73-1.35c.53,1.38,1.06,2.78,1.51,4.15.29.94.63,1.82.87,2.79l.75,2.81c.41,1.81.85,3.67,1.21,5.44.25,1.24.48,2.41.71,3.6-.6-1.34-1.81-3.94-1.94-4.14a19.39,19.39,0,0,0-7.3-6.52,7,7,0,0,0-.65-.89,5,5,0,0,0-7.43-.24c-2.84,3.12-1.13,10.53.75,13.8.11.19,1.55,2.15,2.47,3.37-.65-.64-1.28-1.26-2-1.9-1.33-1.29-2.71-2.53-4.18-3.87l-2.22-1.88c-.73-.65-1.58-1.24-2.37-1.87-1.88-1.41-3.84-2.75-5.86-4.06,1.13-1.18,5-5.4,6-8.06s1.42-6.29-.21-8.78a5,5,0,0,0-7.3-1.37c-3.28,2.66-2.72,10.25-1.35,13.76.08.22,1.34,2.63,2.06,3.94-1.22-.78-2.42-1.56-3.68-2.31-3.62-2.15-7.36-4.22-11.07-6.3l-3.4-1.93c.41-.41,5.17-5.33,6.24-8.31,1-2.65,1.41-6.29-.22-8.78a5,5,0,0,0-7.3-1.37c-3.28,2.66-2.71,10.24-1.35,13.75.1.27,1.92,3.73,2.43,4.59-2.49-1.42-5-2.85-7.33-4.37a88,88,0,0,1-9.23-6.7c.19-.19,5.19-5.31,6.28-8.36.94-2.65,1.41-6.29-.22-8.78a5,5,0,0,0-7.3-1.37c-3.28,2.66-2.71,10.25-1.35,13.76.11.27,2.06,4,2.47,4.65l-.53-.41a64.17,64.17,0,0,1-7.88-8.28c-1.34-1.63-2.52-3.26-3.64-4.88,1-.86,5.69-4.83,7-7.46s2.09-6.1.74-8.75a5,5,0,0,0-7.1-2.17c-3.55,2.28-3.82,9.89-2.86,13.53.06.2.81,2.15,1.39,3.56-.5-.73-1-1.48-1.48-2.2-1.72-2.68-3.14-5.25-4.37-7.53-.69-1.3-1.29-2.49-1.84-3.61.57-1.37,2.8-6.91,2.73-9.79s-.95-6.38-3.37-8.11a5,5,0,0,0-7.31,1.35c-2.09,3.66,1.17,10.54,3.71,13.32.22.24,4.08,3.61,4.11,3.54a.34.34,0,0,0,0-.08c.51,1.09,1.06,2.25,1.7,3.51,1.18,2.31,2.55,4.91,4.22,7.64A87.9,87.9,0,0,0,30.91,333a65.67,65.67,0,0,0,7.8,8.55l.11.09c-1.13-.52-4.31-1.86-4.57-1.93-3.62-1.06-11.22-1-13.59,2.52a5,5,0,0,0,2,7.16C25.27,350.8,28.85,350,31.41,348.85Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 66.0167px 325.101px;"
                                            id="el5sdqn0h73sp" class="animable"></path>
                                        <path
                                            d="M81.44,293c.07,0-1.54-4.87-1.68-5.16-1.59-3.42-6.66-9.09-10.85-8.57a5,5,0,0,0-4.07,6.21c.66,2.91,3.61,5.09,6.17,6.25C74,293.05,81.43,293,81.44,293Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 73.0592px 286.118px;"
                                            id="elmrus9hqm9qn" class="animable"></path>
                                        <path
                                            d="M379.93,72.31c2.25,2.24,8.92,4.68,8.92,4.69s.27-4.89.25-5.2c-.26-3.6-2.89-10.41-6.82-11.37a4.78,4.78,0,0,0-5.76,4.19C376.12,67.45,378,70.41,379.93,72.31Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 382.783px 68.6616px;"
                                            id="ele6fri7q2d9e" class="animable"></path>
                                        <path
                                            d="M374.72,92.36c2.64,1.51,9.21,2.11,9.73,2.15a84.66,84.66,0,0,0-.29,11.31c.07,2.2.22,4.41.39,6.62-.23-1-.44-1.89-.49-2-1.2-3.41-5.53-9.28-9.58-9.17a4.79,4.79,0,0,0-4.45,5.56c.37,2.84,3,5.19,5.33,6.53s8,2,9.45,2.12c.08.85.14,1.7.22,2.55.38,4.07.77,8.13,1,12.12.1,1.41.14,2.8.18,4.19-.2-.88-.38-1.63-.42-1.74-1.21-3.41-5.54-9.28-9.58-9.16a4.79,4.79,0,0,0-4.46,5.56c.37,2.83,3,5.18,5.33,6.52s7.43,1.91,9.19,2.09c0,1.43,0,2.86-.05,4.24-.06.94-.06,1.85-.18,2.8s-.18,1.86-.28,2.78c-.24,1.76-.48,3.58-.76,5.29-.19,1.19-.39,2.32-.59,3.46-.08-1.4-.28-4.14-.33-4.37-.67-3.55-4.06-10-8.08-10.51a4.78,4.78,0,0,0-5.24,4.82c-.07,2.86,2.16,5.58,4.27,7.26,2.33,1.84,8.48,3.39,9.25,3.58-.34,1.89-.68,3.72-1,5.45-.77,3.81-1.54,7.19-2.24,10l2.47,1c.66-3,1.4-6.52,2.12-10.55.35-1.92.68-4,1-6.08a54.42,54.42,0,0,0,6.1-.41c1.11,2.84,5.09,7.22,5.61,7.78-1.32,1.4-2.62,2.73-3.86,4-2.6,2.61-5,4.89-7.06,6.81l2.67,1c1.84-1.8,3.89-3.87,6.1-6.19,1.35-1.4,2.76-2.93,4.19-4.52.65.43,6,3.88,8.93,4.33,2.67.4,6.18.18,8.23-1.82a4.79,4.79,0,0,0-.05-7.12c-3.1-2.6-10.14-.68-13.2,1.25-.18.11-2,1.56-3.13,2.49.58-.65,1.16-1.27,1.75-2,1.18-1.33,2.31-2.69,3.54-4.15l1.72-2.2c.59-.73,1.12-1.56,1.69-2.35,1.29-1.85,2.5-3.78,3.68-5.76,1.16,1,5.36,4.62,7.95,5.43s6.08,1.12,8.4-.54a4.79,4.79,0,0,0,1-7c-2.68-3-9.92-2.21-13.24-.77-.2.09-2.47,1.39-3.69,2.13.69-1.2,1.4-2.38,2.06-3.62,1.93-3.55,3.77-7.21,5.62-10.85.57-1.11,1.14-2.22,1.72-3.32.41.37,5.31,4.75,8.21,5.65,2.57.81,6.08,1.12,8.4-.54a4.79,4.79,0,0,0,1-7c-2.67-3-9.92-2.21-13.23-.77-.25.11-3.5,2-4.31,2.5,1.27-2.44,2.55-4.86,3.91-7.19a86.18,86.18,0,0,1,6.07-9.1c.19.18,5.28,4.77,8.25,5.7,2.58.8,6.08,1.11,8.41-.55a4.79,4.79,0,0,0,1-7c-2.67-3-9.92-2.2-13.24-.76-.26.11-3.75,2.13-4.36,2.54.13-.17.24-.35.38-.52a61.39,61.39,0,0,1,7.62-7.87c1.52-1.34,3-2.54,4.54-3.67.87,1,4.85,5.27,7.42,6.4s5.93,1.77,8.42.38a4.8,4.8,0,0,0,1.8-6.9c-2.32-3.31-9.62-3.28-13.07-2.21-.19.06-2,.86-3.37,1.46.69-.5,1.39-1,2.06-1.49,2.51-1.76,4.91-3.21,7.05-4.48,1.22-.72,2.34-1.34,3.39-1.91,1.33.5,6.72,2.42,9.48,2.24s6.08-1.15,7.65-3.54a4.79,4.79,0,0,0-1.58-6.94c-3.59-1.87-10.05,1.52-12.62,4-.22.22-3.31,4-3.24,4.08l.08,0c-1,.53-2.11,1.1-3.29,1.76-2.17,1.22-4.61,2.63-7.17,4.34a85.58,85.58,0,0,0-8,5.9,61.71,61.71,0,0,0-7.9,7.8,1,1,0,0,1-.08.11c.45-1.1,1.61-4.2,1.67-4.45.88-3.51.51-10.79-2.93-12.93a4.79,4.79,0,0,0-6.79,2.18c-1.25,2.56-.37,6,.85,8.38,1.38,2.71,6.53,6.84,6.94,7.17a83.85,83.85,0,0,0-6.49,9.26c-1.15,1.87-2.25,3.8-3.32,5.74.36-1,.67-1.82.7-2,.87-3.5.5-10.79-2.93-12.92a4.79,4.79,0,0,0-6.79,2.18c-1.25,2.56-.37,6,.85,8.37s5.56,6,6.71,7c-.4.75-.82,1.49-1.22,2.25-1.93,3.6-3.84,7.2-5.83,10.68-.7,1.23-1.43,2.41-2.16,3.59.32-.85.58-1.57.61-1.68.87-3.51.5-10.8-2.93-12.93a4.79,4.79,0,0,0-6.79,2.18c-1.25,2.56-.37,6,.85,8.38s5.14,5.69,6.5,6.81c-.78,1.19-1.56,2.39-2.37,3.51-.58.75-1.08,1.51-1.69,2.24s-1.19,1.44-1.77,2.16c-1.18,1.33-2.38,2.72-3.56,4-.81.89-1.61,1.72-2.4,2.57.71-1.22,2.05-3.62,2.14-3.83a18.56,18.56,0,0,0,1-9.33,6,6,0,0,0,.33-1,4.79,4.79,0,0,0-4-5.92c-4-.45-8.83,5-10.32,8.32-.09.2-.8,2.41-1.23,3.81.12-.86.26-1.7.38-2.59.24-1.76.44-3.52.66-5.42.07-.92.15-1.84.22-2.78s.08-1.92.12-2.89c.05-2.25,0-4.54-.12-6.84,1.54.22,7,.9,9.63.15s5.69-2.43,6.71-5.09a4.78,4.78,0,0,0-3-6.45c-3.9-1.06-9.49,3.63-11.46,6.66-.12.19-1.29,2.52-1.91,3.81-.07-1.38-.14-2.76-.27-4.15-.35-4-.83-8.09-1.3-12.15-.14-1.24-.27-2.48-.4-3.72.55.08,7,1,10,.19,2.59-.75,5.68-2.43,6.7-5.09a4.78,4.78,0,0,0-3-6.45c-3.91-1.06-9.49,3.63-11.46,6.66-.15.23-1.83,3.59-2.21,4.46-.29-2.73-.56-5.46-.71-8.16a84.69,84.69,0,0,1,0-10.93c.26,0,7,1.06,10,.2,2.6-.75,5.69-2.43,6.71-5.09a4.79,4.79,0,0,0-3-6.45c-3.91-1.06-9.5,3.63-11.46,6.66-.16.24-2,3.85-2.24,4.53,0-.21,0-.43,0-.64a61.84,61.84,0,0,1,2-10.78c.52-2,1.13-3.79,1.76-5.56,1.24.32,6.94,1.72,9.71,1.24s5.92-1.79,7.23-4.32a4.8,4.8,0,0,0-2.3-6.75c-3.76-1.48-9.83,2.57-12.12,5.37-.13.15-1.22,1.83-2,3.07.3-.8.59-1.62.89-2.38,1.12-2.85,2.32-5.39,3.4-7.62.63-1.27,1.22-2.41,1.78-3.46,1.39-.33,6.95-1.69,9.15-3.37s4.43-4.31,4.42-7.16a4.79,4.79,0,0,0-5.15-4.93c-4,.42-7.54,6.81-8.29,10.35-.06.3-.52,5.2-.45,5.18l.09,0c-.57,1-1.16,2.09-1.78,3.29-1.13,2.22-2.39,4.74-3.58,7.57a86.35,86.35,0,0,0-3.4,9.32A63.33,63.33,0,0,0,384.49,94a.57.57,0,0,1,0,.13c-.23-1.16-1-4.39-1.06-4.64-1.2-3.4-5.53-9.28-9.58-9.16a4.79,4.79,0,0,0-4.45,5.56C369.76,88.67,372.37,91,374.72,92.36Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 423.525px 111.658px;"
                                            id="elrfsfoo9y53m" class="animable"></path>
                                        <path
                                            d="M446.25,100c0,.06,2.92-3.92,3.07-4.2,1.77-3.15,3.34-10.27.59-13.24a4.79,4.79,0,0,0-7.12.31c-1.89,2.14-1.94,5.66-1.4,8.31C442,94.24,446.24,100,446.25,100Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 446.247px 90.5618px;"
                                            id="eluh3srpsp5vc" class="animable"></path>
                                        <path
                                            d="M419.22,210.12c1.12,2.34,5.6,6,5.6,6s1.54-3.69,1.61-3.94c.77-2.84.6-8.8-2.17-10.61a3.91,3.91,0,0,0-5.58,1.66C417.61,205.34,418.27,208.13,419.22,210.12Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 422.478px 208.556px;"
                                            id="el6vbtczcqmts" class="animable"></path>
                                        <path
                                            d="M409.76,224.15c1.63,1.88,6.53,4.12,6.92,4.3a70.39,70.39,0,0,0-3.3,8.63c-.53,1.71-1,3.46-1.49,5.21.09-.83.17-1.58.17-1.68,0-3-1.75-8.65-4.89-9.66a3.9,3.9,0,0,0-4.94,3.07c-.49,2.28.89,4.81,2.33,6.47s5.61,3.69,6.71,4.2c-.17.68-.35,1.35-.52,2-.82,3.24-1.62,6.47-2.5,9.62-.31,1.11-.65,2.19-1,3.28.09-.74.15-1.37.15-1.46,0-3-1.75-8.65-4.89-9.66a3.9,3.9,0,0,0-4.94,3.07c-.49,2.29.89,4.81,2.33,6.47s5.2,3.49,6.51,4.11c-.38,1.1-.77,2.2-1.19,3.25-.3.71-.55,1.41-.89,2.11s-.65,1.38-1,2.06c-.67,1.29-1.35,2.63-2,3.87-.47.87-.93,1.69-1.39,2.51.32-1.1.9-3.27.93-3.45.45-2.92-.41-8.82-3.37-10.29a3.91,3.91,0,0,0-5.35,2.29c-.83,2.18.15,4.88,1.33,6.75,1.29,2.05,5.6,4.92,6.15,5.27-.77,1.36-1.54,2.68-2.27,3.92-1.63,2.72-3.14,5.11-4.45,7.12l1.64,1.41c1.31-2.1,2.85-4.64,4.5-7.55.79-1.38,1.6-2.87,2.42-4.41a44.75,44.75,0,0,0,4.81,1.34c.08,2.49,2,6.95,2.21,7.52-1.39.71-2.76,1.39-4.05,2-2.71,1.31-5.17,2.42-7.29,3.34l1.77,1.53c1.91-.89,4.06-1.92,6.39-3.11,1.42-.72,2.92-1.51,4.45-2.35.39.51,3.56,4.61,5.71,5.76,1.94,1,4.71,1.81,6.83.83a3.9,3.9,0,0,0,1.89-5.5c-1.68-2.84-7.63-3.27-10.5-2.62-.17,0-2,.66-3.09,1.08l1.87-1c1.27-.71,2.51-1.45,3.86-2.24l1.92-1.23c.65-.4,1.29-.9,1.94-1.35,1.49-1.08,2.95-2.24,4.4-3.44.62,1.11,2.87,5,4.65,6.34s4.38,2.51,6.62,1.86a3.9,3.9,0,0,0,2.71-5.15c-1.23-3.07-7.05-4.39-10-4.18-.18,0-2.28.4-3.42.63.86-.73,1.72-1.45,2.57-2.22,2.45-2.21,4.86-4.53,7.27-6.84l2.23-2.09c.21.39,2.8,5.1,4.79,6.58,1.76,1.32,4.38,2.51,6.62,1.86a3.91,3.91,0,0,0,2.71-5.15c-1.24-3.06-7.05-4.39-10-4.18-.22,0-3.24.58-4,.76,1.64-1.54,3.29-3,5-4.48a69.27,69.27,0,0,1,7.14-5.36c.1.18,2.78,5.1,4.81,6.62,1.77,1.32,4.38,2.51,6.63,1.86a3.91,3.91,0,0,0,2.7-5.15c-1.23-3.06-7-4.39-10-4.18-.24,0-3.48.62-4.06.78l.43-.3a50.36,50.36,0,0,1,8-4c1.53-.62,3-1.13,4.49-1.59.41,1,2.3,5.37,4,6.94s4.08,3,6.38,2.58a3.92,3.92,0,0,0,3.26-4.83c-.89-3.18-6.52-5.13-9.47-5.25-.16,0-1.8.11-3,.21l2-.59c2.41-.67,4.65-1.14,6.64-1.54,1.14-.22,2.17-.39,3.13-.54.9.74,4.53,3.69,6.7,4.29s5,.77,6.85-.65a3.9,3.9,0,0,0,.67-5.78c-2.25-2.41-8.15-1.56-10.82-.3-.23.11-3.65,2.22-3.6,2.26l0,0c-.93.13-1.93.27-3,.46-2,.35-4.27.78-6.7,1.4a70,70,0,0,0-7.75,2.38,51.85,51.85,0,0,0-8.2,3.87l-.09.06c.65-.72,2.38-2.8,2.5-3,1.62-2.47,3.31-8.18,1.25-10.76a3.91,3.91,0,0,0-5.82-.16c-1.67,1.63-1.91,4.5-1.62,6.68.32,2.47,3.17,7,3.39,7.41a70.51,70.51,0,0,0-7.51,5.37q-2.09,1.71-4.12,3.53l1.08-1.31c1.62-2.47,3.31-8.18,1.24-10.76a3.9,3.9,0,0,0-5.81-.16c-1.67,1.63-1.91,4.5-1.63,6.68s2.64,6.17,3.28,7.21l-1.55,1.4c-2.47,2.25-4.92,4.51-7.39,6.65-.87.75-1.76,1.46-2.64,2.18.48-.57.87-1.06.93-1.14,1.62-2.46,3.31-8.17,1.24-10.75a3.9,3.9,0,0,0-5.82-.16c-1.66,1.63-1.9,4.5-1.62,6.68s2.42,5.78,3.17,7c-.93.7-1.86,1.41-2.79,2.05-.64.43-1.23.88-1.9,1.27l-1.95,1.19c-1.27.7-2.58,1.44-3.83,2.1-.87.47-1.7.9-2.54,1.33.87-.74,2.56-2.23,2.68-2.37a15.16,15.16,0,0,0,3.29-6.92,4.45,4.45,0,0,0,.52-.69,3.91,3.91,0,0,0-1.45-5.64c-3-1.44-8.17,1.48-10.21,3.61-.12.13-1.28,1.64-2,2.61.33-.64.66-1.24,1-1.9.67-1.29,1.3-2.59,2-4l.93-2.09c.32-.69.58-1.46.87-2.19.65-1.72,1.23-3.5,1.77-5.3,1.13.58,5.17,2.6,7.38,2.72s5-.32,6.55-2.1a3.91,3.91,0,0,0-.58-5.79c-2.73-1.88-8.3.22-10.64,2-.15.12-1.68,1.6-2.51,2.42.32-1.08.64-2.16.92-3.27.82-3.2,1.55-6.46,2.3-9.71.22-1,.46-2,.7-3,.4.21,5.15,2.71,7.62,2.85,2.2.13,5-.32,6.55-2.1a3.91,3.91,0,0,0-.58-5.79c-2.72-1.88-8.3.22-10.64,2-.17.14-2.38,2.27-2.91,2.84.52-2.19,1.05-4.36,1.67-6.48a66.81,66.81,0,0,1,3-8.41c.18.1,5.13,2.72,7.67,2.87,2.2.13,5-.32,6.55-2.1a3.91,3.91,0,0,0-.59-5.79c-2.72-1.88-8.3.22-10.63,2-.19.14-2.56,2.44-3,2.88.07-.15.13-.33.2-.48a50.39,50.39,0,0,1,4.48-7.75c.93-1.37,1.9-2.62,2.87-3.81.87.58,4.88,3.21,7.15,3.59s5,.23,6.74-1.37a3.91,3.91,0,0,0,.05-5.82c-2.49-2.16-8.27-.69-10.79.84-.14.09-1.44,1.09-2.38,1.83.45-.53.9-1.09,1.33-1.59,1.64-1.89,3.26-3.52,4.7-4.95.82-.81,1.59-1.53,2.31-2.19,1.15.13,5.81.59,8-.11s4.58-2.12,5.35-4.32a3.92,3.92,0,0,0-2.63-5.19c-3.22-.77-7.66,3.2-9.2,5.72-.13.22-1.81,3.87-1.75,3.87h.07c-.71.62-1.46,1.3-2.26,2.05-1.48,1.4-3.13,3-4.81,4.86a70,70,0,0,0-5.15,6.26,51.11,51.11,0,0,0-4.71,7.76l0,.1c.14-1,.44-3.65.44-3.86,0-3-1.74-8.65-4.89-9.66a3.9,3.9,0,0,0-4.94,3.07C406.94,220,408.32,222.49,409.76,224.15Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 441.233px 245.743px;"
                                            id="eltkypqfaliqj" class="animable"></path>
                                        <path
                                            d="M462.81,249.42c0,.05,3.32-2.23,3.51-2.4,2.22-2,5.36-7,4-10.05a3.91,3.91,0,0,0-5.56-1.69c-2,1.14-3,3.84-3.33,6C461.11,243.86,462.81,249.41,462.81,249.42Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 466.02px 242.07px;"
                                            id="el143n72gqk2n" class="animable"></path>
                                    </g>
                                    <g id="freepik--Screen--inject-7" class="animable"
                                       style="transform-origin: 259.21px 282.895px;">
                                        <rect x="93.32" y="128.64" width="326.36" height="312.72"
                                              style="fill: rgb(38, 50, 56); transform-origin: 256.5px 285px;"
                                              id="elimfqv09ix4k" class="animable"></rect>
                                        <path
                                            d="M419.68,441.86H93.32a.5.5,0,0,1-.5-.5V128.64a.5.5,0,0,1,.5-.5H419.68a.5.5,0,0,1,.5.5V441.36A.5.5,0,0,1,419.68,441.86Zm-325.86-1H419.18V129.14H93.82Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 256.5px 285px;"
                                            id="elzs8nyfin1t" class="animable"></path>
                                        <rect x="98.74" y="124.43" width="326.36" height="312.72"
                                              style="fill: rgb(255, 255, 255); transform-origin: 261.92px 280.79px;"
                                              id="elg2sen00x0v" class="animable"></rect>
                                        <path
                                            d="M425.1,437.65H98.74a.5.5,0,0,1-.5-.5V124.43a.5.5,0,0,1,.5-.5H425.1a.5.5,0,0,1,.5.5V437.15A.51.51,0,0,1,425.1,437.65Zm-325.86-1H424.6V124.93H99.24Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 261.92px 280.79px;"
                                            id="elunpb6j3oac" class="animable"></path>
                                        <path
                                            d="M259.06,421.05a.51.51,0,0,1-.5-.5v-281a.51.51,0,0,1,.5-.5.5.5,0,0,1,.5.5v281A.5.5,0,0,1,259.06,421.05Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 259.06px 280.05px;"
                                            id="elh4edde277g" class="animable"></path>
                                    </g>
                                    <g id="freepik--Bricks--inject-7" class="animable"
                                       style="transform-origin: 345.39px 276.315px;">
                                        <g id="elhg8e2x0c3lf">
                                            <g style="opacity: 0.2; transform-origin: 345.39px 276.315px;"
                                               class="animable" id="elii16jz6u3b">
                                                <rect x="276.63" y="183.1" width="21.28" height="9.67"
                                                      id="elcnxrqdaxb05" class="animable"
                                                      style="transform-origin: 287.27px 187.935px;"></rect>
                                                <rect x="288.53" y="171.08" width="21.28" height="9.67"
                                                      id="el9qdm19gysv7" class="animable"
                                                      style="transform-origin: 299.17px 175.915px;"></rect>
                                                <rect x="301.48" y="183.1" width="21.28" height="9.67"
                                                      id="el8c53jy0hrik" class="animable"
                                                      style="transform-origin: 312.12px 187.935px;"></rect>
                                                <rect x="338.52" y="149.82" width="21.28" height="9.67"
                                                      id="eld5yxue5ykil" class="animable"
                                                      style="transform-origin: 349.16px 154.655px;"></rect>
                                                <rect x="350.42" y="137.79" width="21.28" height="9.67"
                                                      id="elowi8m8n8ry" class="animable"
                                                      style="transform-origin: 361.06px 142.625px;"></rect>
                                                <rect x="363.37" y="149.82" width="21.28" height="9.67"
                                                      id="elalwd7v11u6k" class="animable"
                                                      style="transform-origin: 374.01px 154.655px;"></rect>
                                                <rect x="301.48" y="213.97" width="21.28" height="9.67"
                                                      id="elksggiovfwj" class="animable"
                                                      style="transform-origin: 312.12px 218.805px;"></rect>
                                                <rect x="313.38" y="201.94" width="21.28" height="9.67"
                                                      id="elwz2vmm2tcuo" class="animable"
                                                      style="transform-origin: 324.02px 206.775px;"></rect>
                                                <rect x="326.33" y="213.97" width="21.28" height="9.67"
                                                      id="elpxd42r8cpff" class="animable"
                                                      style="transform-origin: 336.97px 218.805px;"></rect>
                                                <rect x="368.02" y="304.96" width="21.28" height="9.67"
                                                      id="el62pke0qr0vo" class="animable"
                                                      style="transform-origin: 378.66px 309.795px;"></rect>
                                                <rect x="379.92" y="292.93" width="21.28" height="9.67"
                                                      id="eltpwtyycob9q" class="animable"
                                                      style="transform-origin: 390.56px 297.765px;"></rect>
                                                <rect x="392.87" y="304.96" width="21.28" height="9.67"
                                                      id="el5h4v4qyg0ww" class="animable"
                                                      style="transform-origin: 403.51px 309.795px;"></rect>
                                                <rect x="368.02" y="405.17" width="21.28" height="9.67"
                                                      id="elhha7y72yvri" class="animable"
                                                      style="transform-origin: 378.66px 410.005px;"></rect>
                                                <rect x="379.92" y="393.14" width="21.28" height="9.67"
                                                      id="elt7rlii03w3" class="animable"
                                                      style="transform-origin: 390.56px 397.975px;"></rect>
                                                <rect x="392.87" y="405.17" width="21.28" height="9.67"
                                                      id="elregj82ew17a" class="animable"
                                                      style="transform-origin: 403.51px 410.005px;"></rect>
                                                <rect x="282.24" y="327" width="21.28" height="9.67" id="el7yme06rayog"
                                                      class="animable"
                                                      style="transform-origin: 292.88px 331.835px;"></rect>
                                                <rect x="294.14" y="314.98" width="21.28" height="9.67"
                                                      id="elb3mkoqwfuii" class="animable"
                                                      style="transform-origin: 304.78px 319.815px;"></rect>
                                                <rect x="307.09" y="327" width="21.28" height="9.67" id="elqdphry2kp0c"
                                                      class="animable"
                                                      style="transform-origin: 317.73px 331.835px;"></rect>
                                                <rect x="282.24" y="361.88" width="21.28" height="9.67"
                                                      id="eliogi8nrxcmq" class="animable"
                                                      style="transform-origin: 292.88px 366.715px;"></rect>
                                                <rect x="294.14" y="349.85" width="21.28" height="9.67"
                                                      id="el5f8g005gsm" class="animable"
                                                      style="transform-origin: 304.78px 354.685px;"></rect>
                                                <rect x="307.09" y="361.88" width="21.28" height="9.67"
                                                      id="elp31x8by2ht" class="animable"
                                                      style="transform-origin: 317.73px 366.715px;"></rect>
                                                <rect x="332.34" y="361.88" width="21.28" height="9.67"
                                                      id="eliwy86glb24e" class="animable"
                                                      style="transform-origin: 342.98px 366.715px;"></rect>
                                                <rect x="344.24" y="349.85" width="21.28" height="9.67"
                                                      id="eld0iiissat4s" class="animable"
                                                      style="transform-origin: 354.88px 354.685px;"></rect>
                                                <rect x="357.19" y="361.88" width="21.28" height="9.67"
                                                      id="el65fl9hxwgwg" class="animable"
                                                      style="transform-origin: 367.83px 366.715px;"></rect>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="freepik--Information--inject-7" class="animable"
                                       style="transform-origin: 179.318px 311.538px;">
                                        <rect x="125.98" y="302.67" width="106.69" height="18.09"
                                              style="fill: rgb(255, 255, 255); transform-origin: 179.325px 311.715px;"
                                              id="elcww7zh1147g" class="animable"></rect>
                                        <path
                                            d="M232.67,321.26H126a.5.5,0,0,1-.5-.5V302.67a.5.5,0,0,1,.5-.5H232.67a.5.5,0,0,1,.5.5v18.09A.5.5,0,0,1,232.67,321.26Zm-106.19-1H232.17V303.17H126.48Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 179.335px 311.715px;"
                                            id="elkx1hiqq9oc" class="animable"></path>
                                        <rect x="125.98" y="336.36" width="106.69" height="18.09"
                                              style="fill: rgb(255, 255, 255); transform-origin: 179.325px 345.405px;"
                                              id="elzwayfojflis" class="animable"></rect>
                                        <path
                                            d="M232.67,355H126a.5.5,0,0,1-.5-.5V336.36a.5.5,0,0,1,.5-.5H232.67a.5.5,0,0,1,.5.5v18.09A.5.5,0,0,1,232.67,355Zm-106.19-1H232.17V336.86H126.48Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 179.336px 345.43px;"
                                            id="elsw8tooyhts7" class="animable"></path>
                                        <rect x="144.9" y="379.85" width="68.86" height="21.46" rx="4.84"
                                              style="fill: rgb(38, 50, 56); transform-origin: 179.33px 390.58px;"
                                              id="elirg9vce9sj" class="animable"></rect>
                                        <path
                                            d="M208.91,401.8H149.74a5.34,5.34,0,0,1-5.34-5.34V384.69a5.34,5.34,0,0,1,5.34-5.34h59.17a5.35,5.35,0,0,1,5.35,5.34v11.77A5.35,5.35,0,0,1,208.91,401.8Zm-59.17-21.45a4.34,4.34,0,0,0-4.34,4.34v11.77a4.34,4.34,0,0,0,4.34,4.34h59.17a4.34,4.34,0,0,0,4.35-4.34V384.69a4.34,4.34,0,0,0-4.35-4.34Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 179.33px 390.575px;"
                                            id="elbafrpyj62j" class="animable"></path>
                                        <path
                                            d="M120.64,253.6v-4.46a11.14,11.14,0,0,0,1.88-.13,2.47,2.47,0,0,0,1.19-.5,2.13,2.13,0,0,0,.62-1.06,7.28,7.28,0,0,0,.19-1.8v-24h6.34v24.24a12.81,12.81,0,0,1-.62,4.29,4.53,4.53,0,0,1-2.17,2.55,9.14,9.14,0,0,1-4.36.85Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 125.752px 237.625px;"
                                            id="el490v1dfgfqd" class="animable"></path>
                                        <path
                                            d="M144.23,253.22a10.29,10.29,0,0,1-5.42-1.23,6.89,6.89,0,0,1-2.86-3.52,15.41,15.41,0,0,1-.87-5.48v-11.6a15.23,15.23,0,0,1,.87-5.45,6.63,6.63,0,0,1,2.86-3.46,13,13,0,0,1,10.89,0,6.73,6.73,0,0,1,2.89,3.45,15.37,15.37,0,0,1,.86,5.44V243a15.64,15.64,0,0,1-.86,5.48A6.85,6.85,0,0,1,149.7,252,10.45,10.45,0,0,1,144.23,253.22Zm0-4.58a2.5,2.5,0,0,0,1.8-.55,2.8,2.8,0,0,0,.77-1.5,10,10,0,0,0,.2-2V229.85a9.58,9.58,0,0,0-.2-2,2.74,2.74,0,0,0-.77-1.48,2.5,2.5,0,0,0-1.8-.56,2.4,2.4,0,0,0-1.73.56,2.81,2.81,0,0,0-.77,1.48,9.6,9.6,0,0,0-.19,2v14.72a11.7,11.7,0,0,0,.17,2,2.78,2.78,0,0,0,.75,1.5A2.47,2.47,0,0,0,144.23,248.64Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 144.265px 237.259px;"
                                            id="elns4c72n47c" class="animable"></path>
                                        <path d="M157.75,252.79V221.67h6.3v31.12Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 160.9px 237.23px;"
                                              id="elio4cwd38a6f" class="animable"></path>
                                        <path
                                            d="M168.82,252.79V221.67h4.42l6.91,16.21V221.67h5.23v31.12h-4.23l-6.91-17.21v17.21Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 177.1px 237.23px;"
                                            id="el1j446xy236l" class="animable"></path>
                                        <path
                                            d="M208.47,253.22A10.39,10.39,0,0,1,203,252a6.37,6.37,0,0,1-2.75-3.49,17.06,17.06,0,0,1-.79-5.55V221.67h6.26v22.17a14.28,14.28,0,0,0,.18,2.27,3.53,3.53,0,0,0,.76,1.8,2.3,2.3,0,0,0,1.83.69,2.32,2.32,0,0,0,1.86-.69,3.36,3.36,0,0,0,.75-1.8,17.08,17.08,0,0,0,.16-2.27V221.67h6.26V243a17.06,17.06,0,0,1-.79,5.55A6.37,6.37,0,0,1,214,252,10.39,10.39,0,0,1,208.47,253.22Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 208.49px 237.454px;"
                                            id="elew0yi8agurv" class="animable"></path>
                                        <path
                                            d="M230,253.22a9.92,9.92,0,0,1-4.81-1.06,6.74,6.74,0,0,1-2.9-3.19,14.73,14.73,0,0,1-1.13-5.44l5.45-.92a16.37,16.37,0,0,0,.41,3.21,3.8,3.8,0,0,0,1,1.92,2.33,2.33,0,0,0,1.67.63,1.76,1.76,0,0,0,1.67-.76,3.57,3.57,0,0,0,.44-1.77,5.53,5.53,0,0,0-.94-3.29,15.84,15.84,0,0,0-2.48-2.67l-3.23-2.8a13.17,13.17,0,0,1-2.82-3.31,8.73,8.73,0,0,1-1.09-4.53,7.59,7.59,0,0,1,2.24-5.9,8.81,8.81,0,0,1,6.17-2.05,8.44,8.44,0,0,1,3.84.76,5.93,5.93,0,0,1,2.33,2.06,8.46,8.46,0,0,1,1.15,2.81,18.41,18.41,0,0,1,.4,3l-5.42.81c-.05-1-.13-1.78-.24-2.5a3.41,3.41,0,0,0-.7-1.69,1.9,1.9,0,0,0-1.55-.61,1.81,1.81,0,0,0-1.65.82,3.27,3.27,0,0,0-.54,1.83,4.59,4.59,0,0,0,.75,2.71,13.09,13.09,0,0,0,2.05,2.2l3.15,2.77a17.9,17.9,0,0,1,3.36,3.86,9.66,9.66,0,0,1,1.41,5.36,8,8,0,0,1-1,4,7.21,7.21,0,0,1-2.79,2.77A8.53,8.53,0,0,1,230,253.22Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 229.578px 237.251px;"
                                            id="el0odpiowsd5pe" class="animable"></path>
                                        <path d="M144.81,275.91V258.56h1.63v17.35Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 145.625px 267.235px;"
                                              id="elnrp2qz1lltp" class="animable"></path>
                                        <path d="M151.66,275.91V259.82h-3.28v-1.26h8.08v1.26h-3.17v16.09Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 152.42px 267.235px;"
                                              id="elmstgfbt9j5" class="animable"></path>
                                        <path
                                            d="M158.35,263.46l-.39-.57a1.31,1.31,0,0,0,.79-.73,4.23,4.23,0,0,0,.2-1.48h-.86v-2.12h1.8v1.8a5.63,5.63,0,0,1-.32,2.09A1.77,1.77,0,0,1,158.35,263.46Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 158.927px 261.01px;"
                                            id="eliphg5uyhum" class="animable"></path>
                                        <path
                                            d="M165.8,276.12a4.38,4.38,0,0,1-2.35-.58,3.77,3.77,0,0,1-1.4-1.65,7.59,7.59,0,0,1-.58-2.48l1.44-.43a9.67,9.67,0,0,0,.38,1.94,2.89,2.89,0,0,0,.88,1.37,2.47,2.47,0,0,0,1.65.51,2.54,2.54,0,0,0,1.8-.6,2.5,2.5,0,0,0,.64-1.91,3.51,3.51,0,0,0-.56-2,10.46,10.46,0,0,0-1.56-1.77l-3.06-2.93a5.68,5.68,0,0,1-1.2-1.64,4.4,4.4,0,0,1-.39-1.86,3.51,3.51,0,0,1,1.08-2.76,4.09,4.09,0,0,1,2.84-1,5.64,5.64,0,0,1,1.66.23,3.09,3.09,0,0,1,1.27.76,3.66,3.66,0,0,1,.82,1.36,8.25,8.25,0,0,1,.41,2l-1.39.36a7.66,7.66,0,0,0-.36-1.87,2.28,2.28,0,0,0-.83-1.19,3.12,3.12,0,0,0-3.33.15A2.09,2.09,0,0,0,163,262a3,3,0,0,0,.27,1.29,4.42,4.42,0,0,0,.95,1.24l3.07,2.89a11.38,11.38,0,0,1,1.77,2.15,4.82,4.82,0,0,1,.75,2.65,4.33,4.33,0,0,1-.5,2.19,3.3,3.3,0,0,1-1.4,1.32A4.75,4.75,0,0,1,165.8,276.12Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 165.642px 267.226px;"
                                            id="elm6qmopswc4" class="animable"></path>
                                        <path d="M176.34,275.91V258.56h6.23v1.22H178v6.53h3.83v1.2H178v8.4Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 179.455px 267.235px;"
                                              id="el8pwvopiwj78" class="animable"></path>
                                        <path
                                            d="M184.61,275.91V258.56h3.92a5.26,5.26,0,0,1,2.56.52,3.06,3.06,0,0,1,1.34,1.52,6.32,6.32,0,0,1,.4,2.37,7.63,7.63,0,0,1-.21,1.82,3.53,3.53,0,0,1-.73,1.46,2.51,2.51,0,0,1-1.46.79l2.66,8.87H191.5L189,267.38h-2.72v8.53Zm1.63-9.73h2.2a3.29,3.29,0,0,0,1.69-.36,2,2,0,0,0,.86-1.07,5.27,5.27,0,0,0,.26-1.78,4.21,4.21,0,0,0-.56-2.4,2.55,2.55,0,0,0-2.21-.79h-2.24Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 188.85px 267.232px;"
                                            id="ell1o6coxkui" class="animable"></path>
                                        <path
                                            d="M195.55,275.91V258.56h6.28v1.26H197.2v6.52H201v1.19H197.2v7.16h4.67v1.22Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 198.71px 267.235px;"
                                            id="elwuc3pf1vo8p" class="animable"></path>
                                        <path
                                            d="M204.08,275.91V258.56h6.28v1.26h-4.63v6.52h3.77v1.19h-3.77v7.16h4.67v1.22Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 207.24px 267.235px;"
                                            id="elrybqbk50fb9" class="animable"></path>
                                        <path d="M212.41,275.91v-1.86h1.67v1.86Zm.56-3.73-.54-13.62h1.67l-.57,13.62Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 213.255px 267.235px;"
                                              id="el9m3ozp8111o" class="animable"></path>
                                        <path
                                            d="M162,316.33a2.23,2.23,0,0,1-1.34-.35,1.69,1.69,0,0,1-.63-1,5.82,5.82,0,0,1-.17-1.47v-5.31H161v5.36a5.53,5.53,0,0,0,.07.94,1.3,1.3,0,0,0,.3.67,1,1,0,0,0,.7.25.93.93,0,0,0,.7-.25,1.3,1.3,0,0,0,.3-.67,6.79,6.79,0,0,0,.07-.94v-5.36h1v5.31A5.4,5.4,0,0,1,164,315a1.73,1.73,0,0,1-.62,1A2.19,2.19,0,0,1,162,316.33Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 162.003px 312.27px;"
                                            id="elfjht0hnoepi" class="animable"></path>
                                        <path
                                            d="M167.22,316.33a2.07,2.07,0,0,1-1.15-.3,1.92,1.92,0,0,1-.69-.82,3.42,3.42,0,0,1-.28-1.22l1-.26a4.52,4.52,0,0,0,.13.82,1.41,1.41,0,0,0,.34.64.87.87,0,0,0,.66.26.83.83,0,0,0,.66-.25,1,1,0,0,0,.22-.69,1.48,1.48,0,0,0-.24-.88,4.8,4.8,0,0,0-.63-.66l-1.34-1.19a2.24,2.24,0,0,1-.58-.75,2.41,2.41,0,0,1-.19-1,1.82,1.82,0,0,1,.5-1.36,1.93,1.93,0,0,1,1.38-.48,2.64,2.64,0,0,1,.83.12,1.54,1.54,0,0,1,.61.38,1.8,1.8,0,0,1,.38.65,3.32,3.32,0,0,1,.19.91l-.95.26a3.87,3.87,0,0,0-.11-.73,1.06,1.06,0,0,0-.32-.53.87.87,0,0,0-.63-.2.9.9,0,0,0-.65.22.87.87,0,0,0-.23.65,1.35,1.35,0,0,0,.12.61,1.85,1.85,0,0,0,.4.48l1.36,1.19a4.1,4.1,0,0,1,.8.94,2.4,2.4,0,0,1,.34,1.3,2,2,0,0,1-.25,1,1.64,1.64,0,0,1-.67.66A2.14,2.14,0,0,1,167.22,316.33Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 167.125px 312.259px;"
                                            id="eljjwefqgo28b" class="animable"></path>
                                        <path d="M170,316.24v-8h3.1v.83h-2v2.65h1.61v.79h-1.61v2.94h2v.8Z"
                                              style="fill: rgb(204, 204, 204); transform-origin: 171.55px 312.245px;"
                                              id="elvl33pqu097d" class="animable"></path>
                                        <path
                                            d="M174,316.24v-8h1.61a3.58,3.58,0,0,1,1.33.22,1.47,1.47,0,0,1,.77.68,2.56,2.56,0,0,1,.25,1.23,3.12,3.12,0,0,1-.1.84,1.64,1.64,0,0,1-.31.65,1.33,1.33,0,0,1-.57.38l1.13,4h-1.08l-1-3.76h-.87v3.76Zm1.12-4.56h.42a2,2,0,0,0,.77-.12.75.75,0,0,0,.44-.4,1.91,1.91,0,0,0,.14-.8,1.57,1.57,0,0,0-.26-1,1.28,1.28,0,0,0-1-.32h-.49Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 176.055px 312.239px;"
                                            id="elsp6fr9z1c3" class="animable"></path>
                                        <path d="M179.16,316.24v-8h.76l2.27,5.32v-5.32h.93v8h-.71l-2.3-5.47v5.47Z"
                                              style="fill: rgb(204, 204, 204); transform-origin: 181.14px 312.24px;"
                                              id="elvgpewcdzpqk" class="animable"></path>
                                        <path
                                            d="M183.94,316.24l1.7-8h1.08l1.71,8h-1.06l-.37-2h-1.63l-.38,2Zm1.58-2.82h1.34l-.68-3.6Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 186.185px 312.24px;"
                                            id="elq8o46l5sx5l" class="animable"></path>
                                        <path
                                            d="M189.22,316.24l.14-8h1.1l1.41,6.5,1.43-6.5h1.08l.15,8h-.9l-.09-5.81-1.35,5.81h-.63l-1.35-5.81-.08,5.81Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 191.875px 312.24px;"
                                            id="elp8qmp537se" class="animable"></path>
                                        <path d="M195.76,316.24v-8h3.1v.83h-2v2.65h1.61v.79h-1.61v2.94h2v.8Z"
                                              style="fill: rgb(204, 204, 204); transform-origin: 197.31px 312.245px;"
                                              id="elydw4nsb4fm" class="animable"></path>
                                        <path
                                            d="M159.2,349.34v-8h2a2.23,2.23,0,0,1,1.15.26,1.52,1.52,0,0,1,.63.76,3.26,3.26,0,0,1,.2,1.19,2.48,2.48,0,0,1-.22,1.1,1.64,1.64,0,0,1-.66.72,2.12,2.12,0,0,1-1.09.25h-.88v3.72Zm1.11-4.52h.52a2.22,2.22,0,0,0,.76-.11.69.69,0,0,0,.39-.38,2,2,0,0,0,.12-.77,3.77,3.77,0,0,0-.08-.87.62.62,0,0,0-.35-.43,2.17,2.17,0,0,0-.83-.12h-.53Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 161.191px 345.339px;"
                                            id="elfenb6dq72zh" class="animable"></path>
                                        <path
                                            d="M163.13,349.34l1.7-8h1.08l1.71,8h-1.06l-.37-2h-1.63l-.38,2Zm1.58-2.81H166l-.67-3.61Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 165.375px 345.34px;"
                                            id="elsatr3yvsyfs" class="animable"></path>
                                        <path
                                            d="M170.31,349.43a2.16,2.16,0,0,1-1.15-.29,1.87,1.87,0,0,1-.7-.82,3.47,3.47,0,0,1-.27-1.22l1-.26a4.52,4.52,0,0,0,.13.82,1.46,1.46,0,0,0,.34.64,1,1,0,0,0,1.32,0,1,1,0,0,0,.22-.69,1.39,1.39,0,0,0-.25-.88,4.68,4.68,0,0,0-.62-.67L169,344.89a2.18,2.18,0,0,1-.58-.76,2.33,2.33,0,0,1-.19-1,1.8,1.8,0,0,1,.5-1.36,1.89,1.89,0,0,1,1.38-.49,2.37,2.37,0,0,1,.83.13,1.44,1.44,0,0,1,.6.38,1.92,1.92,0,0,1,.39.64,3.82,3.82,0,0,1,.19.92l-.95.25a3.86,3.86,0,0,0-.12-.72,1.12,1.12,0,0,0-.31-.54,1.08,1.08,0,0,0-1.28,0,.86.86,0,0,0-.23.66,1.31,1.31,0,0,0,.12.6,1.69,1.69,0,0,0,.4.49l1.35,1.18a4.12,4.12,0,0,1,.8,1,2.38,2.38,0,0,1,.35,1.3,2,2,0,0,1-.25,1,1.7,1.7,0,0,1-.67.66A2.14,2.14,0,0,1,170.31,349.43Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 170.22px 345.355px;"
                                            id="elqw6x97g6kll" class="animable"></path>
                                        <path
                                            d="M175,349.43a2.17,2.17,0,0,1-1.16-.29,1.92,1.92,0,0,1-.69-.82,3.47,3.47,0,0,1-.28-1.22l1-.26a4.52,4.52,0,0,0,.13.82,1.57,1.57,0,0,0,.34.64.87.87,0,0,0,.67.25.85.85,0,0,0,.65-.24,1,1,0,0,0,.22-.69,1.46,1.46,0,0,0-.24-.88,5.35,5.35,0,0,0-.62-.67l-1.35-1.18a2.18,2.18,0,0,1-.58-.76,2.33,2.33,0,0,1-.19-1,1.8,1.8,0,0,1,.5-1.36,1.89,1.89,0,0,1,1.38-.49,2.37,2.37,0,0,1,.83.13,1.54,1.54,0,0,1,.61.38,1.76,1.76,0,0,1,.38.64,3.4,3.4,0,0,1,.19.92l-1,.25a3.2,3.2,0,0,0-.11-.72,1.2,1.2,0,0,0-.31-.54,1,1,0,0,0-.64-.2.94.94,0,0,0-.65.22.9.9,0,0,0-.23.66,1.31,1.31,0,0,0,.12.6,1.87,1.87,0,0,0,.4.49l1.36,1.18a4.38,4.38,0,0,1,.8,1,2.38,2.38,0,0,1,.34,1.3,2.08,2.08,0,0,1-.24,1,1.79,1.79,0,0,1-.68.66A2.12,2.12,0,0,1,175,349.43Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 174.871px 345.354px;"
                                            id="elemmht0ioh17" class="animable"></path>
                                        <path
                                            d="M178.81,349.34l-1.31-8h.93l.86,5.75,1.08-5.72h.79l1.09,5.75.84-5.78H184l-1.29,8h-.81l-1.12-5.92-1.12,5.92Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 180.75px 345.34px;"
                                            id="el75tl8tsx3i7" class="animable"></path>
                                        <path
                                            d="M186.94,349.43a2.32,2.32,0,0,1-1.29-.31,1.74,1.74,0,0,1-.7-.91,4.35,4.35,0,0,1-.2-1.37v-3a3.93,3.93,0,0,1,.21-1.36,1.71,1.71,0,0,1,.69-.87,2.41,2.41,0,0,1,1.29-.3,2.35,2.35,0,0,1,1.28.31,1.67,1.67,0,0,1,.69.87,3.83,3.83,0,0,1,.21,1.35v3a4,4,0,0,1-.21,1.37,1.75,1.75,0,0,1-.69.9A2.19,2.19,0,0,1,186.94,349.43Zm0-.88a1.05,1.05,0,0,0,.67-.18.94.94,0,0,0,.31-.51,3.53,3.53,0,0,0,.08-.78v-3.5a3.37,3.37,0,0,0-.08-.77.85.85,0,0,0-.31-.49,1.05,1.05,0,0,0-.67-.18,1.1,1.1,0,0,0-.68.18.81.81,0,0,0-.31.49,3.37,3.37,0,0,0-.08.77v3.5a3.53,3.53,0,0,0,.08.78.89.89,0,0,0,.31.51A1.1,1.1,0,0,0,186.94,348.55Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 186.935px 345.371px;"
                                            id="el3zhizsd04e3" class="animable"></path>
                                        <path
                                            d="M190.22,349.34v-8h1.61a3.58,3.58,0,0,1,1.32.21,1.51,1.51,0,0,1,.78.69,2.56,2.56,0,0,1,.25,1.23,3.12,3.12,0,0,1-.1.84,1.59,1.59,0,0,1-.31.64,1.23,1.23,0,0,1-.58.38l1.14,4h-1.08l-1-3.75h-.87v3.75Zm1.12-4.55h.42a2.07,2.07,0,0,0,.77-.12.82.82,0,0,0,.44-.4,1.93,1.93,0,0,0,.13-.8,1.63,1.63,0,0,0-.25-1,1.32,1.32,0,0,0-1-.31h-.49Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 192.275px 345.339px;"
                                            id="elu56pubwg60h" class="animable"></path>
                                        <path
                                            d="M195.35,349.34v-8h1.74a3,3,0,0,1,1.4.27,1.56,1.56,0,0,1,.74.82,3.52,3.52,0,0,1,.23,1.35v3a4,4,0,0,1-.23,1.43,1.62,1.62,0,0,1-.72.88,2.58,2.58,0,0,1-1.34.3Zm1.11-.8h.64a1.25,1.25,0,0,0,.86-.23,1.07,1.07,0,0,0,.32-.69c0-.31.05-.67.05-1.1v-2.6a5.49,5.49,0,0,0-.08-1,.87.87,0,0,0-.34-.56,1.54,1.54,0,0,0-.84-.18h-.61Z"
                                            style="fill: rgb(204, 204, 204); transform-origin: 197.406px 345.365px;"
                                            id="el9ee2xxzbnsm" class="animable"></path>
                                        <path
                                            d="M158.87,396.92a3.85,3.85,0,0,1-1.86-.41,2.63,2.63,0,0,1-1.13-1.24,5.66,5.66,0,0,1-.44-2.12l2.12-.35a6.56,6.56,0,0,0,.15,1.24,1.61,1.61,0,0,0,.39.75.94.94,0,0,0,.65.25.68.68,0,0,0,.65-.3,1.31,1.31,0,0,0,.17-.69,2.19,2.19,0,0,0-.36-1.28,6.46,6.46,0,0,0-1-1L157,390.65a5.17,5.17,0,0,1-1.1-1.29,3.42,3.42,0,0,1-.42-1.76,2.94,2.94,0,0,1,.87-2.29,3.43,3.43,0,0,1,2.4-.8,3.27,3.27,0,0,1,1.49.3,2.2,2.2,0,0,1,.9.8,3,3,0,0,1,.45,1.09,6.72,6.72,0,0,1,.16,1.17l-2.11.31c0-.37,0-.69-.09-1a1.43,1.43,0,0,0-.27-.66.79.79,0,0,0-.61-.23.7.7,0,0,0-.64.32,1.26,1.26,0,0,0-.21.71,1.83,1.83,0,0,0,.29,1,5.59,5.59,0,0,0,.8.86l1.23,1.07a7.16,7.16,0,0,1,1.3,1.5,3.74,3.74,0,0,1,.55,2.09,3,3,0,0,1-.39,1.53,2.8,2.8,0,0,1-1.08,1.08A3.32,3.32,0,0,1,158.87,396.92Z"
                                            style="fill: #3AADE1; transform-origin: 158.716px 390.713px;"
                                            id="elz4b55ujp1z" class="animable"></path>
                                        <path d="M163.11,396.75V384.66h2.45v12.09Z"
                                              style="fill: #3AADE1; transform-origin: 164.335px 390.705px;"
                                              id="elox4fk3qdp4" class="animable"></path>
                                        <path
                                            d="M170.5,396.93a3.3,3.3,0,0,1-1.94-.51,2.77,2.77,0,0,1-1-1.47,7.25,7.25,0,0,1-.31-2.2V388.7a7,7,0,0,1,.32-2.23,2.68,2.68,0,0,1,1.09-1.45,3.9,3.9,0,0,1,2.13-.51,4.09,4.09,0,0,1,2,.43,2.46,2.46,0,0,1,1.09,1.23,4.83,4.83,0,0,1,.33,1.88v.7h-2.41v-.85a5.39,5.39,0,0,0-.06-.85,1,1,0,0,0-.27-.57,1,1,0,0,0-.7-.21,1,1,0,0,0-.72.25,1.33,1.33,0,0,0-.28.65,5.77,5.77,0,0,0-.06.85v5.36a4.19,4.19,0,0,0,.09.91,1.14,1.14,0,0,0,.34.63,1.21,1.21,0,0,0,1.42,0,1.24,1.24,0,0,0,.35-.65,3.73,3.73,0,0,0,.1-.93V392h-1.18v-1.49h3.41v6.21h-1.62l-.15-1.09a2.19,2.19,0,0,1-.71.91A2.1,2.1,0,0,1,170.5,396.93Z"
                                            style="fill: #3AADE1; transform-origin: 170.744px 390.72px;"
                                            id="elzbrewrsbfb" class="animable"></path>
                                        <path d="M176,396.75V384.66h1.72l2.69,6.3v-6.3h2v12.09h-1.64l-2.69-6.69v6.69Z"
                                              style="fill: #3AADE1; transform-origin: 179.205px 390.705px;"
                                              id="elsxgon506htp" class="animable"></path>
                                        <path
                                            d="M191.36,396.92a4.05,4.05,0,0,1-2.13-.47,2.51,2.51,0,0,1-1.07-1.36,6.53,6.53,0,0,1-.31-2.16v-8.27h2.44v8.61a6.29,6.29,0,0,0,.06.88,1.49,1.49,0,0,0,.3.71,1.11,1.11,0,0,0,1.43,0,1.32,1.32,0,0,0,.3-.71,6.29,6.29,0,0,0,.06-.88v-8.61h2.43v8.27a6.53,6.53,0,0,1-.31,2.16,2.54,2.54,0,0,1-1.06,1.36A4.12,4.12,0,0,1,191.36,396.92Z"
                                            style="fill: #3AADE1; transform-origin: 191.36px 390.793px;"
                                            id="eljbtxgsjru0i" class="animable"></path>
                                        <path
                                            d="M196.59,396.75V384.66h3.83a3.47,3.47,0,0,1,1.78.41,2.44,2.44,0,0,1,1,1.19,4.58,4.58,0,0,1,.34,1.88,4,4,0,0,1-.44,2,2.44,2.44,0,0,1-1.2,1,4.55,4.55,0,0,1-1.75.31h-1.12v5.24Zm2.46-7h.87a1.67,1.67,0,0,0,.82-.17.88.88,0,0,0,.4-.55,3.54,3.54,0,0,0,.11-.95,4.06,4.06,0,0,0-.09-.93.91.91,0,0,0-.36-.58,1.53,1.53,0,0,0-.9-.21h-.85Z"
                                            style="fill: #3AADE1; transform-origin: 200.067px 390.704px;"
                                            id="elie8x6iuxvzc" class="animable"></path>
                                    </g>
                                    <g id="freepik--Mail--inject-7" class="animable"
                                       style="transform-origin: 178.003px 179.66px;">
                                        <rect x="147.94" y="169.83" width="60.12" height="39.96"
                                              style="fill: #3AADE1; transform-origin: 178px 189.81px;"
                                              id="elm3t7z7r2jnr" class="animable"></rect>
                                        <path
                                            d="M208.06,210.29H147.94a.5.5,0,0,1-.5-.5v-40a.5.5,0,0,1,.5-.5h60.12a.5.5,0,0,1,.5.5v40A.5.5,0,0,1,208.06,210.29Zm-59.62-1h59.12v-39H148.44Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 178px 189.79px;"
                                            id="elyzzscl40fhg" class="animable"></path>
                                        <polygon points="208.06 169.83 178 189.81 147.94 169.83 208.06 169.83"
                                                 style="fill: rgb(38, 50, 56); transform-origin: 178px 179.82px;"
                                                 id="el22vqot4j7hu" class="animable"></polygon>
                                        <path
                                            d="M178,190.31a.57.57,0,0,1-.28-.08l-30.06-20a.51.51,0,0,1-.2-.56.5.5,0,0,1,.48-.35h60.12a.5.5,0,0,1,.28.91l-30.06,20A.57.57,0,0,1,178,190.31Zm-28.41-20L178,189.21l28.4-18.88Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 177.997px 179.815px;"
                                            id="eldltdjhi7vmr" class="animable"></path>
                                        <polygon
                                            points="155.91 175.35 155.91 149.53 200.03 149.53 200.03 175.14 178 189.81 155.91 175.35"
                                            style="fill: rgb(255, 255, 255); transform-origin: 177.97px 169.67px;"
                                            id="elitav0jvc5u9" class="animable"></polygon>
                                        <path
                                            d="M178,190.31a.57.57,0,0,1-.28-.08l-22.08-14.46a.52.52,0,0,1-.23-.42V149.53a.5.5,0,0,1,.5-.5H200a.5.5,0,0,1,.5.5v25.61a.5.5,0,0,1-.22.42l-22,14.67A.57.57,0,0,1,178,190.31Zm-21.59-15.23L178,189.21l21.53-14.33V150H156.41Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 177.955px 169.67px;"
                                            id="el60wd0cjixf" class="animable"></path>
                                        <path
                                            d="M190.88,159H164.25a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5h26.63a.5.5,0,0,1,.5.5A.5.5,0,0,1,190.88,159Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 177.565px 158.5px;"
                                            id="elrnanjb47pbo" class="animable"></path>
                                        <path
                                            d="M190.88,165.68H164.25a.5.5,0,0,1-.5-.5.5.5,0,0,1,.5-.5h26.63a.5.5,0,0,1,.5.5A.5.5,0,0,1,190.88,165.68Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 177.565px 165.18px;"
                                            id="elkmphc1tlj5o" class="animable"></path>
                                        <path d="M190.88,172.39H164.25a.5.5,0,0,1,0-1h26.63a.5.5,0,0,1,0,1Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 177.565px 171.89px;"
                                              id="elgaemlgzrp7b" class="animable"></path>
                                        <polygon points="147.94 209.79 178.07 184.7 208.06 209.79 147.94 209.79"
                                                 style="fill: #3AADE1; transform-origin: 178px 197.245px;"
                                                 id="elo8ct09mhrhe" class="animable"></polygon>
                                        <path
                                            d="M208.06,210.29H147.94a.5.5,0,0,1-.32-.88l30.13-25.1a.5.5,0,0,1,.64,0l30,25.09a.5.5,0,0,1-.32.88Zm-58.74-1h57.36l-28.61-23.94Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 178.005px 197.242px;"
                                            id="elksdvzvbr2cf" class="animable"></path>
                                    </g>
                                    <g id="freepik--Character--inject-7" class="animable"
                                       style="transform-origin: 348.005px 316.408px;">
                                        <path
                                            d="M325.68,287s-3.29,17.94-3.79,23.25-1,26.91,2.78,41.56A137.57,137.57,0,0,0,334,377.34s2.52,10.36,4,13.14,14.15,24.26,14.15,24.26-.76,8.84-1.26,10.36-2.28,10.86-1.77,13.64,1.26,4.55.5,8.09-1.77,7.07,0,10.11,6.07,3.28,7.33,1.51a13.77,13.77,0,0,0,2.78-10.36c-.76-5-3.29-11.62-2.78-14.4a29.63,29.63,0,0,1,2.27-6.32s9.61,19.71,10.11,21.23,1.52,7.83,2,9.85,3.29-.76,4.3-2,4.8-6.57,4-10.11-3-9.85-3-9.85l3.77,5a.56.56,0,0,0,1-.49c-.71-2.43-1.67-5.65-2-6.26-.51-1-.76-4.3-2.78-7.07s-7.58-.26-7.58-.26l-4.3-13.64s7.84-25.77,6.32-34.37-2.27-14.9-1.77-16.67,10.11-28.43,10.11-34,.25-18.95-2.78-26.28a126.29,126.29,0,0,0-7.08-14.14Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 351.491px 373.28px;"
                                            id="el0zapu9eilx0l" class="animable"></path>
                                        <path
                                            d="M354.34,460.06h-.26a6,6,0,0,1-4.83-2.86c-1.71-2.94-1-6.3-.26-9.55l.2-.92a12.88,12.88,0,0,0-.18-6.31c-.11-.5-.22-1-.33-1.58-.52-2.9,1.28-12.35,1.79-13.89a101.38,101.38,0,0,0,1.23-10.08c-1.09-1.85-12.64-21.5-14.08-24.14s-3.85-12.29-4.07-13.2A140,140,0,0,1,324.18,352c-3.72-14.41-3.34-35.94-2.79-41.74.5-5.27,3.76-23.11,3.8-23.29l.07-.42h.43l44.24,1.27.14.24a128.91,128.91,0,0,1,7.11,14.21c2.87,6.94,2.84,19.32,2.82,25.27v1.2c0,4.6-6.32,23-9,30.82-.6,1.73-1,3-1.12,3.31-.26.9-.37,4.25,1.78,16.45,1.48,8.36-5.58,32.12-6.28,34.45l4.08,13c1.5-.58,5.8-1.94,7.67.63a16.16,16.16,0,0,1,2.42,5.78,8.79,8.79,0,0,0,.41,1.37c.25.51.93,2.64,2,6.34a1.05,1.05,0,0,1-1.85.93l-1.89-2.49c.71,2.13,1.6,5,2,7,.89,4.17-3.94,10.27-4.14,10.52s-2.64,3.24-4.21,2.9a1.28,1.28,0,0,1-1-1.07c-.22-.88-.53-2.54-.86-4.3-.41-2.2-.88-4.68-1.15-5.51-.38-1.13-6.22-13.22-9.63-20.23a25.28,25.28,0,0,0-1.79,5.25c-.28,1.55.49,4.54,1.31,7.71a64.2,64.2,0,0,1,1.47,6.53,14.17,14.17,0,0,1-2.86,10.72A3.71,3.71,0,0,1,354.34,460.06ZM326.09,287.52c-.5,2.74-3.25,18-3.7,22.79-.55,5.75-.93,27.1,2.76,41.39a139,139,0,0,0,9.31,25.42l0,.1c0,.11,2.53,10.33,4,13s14,24,14.14,24.25l.08.13v.16c0,.37-.77,8.92-1.29,10.48s-2.24,10.69-1.75,13.39c.1.55.21,1.06.31,1.55a13.87,13.87,0,0,1,.19,6.73l-.2.92c-.71,3.21-1.37,6.23.14,8.83a4.94,4.94,0,0,0,4,2.37,2.86,2.86,0,0,0,2.48-.89,13.21,13.21,0,0,0,2.7-10c-.31-2-.89-4.26-1.45-6.43-.85-3.28-1.65-6.37-1.33-8.14a28.84,28.84,0,0,1,2.32-6.45l.45-.91.44.91c.4.81,9.63,19.76,10.14,21.29.29.89.74,3.31,1.18,5.65.33,1.74.63,3.38.85,4.24.05.2.12.31.2.33.53.11,2.06-1.1,3.22-2.54,1.64-2.06,4.58-6.72,3.94-9.69-.74-3.47-3-9.73-3-9.79l-1.11-3.08,5.75,7.59.58-.19-.48.14c-1.39-4.77-1.81-5.92-1.94-6.18a8.32,8.32,0,0,1-.48-1.57,15.28,15.28,0,0,0-2.26-5.43c-1.75-2.42-6.91-.12-7-.09l-.51.23-4.51-14.33,0-.15c.08-.25,7.79-25.75,6.31-34.13-1.67-9.45-2.26-15.14-1.76-16.9.1-.34.51-1.54,1.13-3.35,2.45-7.13,9-26.07,9-30.5v-1.2c0-5.88.05-18.13-2.74-24.88a125.84,125.84,0,0,0-6.91-13.85Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 351.524px 373.31px;"
                                            id="elwbit1ifkkkc" class="animable"></path>
                                        <path
                                            d="M368.23,424.47l-3.39-10.74s7.84-25.77,6.32-34.37-2.27-14.9-1.77-16.67,9.22-28.5,10.11-34a47.5,47.5,0,0,0-2.78-26.28,126.29,126.29,0,0,0-7.08-14.14l-44-1.27s-3.29,17.94-3.79,23.25-1,26.91,2.78,41.56A137.57,137.57,0,0,0,334,377.34s2.52,10.36,4,13.14,14.15,24.26,14.15,24.26-.44,5.08-.87,8.2a13.28,13.28,0,0,0,5.92,2.41l2,2S365,429.9,368.23,424.47Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 350.873px 357.474px;"
                                            id="eld81hshbzxke" class="animable"></path>
                                        <path
                                            d="M362.36,428.45a9.18,9.18,0,0,1-3.28-.62l-.15-.1-1.89-1.9a14,14,0,0,1-6-2.48l-.27-.17.05-.31c.38-2.76.77-7.13.85-8-1.09-1.85-12.64-21.5-14.08-24.14s-3.85-12.29-4.07-13.2A140,140,0,0,1,324.18,352c-3.72-14.41-3.34-35.94-2.79-41.74.5-5.27,3.76-23.11,3.8-23.29l.07-.42h.43l44.24,1.27.14.24a128.91,128.91,0,0,1,7.11,14.21A48.24,48.24,0,0,1,380,328.78c-.71,4.41-6.26,21.85-8.92,30.24-.65,2.05-1.1,3.45-1.2,3.81-.26.9-.37,4.25,1.78,16.45,1.48,8.36-5.58,32.12-6.28,34.45l3.4,10.81-.11.19A7,7,0,0,1,362.36,428.45Zm-2.79-1.5c.7.28,5.33,1.91,8.11-2.54l-3.36-10.68,0-.15c.08-.25,7.79-25.75,6.31-34.13-1.67-9.45-2.26-15.14-1.76-16.9.1-.36.55-1.77,1.21-3.83,2.45-7.71,8.18-25.77,8.89-30.1a47.28,47.28,0,0,0-2.75-26,124.87,124.87,0,0,0-6.91-13.85l-43.26-1.25c-.5,2.74-3.25,18-3.7,22.79-.55,5.75-.93,27.1,2.76,41.39a139,139,0,0,0,9.31,25.42l0,.1c0,.11,2.53,10.33,4,13s14,24,14.14,24.25l.08.13v.16c0,.05-.42,4.8-.83,7.91a12.3,12.3,0,0,0,5.42,2.16l.18,0Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 350.885px 357.501px;"
                                            id="el3pnjw4qkanq" class="animable"></path>
                                        <path
                                            d="M361.7,403.64a.49.49,0,0,1-.48-.37c-1.15-4.42-2.72-10.37-3.68-13.66-1.74-6-7.26-21.29-7.32-21.45a.5.5,0,0,1,0-.12l-4.53-45.87-8.39-5.43a.5.5,0,0,1-.15-.69.52.52,0,0,1,.7-.15l8.59,5.56a.5.5,0,0,1,.22.37l4.54,46.05c.38,1.05,5.62,15.63,7.32,21.45,1,3.3,2.53,9.26,3.68,13.69a.5.5,0,0,1-.35.61Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 349.644px 359.732px;"
                                            id="el8rdboifopsl" class="animable"></path>
                                        <path
                                            d="M363.58,410.94a.51.51,0,0,1-.49-.37s-.37-1.48-.94-3.7a.5.5,0,1,1,1-.25c.57,2.22.94,3.7.94,3.7a.5.5,0,0,1-.36.61Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 363.12px 408.583px;"
                                            id="elgnjnu5y52s" class="animable"></path>
                                        <path
                                            d="M348.67,323.39l-.16,0a.5.5,0,0,1-.31-.64c1-2.87,3.09-6.92,6.35-12a.5.5,0,1,1,.84.53,60.87,60.87,0,0,0-6.24,11.82A.5.5,0,0,1,348.67,323.39Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 351.836px 316.928px;"
                                            id="elzasp3lw3s1p" class="animable"></path>
                                        <path
                                            d="M357.08,308.25a.47.47,0,0,1-.28-.09.5.5,0,0,1-.14-.69c1.43-2.12,2.46-3.55,2.47-3.57a.5.5,0,1,1,.81.59s-1,1.43-2.45,3.54A.5.5,0,0,1,357.08,308.25Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 358.308px 305.971px;"
                                            id="eliypyd0txqb" class="animable"></path>
                                        <path
                                            d="M379.5,434.7c-.51-1-.76-4.3-2.78-7.07a3.32,3.32,0,0,0-2.52-1.28c1.72,4.35.12,7.83,1,11.13,1,3.79,1.77,7.07.26,9.85s-5.31,4.3-5.31,4.3h-.07c.47,2.44,1,5.51,1.33,6.81.51,2,3.29-.76,4.3-2s4.8-6.57,4-10.11-3-9.85-3-9.85l4.38,5.78a.37.37,0,0,0,.65-.32C381,439.48,379.85,435.4,379.5,434.7Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 375.916px 442.748px;"
                                            id="el57oht22mn1e" class="animable"></path>
                                        <path
                                            d="M372.16,459.67a1.24,1.24,0,0,1-.27,0,1.28,1.28,0,0,1-1-1.07c-.22-.88-.53-2.54-.86-4.29-.16-.86-.32-1.74-.48-2.54l-.1-.5.5-.09h0s3.62-1.47,5-4.06.75-5.54-.3-9.48a14.32,14.32,0,0,1-.24-4.49,14.57,14.57,0,0,0-.75-6.58l-.3-.76.81.07a3.79,3.79,0,0,1,2.88,1.48,16.16,16.16,0,0,1,2.42,5.78,8.79,8.79,0,0,0,.41,1.37h0c.27.56,1,3,2.28,7.31a.87.87,0,0,1-1.53.76l-2.49-3.29c.71,2.13,1.6,5,2,7,.89,4.17-3.94,10.27-4.14,10.52S373.71,459.67,372.16,459.67ZM370.65,452c.13.69.27,1.42.4,2.14.33,1.73.63,3.38.85,4.23.05.2.12.31.2.33.53.11,2.06-1.1,3.22-2.54,1.64-2.06,4.58-6.72,3.94-9.69-.74-3.47-3-9.73-3-9.79l-.82-2.29a10.27,10.27,0,0,0,.26,3c1.07,4,1.77,7.35.2,10.22C374.55,450,371.62,451.52,370.65,452Zm4.79-18,5.62,7.41c-1.05-3.65-1.78-6-2-6.45h0a8.32,8.32,0,0,1-.48-1.57,15.28,15.28,0,0,0-2.26-5.43A2.44,2.44,0,0,0,375,427a16.88,16.88,0,0,1,.52,6.17C375.46,433.43,375.45,433.7,375.44,434Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 375.821px 442.744px;"
                                            id="elvto4wrnok1" class="animable"></path>
                                        <path
                                            d="M359.85,448.64c-.37,1.2-.85,2.68-1.32,4-1,2.78-4.3,3-6.57.51a10.56,10.56,0,0,1-2.28-6.32c-.76,3.54-1.77,7.07,0,10.11s6.07,3.28,7.33,1.51A13.84,13.84,0,0,0,359.85,448.64Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 354.305px 453.195px;"
                                            id="elkotuej89ir" class="animable"></path>
                                        <path
                                            d="M354.34,460.06h-.26a6,6,0,0,1-4.83-2.86c-1.71-2.94-1-6.3-.26-9.55l1.18-5.48v4.67a10.11,10.11,0,0,0,2.15,6,4,4,0,0,0,3.67,1.53,2.77,2.77,0,0,0,2.06-1.87c.4-1.1.84-2.44,1.32-4l.71-2.3.26,2.4a14.29,14.29,0,0,1-2.93,10.15A3.71,3.71,0,0,1,354.34,460.06Zm-4.75-10.43c-.5,2.54-.71,4.94.52,7.05a4.94,4.94,0,0,0,4,2.37,2.86,2.86,0,0,0,2.48-.89,14.37,14.37,0,0,0,2.69-6.18l-.29.83a3.77,3.77,0,0,1-2.81,2.51,5,5,0,0,1-4.61-1.84A9.49,9.49,0,0,1,349.59,449.63Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 354.301px 451.119px;"
                                            id="el9nz7w3t5wz5" class="animable"></path>
                                        <path
                                            d="M321.91,224.87s-3.84,1.34-3.68,1.84-6.13,32-6.13,32-4.47,11.6-4,15.74,4,9.11,7.95,9.11a7,7,0,0,0,6.29-3.64c.83-1.16,3.65-6.63,3.65-6.63s-1,10.44-1.33,11.43-2,3.64-1.16,4.47a13.92,13.92,0,0,0,4.31,2.49,107.4,107.4,0,0,0,25.34,2.15c11.27-.66,18.06-3.64,18.06-3.64a33.52,33.52,0,0,1,1.33-3.65c.33-.5,1-1.32,1-1.32s10.6-1.16,11.26-1.83,2.49-3.47,2.32-7.95,1.49-43.23.67-44.06a33.81,33.81,0,0,0-4.71-2.8l-19.19-10.73-28.62,3.76Z"
                                            style="fill: #3AADE1; transform-origin: 348.042px 255.871px;"
                                            id="elpuxquphkc2" class="animable"></path>
                                        <path
                                            d="M349.2,294.41a112.54,112.54,0,0,1-21.5-2.28,14.38,14.38,0,0,1-4.52-2.61c-.87-.87,0-2.63.62-4a10.17,10.17,0,0,0,.42-1c.18-.56.66-4.91,1-8.76-.88,1.66-2,3.72-2.49,4.41l-.15.21a7.36,7.36,0,0,1-6.55,3.64c-4.18,0-7.91-5-8.45-9.55-.51-4.22,3.82-15.5,4-16,2.39-12,6-30.31,6.09-31.71-.11-.39,0-1,4-2.39l.05,0,13.38-3.29,28.67-3.76a.46.46,0,0,1,.31.06l19.19,10.72a32.2,32.2,0,0,1,4.82,2.89c.51.51.56,4.57-.17,28.95-.22,7.4-.41,13.8-.35,15.44.18,4.64-1.72,7.58-2.46,8.33s-7.31,1.49-11.36,1.94c-.2.26-.61.78-.84,1.13a31.39,31.39,0,0,0-1.26,3.52.52.52,0,0,1-.28.3c-.28.13-7,3-18.23,3.69C351.89,294.38,350.55,294.41,349.2,294.41ZM326,272.76l.14,0a.51.51,0,0,1,.36.53c-.11,1.07-1,10.52-1.35,11.54-.1.27-.27.64-.46,1.06-.36.75-1.2,2.53-.82,2.9a13.47,13.47,0,0,0,4.09,2.36,106.68,106.68,0,0,0,25.18,2.13,59,59,0,0,0,17.68-3.52,26.83,26.83,0,0,1,1.31-3.55c.34-.5,1-1.32,1-1.36a.48.48,0,0,1,.34-.18c4.94-.54,10.4-1.33,11-1.7.59-.59,2.3-3.3,2.14-7.56-.06-1.68.13-8.09.35-15.51.32-10.67.8-26.72.4-28.28a35.38,35.38,0,0,0-4.52-2.65l-19.06-10.65-28.45,3.73-13.31,3.28a16.65,16.65,0,0,0-3.34,1.48c-.1,1-.91,5.9-6.12,31.95-.07.2-4.44,11.61-4,15.58s3.85,8.67,7.46,8.67a6.39,6.39,0,0,0,5.73-3.21l.16-.23c.79-1.11,3.58-6.51,3.6-6.56A.5.5,0,0,1,326,272.76Zm-7.31-46.2a.73.73,0,0,1,0,.23A.36.36,0,0,0,318.71,226.56Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 348.005px 255.862px;"
                                            id="el2894i7v3d07" class="animable"></path>
                                        <path
                                            d="M326,243.63c-.84-3.93-4.25-10.21-4.28-10.28l.88-.47c.14.26,3.51,6.47,4.38,10.54Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 324.35px 238.255px;"
                                            id="eljp1o2nvo1y" class="animable"></path>
                                        <path
                                            d="M321,264.64a.53.53,0,0,1-.41-.2c-1.58-2.21-5.87-2.78-5.92-2.79a.5.5,0,1,1,.13-1c.19,0,4.77.63,6.61,3.19a.5.5,0,0,1-.12.7A.52.52,0,0,1,321,264.64Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 317.867px 262.643px;"
                                            id="elmvxz0a03wpe" class="animable"></path>
                                        <path
                                            d="M322.3,263.58a.5.5,0,0,1-.46-.29,6.67,6.67,0,0,0-2.47-2,.5.5,0,0,1,.46-.89c.25.13,2.39,1.27,2.93,2.46a.51.51,0,0,1-.25.66A.52.52,0,0,1,322.3,263.58Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 320.95px 261.962px;"
                                            id="el79a5y309gl2" class="animable"></path>
                                        <path
                                            d="M326,273.76a.51.51,0,0,1-.17,0,.49.49,0,0,1-.3-.64l.92-2.62-2.69-5.53-1.9.67a.48.48,0,0,1-.45-.05s-3.84-2.53-6.42-2.08-4.27,3.84-4.28,3.87a.5.5,0,0,1-.9-.44c.08-.16,2-3.88,5-4.41,2.63-.47,6.05,1.53,6.94,2.09l2.09-.75a.51.51,0,0,1,.62.26l3,6.12a.48.48,0,0,1,0,.39l-1,2.82A.51.51,0,0,1,326,273.76Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 318.63px 268.113px;"
                                            id="el1u9ckq8af2u" class="animable"></path>
                                        <path
                                            d="M376.94,243.12a.43.43,0,0,1-.19,0,.51.51,0,0,1-.27-.66c.79-1.84,3.28-7.48,3.28-7.48l.92.41s-2.49,5.63-3.28,7.47A.49.49,0,0,1,376.94,243.12Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 378.561px 239.055px;"
                                            id="el4fc2bx8yet3" class="animable"></path>
                                        <path
                                            d="M373.56,285.69a.49.49,0,0,1-.34-.14l-9.64-9.1a.5.5,0,0,1,0-.71.49.49,0,0,1,.7,0l9.64,9.1a.5.5,0,0,1-.34.87Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 368.758px 280.651px;"
                                            id="elb0qq01xjkj" class="animable"></path>
                                        <path
                                            d="M369.78,284.34a.5.5,0,0,1-.23,0l-9.65-5a.5.5,0,1,1,.46-.89l9.65,5a.5.5,0,0,1-.23.94Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 364.951px 281.392px;"
                                            id="elnqt2owp5vfn" class="animable"></path>
                                        <path
                                            d="M332.53,292.62a.49.49,0,0,1-.49-.45.5.5,0,0,1,.44-.55L358,288.87a.49.49,0,0,1,.55.44.5.5,0,0,1-.44.55l-25.52,2.76Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 345.295px 290.743px;"
                                            id="el8kfrtn5g1yi" class="animable"></path>
                                        <path
                                            d="M350.64,262.61h-.05a.5.5,0,0,1-.45-.55c.17-1.53,3.08-30.06,3.11-30.35a.5.5,0,1,1,1,.1c0,.29-2.93,28.82-3.1,30.36A.51.51,0,0,1,350.64,262.61Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 352.195px 246.933px;"
                                            id="elw13qm9f749" class="animable"></path>
                                        <path
                                            d="M348.23,283.31h-.05a.5.5,0,0,1-.45-.55l.86-9.48a.51.51,0,0,1,.54-.45.5.5,0,0,1,.46.54l-.87,9.48A.5.5,0,0,1,348.23,283.31Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 348.66px 278.069px;"
                                            id="elb9enpgekf7" class="animable"></path>
                                        <polygon
                                            points="365.7 213.04 363.16 219.47 354.79 229.03 347.32 219.17 347.93 206.71 357.33 215.28 365.7 213.04"
                                            style="fill: rgb(255, 255, 255); transform-origin: 356.51px 217.87px;"
                                            id="elxwy95grhc1s" class="animable"></polygon>
                                        <path
                                            d="M354.76,229.83l-7.95-10.5v-.18l.67-13.52,10,9.1,9.06-2.43-3,7.5ZM347.83,219l7,9.23,7.91-9,2.14-5.42-7.67,2.06-8.82-8Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 356.675px 217.73px;"
                                            id="elqqro4p5554j" class="animable"></path>
                                        <path
                                            d="M358.09,173.58s-14.73,5.33-16.76,9.52a64.81,64.81,0,0,0-3.93,12.31c0,.51-7,3.31-8.38,5.46s.12,8.51,0,10.29-6.6,3.81-7.24,7.74a12.79,12.79,0,0,0,.13,6l11.3-1.78s7.36,2.92,11.3,1.4,4.31-9.14,4.06-11.68-.64-6.1-.64-6.1L353.14,192l11.8-3.56,7.49,7-6.88,18.08s-2.17,4.39-1.79,5.53,3.85,2.29,3.85,2.29l15.49,7.24a8.47,8.47,0,0,0,.38-3.68c-.25-2-3.56-6.35-3.56-7.62s4.32-6.22,2.29-10.66-4.19-6.86-5.33-9.14,1-6.61-1.27-12.19-9.78-10.41-11.81-11.55S358.09,173.58,358.09,173.58Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 352.512px 200.884px;"
                                            id="ell052fy6don8" class="animable"></path>
                                        <path
                                            d="M383.37,229.23l-16-7.46c-.57-.19-3.68-1.28-4.11-2.59s1.28-4.84,1.82-5.91l6.74-17.72-7-6.56-11.29,3.4-5.08,14.38c.07.63.4,3.71.62,6,.22,2.13.1,10.46-4.37,12.19-3.83,1.48-10.49-.95-11.54-1.35l-11.57,1.82-.14-.38a13.18,13.18,0,0,1-.15-6.22c.41-2.53,2.91-4.26,4.93-5.65,1.06-.73,2.26-1.56,2.3-2a19.34,19.34,0,0,0-.22-2.64c-.34-2.78-.76-6.24.3-7.88.94-1.46,4-3.08,6.3-4.26a22,22,0,0,0,2-1.12,65.38,65.38,0,0,1,4-12.34c2.1-4.32,16.43-9.55,17-9.77h0c.15,0,3.9-1.06,6.09.17.09,0,9.38,5.33,12,11.8a17.85,17.85,0,0,1,1,8.62,7.47,7.47,0,0,0,.23,3.53A29.31,29.31,0,0,0,379,200a44.31,44.31,0,0,1,3.64,6.37c1.57,3.42-.36,7.07-1.51,9.25a7.31,7.31,0,0,0-.73,1.62,12.22,12.22,0,0,0,1.48,3,15.21,15.21,0,0,1,2.07,4.54,8.74,8.74,0,0,1-.41,3.92Zm-18.29-41.36,7.94,7.41-7,18.39c-1,2.06-2,4.61-1.79,5.19s2,1.46,3.54,2l15,7a8.06,8.06,0,0,0,.19-2.92,15.49,15.49,0,0,0-2-4.16c-1-1.73-1.61-2.82-1.61-3.52a5.59,5.59,0,0,1,.85-2.08c1.13-2.15,2.84-5.4,1.48-8.38a43.62,43.62,0,0,0-3.56-6.23,30,30,0,0,1-1.76-2.89,8.15,8.15,0,0,1-.32-4,17.06,17.06,0,0,0-1-8.17c-2.52-6.15-11.5-11.26-11.59-11.31-1.76-1-5.05-.15-5.32-.08-.61.22-14.57,5.37-16.46,9.26a64.22,64.22,0,0,0-3.88,12.11c0,.46-.4.69-2.54,1.8s-5.12,2.67-5.92,3.92-.43,4.87-.15,7.21a19,19,0,0,1,.23,2.83c-.07,1-1.25,1.78-2.74,2.81-1.85,1.28-4.16,2.87-4.51,5a14.32,14.32,0,0,0,0,5.32l11-1.73.13.05c.07,0,7.23,2.83,10.94,1.4s4-8.67,3.74-11.16-.63-6.09-.63-6.09l0-.12,0-.1,5.29-15Zm-28.18,7.5v0Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 352.508px 200.988px;"
                                            id="el56lnru38b0b" class="animable"></path>
                                        <path
                                            d="M363.42,183.86s-11.42,5.08-12.31,7.49-3.3,13.59-3.18,15.36,7.75,10.92,9.27,11.18,9.35-4.28,10.75-5.3,6-16.29,5.88-18.7S364.69,184,363.42,183.86Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 360.879px 200.88px;"
                                            id="elxef6vwkb9n" class="animable"></path>
                                        <path
                                            d="M357.3,218.39h-.18c-1.76-.29-9.54-9.64-9.69-11.63s2.35-13.25,3.21-15.57c.93-2.54,11.39-7.25,12.58-7.77l.12-.06.13,0c1.42.14,10.71,7.68,10.86,10.5.13,2.49-4.5,18-6.09,19.13C367.23,213.74,359.45,218.39,357.3,218.39Zm6.17-34c-4.36,2-11.31,5.54-11.89,7.14-.91,2.45-3.27,13.46-3.15,15.15.11,1.53,7.47,10.44,8.85,10.71,1.16.2,8.58-3.9,10.37-5.2,1.14-.86,5.81-15.89,5.68-18.27C373.22,191.83,364.85,184.92,363.47,184.39Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 360.878px 200.875px;"
                                            id="el1ospf8tgym4" class="animable"></path>
                                        <path
                                            d="M374.19,196.14c-4.57-1.37-9.39-9-10.8-11.34-1.37,1.9-5.69,7.26-12.27,9l-.26-1c7.51-2,12.09-9.18,12.14-9.25l.45-.72.41.74c.05.1,5.69,10.09,10.62,11.57Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 362.67px 189.485px;"
                                            id="elcmo4y5krqar" class="animable"></path>
                                        <path
                                            d="M348.23,194.6l-.19-1c3.72-.75,14.95-10.05,15.06-10.14l.64.77C363.27,184.64,352.2,193.8,348.23,194.6Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 355.89px 189.03px;"
                                            id="el6h32eji8cte" class="animable"></path>
                                        <path
                                            d="M360.93,208.09A3.51,3.51,0,0,1,360,208a.5.5,0,0,1,.28-1,4,4,0,0,0,3.11-.8.5.5,0,0,1,.61.79A5.51,5.51,0,0,1,360.93,208.09Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 361.896px 207.103px;"
                                            id="elp0ac4ohrayg" class="animable"></path>
                                        <path
                                            d="M360.23,210.9a6.5,6.5,0,0,1-4.82-2.23.5.5,0,0,1,.79-.61,5.43,5.43,0,0,0,6.64,1.24.5.5,0,1,1,.4.92A7.36,7.36,0,0,1,360.23,210.9Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 359.433px 209.395px;"
                                            id="elct0i1410hu" class="animable"></path>
                                        <path
                                            d="M360.12,196.68a.49.49,0,0,1-.28-.09s-3-2-5.73-.72a.5.5,0,0,1-.42-.91c3.27-1.49,6.57.71,6.71.8a.5.5,0,0,1,.13.7A.49.49,0,0,1,360.12,196.68Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 357.009px 195.562px;"
                                            id="el3k9d2kwzjmh" class="animable"></path>
                                        <path
                                            d="M371.17,197.69a.54.54,0,0,1-.36-.14c-1.4-1.4-4.63-.16-4.67-.15a.5.5,0,0,1-.36-.93c.15-.06,3.88-1.49,5.74.37a.51.51,0,0,1,0,.71A.54.54,0,0,1,371.17,197.69Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 368.579px 196.789px;"
                                            id="el035lnxo4cjvc" class="animable"></path>
                                        <path
                                            d="M357.83,200c-.08.77-.63,1.34-1.22,1.28a1.28,1.28,0,0,1-.93-1.51c.09-.76.63-1.33,1.23-1.27A1.27,1.27,0,0,1,357.83,200Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 356.755px 199.89px;"
                                            id="elo7nk9iiff2a" class="animable"></path>
                                        <path
                                            d="M367.86,201.5a1.12,1.12,0,1,1-2.15-.23c.08-.77.63-1.34,1.22-1.28A1.28,1.28,0,0,1,367.86,201.5Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 366.761px 201.391px;"
                                            id="elo85iuofno3j" class="animable"></path>
                                        <polygon
                                            points="343.13 224.7 347.62 232.62 353.3 226.94 347.32 219.17 343.13 224.7"
                                            style="fill: #3AADE1; transform-origin: 348.215px 225.895px;"
                                            id="el2bgrtewt32w" class="animable"></polygon>
                                        <path
                                            d="M347.62,233.12h-.07a.53.53,0,0,1-.37-.25L342.7,225a.5.5,0,0,1,0-.55l4.19-5.53a.54.54,0,0,1,.4-.2.47.47,0,0,1,.39.2l6,7.77a.49.49,0,0,1,0,.66L348,233A.5.5,0,0,1,347.62,233.12Zm-3.89-8.38,4,7.06,4.9-4.9L347.32,220Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 348.213px 225.921px;"
                                            id="elzj15ujeit3g" class="animable"></path>
                                        <polygon
                                            points="356.88 227.24 360.92 233.07 367.61 221.31 363.91 217.82 356.88 227.24"
                                            style="fill: #3AADE1; transform-origin: 362.245px 225.445px;"
                                            id="elmhrqjymrib" class="animable"></polygon>
                                        <path
                                            d="M360.92,233.57a.51.51,0,0,1-.41-.21l-4-5.83a.53.53,0,0,1,0-.59l7-9.41a.46.46,0,0,1,.36-.2.45.45,0,0,1,.38.13L368,221a.5.5,0,0,1,.1.61l-6.7,11.76a.49.49,0,0,1-.41.25Zm-3.42-6.32,3.38,4.88,6.1-10.72-3-2.84Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 362.291px 225.473px;"
                                            id="eliwhsvkvrii" class="animable"></path>
                                        <polygon
                                            points="337.97 266.75 329.18 266.75 328.08 246.41 339.07 246.41 337.97 266.75"
                                            style="fill: rgb(255, 255, 255); transform-origin: 333.575px 256.58px;"
                                            id="elho1o7ealpa8" class="animable"></polygon>
                                        <path d="M338.44,267.25h-9.73l-1.16-21.34h12Zm-8.79-1h7.84l1.05-19.34h-9.93Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 333.55px 256.58px;"
                                              id="elqubqyl2xdpr" class="animable"></path>
                                        <rect x="326.92" y="244.68" width="13.11" height="3.08"
                                              style="fill: rgb(38, 50, 56); transform-origin: 333.475px 246.22px;"
                                              id="eljqmr7nz09x" class="animable"></rect>
                                        <path d="M340.53,248.26H326.42v-4.08h14.11Zm-13.11-1h12.11v-2.08H327.42Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 333.475px 246.22px;"
                                              id="eltlr1tba968n" class="animable"></path>
                                        <rect x="328.76" y="243.23" width="9.64" height="1.45"
                                              style="fill: rgb(38, 50, 56); transform-origin: 333.58px 243.955px;"
                                              id="elql9quioww" class="animable"></rect>
                                        <path d="M338.89,245.18H328.26v-2.45h10.63Zm-9.63-1h8.63v-.45h-8.63Z"
                                              style="fill: rgb(38, 50, 56); transform-origin: 333.575px 243.955px;"
                                              id="elqv52uzasrb" class="animable"></path>
                                        <path
                                            d="M327.66,268.57c0,.05,0,.1,0,.12a4.11,4.11,0,0,1-3.57,2.75,3.14,3.14,0,0,1-2.41-.78,3.81,3.81,0,0,1-1-2.37,4.94,4.94,0,0,1,1.42-4.54c.42-.5,2-1.79,2.12-2.43l.89-7s8.72-2,9.47-1.89a1,1,0,0,1,.76,1.42c-.19.57-1.51.85-1.8.94s-4.55,1.14-4.55,1.14l-1.51,1.8a18.58,18.58,0,0,1,2.27-.95c.29,0,5-.66,5.59-.75a1,1,0,0,1,.95,1.42c-.38.76-.66.94-.95.94s-5,.86-5,.86l-2.65,2.27s3.6-1.14,4-1.14,3.69-.09,3.79.48a1.19,1.19,0,0,1-.76,1.42c-.66.19-3.22.57-3.22.57l-2.85,1.51h2.75s2.66.86,3.22,1,1,.38.19,1.23-6.65.17-6.65.17S327.76,268.11,327.66,268.57Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 328.483px 261.941px;"
                                            id="el4kq9f05zmqv" class="animable"></path>
                                        <path
                                            d="M323.75,272a3.5,3.5,0,0,1-2.45-.93,4.22,4.22,0,0,1-1.17-2.68,5.42,5.42,0,0,1,1.54-4.92c.13-.15.37-.39.65-.65a7.06,7.06,0,0,0,1.35-1.51l.94-7.37.34-.08c2.06-.47,8.85-2,9.65-1.9a1.36,1.36,0,0,1,1,.63,1.74,1.74,0,0,1,.15,1.45c-.25.73-1.36,1-2,1.21l-.16.05c-.27.09-3.45.87-4.43,1.11l0,0a1.46,1.46,0,0,1,.51-.13c.34,0,4.91-.65,5.51-.75a1.51,1.51,0,0,1,1.48,2.14c-.31.61-.71,1.23-1.4,1.23-.26,0-3,.5-4.8.82l-.73.62a12.85,12.85,0,0,1,1.84-.45h.15c3.35,0,4,.28,4.13.9a1.67,1.67,0,0,1-1.11,2c-.63.18-2.74.5-3.2.57l-1,.53.91,0c1,.34,2.76.86,3.15.93a1.13,1.13,0,0,1,1,.66c.19.53-.2,1.05-.5,1.4-.84.94-5.23.54-6.66.38,0,.17-.07.38-.12.59s-.13.67-.18.85h0a.84.84,0,0,1-.05.18,4.61,4.61,0,0,1-4,3.08Zm1.76-17.24-.85,6.68c-.07.58-.73,1.24-1.65,2.11a8,8,0,0,0-.58.57,4.44,4.44,0,0,0-1.3,4.16,3.3,3.3,0,0,0,.86,2.07,2.66,2.66,0,0,0,2,.64,3.61,3.61,0,0,0,3.14-2.42l.51.05-.49-.12c0-.17.11-.5.17-.82.27-1.32.31-1.48.78-1.43,2.6.3,5.8.37,6.23,0a2,2,0,0,0,.27-.37l-.17,0c-.55-.1-2.72-.79-3.22-1h-4.66l4.76-2.51c.71-.1,2.64-.4,3.16-.55a.65.65,0,0,0,.42-.71,11.34,11.34,0,0,0-3.15-.21h-.16c-.27,0-2.16.58-3.83,1.11l-2.34.74,4.62-4,.13,0c1.79-.33,4.83-.86,5.11-.86.06,0,.24-.15.5-.68a.44.44,0,0,0-.05-.48.47.47,0,0,0-.37-.22c-.29.05-5.29.76-5.67.76-.17,0-1.21.5-2.06.9l-2.08,1,3.11-3.7.15,0c1.63-.4,4.3-1.06,4.52-1.13l.2-.06c1.06-.3,1.25-.5,1.28-.57a.74.74,0,0,0,0-.59.38.38,0,0,0-.31-.18C334,252.89,329.53,253.8,325.51,254.71Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 328.415px 261.978px;"
                                            id="elsl02dy3x2x" class="animable"></path>
                                        <path
                                            d="M373.62,264.49,371.74,267s0,15,.59,16.25,5.18,4.71,7.65,4.71,7.31-5.65,7.54-6.59-6.12-19.2-6-19.67-.58-1.06-1.41-1.06S373.62,264.49,373.62,264.49Z"
                                            style="fill: #3AADE1; transform-origin: 379.633px 274.3px;"
                                            id="elkd392pao7s" class="animable"></path>
                                        <path
                                            d="M380,288.43c-2.72,0-7.45-3.55-8.11-5s-.63-13.95-.63-16.46a.45.45,0,0,1,.1-.3l1.88-2.48.12-.11c2.16-1.48,5.91-4,6.76-4a2.16,2.16,0,0,1,1.67.75,1.13,1.13,0,0,1,.25.84c.1.55,1.18,3.85,2.23,7.05,3.16,9.66,3.9,12.15,3.76,12.71C387.71,282.66,382.72,288.43,380,288.43Zm-7.74-21.29c0,7.15.19,15.1.54,15.88.54,1.18,5,4.41,7.2,4.41s6.8-5.29,7.06-6.21c0-.72-2.25-7.6-3.74-12.16-2.28-6.94-2.34-7.24-2.27-7.51a1.07,1.07,0,0,0-.93-.44,42.78,42.78,0,0,0-6.13,3.75Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 379.653px 274.255px;"
                                            id="elxyaylzjj9l" class="animable"></path>
                                        <path
                                            d="M380.15,255.56l.3,6.34s-.35,2.59-2,3.65a8.23,8.23,0,0,1-3.89,1.06l-1.06-2.12-1.64-1.65Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 376.155px 261.085px;"
                                            id="elnnp9basvyyb" class="animable"></path>
                                        <path
                                            d="M374.56,267.11h-.3l-1.17-2.32-2-2,9.47-8.32.35,7.38c0,.2-.41,2.92-2.23,4.1A8.68,8.68,0,0,1,374.56,267.11Zm-2-4.24,1.36,1.4.92,1.83a7.38,7.38,0,0,0,3.31-1c1.44-.92,1.78-3.27,1.78-3.3l-.26-5.21Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 376px 260.79px;"
                                            id="el45w05fff9y3" class="animable"></path>
                                        <polygon
                                            points="382.06 246.94 370.13 244.45 362.66 264.38 372.75 266.21 382.06 246.94"
                                            style="fill: rgb(38, 50, 56); transform-origin: 372.36px 255.33px;"
                                            id="elqccs1rlr4v" class="animable"></polygon>
                                        <path
                                            d="M373,266.77l-11-2,7.83-20.88,13,2.71ZM363.34,264l9.12,1.66,8.87-18.35L370.45,245Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 372.415px 255.33px;"
                                            id="elbuorv29cp9k" class="animable"></path>
                                        <path
                                            d="M380.42,252s-8,.36-8.09,1,.18,1.42.45,1.51,7.37,1.07,7.37,1.07,2-.45,1.86-2.05A1.5,1.5,0,0,0,380.42,252Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 377.165px 253.789px;"
                                            id="el0gt1r8uferg" class="animable"></path>
                                        <path
                                            d="M380.17,256.07l-.09,0c-2.67-.36-7.19-1-7.46-1.08-.63-.21-.88-1.36-.78-2.06.06-.43.15-1,8.55-1.4a2.16,2.16,0,0,1,1.48.5,2.06,2.06,0,0,1,.64,1.48,2.67,2.67,0,0,1-2.25,2.55ZM373,254c.61.11,4.58.67,7.12,1,.32-.09,1.45-.5,1.4-1.51a1,1,0,0,0-1.08-1l0-.5,0,.5a49.76,49.76,0,0,0-7.62.75A1.75,1.75,0,0,0,373,254Zm0,0Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 377.164px 253.799px;"
                                            id="elro92d54o82m" class="animable"></path>
                                        <path
                                            d="M375.89,255.11s-7-.8-7.37-.35-.71,1.06.35,1.51a81.83,81.83,0,0,0,8,2.22,3.36,3.36,0,0,0,2.49-1.33,1.72,1.72,0,0,0,.18-1.43Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 373.89px 256.556px;"
                                            id="elqyh1286xev" class="animable"></path>
                                        <path
                                            d="M376.86,259a75.28,75.28,0,0,1-8.18-2.26,1.53,1.53,0,0,1-1-1,1.57,1.57,0,0,1,.44-1.33c.18-.23.52-.66,7.81.17h0l3.89.67.11.22a2.12,2.12,0,0,1-.17,1.87A3.85,3.85,0,0,1,376.86,259Zm-8-3.83c-.19.26-.18.35-.18.37s.11.15.4.28c1.12.46,7.28,2.14,7.81,2.18a2.88,2.88,0,0,0,2-1.06,1.67,1.67,0,0,0,.21-.76l-3.29-.56A46.21,46.21,0,0,0,368.84,255.16Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 373.868px 256.546px;"
                                            id="eltjk8dd14bg" class="animable"></path>
                                        <path
                                            d="M372.25,257.42s-5.33-1.06-5.6-.53-.35,1.42.18,1.78,7.64,2.3,8.08,2.48,1.51-.35,1.86-1.06a2.44,2.44,0,0,0,.09-1.6Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 371.696px 258.964px;"
                                            id="elq39niqt07se" class="animable"></path>
                                        <path
                                            d="M375.11,261.69a1.23,1.23,0,0,1-.39-.07c-.13-.06-1.13-.35-2.11-.63a50.47,50.47,0,0,1-6.06-1.91,1.9,1.9,0,0,1-.35-2.41c.17-.33.44-.88,6.14.26h0l4.9,1.14.08.27a2.89,2.89,0,0,1-.12,2A2.67,2.67,0,0,1,375.11,261.69ZM367,257.25c-.14.37-.15.86.06,1,.39.22,3.91,1.24,5.79,1.78,1.37.4,2,.59,2.21.66a1.47,1.47,0,0,0,1.34-1.79l-4.3-1A25.8,25.8,0,0,0,367,257.25Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 371.681px 258.967px;"
                                            id="elg4sb66f77pu" class="animable"></path>
                                        <path
                                            d="M372.42,260.53s-4-.8-4.17-.35-.27,1.42.53,1.68,5.42,2.13,6.22,1.6.53-1.95.53-1.95Z"
                                            style="fill: rgb(255, 255, 255); transform-origin: 371.853px 261.798px;"
                                            id="eljnl2qy1up4" class="animable"></path>
                                        <path
                                            d="M374.53,264.05a19.31,19.31,0,0,1-5.29-1.49l-.62-.22a1.38,1.38,0,0,1-.83-.74,2.13,2.13,0,0,1,0-1.61c.13-.35.33-.83,4.73.05h.05l3.4,1.07,0,.3c0,.17.3,1.76-.74,2.46A1.41,1.41,0,0,1,374.53,264.05Zm-5.87-3.51a1.12,1.12,0,0,0,0,.63.39.39,0,0,0,.25.22l.65.23c3.73,1.38,4.86,1.53,5.15,1.42s.35-.77.33-1.15L372.3,261A21,21,0,0,0,368.66,260.54Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 371.821px 261.795px;"
                                            id="el2q39d4lcg2t" class="animable"></path>
                                    </g>
                                    <g id="freepik--speech-bubble--inject-7" class="animable"
                                       style="transform-origin: 414.41px 168.964px;">
                                        <path
                                            d="M396.28,143.67h36.27a6.14,6.14,0,0,1,6.14,6.14v24.58a6.14,6.14,0,0,1-6.14,6.14h-21.3l-9.74,13.72V180.53h-5.23a6.14,6.14,0,0,1-6.15-6.14V149.81A6.14,6.14,0,0,1,396.28,143.67Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 414.41px 168.96px;"
                                            id="eldrh3g07jqye" class="animable"></path>
                                        <path
                                            d="M401.51,194.75a.4.4,0,0,1-.15,0,.49.49,0,0,1-.35-.47V181h-4.73a6.65,6.65,0,0,1-6.65-6.64V149.81a6.65,6.65,0,0,1,6.65-6.64h36.27a6.65,6.65,0,0,1,6.64,6.64v24.58a6.65,6.65,0,0,1-6.64,6.64h-21l-9.59,13.51A.52.52,0,0,1,401.51,194.75Zm-5.23-50.58a5.65,5.65,0,0,0-5.65,5.64v24.58a5.65,5.65,0,0,0,5.65,5.64h5.23a.5.5,0,0,1,.5.5v12.15l8.84-12.44a.49.49,0,0,1,.4-.21h21.3a5.65,5.65,0,0,0,5.64-5.64V149.81a5.65,5.65,0,0,0-5.64-5.64Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 414.41px 168.964px;"
                                            id="elmb4dxhwq4fn" class="animable"></path>
                                        <path
                                            d="M412.12,174.43H412a3.5,3.5,0,0,1-2.73-1.5l-6.59-9.45a3.5,3.5,0,1,1,5.74-4l4,5.67,13.86-16.85a3.5,3.5,0,0,1,5.41,4.44l-16.79,20.42A3.51,3.51,0,0,1,412.12,174.43Z"
                                            style="fill: #3AADE1; transform-origin: 417.213px 160.751px;"
                                            id="elwie0eribl6" class="animable"></path>
                                        <path
                                            d="M428.91,147a3.44,3.44,0,0,1,2.22.8,3.49,3.49,0,0,1,.49,4.92l-16.79,20.42a3.51,3.51,0,0,1-2.71,1.28H412a3.5,3.5,0,0,1-2.73-1.5l-6.59-9.45a3.5,3.5,0,1,1,5.74-4l4,5.67,13.86-16.85a3.46,3.46,0,0,1,2.7-1.28m0-2a5.48,5.48,0,0,0-4.25,2l-12.18,14.81-2.44-3.5a5.5,5.5,0,0,0-9,6.29l6.59,9.46a5.54,5.54,0,0,0,4.29,2.35h.22a5.5,5.5,0,0,0,4.25-2L433.16,154a5.5,5.5,0,0,0-4.25-9Z"
                                            style="fill: rgb(38, 50, 56); transform-origin: 417.358px 160.71px;"
                                            id="el0q78e9b558gh" class="animable"></path>
                                    </g>
                                    <defs>
                                        <filter id="active" height="200%">
                                            <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                                          radius="2"></feMorphology>
                                            <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>
                                            <feComposite in="PINK" in2="DILATED" operator="in"
                                                         result="OUTLINE"></feComposite>
                                            <feMerge>
                                                <feMergeNode in="OUTLINE"></feMergeNode>
                                                <feMergeNode in="SourceGraphic"></feMergeNode>
                                            </feMerge>
                                        </filter>
                                        <filter id="hover" height="200%">
                                            <feMorphology in="SourceAlpha" result="DILATED" operator="dilate"
                                                          radius="2"></feMorphology>
                                            <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>
                                            <feComposite in="PINK" in2="DILATED" operator="in"
                                                         result="OUTLINE"></feComposite>
                                            <feMerge>
                                                <feMergeNode in="OUTLINE"></feMergeNode>
                                                <feMergeNode in="SourceGraphic"></feMergeNode>
                                            </feMerge>
                                            <feColorMatrix type="matrix"
                                                           values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>
                                        </filter>
                                    </defs>
                                </svg>
                                {{--                                <img src="{{asset('frontend/join.png')}}" alt="">--}}
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- End Pricing Area -->



@stop
