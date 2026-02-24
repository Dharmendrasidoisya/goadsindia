@php  $mycaptcha =  mt_rand(100000, 999999); 
session_start();
$_SESSION['scaptcha'] = $mycaptcha;
    setcookie("ccaptcha",$mycaptcha,time()+300,'/','',1);
@endphp
@extends('frontend.layout.master')
@section('content')  
  <!-- rts banner area strart -->
    <div class="rts-banner-area rts-section-gap rts-breadcrumb-area  position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area-inner">
                        <span class="water-text">Contact Us</span>
                        <div class="nav-area-navigation">
                            <a href="{{ url('/') }}">home</a>
                            <a class="current">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- rta contact area stsart -->
    <div class="rts-contact-area-page rts-section-gap">
        
        <div class="container">
            <div class="row align-items-center">
                      @foreach ($settings as $setting)
                <div class="col-lg-6 pr--60 pr_sm--0 mb_sm--30 pr_md--10 pb_md--25 pb_sm--25">
                    <div class="contact-main-wrapper-left">
                        <span>Get In Touch</span>
                        <h3 class="title-main">
                            We are always ready to help you <br> and answer your questions
                        </h3>
                        
                        <div class="row g-24">
                            <div class="col-lg-6">
                                <div class="quick-contact-page-1">
                                 <div class="icon">
                                       <img src="assets/images/contact/company.jpg" loading="lazy" style="width: 50px; height: 50px;" alt="contact">
                                    </div>
                                 <h5 class="title"> {{$setting->about_title}}</h5>
                                    
                                      <div class="icon">
                                               <img src="assets/images/contact/02.png" loading="lazy" style="width: 50px; height: 50px;" alt="contact">
                                    </div>
                                       <h5 class="title">Head Office</h5> 
                                    <p>
                                  {{$setting->header_about_address}}
                                    </p>
                                    <h5 class="title">Branch Office</h5> 
                                    <p>
                                  {{$setting->company_address}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="quick-contact-page-1">
                                
                                      <div class="icon">
                                      <img src="assets/images/contact/01.png" loading="lazy" loading="lazy" style="width: 50px; height: 50px;" alt="contact">
                                    </div>  
										  <h5 class="title">Call Us</h5>
                                    <a href="tel:+91{{$setting->support_phone}}"><p>
                                        +91 {{$setting->support_phone}}
                                    </p> </a>
                               
                                    <br/>
                             
                           <div class="icon">
                                       <img src="assets/images/contact/03.png" loading="lazy" style="width: 50px; height: 50px;" alt="contact">
                                    </div>
									   <h5 class="title">Mail Us</h5>
                                    <a href="mailto:{{$setting->email}}" class="lop"><p>
                                     {{$setting->email}}
                                    </p> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-6">
             
                    <form name="form" action="{{route('inquirystored')}}" method="post" class="contact-form-area-wrapper">
                           @csrf
                        <h4 class="title">Let’s Get in Touch</h4>
                        <div class="half-inpur-wrapper">
                            <div class="single">
                         <input type="text" name="name" placeholder="Name *"
       pattern="[A-Za-z\s]+"
       title="Only alphabets allowed"
       required>
                                @error('name')
                                    <span style="color:red;">{{$message}}</span>
                                    @enderror
                                  <span class="error-message" id="captcha-error"></span> 
                            </div>
                            <div class="single">
                             <input type="email" name="email" placeholder="Email *" required>
                                 @error('email')
                                    <span style="color:red;">{{$message}}</span>
                                    @enderror
                                  <span class="error-message" id="captcha-error"></span>
                            </div>
                        </div>
                        <div class="half-inpur-wrapper">
                            <div class="single">
                    <input type="text" name="phone" placeholder="Phone *"
       pattern="[0-9]{1,13}"
       maxlength="13"
       title="Only numbers allowed (max 13 digits)"
       required>
                                        @error('phone')
                            <span style="color:red;">{{$message}}</span>
                            @enderror
                          <span class="error-message" id="captcha-error"></span> 
                            </div>
                            <div class="single">
                        <input type="text" name="location" id="location" placeholder="Location *"
       pattern="[A-Za-z\s]+"
       title="Only alphabets allowed"
       required>
                                                     @error('location')
                                    <span style="color:red;">{{$message}}</span>
                                    @enderror
                                  <span class="error-message" id="captcha-error"></span> 
                            </div>
                        </div>
<textarea name="mes" placeholder="Message *"
          pattern="[A-Za-z0-9\s]+"
          title="Only letters and numbers allowed"
          required></textarea>
                                 @error('mes')
                                    <span style="color:red;">{{$message}}</span>
                                    @enderror
                                  <span class="error-message" id="captcha-error"></span>
                     
                                  <div class="col-md-12">
                                        <div class="form-group">
                                    <h6 style="color: #000;"> Validation Code : <?php echo $mycaptcha;?></h6>
                              <input id="captcha" class="form-control"  type="text" name="captcha" placeholder="Enter Validation Code *"   required>
                              <input id="kcaptcha" class="form-control" type="hidden" name="kcaptcha"  value="<?php echo $mycaptcha; ?>" >
                              @error('captcha')
                              <span style="color:red;">{{$message}}</span>
                              @enderror
                            <span class="error-message" id="captcha-error"></span> 
                                    </div>
                                </div>
                        <button class="rts-btn btn-primary" type="submit" >Send Message</button>
                    </form>
                           @if (session('popup_error'))
                   <script>
                    alert("{{ session('popup_error') }}");
                    </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- rta contact area end -->

    {{-- <div class="rts-map-area rts-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rts-map-main-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4344.209233478553!2d77.2257705!3d28.66287010000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd0eddff621d%3A0xf730ecb61584211a!2s605%2C%20Hamilton%20Rd%2C%20Ganda%20Nala%20Bazar%2C%20Chhota%20Bazar%2C%20Kashmere%20Gate%2C%20Delhi%2C%20110006!5e1!3m2!1sen!2sin!4v1760344777051!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                       </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection