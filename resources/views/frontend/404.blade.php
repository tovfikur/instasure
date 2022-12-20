@extends('frontend.layouts.app')
@section('title', 'Blogs')
@push('css')
    <style>
        .fullimage>img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            padding: 5px;
            border-radius: 10px;
            background: #e5dddd;
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
                        <h2>Not Found</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Error Area -->
    <section class="error-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="error-content">
                        <img src="{{ asset('frontend/404.png') }}" alt="error" width="350">

                        <h5>Sorry! Page Not Found</h5>

                        <a href="{{ route('index') }}" class="default-btn">Go to Home <span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Error Area -->

@stop
