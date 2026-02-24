@extends('frontend.layout.categorymaster')
@section('content')
{{-- <style>
    .two-line-desc{
    text-align: justify;
    display: -webkit-box;
    -webkit-line-clamp: 2;   /* number of lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

    </style> --}}
  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                           @foreach ($categoryed as $categories)
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">{{ $categories->category_name }}</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">{{ $categories->category_name }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->

    <div class="rts-blog-area rts-section-gap">
    <div class="container">
             <div class="section-title-01 mb-5 text-center wow fadeIn" data-wow-dela="100ms">

            <h2 class="text-dark">{{ $categories->category_name }}</h2>
         <div class="two-line-desc">
           {!!($categories->category_description)!!}
    {{-- {!! strip_tags($categories->category_description) !!} --}}
</div>

     {{-- @if(!empty($categories->category_pdf))
                 <br/>
                    <a href="{{ asset($categories->category_pdf) }}" target="_blank" class="rts-btn btn-primary" style="display: inline-block;">
                    Download Brochure
                    </a>
@endif --}}

        </div>
        <div class="row g-24 mt_sm--10">
            @forelse ($Projectsnew as $Project)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="rts-blog-card-one">
                        <a class="thumbnail">
                            <img src="{{ asset($Project->project_image) }}" alt="{{ $Project->project_name }}">
                        </a>
                        <div class="inner-wrapper">
                            <a>
                                <h5 class="title">{{ $Project->project_name }}</h5>
                            </a>
                            <p class="disc">
                                {!! Str::words(strip_tags($Project->project_description), 30, '...') !!}
                            </p>
                             <a href="{{route ('contact-us')}}" class="read-more-btn">
                                Get Info <i class="fa-sharp fa-regular fa-arrow-right"></i>
                            </a>
                            {{-- <a href="{{ url('products/' . Str::slug($Project->project_name) . '/' . $Project->id) }}" class="read-more-btn">
                                Read More <i class="fa-sharp fa-regular fa-arrow-right"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center mt-4">
                    <h3 style="color: #000;">No Products Available.</h3>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
