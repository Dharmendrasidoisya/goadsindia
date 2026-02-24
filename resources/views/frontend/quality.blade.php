@extends('frontend.layout.master')
@section('content')  
   <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section top-position1 bg-img cover-background left-overlay-secondary" data-overlay-dark="85" data-background="img/banner/page-title-01.jpg">
            <div class="container">                
                <h1>Quality Assurance</h1>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Quality Assurance</li>
                </ul>                
            </div>
        </section>

        <!-- ABOUT US
        ================================================== -->
        <section class="about-style-02 pb-lg-20">
            <div class="container">
                <div class="row align-items-center justify-content-center mt-n1-9 mt-md-n6">
                    <div class="col-lg-12 mt-1-9 mt-md-6 order-2 order-lg-1 wow fadeIn" data-wow-delay="100ms">
                            @foreach ( $quality as  $qualitys)
                        <div class="pe-lg-6 pe-xl-10">
                                {{-- <div class="section-title-01 mb-1-9">
                                    <span class="text-primary font-weight-600 text-uppercase letter-spacing-1 position-relative ps-2">Quality</span>
                                    <h2 class="display-5 lh-1 font-weight-800 mb-0">QUALITY & COMPLIANCE</h2>
                                </div> --}}
                                <div>
                                {!! $qualitys->testimonial_description !!}
                            </div>
                        
                        </div>
                        @endforeach
                    </div>
          
                </div>
            </div>
        </section>

@endsection