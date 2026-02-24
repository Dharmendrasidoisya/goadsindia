@extends('frontend.layout.blogmaster')
@section('content')

    <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
           @foreach ($blogPosted as $blogPoste)
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">{!! \Illuminate\Support\Str::of($blogPoste->post_title)->words(5, '...') !!}</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">{!! \Illuminate\Support\Str::of($blogPoste->post_title)->words(5, '...') !!}</a>
                        </div>
                    </div>
            @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->

<div class="rts-blog-list-area rts-section-gap">
    <div class="container">
        <div class="row g-5">

            <!-- Main Blog Content -->
            <div class="col-xl-8 col-md-12 col-sm-12 col-12 order-1 order-md-1 order-xl-1">
                @if(isset($blogPosted) && $blogPosted->isNotEmpty())
                    @foreach ($blogPosted as $blogPoste)
                        <div class="blog-single-post-listing details mb--50">
                            <!-- Blog Image -->
                            <div class="thumbnail text-center mb-3">
                                <img src="{{ asset($blogPoste->post_image) }}" loading="lazy" alt="{{ $blogPoste->post_title }}">
                            </div>

                            <!-- Blog Content -->
                            <div class="blog-listing-content">
                                <h3 class="title animated fadeIn">{{ $blogPoste->post_title }}</h3>
                                <p class="disc para-1 mt-3">
                                    {!! $blogPoste->post_short_description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Sidebar (Related Blogs) -->
            <div class="col-xl-4 col-md-12 col-sm-12 col-12 order-2 order-md-2 order-xl-2">
                
                {{-- Related Blogs --}}
                @if(isset($blogPost) && $blogPost->isNotEmpty())
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">Related Blogs</h5>
                        </div>
                        <div class="wized-body">
                            @foreach($blogPost as $relatedBlog)
                                {{-- Skip current blog --}}
                                @if(!isset($blogPoste) || $relatedBlog->id !== $blogPoste->id)
                                    <ul class="single-categories">
                                        <li>
                                            <a href="{{ url('blogs/' . Str::slug($relatedBlog->post_title) . '/' . $relatedBlog->id) }}">
                                                {{ $relatedBlog->post_title }}
                                                <i class="far fa-long-arrow-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>

    

@endsection
