<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Kabra Trading Co.</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content=" " />
    <meta property="og:site_name" content="" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('asset/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('asset/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{ asset('adminbackend/assets/images/favicon-32x32old.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('adminbackend/assets/images/favicon-32x32old.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('adminbackend/assets/images/favicon-32x32old.png') }}">
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    </script>
    <style>
        .mobiledisplay{
            display: none !important; 
        }
        @media only screen and (max-width: 600px) {
            .mobiledisplay{
            display: block !important; 
        }
        .mv{
            display: block !important; 
            text-align: center!important;
        }
        .logomob{
            text-align: center!important;
        }
        #kt_footer{
            display: none !important; 
        }
}
    </style>

    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->

            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-1"
            style="background-image: url('{{ asset('asset/media/misc/auth-bg.png') }}');">

                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-2">
                    <!--begin::Form-->
                    @foreach ($settings as $setting)
                        <a href="{{ route('home') }}" class="mb-0 mb-lg-12 logomob">
                            <img alt="Logo" src="{{ asset($setting->footerlogo) }}" class="h-60px h-lg-75px" />

                        </a>
                    @endforeach
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10">

                            <!--begin::Form-->
                            <div class="d-none d-lg-block text-white fs-base text-justify order-1 order-lg-1 mv">Grow Your
                                Business With Our Unified
                                Ecommerce Platform. Start a 14 Day Free Trial Now. Quick & Easy Setup - Everything You
                                Need To
                                Start Selling Online Today. SEO Optimized. Mobile Commerce Ready. SSL Certificate.
                                Unlimited
                                Bandwidth.

                            </div>

                        </div>
                    </div>

                    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                        <!--begin::Container-->
                        <div
                            class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">

                            <div class="text-gray-900 order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1" style="color: #fff !important;">2025©</span>
                                <a href="https://www.goadsindia.com/" target="_blank"
                                    class="text-gray-800 text-hover-primary" style="color: #fff !important;">Go Ads
                                    India Pvt. Ltd.</a>
                            </div>

                            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                <li class="menu-item">
                                    <a href="https://www.goadsindia.com/" target="_blank" class="menu-link px-2"
                                        style="color: #fff !important;">Privacy</a>
                                </li>
                                <li class="menu-item">
                                    <a href="https://www.goadsindia.com/" target="_blank" class="menu-link px-2"
                                        style="color: #fff !important;">Contact</a>
                                </li>

                            </ul>
                            <!--end::Menu-->
                        </div>

                    </div>

                </div>

            </div>

            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-2">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">


                        <div class="form-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                            <form class="row g-3" method="POST" action="{{ route('forget.password.post') }}">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Forgotten Password ?</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="email_address" class="form-label">E-Mail Address</label>

                                    <input type="text" id="email_address" class="form-control" name="email"
                                        required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>
                                            Send Password Reset Link</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-lg-500px d-flex flex-stack px-10 mx-auto mobiledisplay">
                    <div class="d-flex fw-semibold text-primary fs-base gap-5">
                        <a href="https://www.goadsindia.com/" target="_blank"  style="color: #000 !important;">Privacy</a>
                        <a href="https://www.goadsindia.com/" target="_blank"  style="color: #000 !important;">Legal</a>
                        <a href="https://www.goadsindia.com/" target="_blank" style="color: #000 !important;">Contact</a>
                    </div>
               
                </div>

            </div>
            <div class="text-gray-900 text-center order-2 order-md-1 mobiledisplay" >
                <span class="text-muted fw-semibold me-1 text-gray-800">©2024</span>
                <a href="https://www.goadsindia.com/" target="_blank" class="text-gray-800 text-hover-primary">Go Ads India Pvt. Ltd.</a>
            </div>
        </div>

    </div>

    <script>
        var hostUrl = "assets/";
    </script>

    <script src="{{ asset('asset/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('asset/js/scripts.bundle.js') }}"></script>

    <script src="{{ asset('asset/js/custom/authentication/sign-in/general.js') }}"></script>

</body>


</html>
