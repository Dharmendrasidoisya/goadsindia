@extends('frontend.layout.master')
@section('content')  
  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">About Us</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts banner area end -->


    <!-- about us area start -->
<div class="about-us-area-five rts-section-gap">
    @foreach ($About as $Abouts)
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Main About Section -->
                <div class="about-wrapper-area-five">
                    <div class="about-left-wrapper order-2 order-lg-1">
                        <span class="pre">About Us</span>
                        <h2 class="title">{{ $Abouts->about_name }}</h2>
                        <p class="disc">{!! $Abouts->about_description !!}</p>                   
                    </div>

                    <div class="right-thumbnail order-1 order-lg-2">
                        <img src="{{ $Abouts->about_image }}" alt="{{ $Abouts->about_name }}">
                    </div>
                </div>

                <!-- Story Section With Image Left & Content Right -->
                <div class="about-wrapper-area-five" style="margin-top:120px;">
                    
                    <!-- Left Image -->
                    <div class="right-thumbnail order-1 order-lg-1">
                        <img src="{{ asset('assets/images/about/story.jpg') }}" alt="LKF Accessories Story">
                    </div>

                    <!-- Right Content -->
                    <div class="about-left-wrapper order-2 order-lg-2" style="display:none;">
                        <h4 class="title">
                            <strong>Quality-conscious Ram</strong> and <strong>price-conscious Shyam</strong>, both bought the same bearing...<br>
                            <strong>Months later, Ram was thriving while Shyam was diving.</strong>
                        </h4>

                        <p><strong>Shyam:</strong> Those high-priced bearings were a total let down. I'm changing them like nobody's business.</p>
                        <p><strong>Ram:</strong> I hope you're using the right sleeves, housings and dismounting tools.</p>
                        <p><strong>Shyam:</strong> I bought them dirt cheap from the workshop next door.</p>
                        <p><strong>Ram:</strong> That's your mistake, I never use anything but <strong>LKF accessories</strong>. My bearings never let me down.</p>
                        <p><strong>Shyam:</strong> How come you never told me this before?</p>
                        <p><strong>Ram:</strong> I did, but you were crying over the price.</p>
                        <p><strong>Shyam:</strong> Where can I get these accessories?</p>
                        <p><strong>Ram:</strong> Get in touch with your nearest <strong>LKF Company</strong>.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>


    <!-- about us area end -->  
@endsection