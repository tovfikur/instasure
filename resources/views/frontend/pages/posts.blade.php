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
                        <h2>{{ $type == 'blog' ? 'Blogs' : 'Press Releases' }}</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>{{ $type == 'blog' ? 'Blogs' : 'Press Releases' }}</li>
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
                    <div class="row">
                        @if (count($posts))
                            @foreach ($posts as $post)
                                <div class="col-lg-6 col-md-6">
                                    <div class="single-blog-post">
                                        <div class="post-image">
                                            <a
                                                href="{{ $type == 'blog' ? route('blog.details', $post->slug) : route('press_release.details', $post->slug) }}">
                                                <img src="{{ asset('uploads/blogs') . '/' . $post->image }}"
                                                    alt="{{ $post->title }}">
                                            </a>

                                            <div class="date"><i class="flaticon-calendar"></i>
                                                {{ $post->created_at->diffForHumans() }} </div>
                                        </div>
                                        <!-- /.post-image -->
                                        <div class="post-content">
                                            <h3>
                                                <a
                                                    href="{{ $type == 'blog' ? route('blog.details', $post->slug) : route('press_release.details', $post->slug) }}">
                                                    {{ $post->title }}
                                                </a>
                                            </h3>

                                            <div class="text-secondary" style="margin: -10px 0 5px 0; font-size: 12px">
                                                Posted on:
                                                <a
                                                    href="{{ $type == 'blog' ? route('blogs', ['category' => $post->category->slug]) : route('press_releases', ['category' => $post->category->slug]) }}">

                                                    <em>{{ ucwords($post->category->name) }}</em>

                                                </a>
                                            </div>
                                            <p>
                                                {!! substrings($post->description, 240) !!}
                                            </p>

                                            <a href="{{ $type == 'blog' ? route('blog.details', $post->slug) : route('press_release.details', $post->slug) }}"
                                                class="default-btn">Read
                                                More <span></span></a>
                                        </div>
                                        <!-- /.post-content -->
                                    </div>
                                    <!-- /.single-blog-post -->
                                </div>
                                <!-- /.col -->
                            @endforeach

                            <div class="col-lg-12 col-md-12">
                                <div class="pagination-area">

                                    {!! $posts->links() !!}
                                </div>
                                <!-- /.pagination-area -->
                            </div>
                            <!-- /.col -->
                        @endif
                    </div>
                    <!-- /.row -->
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
