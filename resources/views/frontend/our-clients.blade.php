@extends('frontend.layout.master')
@section('content')

    <!--=====HERO AREA START=======-->
  <div class="common-hero" style="background-image: url(assets/new-img/banner/bredcum.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="common-hero-heading">
                    <h1 class="text-40 sm:text-30 md:text-30 leading-56 font-semibold white">Our Clients</h1>
                    <div class="page-change">
                        <ul>
                            <li class="inline-block"><a href="{{url('/')}}" class="inline-block text-16 leading-16 white font-semibold">Home</a></li>
                            <li class="inline-block arrow text-16 leading-16 white font-normal"><i class="fa-solid fa-angle-right"></i></li>
                            <li class="inline-block text-16 leading-16 white font-normal">Our Clients</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
    <!--=====HERO AREA END=======-->

<section class="sponsors-section-four py-4" >
    <div class="container">
        <div class="row">
            @php $hasLogo = false; @endphp

            @foreach ($offer as $banners)
                @if (!empty($banners->offer_images))
                    @foreach (json_decode($banners->offer_images) as $image)
                        @php $hasLogo = true; @endphp
                        <div class="col-6 col-sm-6 col-md-3 py-4">
                            <div class="logo-box text-center p-3 border rounded h-100">
                                <img src="{{ asset($image) }}" class="img-fluid" alt="logo">
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach

            @if (!$hasLogo)
                <div class="col-12 text-center">
                    <p>No client logos available</p>
                </div>
            @endif
        </div>
    </div>
</section>


    <!--=====CTA AREA START=======-->
    <div class="cta1 sp _relative" style="background-color: #25064cf2;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                 <h2 class="text-44 sm:text-30 md:text-30 leading-56 font-semibold white">Trusted Partner for Surgical Disposables</h2>
                </div>
                <div class="col-lg-3">
                    <div class="buttons text-end md:text-start xs:text-start sm:mt-20 md:mt-20">
                        <a href="#" class="theme-btn4 btn_theme_active4 wow fadeInDown">Contact
                            Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====CTA AREA END=======-->

@endsection
