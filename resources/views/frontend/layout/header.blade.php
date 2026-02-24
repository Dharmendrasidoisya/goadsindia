    <!-- header two area start -->
    <header class="header-two header--sticky">
            @foreach ($settings as $setting)
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top-wrapper">
                            <div class="left">
                                <div class="call">
                                    <i class="fa-light fa-mobile"></i>
                                    <a href="tel:+91{{$setting->support_phone}}">+91 {{$setting->support_phone}} </a>
                                </div>
                                <div class="call">
                                    <i class="fa-solid fa-envelope"></i>
                                    <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                </div>
                            </div>
                            <div class="right">
                                <div class="social-header">
                                    <span>Follow Us On:</span>
                                    <ul>
                                              @if($setting->linkedin !=null)
                                        <li><a href="{{$setting->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-two-main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-two-wrapper">
                            <a href="{{ url('/') }}" class="logo-area">
                                <img src="{{ asset($setting->logo) }}" width="120" alt="logo" class="mobhi">
                            </a>
                       <div class="nav-area">
    <ul>
        {{-- Home --}}
        <li class="main-nav project-a-after">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        </li>

        {{-- About Us --}}
        <li class="main-nav project-a-after">
            <a href="{{ route('about-us') }}" class="{{ request()->is('about-us') ? 'active' : '' }}">About Us</a>
        </li>

{{-- Products --}}
<li class="main-nav has-dropdown project-a-after 
    {{ request()->is('products*') || request()->routeIs('productsdeatils') ? 'active' : '' }}">
    <a href="{{ route('products') }}" 
       class="{{ request()->is('products*') || request()->routeIs('productsdeatils') ? 'active' : '' }}">
        Products
    </a>
    <ul class="submenu parent-nav">
        @foreach ($category as $categories)
            <li class="{{ request()->is(Str::slug($categories->category_name) . '/' . $categories->id) ? 'active' : '' }}">
                <a href="{{ url(Str::slug($categories->category_name) . '/' . $categories->id) }}">
                    {{ $categories->category_name }}
                </a>
            </li>
        @endforeach
    </ul>
</li>



        {{-- Gallery --}}
        <li class="main-nav project-a-after">
            <a href="{{ route('gallery') }}" class="{{ request()->is('gallery') ? 'active' : '' }}">Gallery</a>
        </li>

        {{-- Catalogs --}}
       <li class="main-nav project-a-after 
    {{ request()->routeIs('catalogs') ? 'active' : '' }}">
    <a href="{{ $setting->brochure }}" target="_blank"
       class="{{ request()->routeIs('catalogs') ? 'active' : '' }}">
        Catalogue 
    </a>
</li>


        {{-- Contact Us --}}
        <li class="main-nav project-a-after">
            <a href="{{ route('contact-us') }}" class="{{ request()->is('contact-us') ? 'active' : '' }}">Contact Us</a>
        </li>
    </ul>
</div>

                            <div class="header-end">
                                <a href="{{ route('contact-us') }}" class="rts-btn btn-primary">Request A Quote</a>
                                <div class="nav-btn menu-btn">
                                    <img src="{{asset('assets/images/logo/bar.svg')}}" alt="nav-iamge">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </header>
    <!-- header two area end -->