@extends('frontend.layout.master')
@section('content')  
  <section class="page-title-section top-position1 bg-img cover-background left-overlay-secondary" data-overlay-dark="85" data-background="img/banner/page-title-01.jpg">
            <div class="container">                
                <h1>Video Gallery</h1>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Video Gallery</li>
                </ul>                
            </div>
        </section>

  <section>
  <div class="container">
    <div class="row">

    @foreach ( $sliders as  $slider)
      <div class="col-12 col-sm-6 col-xl-3 mb-4">
        <div class="ratio ratio-16x9 rounded overflow-hidden">
          <iframe src="{{ $slider->slider_title }}" 
                  title="YouTube video" 
                  allowfullscreen></iframe>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</section>
@endsection