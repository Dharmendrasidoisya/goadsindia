@extends('frontend.layout.master')
@section('content')  
   <!-- PAGE TITLE
        ================================================== -->
        <section class="page-title-section top-position1 bg-img cover-background left-overlay-secondary" data-overlay-dark="85" data-background="img/banner/page-title-01.jpg">
            <div class="container">                
                <h1>Custom Bearings</h1>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>Custom Bearings </li>
                </ul>                
            </div>
        </section>

        <!-- ABOUT US
        ================================================== -->
        <section class="about-style-02 pb-lg-20" style="padding-bottom:0!important;">
            <div class="container">
                <div class="row align-items-center justify-content-center mt-n1-9 mt-md-n6">
                    <div class="col-lg-6 mt-1-9 mt-md-6 order-2 order-lg-1 wow fadeIn" data-wow-delay="100ms">
                        <div class="pe-lg-6 pe-xl-10">
                            <div class="section-title-01 mb-1-9">
                                <span class="text-primary font-weight-600 text-uppercase letter-spacing-1 position-relative ps-2">JAYCO ENGINEERING (INDIA)</span>
                                <h2 class="display-5 lh-1 font-weight-800 mb-0">Custom Bearings Manufacturer</h2>
                            </div>
                        
                        </div>
                
                    </div>
                    <div class="col-lg-6 mt-1-9 mt-md-6 order-1 order-lg-2 wow fadeIn" data-wow-delay="150ms">
                        <div class="about-image position-relative">
                            <p>Custom bearings are precision-engineered bearing solutions specifically designed to match non-standard specifications. Unlike off-the-shelf bearings, custom variants are developed with unique features such as modified dimensions, materials, coatings, and sealing solutions, depending on the application's environment and performance criteria.</p>
                            <p>At Jayco Engineering, we understand that every industry has its own set of challenges and operational demands. Our expertise lies in delivering custom bearings that are optimized for your application's load capacity, speed, temperature tolerance, and environmental conditions.</p>
                            <a href="{{ asset('pdf/brochure.pdf') }}" target="_blank" class="btn-style1"><span>Download Brochure</span></a>
                        </div>
                    </div>
                </div>
            </div>

                        <div class="container">
                <div class="row align-items-center justify-content-center mt-n1-9 mt-md-n6">
                    <div class="col-lg-6 mt-1-9 mt-md-6 order-2 order-lg-1 wow fadeIn" data-wow-delay="100ms">
                        <div class="pe-lg-6 pe-xl-10">
                            <div class="section-title-01 mb-1-9">
                   <iframe width="100%" height="400" src="https://www.youtube.com/embed/IgKgA5i_1hY?si=Fi6lZCXzKwVHcSvz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        
                        </div>
                
                    </div>
                    <div class="col-lg-6 mt-1-9 mt-md-6 order-1 order-lg-2 wow fadeIn" data-wow-delay="150ms">
                        <div class="about-image position-relative">
                      <img src="img/product/customise.jpg" alt="img" class="rounded-top">
                        </div>
                    </div>
                </div>
                                        <p>At Jayco Engineering, we understand that every industry has its own set of challenges and operational demands. Our expertise lies in delivering custom bearings that are optimized for your application's load capacity, speed, temperature tolerance, and environmental conditions. Whether you require a bearing for high-speed rotation, corrosive environments, or space-limited designs, Jayco Engineering can deliver exactly what you need.</p>
            </div>
        </section>


        <!-- FAQ
        ================================================== -->
        <section>
            <div class="container">
                <div class="row mt-n2-9">
                <h2 class="lh-1 font-weight-800 mb-0">Frequently Asked Questions</h2>
                    <div class="col-lg-12 mt-2-9 wow fadeIn" data-wow-delay="150ms">
                        <div>
                            <div id="accordion" class="accordion-style">
                                <div class="card mb-3">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">1. What are Plummer Blocks and their applications?</button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="card-body">
  Plummer Blocks are bearing housings designed to provide support for rotating shafts with the help of compatible bearings. They are widely used in industries such as cement, mining, paper, and power plants.
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">2. Why choose our Plummer Blocks?</button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                        <div class="card-body">
   Our Plummer Blocks are manufactured with high-grade raw materials and advanced machining technology, ensuring superior strength, excellent load-carrying capacity, and long service life with minimal maintenance.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">3. Do you provide customized Plummer Blocks?</button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                        <div class="card-body">
  Yes, we offer customized Plummer Block solutions based on client requirements. From special sizes to specific material grades, we work with our customers to deliver tailor-made products for their applications.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection