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

        .blog-details-desc .article-image {
            border: 5px solid #e9ecef;
            border-radius: 10px;
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
                        <h2>Blog Details</h2>
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{ route('blogs') }}">Blog</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Blog Area -->
    <section class="blog-area ptb-100">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                            <img src="{{ asset('uploads/blogs') . '/' . $post->image }}" alt="{{ $post->slug }}">
                        </div>

                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="far fa-clock"></i> <a>{{ $post->created_at }}</a></li>
                                    <li><i class="fas fa-user"></i> <a>
                                            {{ $post->author }}
                                        </a></li>
                                </ul>
                            </div>
                            <h3>{{ ucwords($post->title) }}</h3>
                            {!! $post->description !!}
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!-- Right sidebar Area -->
                <div class="col-lg-4 col-md-12">
                    @includeIf('frontend.partials.post_sidebar')
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- End Blog Area -->



@stop

{{-- @push('js')
    @if (session('javascript'))
        <script>
            document.cookie = "javascript=javascript";
        </script>
    @endif
@endpush --}}
