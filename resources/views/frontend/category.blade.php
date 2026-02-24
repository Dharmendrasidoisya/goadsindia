@extends('frontend.layout.master')
@section('content')
  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">Products</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">Products</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->

        <div class="rts-blog-area rts-section-gap">
        <div class="container">
            <div class="row g-24 mt_sm--10">
                	@foreach($category as $categories)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    	
                    <div class="rts-blog-card-one">
                        <a href="{{ Str::slug($categories->category_name) . '/' . $categories->id }}" class="thumbnail">
                            <img src="{{asset( $categories->category_image) }}" alt="{{$categories->category_name}}">
                        </a>
                        <div class="inner-wrapper">
                            <a href="{{ Str::slug($categories->category_name) . '/' . $categories->id }}">
                                <h5 class="title">{{$categories->category_name}}</h5>
                            </a>
                            <p class="disc">
                  {!! Str::words(strip_tags($categories->category_description), 30, '...') !!}
                            </p>
                            <a href="{{ Str::slug($categories->category_name) . '/' . $categories->id }}" class="rts-btn btn-primary">Read More</a>
                        </div>
                    </div>
              
                </div>
                      @endforeach
          
            </div>
        </div>
    </div>


@endsection