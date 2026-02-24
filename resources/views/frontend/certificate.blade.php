@extends('frontend.layout.master')
@section('content')  
   <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section top-position1 bg-img cover-background left-overlay-secondary" data-overlay-dark="85" data-background="img/banner/page-title-01.jpg">
            <div class="container">                
                <h1>Certificate</h1>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Certificate</li>
                </ul>                
            </div>
        </section>

        <!-- ABOUT US
        ================================================== -->
        <section class="about-style-02 pb-lg-20">
            <div class="container">
                <div class="row align-items-center justify-content-center mt-n1-9 mt-md-n6">
                    <div class="col-lg-12 mt-1-9 mt-md-6 order-2 order-lg-1 wow fadeIn" data-wow-delay="100ms">
                                <div>
                            @foreach ($application as $applications)
                         	<img src="{{ asset($applications->application_image) }}" alt="image">
                            @endforeach
                                </div>
                    </div>
                </div>
            </div>
        </section>

@endsection