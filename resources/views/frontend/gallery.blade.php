@extends('frontend.layout.master')
@section('content')  
  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">Gallery</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">Gallery</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->
 <div class="rts-projects-area-inner rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="row g-24">
                               @foreach ($Services as $service)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="single-project-card-inner">
                                        <a href="{{ asset($service->services_image) }}" class="thumbnail gallery-image">
                                            <img src="{{ asset($service->services_image) }}" loading="lazy" alt="image">
                                        </a>
                                    </div>
                                </div>
                              @endforeach
                        
                           
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection