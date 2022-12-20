<aside class="widget-area" id="secondary">

    <section class="widget widget_pearo_posts_thumb">
        <h3 class="widget-title">Latest {{ $type == 'blog' ? 'Blogs' : 'Press Releases' }} </h3>
        @if (count($posts))
            @foreach ($posts->take(10) as $post)
                <article class="item">
                    <a href="{{ $type == 'blog' ? route('blog.details', $post->slug) : route('press_release.details', $post->slug) }}"
                        class="thumb">
                        <span class="fullimage cover bg1" role="img">
                            <img src="{{ asset('uploads/blogs') . '/' . $post->image }}" alt="{{ $post->slug }}">
                        </span>
                    </a>
                    <div class="info">
                        <time datetime="2021-06-30">

                            {{ date_format_custom($post->created_at) }}
                        </time>
                        <h4 class="title usmall">
                            <a
                                href="{{ $type == 'blog' ? route('blog.details', $post->slug) : route('press_release.details', $post->slug) }}">
                                {{ ucwords($post->title) }}
                            </a>
                        </h4>
                    </div>

                    <div class="clear"></div>
                </article>
            @endforeach
        @endif

    </section>
    <!-- /.widget -->
    <section class="widget widget_categories">
        <h3 class="widget-title">Categories</h3>

        <ul>

            @if (isset($categories) && count($categories))
                <li>
                    <a href="{{ $type == 'blog' ? route('blogs') : route('press_releases') }}">All Categories</a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a
                            href="{{ $type == 'blog'? route('blogs', ['category' => $category->slug]): route('press_releases', ['category' => $category->slug]) }}">{{ ucwords($category->name) }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </section>
    <!-- /.widget -->
</aside>
<!-- /.widget-area -->
