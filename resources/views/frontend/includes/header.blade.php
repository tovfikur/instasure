<!-- Start Header Area -->
<header class="header-area">

    <!-- Start Top Header -->
    {{-- <div class="top-header"> --}}
    {{-- <div class="container"> --}}
    {{-- <div class="row align-items-center"> --}}
    {{-- <div class="col-lg-7 col-md-12"> --}}
    {{-- <div class="top-header-left-side"> --}}
    {{-- <ul> --}}
    {{-- <li> --}}
    {{-- <div class="icon"> --}}
    {{-- <i class="flaticon-call"></i> --}}
    {{-- </div> --}}
    {{-- <span>Call us:</span> --}}
    {{-- <a href="tel:01723144515">+880960-6252525</a> --}}
    {{-- </li> --}}

    {{-- <li> --}}
    {{-- </li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{-- <div class="col-lg-5 col-md-12"> --}}
    {{-- <div class="top-header-right-side"> --}}
    {{-- <ul> --}}
    {{-- <li> --}}
    {{-- @if (Auth::check()) --}}
    {{-- @if (Auth::user()->user_type == 'customer') --}}
    {{-- <a href="{{route('user.dashboard')}}" class="default-btn">Dashboard<span></span></a> --}}
    {{-- @elseif (Auth::user()->user_type == 'service_center') --}}
    {{-- <a href="{{route('serviceCenter.dashboard')}}" class="default-btn">Dashboard<span></span></a> --}}
    {{-- @elseif (Auth::user()->user_type == 'parent_dealer') --}}
    {{-- <a href="{{route('parentDealer.dashboard')}}" class="default-btn">Dashboard<span></span></a> --}}
    {{-- @elseif (Auth::user()->user_type == 'child_dealer') --}}
    {{-- <a href="{{route('childDealer.dashboard')}}" class="default-btn">Dashboard<span></span></a> --}}
    {{-- @elseif (Auth::user()->user_type == 'admin') --}}
    {{-- <a href="{{route('admin.dashboard')}}" class="default-btn">Dashboard<span></span></a> --}}
    {{-- @endif --}}
    {{-- @else --}}
    {{-- <a href="{{route('login')}}" class="default-btn">Sign In<span></span></a> --}}
    {{-- @endif --}}
    {{-- </li> --}}
    {{-- </ul> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    <!-- End Top Header -->

    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="pearo-responsive-nav">
            <div class="container">
                <div class="pearo-responsive-menu">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            {{-- <img src="{{asset('frontend/logo-instasure.jpeg')}}" alt="logo" width="142" height="47"> --}}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pearo-nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('frontend/logo-instasure-2.png') }}" alt="logo" width="142" height="47">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="{{ url('/') }}"
                                    class="nav-link  {{ request()->is('/') ? 'active' : '' }}">Home </a></li>
                            <li class="nav-item"><a href="{{ route('about') }}"
                                    class="nav-link {{ request()->is('about-us') ? 'active' : '' }}">About Us</a></li>
                            <li class="nav-item"><a href="{{ route('partner-program') }}"
                                    class="nav-link {{ request()->is('partner-program') ? 'active' : '' }}">Partner
                                    Program</a></li>
                            {{-- <li class="nav-item"><a href="#" class="nav-link">Partners --}}
                            {{-- <i class="flaticon-down-arrow"></i></a> --}}
                            {{-- <ul class="dropdown-menu"> --}}
                            {{-- <li class="nav-item"> --}}
                            {{-- <a href="#" class="nav-link">Why work with us</a> --}}
                            {{-- </li> --}}
                            {{-- <li class="nav-item"> --}}
                            {{-- <a href="#" class="nav-link">Our technology</a> --}}
                            {{-- </li> --}}
                            {{-- <li class="nav-item"> --}}
                            {{-- <a href="#" class="nav-link">Case study</a> --}}
                            {{-- </li> --}}
                            {{-- </ul> --}}
                            {{-- </li> --}}
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link
                                    {{ request()->is('mobile-phone-protection') || request()->is('international-travel-insurance') ? 'active' : '' }}">Products
                                    <i class="flaticon-down-arrow"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="{{ route('mobile-phone-protection') }}"
                                            class="nav-link">Mobile
                                            Phone protection plan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('international-travel-insurance') }}"
                                            class="nav-link">International Travel Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('health-insurance') }}" class="nav-link">Health
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('life-insurance') }}" class="nav-link">Life
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('agriculture-insurance') }}"
                                            class="nav-link">Agriculture Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('car-insurance') }}" class="nav-link">Car
                                            Insurance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('home-insurance') }}" class="nav-link">Home
                                            Insurance</a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-item"><a href="#" class="nav-link">Insurance --}}
                            {{-- <i class="flaticon-down-arrow"></i></a> --}}
                            {{-- <ul class="dropdown-menu"> --}}
                            {{-- @foreach (\App\Model\Category::all() as $category) --}}
                            {{-- <li class="nav-item"><a href="{{route('insurance.details',$category->slug)}}" --}}
                            {{-- class="nav-link">{{$category->name}}</a></li> --}}
                            {{-- @endforeach --}}
                            {{-- </ul> --}}
                            {{-- </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('blogs') }}"
                                    class="nav-link @if (request()->is('blogs*')) active @endif">Blogs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('press_releases') }}"
                                    class="nav-link @if (request()->is('press-releases*')) active @endif">Press Releases
                                </a>
                            </li>
                            <li class="nav-item"><a href="{{ route('contact-us') }}"
                                    class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}">Contact</a>
                            </li>
                            <li class="nav-item">
                                {{-- @if (Auth::check()) --}}
                                {{-- <a href="{{route('claim-form')}}" class="nav-link">CLAIM</a> --}}
                                {{-- @else --}}
                                {{-- <a href="{{route('login')}}" class="nav-link">CLAIM</a> --}}
                                {{-- @endif --}}
                                <a href="{{ route('claim-form') }}"
                                    class="nav-link {{ request()->is('claim-form') ? 'active' : '' }}">CLAIM</a>
                            </li>
                            <li class="nav-item">
                                @if (Auth::check())
                                    @if (Auth::user()->user_type == 'customer')
                                        <a href="{{ route('user.dashboard') }}" class="nav-link">Dashboard</a>
                                    @elseif (Auth::user()->user_type == 'service_center')
                                        <a href="{{ route('serviceCenter.dashboard') }}"
                                            class="nav-link">Dashboard</a>
                                    @elseif (Auth::user()->user_type == 'parent_dealer')
                                        <a href="{{ route('parentDealer.dashboard') }}"
                                            class="nav-link">Dashboard</a>
                                    @elseif (Auth::user()->user_type == 'child_dealer')
                                        <a href="{{ route('childDealer.dashboard') }}"
                                            class="nav-link">Dashboard</a>
                                    @elseif (Auth::user()->user_type == 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="nav-link {{ request()->is('login') ? 'active' : '' }}">Sign In</a>
                                @endif
                            </li>
                        </ul>

                        {{-- <div class="others-option"> --}}
                        {{-- <div class="option-item"> --}}
                        {{-- <i class="search-btn flaticon-search"></i> --}}
                        {{-- <i class="close-btn flaticon-cross-out"></i> --}}

                        {{-- <div class="search-overlay search-popup"> --}}
                        {{-- <div class='search-box'> --}}
                        {{-- <form class="search-form"> --}}
                        {{-- <input class="search-input" name="search" placeholder="Search" type="text"> --}}

                        {{-- <button class="search-button mr-5" type="submit"><i class="flaticon-search"></i> --}}
                        {{-- </button> --}}
                        {{-- </form> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}

                        {{--  --}}{{-- <div class="burger-menu"> --}}
                        {{--  --}}{{-- <i class="flaticon-menu"></i> --}}
                        {{--  --}}{{-- </div> --}}
                        {{-- </div> --}}
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->

</header>
<!-- End Header Area -->

{{-- <!-- Sidebar Modal --> --}}
{{-- <div class="sidebar-modal"> --}}
{{-- <div class="sidebar-modal-inner"> --}}
{{-- <div class="sidebar-about-area"> --}}
{{-- <div class="title"> --}}
{{-- <h2>About Us</h2> --}}
{{-- <p>We believe brand interaction is key in communication. Real innovations and a positive customer experience are the heart of successful communication. No fake products and services. The customer is king, their lives and needs are the inspiration.</p> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- <div class="sidebar-instagram-feed"> --}}
{{-- <h2>Instagram</h2> --}}

{{-- <ul> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/1.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/2.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/3.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/4.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/5.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/6.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/7.jpg')}}" alt="image"></a></li> --}}
{{-- <li><a href="single-blog.html"><img src="{{asset('frontend/assets/img/blog-image/8.jpg')}}" alt="image"></a></li> --}}
{{-- </ul> --}}
{{-- </div> --}}

{{-- <div class="sidebar-contact-area"> --}}
{{-- <div class="sidebar-contact-info"> --}}
{{-- <div class="contact-info-content"> --}}
{{-- <h2> --}}
{{-- <a href="tel:+0881306298615">+088 130 629 8615</a> --}}
{{-- <span>OR</span> --}}
{{-- <a href="mailto:pearo@gmail.com">pearo@gmail.com</a> --}}
{{-- </h2> --}}

{{-- <ul class="social"> --}}
{{-- <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li> --}}
{{-- <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li> --}}
{{-- <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li> --}}
{{-- <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li> --}}
{{-- <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li> --}}
{{-- </ul> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- </div> --}}

{{-- <span class="close-btn sidebar-modal-close-btn"><i class="flaticon-cross-out"></i></span> --}}
{{-- </div> --}}
{{-- </div> --}}
{{-- <!-- End Sidebar Modal --> --}}
