@extends('frontend.layout.master')
@section('content')

  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
          
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">Catalogs</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">Catalogs</a>
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
                 @foreach ($application as $applications)
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="rts-blog-card-one">
                         <a href="{{ asset($applications->application_pdf) }}" class="thumbnail">
                            <img src="{{asset( $applications->application_image) }}" alt="{{ $applications->application_name}}">
                        </a>
                        <div class="inner-wrapper">
                               <a href="{{ asset($applications->application_pdf) }}"> <h5 class="title">{{ $applications->application_name}}</h5> </a>
                            <a href="{{ asset($applications->application_pdf) }}" class="rts-btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>
                       @endforeach
        
            </div>
          
        </div>
    </div>
    <!-- blog area end -->
       
@endsection
