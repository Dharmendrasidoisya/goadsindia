@extends('frontend.layout.productmaster')
@section('content')


    <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    	@foreach($Project_front as $Project) 
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">{{ $Project->project_name }}</span>
                        <div class="nav-area-navigation">
                            <a href="index.html">home</a>
                            <a class="current">{{ $Project->project_name }}</a>
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
            <!-- Sidebar -->
            <div class="col-xl-4 col-md-12 col-sm-12 col-12 order-last order-md-first">
                
                {{-- Related Products --}}
                @if(isset($Projectsrelated) && $Projectsrelated->isNotEmpty())
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">Related Products</h5>
                        </div>
                        <div class="wized-body">
                            @foreach($Projectsrelated as $relatedProject)
                                <ul class="single-categories">
                                    <li>
                                        <a href="{{ url('products/' . Str::slug($relatedProject->project_name) . '/' . $relatedProject->id) }}">
                                            {{ $relatedProject->project_name }}
                                            <i class="far fa-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Contact Box --}}
                <div class="rts-single-wized contact">
                    <div class="wized-header">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" loading="lazy" alt="Business_logo" style="width: 150px;">
                        </a>
                    </div>
                    <div class="wized-body">
                        <h5 class="title">Need Help? We Are Here To Help You</h5>
                        <a class="rts-btn btn-primary" href="{{ url('contact-us') }}">Contact Us</a>


                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                @if(isset($Project))
                    <div class="blog-single-post-listing details mb--0">
                        <div class="thumbnail text-center">
                            <img src="{{ asset($Project->project_image) }}" loading="lazy" alt="{{ $Project->project_name }}">
                        </div>
                        <div class="blog-listing-content">
                            <h3 class="title animated fadeIn">{{ $Project->project_name }}</h3>
                            <p class="disc para-1">
                                {!! $Project->project_description !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
