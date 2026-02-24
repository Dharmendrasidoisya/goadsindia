<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">



     <!--- Meta Title Start--->
     @foreach ($otherseo as   $seos)
     @if($seos->status =='1')
     @if($seos->menu_home =='0')
     <title>{{$seos->meta_title}}</title>
     <meta name="description" content="{{$seos->description}}" />
     <meta name="keywords" content="{{$seos->keyword}}" />
     
     <link rel="canonical" href="{{$seos->canonical}}" /> 
	 <!-- Define x-default hreflang tag -->
     <link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />
     
     <meta property="og:title" content="{{$seos->meta_title}}">
     <meta property="og:description" content="{{$seos->description}}">
     <meta property="og:image" content="{{$seos->image}}">
     <meta property="og:url" content="{{$seos->canonical}}">
     <meta property="og:type" content="website">
 
     <meta name="twitter:card" content="summary_large_image">
     <meta name="twitter:site" content="@sacrelifesciences">
     <meta name="twitter:title" content="{{$seos->meta_title}}">
     <meta name="twitter:description" content="{{$seos->description}}">
     <meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

     @elseif($seos->menu_home =='1')
     <title>{{$seos->meta_title}}</title>
     <meta name="description" content="{{$seos->description}}" />
     <meta name="keywords" content="{{$seos->keyword}}" /> 
         
     <link rel="canonical" href="{{$seos->canonical}}" />
     <!-- Define x-default hreflang tag -->
     <link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

     <meta property="og:title" content="{{$seos->meta_title}}">
     <meta property="og:description" content="{{$seos->description}}">
     <meta property="og:image" content="{{$seos->image}}">
     <meta property="og:url" content="{{$seos->canonical}}">
     <meta property="og:type" content="website">
 
     <meta name="twitter:card" content="summary_large_image">
     <meta name="twitter:site" content="@sacrelifesciences">
     <meta name="twitter:title" content="{{$seos->meta_title}}">
     <meta name="twitter:description" content="{{$seos->description}}">
     <meta name="twitter:image" content="{{$seos->image}}">

    
    {!! $seos->schema !!}
     
  @elseif($seos->menu_home =='2')
  <title>{{$seos->meta_title}}</title>
  <meta name="description" content="{{$seos->description}}" />
  <meta name="keywords" content="{{$seos->keyword}}" /> 
    
  <link rel="canonical" href="{{$seos->canonical}}" />
  <!-- Define x-default hreflang tag -->
  <link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />
	
  <meta property="og:title" content="{{$seos->meta_title}}">
  <meta property="og:description" content="{{$seos->description}}">
  <meta property="og:image" content="{{$seos->image}}">
  <meta property="og:url" content="{{$seos->canonical}}">
  <meta property="og:type" content="website">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@sacrelifesciences">
  <meta name="twitter:title" content="{{$seos->meta_title}}">
  <meta name="twitter:description" content="{{$seos->description}}">
  <meta name="twitter:image" content="{{$seos->image}}">

 
    {!! $seos->schema !!}

@elseif($seos->menu_home =='3')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" />
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

@elseif($seos->menu_home =='4')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 

<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}
     
@elseif($seos->menu_home =='5')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

    @elseif($seos->menu_home =='6')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

        @elseif($seos->menu_home =='7')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

        @elseif($seos->menu_home =='8')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}

     @elseif($seos->menu_home =='9')
<title>{{$seos->meta_title}}</title>
<meta name="description" content="{{$seos->description}}" />
<meta name="keywords" content="{{$seos->keyword}}" /> 
    
<link rel="canonical" href="{{$seos->canonical}}" /> 
<!-- Define x-default hreflang tag -->
<link rel="alternate" href="{{$seos->canonical}}" hreflang="x-default" />

<meta property="og:title" content="{{$seos->meta_title}}">
<meta property="og:description" content="{{$seos->description}}">
<meta property="og:image" content="{{$seos->image}}">
<meta property="og:url" content="{{$seos->canonical}}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sacrelifesciences">
<meta name="twitter:title" content="{{$seos->meta_title}}">
<meta name="twitter:description" content="{{$seos->description}}">
<meta name="twitter:image" content="{{$seos->image}}">


    {!! $seos->schema !!}
    
    
     @else
     @endif
     @endif
 @endforeach
 <!--- Meta Title End--->
       
	<!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/logo/favicon.png')}}" alt="favicon" type="image/x-icon">

    <!-- CSS -->
	<link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/fontawesome.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/aos.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/odometer.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/swiper.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/metismenu.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/plugins/magnifying-popup.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet preload" as="style" href="{{asset('css/whatsup.css')}}">

    
@if ($Analytics)
@foreach ($Analytics as $categoryheder)
    {!! $categoryheder->head !!}
@endforeach
@else
@endif 
<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-DW4YXTZEQG"></script> <script>   window.dataLayer = window.dataLayer || [];   function gtag(){dataLayer.push(arguments);}   gtag('js', new Date());   gtag('config', 'G-DW4YXTZEQG'); </script>
</head>

<body>
    


    @include('frontend.layout.header')
    @yield('content')
    @include('frontend.layout.footer')

    <!-- progress area start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>
    <!-- progress area end -->


    <!-- offcanvase search -->
    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
    <div id="anywhere-home" class="">
    </div>

    <!-- JS -->
    <script src="{{asset('assets/js/plugins/jquery.js')}}"></script>
    <script src="{{asset('assets/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/odometer.js')}}"></script>
    <script src="{{asset('assets/js/plugins/jquery-appear.js')}}"></script>
    <script src="{{asset('assets/js/plugins/metismenu.js')}}"></script>
    <script src="{{asset('assets/js/plugins/swiper.js')}}"></script>
    <script src="{{asset('assets/js/plugins/aos.js')}}"></script>
    <script src="{{asset('assets/js/plugins/nice-select.js')}}"></script>
    <script src="{{asset('assets/js/plugins/smooth-scroll.js')}}"></script>
    <script src="{{asset('assets/js/vendor/waw.js')}}"></script>
    <script src="{{asset('assets/js/vendor/marker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('assets/js/plugins/contact.form.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('js/whatsup.js') }}"></script>

        {{-- <script>
        let lastScrollY = window.scrollY;
        let marquee = document.querySelector('.marquee');
        let position = 0; // Current position of the marquee text
        let scrollTimeout;

        // Function to update marquee position based on scroll
        function updateMarqueeOnScroll() {
            const currentScrollY = window.scrollY;

            // Determine scroll direction
            if (currentScrollY > lastScrollY) {
                // Scrolling down: Move marquee left
                position -= 4; // Adjust speed as needed
            } else if (currentScrollY < lastScrollY) {
                // Scrolling up: Move marquee right
                position += 4; // Adjust speed as needed
            }

            // Update marquee position
            marquee.style.transform = `translateX(${position}px)`;

            lastScrollY = currentScrollY;

            // Clear timeout and reset after scrolling stops
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => marquee.style.transform = `translateX(${position}px)`, 50);
        }

        // Listen for scroll events
        window.addEventListener('scroll', updateMarqueeOnScroll);
    </script> --}}
    <!-- End JS -->

    @if ($Analytics)
    @foreach ($Analytics as $categoryheder)
        {!! $categoryheder->body !!}
    @endforeach
@else
@endif
</body>
</html>
