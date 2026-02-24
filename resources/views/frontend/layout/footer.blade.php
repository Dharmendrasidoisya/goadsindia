   <div class="rts-footer-area rts-section-gapTop bg_footer-1 bg_image">
                @foreach ($settings as $setting)
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-wrapper-left-one">
                        <a href="{{ url('/') }}" class="logo"> 
                            <img src="{{ asset($setting->footerlogo) }}" alt="logo" style="width: 150px;">
                        </a>
                        <p class="disc">
             {!! strip_tags($setting->about_me, '<br><ul><li><strong><b><em><i>') !!}
                        </p>
                   
                        <div class="social-area-wrapper-one">
                      <ul>
                                 
                                              @if($setting->linkedin !=null)
                                        <li><a href="{{$setting->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        @endif
                                    </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="footer-wrapper-right">
                        <div class="single-nav-area-footer use-link lbl">
                            <h4 class="title">Useful Links</h4>
                            <ul>
                                <li><a href="{{ route('about-us') }}">About Us</a>
                                </li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                                <li><a href="{{ $setting->brochure }}" target="_blank">Catalogue</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div class="single-nav-area-footer use-link">
                            <h4 class="title">Quick Products</h4>
                                  <ul>
             @foreach ($category->take(5) as $categories)
    <li>
        <a href="{{ url(Str::slug($categories->category_name) . '/' . $categories->id) }}">
            {{ $categories->category_name }}
        </a>
    </li>
@endforeach

            </ul>
                    
                        </div>
                        <div class="single-nav-area-footer news-letter">
                            <h4 class="title">Contact Us</h4>

                            <ul>
                                <li><i class="fa fa-building" aria-hidden="true"></i> {{$setting->about_title}}</li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{$setting->company_address}}</li>
                                <li><i style="transform: rotate(113deg);" class="fa fa-phone" aria-hidden="true"></i> <a style="display: contents;" href="tel:+91{{$setting->support_phone}}"> +91 {{$setting->support_phone}}</a></li>
                                <li><i class="fa fa-envelope" aria-hidden="true"></i> <a style="display: contents;" href="mailto:{{$setting->email}}">{{$setting->email}}</a> </li>
                            </ul>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="container-full copyright-area-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="copyright-wrapper">
                                    <p class="mb-0">Copyright &copy;
                                        <script>
                                            document.write(
                                                new Date().getFullYear()
                                            )
                                        </script>
                                         Kabra Trading Co. All Rights Reserved. Designed by <a href="https://www.goadsindia.com/" target="_blank" style="color: #000;">Ads India.</a> 
                                    </p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                @foreach ($settings as $setting)
        <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk">
            <div class="thumbnail">
                <img src="{{asset('assets/images/banner/04.jpg')}}" alt="elevate">
            </div>
            <div class="inner-content">
                <h4 class="title">Our Journey in Engineering Excellence</h4>
                <p class="disc">
             Welcome to Kabra Trading Co., your premier destination for top-of-the-line plummer blocks. With a strong commitment to excellence and customer satisfaction, we have established ourselves as a trusted manufacturer and supplier in the industry. 
                </p>
                <div class="footer">
                    <h4 class="title">Got a question in mind?</h4>
                    <a href="{{ route('contact-us') }}" class="rts-btn btn-primary">Contact Us</a>
                </div>
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu d-block d-xl-none">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu metismenu"  id="mobile-menu-active">
                    <li>
                        <a href="{{ url('/') }}" class="main">Home</a>
                    </li>
                 <li>
                        <a href="{{ route('about-us') }}" class="main">About Us</a>
                    </li>
           <li class="has-droupdown">
    <a href="#" class="main">Products</a>

    <ul class="submenu mm-collapse">

        @foreach ($category as $categories)
            <li>
                <a class="mobile-menu-link"
                   href="{{ url(Str::slug($categories->category_name).'/'.$categories->id) }}">
                   
                   {{ $categories->category_name }}

                </a>
            </li>
        @endforeach

    </ul>
</li>
                     <li>
                        <a href="{{ route('gallery') }}" class="main">Gallery</a>
                    </li>
                  <li>
                        <a href="{{ $setting->brochure }}" target="_blank" class="main">Catalogue</a>
                    </li>
                 
                    <li>
                        <a href="{{ route('contact-us') }}" class="main">Contact Us</a>
                    </li>
                </ul>
            </nav>

            <div class="social-wrapper-one">
          <ul>
                                      
            @if($setting->linkedin !=null)
        <li><a href="{{$setting->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
         @endif
         </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>
    @endforeach

                   <!-- newwhatsup -->
@foreach ($settings as $setting)
<div id="qlwapp" class="qlwapp qlwapp-free qlwapp-bubble qlwapp-bottom-left qlwapp-all qlwapp-rounded">
<div class="qlwapp-container">
<div class="qlwapp-box">
<div class="qlwapp-header">
    <i class="qlwapp-close" data-action="close">&times;</i>
    <div class="qlwapp-description">
        <div class="qlwapp-description-container">
            <h3>Hello!</h3>
            <p>Chat with our representatives below by clicking on WhatsApp or send us an email to <a
                    href="mailto:{{$setting->email}}" class="law" style="color: #000;">{{$setting->email}}</a></p>
        </div>
    </div>
</div>
<div class="qlwapp-body">
    <a class="qlwapp-account" data-action="open" data-phone="+91{{$setting->whatsapp_no}}"
        data-message="Hello! I just visited your website and am interested in Know more about your products. I have one query" role="button"
        tabindex="0" target="_blank">
        <div class="qlwapp-avatar">
            <div class="qlwapp-avatar-container">
                <img alt="Kabra Trading Co" data-src="{{asset('assets/img/logo/favicon.png')}}"
                    src="{{asset('assets/img/logo/favicon.png')}}"
                    class="lazyload"
                    style="--smush-placeholder-width: 300px; --smush-placeholder-aspect-ratio: 300/140;">
            </div>
        </div>
        <div class="qlwapp-info">
<span class="qlwapp-label">For Support <strong style="font-size: 18px;
    color: #ef7f1a;">Click Here</strong> </span>
            <span class="qlwapp-name">{{$setting->about_title}}</span>
        </div>
    </a>
</div>
<div class="qlwapp-footer">
          <p>Powered by <a href="https://www.goadsindia.com" target="_blank" style="color: #ef7f1a;">Ads India</a></p>
</div>
</div>

<a class="qlwapp-toggle" data-action="box" data-phone="+91{{$setting->whatsapp_no}}"
data-message="Hello! I just visited your website and am interested in Know more about your products. I have one query"
role="button" tabindex="0" target="_blank">

<img  src="{{asset('images/wt.png')}}" alt="whatsapp" style="width: 65px;">
<i class="qlwapp-close" style=" background: #000;" data-action="close">&times;</i>
</a>
</div>
</div>
@endforeach
  @if ($Analytics)
  @foreach ($Analytics as $categoryheder)
      {!! $categoryheder->footer !!}
  @endforeach
  @else
  
  @endif 
    