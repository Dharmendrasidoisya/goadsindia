@extends('frontend.layout.master')
@section('content')
<style>
    @media screen and (max-width: 600px) {
    .industry-banner .bg_banner-bg-area {
    height: 500px;
}
.mbanner{
         padding: 120px 0px 0px 0px !important;
        background-position: 82% !important;
        background-repeat: no-repeat !important;
}
}
.osd{
    display: inline-block!important;
}
    </style>
<div class="banner-two-swiper-main-wrapper industry-banner">
    <div class="swiper mySwiper-banner2" dir="ltr">
        <div class="swiper-wrapper">
            @foreach ($banner as $banners)
                <div class="swiper-slide">
                    <!-- banner area start -->
                    <div class="banner-area-start bg_banner-bg-area  bg_image mbanner"
                        style="background-image: url('{{ asset($banners->banner_image) }}');
                               background-size: cover;
                               background-position: center;
                               background-repeat: no-repeat;
							   padding: 240px 0px 0px 0px;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-two-inner">
                                        <span>{{ $banners->banner_title }}</span>
                                        <h1 class="title">{!! $banners->banner_description !!}</h1>
                                        <p class="disc">
                                          {!! $banners->banner_longdescription !!}
                                        </p>
                                        <div class="button-wrapper">
                                            <a href="{{ route('about-us') }}" class="rts-btn btn-primary">About Us</a>
                                            <a href="{{ route('contact-us') }}" class="rts-btn btn-white">Contact Us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- banner area end -->
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
    </div>
</div>



    <!-- about area start -->
    <div class="about-service-main-wrapper rts-section-gap bg_white">
          @foreach ( $About as  $Abouts)
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5">
                    <div class="thumbnail-main-wrapper-2">
                        <div class="reveal-item overflow-hidden aos-init">
                            <div class="reveal-animation reveal-end reveal-primary aos aos-init" data-aos="reveal-end">
                            </div>
                            <img src="{{ $Abouts->about_image }}" alt="journey-area">
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 pl--60 pl_md--0 pl_sm--10 pt_md--30 pt_sm--30">
                    <div class="about-content-area-two">
                        <div class="title-style-two-left">
                      <h2 class="title">{{ $Abouts->about_name }}</h2>
                            <p class="disc">
                   {!! \Illuminate\Support\Str::of($Abouts->about_description)->words(120, '...') !!}
                            </p>
                
                  
                            <a href="{{ route('about-us') }}" class="read-more-btn">Read More<i
                                    class="fa-sharp fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- about area end -->


    <div class="total-working-process-wrapper-industry bg-dark">
        <!-- our working process area start -->
        <div class="our-working-process-area-4 bg_image">
     
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                          @foreach ($settings as $setting)
                        <div class="title-center-wrapper-4">
                            <h2 class="title">End-to-End Engineering Excellence</h2>
                            <p class="disc">
                    Delivering precision, performance, and perfection through every stage of your project — we ensure your operations run stronger, safer, and smarter.
                            </p>
                            <br/>
                          <a href="{{ route('contact-us') }}" class="rts-btn btn-primary osd">Contact Us</a>
                        </div>
                        @endforeach
                            
                    </div>
                </div>
            </div>
        </div>
        <!-- our working process area end -->

        <div class="working-process-mt-dec-4" style="background: #fff; padding: 80px 0px;">
            <div class="container">
                <div class="row bd-process">
                    <div class="col-lg-3">
                        <div class="single-process-wrapper-4">
                            <span class="number">01</span>
                            <h5 class="title" style="color: #141416;">Global Quality Standards</h5>
                            <p class="disc">
                             All our products adhere to stringent quality norms, ensuring compatibility and performance across global markets.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single-process-wrapper-4">
                            <span class="number">02</span>
                            <h5 class="title" style="color: #141416;">Comprehensive Product Range</h5>
                            <p class="disc">
                     From Plummer Blocks to Bearing Housings and Adapter Sleeves, we offer a complete lineup designed to support diverse mechanical applications.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single-process-wrapper-4">
                            <span class="number">03</span>
                            <h5 class="title" style="color: #141416;">Continuous Innovation</h5>
                            <p class="disc">
                           We constantly upgrade our technology and design approach to deliver modern, efficient, and high-performance bearing solutions.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="single-process-wrapper-4">
                            <span class="number">04</span>
                            <h5 class="title" style="color: #141416;">Trusted Industry Expertise</h5>
                            <p class="disc">
                              With decades of experience, we understand the unique needs of industries. — delivering tailored solutions that perform.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- small cta area start -->
                    @foreach ($settings as $setting)
        <div class="small-cta-area rts-section-gap">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="cta-small-left">
                            <i class="fa-regular fa-clock"></i>
                            <span>Monday - Saturday: 09:00 AM - 07:00 PM</span>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="cta-small-right">
                            <p>Discover Reliable Bearing Solutions</p>
                            <a href="{{route('contact-us')}}">Request A Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- small cta area end -->
    </div>



    <!-- compoany experties area start -->
    {{-- <div class="company-experties-area rts-section-gap bg_image bg-dark-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-between-style-five mb--35">
                        <div class="title-left-align-five">
                            <span class="pre">About our company</span>
                            <h2 class="title">Excellence That Moves,  <br>
                              Industries Forward </h2>
                        </div>

                    </div>
                </div>
            </div>
          <div class="row mt--60">
    <div class="col-lg-12">
        <div class="row funfacts-list-wrapper-5">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="single-fun-facts-area-5">
                    <div class="icon">
                        <img src="assets/images/facts/icon/06.svg" alt="service">
                    </div>
                    <div class="counter-wrapper">
                        <h2 class="counter title">
                            <span class="odometer" data-count="10">0</span>+
                        </h2>
                        <span class="bottom">Years Of Experience</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="single-fun-facts-area-5">
                    <div class="icon">
                        <img src="assets/images/facts/icon/07.svg" alt="service">
                    </div>
                    <div class="counter-wrapper">
                        <h2 class="counter title">
                            <span class="odometer" data-count="15">0</span>+
                        </h2>
                        <span class="bottom">Exports Countries</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="single-fun-facts-area-5">
                    <div class="icon">
                        <img src="assets/images/facts/icon/08.svg" alt="service">
                    </div>
                    <div class="counter-wrapper">
                        <h2 class="counter title">
                            <span class="odometer" data-count="50">0</span>+
                        </h2>
                        <span class="bottom">Team Engineers</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6 col-lg-3">
                <div class="single-fun-facts-area-5">
                    <div class="icon">
                        <img src="assets/images/facts/icon/09.svg" alt="service">
                    </div>
                    <div class="counter-wrapper">
                        <h2 class="counter title">
                            <span class="odometer" data-count="1100">0</span>+
                        </h2>
                        <span class="bottom">Satisfied Customers</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div> --}}

      <div class="bg_imag">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-area-wrapper-5-main rts-section-gap">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="rts-title-between-area-fou">
                                        <h2 class="title ff">
                                           Our Products
                                        </h2>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt--40">
                                <div class="col-lg-12">
                                    <div class="team-area-swiper-main-4" dir="ltr">
                                        <div class="swiper mySwiper-team-4">
                                            <div class="swiper-wrapper">
                                                   	@foreach($category as $categories)
                                                <div class="swiper-slide">
                                                    <div class="single-team-area-four">
                                                        <a href="{{ Str::slug($categories->category_name) . '/' . $categories->id }}" class="{{$categories->category_name}}">
                                                            <img src="{{asset( $categories->category_image) }}" alt="{{$categories->category_name}}">
                                                        </a>
                                                        <div class="inner">
                                                            <a href="{{ Str::slug($categories->category_name) . '/' . $categories->id }}">
                                                             <h5 class="title ff">{{$categories->category_name}}</h5>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                   @endforeach
                                              
                                            </div>
                                            <div class="swiper-pagination"></div>
                                        </div>
                                   
                                        <div class="swiper-button-next"><i class="fa-light fa-arrow-right"></i></div>
                                        <div class="swiper-button-prev"><i class="fa-light fa-arrow-left"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- <div class="rts-testimonials-area" style="background-color: #fff;">
    <div class="container-1730">
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonials-wrapper-area-4 rts-section-gap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="title-center-wrapper-4">
                                    <h2 class="title" style="color:#000000;">Testimonials</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row g-24 mt--20">
                            <div class="col-lg-12">
                                <div class="swiper mySwiper-testimonails-4" dir="ltr">
                                    <div class="swiper-wrapper">

                                    
                                           @foreach ($testimonials as $testimonial)
                                        <div class="swiper-slide">
                                            <div class="testimonials-area-style-4 text-center">
                                                <p class="disc-area" style="color: #fff!important;">
                                                  {{ $testimonial->testimonial_description }}
                                                </p>
                                                <div class="author-info mt-3">
                                                    <h6 class="title mb-1" style="color: #000!important;">{{ $testimonial->testimonial_name }}</h6>
                                                
                                                </div>
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
        </div>
    </div>
</div> --}}


    <!-- rts blog area start -->
<div class="rts-blog-area rts-section-gap" style="background: #fff; padding: 80px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-style-two-center">
                    <h2 class="title">Industries We Serve</h2>
                </div>
            </div>
        </div>

        <div class="row mt--40">
            <div class="col-lg-12">
                <div class="team-area-swiper-wrapper-5">
                    <div class="swiper mySwiper-team-5">
                        <div class="swiper-wrapper">

                            <!-- Industry 1 -->
                             @foreach ($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="single-blog-three">
                                    <img src="{{ asset($slider->slider_image) }}" alt="Cement Plant">
                                    <div class="inner-content-area">
                                        <a><h3 class="title" style="text-align: center; margin-top:0!important; margin-bottom:0!important;">{{ $slider->slider_title }}</h3></a>
                                    </div>
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

    <!-- rts blog area end -->

    {{-- <div class="rts-blog-area" style="margin-bottom: 120px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-center-style-one dark-title">
                        <span class="pre">Blogs</span>
                        <h2 class="title">Latest Blogs</h2>
                    </div>
                </div>
            </div>

<div class="row g-24 mt--30 mt_sm--10">
             @foreach ($blogPost as $blog)
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
       

        <div class="rts-blog-card-one">
            <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}" class="thumbnail">
                <img src="{{ $blog->post_image }}" alt="blog_card">
            </a>
            <div class="inner-wrapper">
                <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}">
                    <h5 class="title">{{ $blog->post_title }}</h5>
                </a>
                <p class="disc">
                          {!! \Illuminate\Support\Str::words($blog->post_short_description, 20, '...') !!}
                </p>
                <a href="{{ url('blogs/' . Str::slug($blog->post_title) . '/' . $blog->id) }}" class="rts-btn btn-primary">Read More</a>
            </div>
        </div>
   

    </div>
       @endforeach
</div>


        </div>
    </div> --}}

             <div class="container-1730">
                  @foreach ($settings as $setting)
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-four-wrapper">
                        <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="footer-float-right-4">
                                            <div class="left-content-area">
                                                <span>Call Us</span>
                                                <a href="tel:+91{{$setting->phone_one}}">
                                                    <h4 class="title">+91 {{$setting->phone_one}}</h4>
                                                </a>
                                                {{-- <p>Contact Us With Our Hotline</p> --}}
                                            </div>
                                            <div class="map-and-opening-area">
                                                {{-- <div class="map-area">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4344.209233478553!2d77.2257705!3d28.66287010000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd0eddff621d%3A0xf730ecb61584211a!2s605%2C%20Hamilton%20Rd%2C%20Ganda%20Nala%20Bazar%2C%20Chhota%20Bazar%2C%20Kashmere%20Gate%2C%20Delhi%2C%20110006!5e1!3m2!1sen!2sin!4v1760344777051!5m2!1sen!2sin"
                                                        width="200" height="366" style="border:0;" allowfullscreen=""
                                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div> --}}
                                                <div class="opening-area-wrapper">
                                                    <div class="inner">
                                                        <img src="assets/images/service/10.svg" alt="">
                                                        <div class="opening-area mt--30">
                                                            <span>MONDAY - SATURDAY</span>
                                                            <h6 class="title">09:00 AM - 07:00 PM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
@endsection
