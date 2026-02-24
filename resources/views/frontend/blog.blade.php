@extends('frontend.layout.master')
@section('content')

  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
          
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">Blogs</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">Blogs</a>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->

     <!-- rts blog area start -->
    <div class="rts-blog-area rts-section-gap">
        <div class="container">
  
            <div class="row g-24 mt_sm--10">
                 @foreach ($blogPost as $blog)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="rts-blog-card-one">
                        <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}" class="thumbnail">
                            <img src="{{ $blog->post_image }}" alt="{{ $blog->post_title}}">
                        </a>
                        <div class="inner-wrapper">
                            <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}">
                                <h5 class="title">{{ $blog->post_title}}</h5>
                            </a>
                            <p class="disc">
                   {!! \Illuminate\Support\Str::words(strip_tags($blog->post_short_description), 20, '...') !!}
                            </p>
                            <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}" class="rts-btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                       @endforeach
        
            </div>
          
        </div>
    </div>
    <!-- blog area end -->
       
@endsection
