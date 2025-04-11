@extends('layouts.front')

@section('title')
your one stop MFB choice
@endsection

@section('content')

    <!-- Hero -->
    <div class="hero-1 oh pos-rel" style="background: url('images/hero/banner-bg.png')">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-lg-5">
                    <div class="hero-1-content wow fadeInLeft animated">
                        <h5 class="cate  wow fadeInUp animated" data-wow-delay="0.2s">#Bank Loan</h5>
                        <h1 class="title  wow fadeInUp animated" data-wow-delay="0.4s">Personal Bank Loan
                            From $12,500</h1>
                        <p class=" wow fadeInUp animated" data-wow-delay="0.6s">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        <div class="hero-1-button-group">
                            <a href="{{route('register')}}" class="btn theme-btn-1  wow fadeInUp animated" data-wow-delay="0.8s"> Get
                                Started
                                <i class="uil uil-angle-right-b ml-2 mb-2"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-7 d-lg-block">
                    <div class="hero-1-thumb-15 wow fadeInUp animated" data-wow-delay="0.4s">
                        <img class="img-fluid wow fadeInRight animated" src="/user/images/hero/hero-1.png" alt="hero-1">
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Hero -->

    <!-- Featured box -->
    <div class="featured-boxes-area">
        <!-- Container -->
        <div class="container">
            <div class="featured-boxes-inner">
                <!-- row -->
                <div class="row m-0">
                    <!-- col -->
                    <div class="col-lg-3 col-sm-6 col-md-6 p-0">
                        <div class="single-featured-box">
                            <div class="icon color-fb7756">
                                <i class="ri-thumb-up-line"></i>
                            </div>
                            <h3>Professional Services</h3>
                            <p>Lorem ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan.</p>
                            <a href="features-1.html" class="read-more-btn">Read More</a>
                        </div>
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <div class="col-lg-3 col-sm-6 col-md-6 p-0">
                        <div class="single-featured-box">
                            <div class="icon color-facd60">
                                <i class="ri-wallet-line"></i>
                            </div>
                            <h3>Low costing</h3>
                            <p>Lorem ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan.</p>
                            <a href="features-1.html" class="read-more-btn">Read More</a>
                        </div>
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <div class="col-lg-3 col-sm-6 col-md-6 p-0">
                        <div class="single-featured-box">
                            <div class="icon color-1ac0c6">
                                <i class="ri-customer-service-2-line"></i>
                            </div>
                            <h3>Live Support</h3>
                            <p>Lorem ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan.</p>
                            <a href="features-1.html" class="read-more-btn">Read More</a>
                        </div>
                    </div>
                    <!-- /col -->
                    <!-- col -->
                    <div class="col-lg-3 col-sm-6 col-md-6 p-0">
                        <div class="single-featured-box">
                            <div class="icon">
                                <i class="ri-shield-keyhole-line"></i>
                            </div>
                            <h3>Safe and Secure</h3>
                            <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan.</p>
                            <a href="features-1.html" class="read-more-btn">Read More</a>
                        </div>
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /Container -->
    </div>
    <!-- /Featured box -->

    <!-- About Us -->
    <div class="about-area pt-100 pb-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-lg-6 align-self-center">
                    <div class="mb-20">
                        <img src="/user/images/bg/about.png" class="img-fluid  wow fadeInLeft animated" data-wow-delay="0.2s"
                            alt="image">
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-6">
                    <div class="about-content warp">
                        <!-- row -->
                        <div class="row justify-content-center text-center">
                            <!-- col -->
                            <div class="col-lg-8 col-md-12 mb-50">
                                <div class="section-title">
                                    <h2 class="title">About Us</h2>
                                    <div class="title-bdr">
                                        <div class="left-bdr"></div>
                                        <div class="right-bdr"></div>
                                    </div>
                                    <p>We operate our banking services in many countries around the world.</p>
                                </div>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt labore dolore magna aliqua.</strong>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis.</p>

                        <div class="about-btn justify-content-center text-center">
                            <a href="#" class="btn theme-btn-1">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /About Us -->

    <!-- /Services -->
    <div class="services-area">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row justify-content-center text-center">
                <!-- col -->
                <div class="col-lg-8 col-md-12 mb-50">
                    <div class="section-title">
                        <h2 class="title">Best Services</h2>
                        <div class="title-bdr">
                            <div class="left-bdr"></div>
                            <div class="right-bdr"></div>
                        </div>
                        <p>Presenting Banking Plan & Services That are Right For You</p>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

            <!-- row -->
            <div class="row">
                <!-- col  -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/001.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Personal Loan</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/002.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Business Loan</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/003.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Education Loan</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/004.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Mobile Banking</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/005.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Credit Card</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-services-item">
                        <div class="image">
                            <a href="#">
                                <img src="/user/images/services/006.jpg" alt="image">
                            </a>
                        </div>
                        <div class="content">
                            <h3>
                                <a href="#">Online Deposit</a>
                            </h3>
                            <span>Lorem ipsum</span>
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Services -->

    <!-- Testimonial -->
    <div class="testimonial-area pt-100 pb-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row justify-content-center text-center">
                <!-- col -->
                <div class="col-lg-8 col-md-12 mb-50">
                    <div class="section-title">
                        <h2 class="title">Testimonial</h2>
                        <div class="title-bdr">
                            <div class="left-bdr"></div>
                            <div class="right-bdr"></div>
                        </div>
                        <p>You can see our clients feedback what you say?</p>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
        <!-- Container -->
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-lg-12">
                    <div class="testimonial-item-wrap-1 testimonial-carousel-1">
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/03.jpg" alt="small-avatar">
                                <h3 class="author__title">Jack Hardson</h3>
                                <span class="author__meta">United States</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/02.jpg" alt="small-avatar">
                                <h3 class="author__title">Mike Wood</h3>
                                <span class="author__meta">United Kingdom</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/05.jpg" alt="small-avatar">
                                <h3 class="author__title">Mike Hardson</h3>
                                <span class="author__meta">Italy</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star-half-o"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/04.jpg" alt="small-avatar">
                                <h3 class="author__title">Bernice Pease</h3>
                                <span class="author__meta">Germany</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/06.jpg" alt="small-avatar">
                                <h3 class="author__title">Daniel Ward</h3>
                                <span class="author__meta">India</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/01.jpg" alt="small-avatar">
                                <h3 class="author__title">Kamran Ahmed</h3>
                                <span class="author__meta">Bangladesh</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/02.jpg" alt="small-avatar">
                                <h3 class="author__title">Jessica Brown</h3>
                                <span class="author__meta">Netherlands</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/03.jpg" alt="small-avatar">
                                <h3 class="author__title">Mike Hardson</h3>
                                <span class="author__meta">Pakistan</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img src="/user/images/testimonial/05.jpg" alt="small-avatar">
                                <h3 class="author__title">Bernice Pease</h3>
                                <span class="author__meta">Australia</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-author">
                                <img  src="/user/images/testimonial/04.jpg" alt="small-avatar">
                                <h3 class="author__title">Daniel Ward</h3>
                                <span class="author__meta">Costa rica</span>
                                <span class="author__rating">
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                    <i class="la la-star"></i>
                                </span>
                            </div>
                            <div class="testimonial-desc">
                                <p class="testimonial__desc">
                                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Testimonial -->

    <!-- Choose Us -->
    <div class="why-choose-us-area pb-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-lg-6">
                    <div class="why-choose-us-img">
                        <img src="/user/images/bg/choose-us.png" alt="Image">
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-lg-6">
                    <div class="why-choose-us-content mb-removed">
                        <!-- row -->
                        <div class="row justify-content-center text-center">
                            <!-- col -->
                            <div class="col-lg-8 col-md-12 mb-50">
                                <div class="section-title">
                                    <h2 class="title">Why choose us</h2>
                                    <div class="title-bdr">
                                        <div class="left-bdr"></div>
                                        <div class="right-bdr"></div>
                                    </div>
                                    <p>Client likes seeing our work skills</p>
                                </div>
                            </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis.</p>
                        <ul>
                            <li>
                                <i class="ri-check-line"></i>
                                <h3>Transparent</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </li>
                            <li>
                                <i class="ri-check-line"></i>
                                <h3>Proactive</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </li>
                            <li>
                                <i class="ri-check-line"></i>
                                <h3>Affordable</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </li>
                            <li>
                                <i class="ri-check-line"></i>
                                <h3>Flexible</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Choose Us -->

    <!-- Download -->
    <div class="download-area">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center justify-content-between">
                <!-- col -->
                <div class="col-xl-7 col-lg-6 col-md-6">
                    <div class="download-1-content mt-50">
                        <h2 class=" wow fadeInUp animated">Download Our App</h2>
                        <ul>
                            <li class="wow fadeInUp animated" data-wow-delay="0.2s"><i class="la la-check"></i>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
                            <li class="wow fadeInUp animated" data-wow-delay="0.4s"><i class="la la-check"></i>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
                            <li class="wow fadeInUp animated" data-wow-delay="0.6s"><i class="la la-check"></i>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>
                        </ul>
                        <div class="mt-4 wow fadeInUp animated" data-wow-delay="0.6s">
                            <a href="#" class="btn theme-btn-1">
                                <img src="/user/images/svg/android.svg" alt="">
                            </a>
                            <a href="#" class="btn theme-btn-1">
                                <img src="/user/images/svg/apple.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <div class="download-1-img">
                        <img class=" img-fluid" src="/user/images/bg/download.png" alt="">
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Download -->

    <!-- Blog -->
    <div class="blog-area pt-120 pb-100">
        <!-- Container-->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="blog-wrapper mb-30">
                        <div class="blog-img">
                            <a href='blog-single.html'><img src="/user/images/blog/blog1.jpg"  alt=""></a>
                        </div>
                        <div class="blog-text">
                            <h4><a href='blog-single.html'>Lorem ipsum dolor sit amet.
                                </a>
                            </h4>
                            <a href='blog-single.html'>Read More <i class="ri-arrow-right-line"></i></a>
                            <div class="blog-meta">
                                <span> <i class="las la-calendar"></i> 05 Feb 2022</span>
                                <span> <i class="lar la-heart"></i>Comments (03)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="blog-wrapper mb-30">
                        <div class="blog-img">
                            <a href='blog-single.html'><img src="/user/images/blog/blog2.jpg" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <h4><a href='blog-single.html'>Lorem ipsum dolor sit amet.</a>
                            </h4>
                            <a href='blog-single.html'>Read More <i class="ri-arrow-right-line"></i></a>
                            <div class="blog-meta">
                                <span> <i class="las la-calendar"></i> 05 Feb 2022</span>
                                <span> <i class="lar la-heart"></i>Comments (03)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="blog-wrapper mb-30">
                        <div class="blog-img">
                            <a href='blog-single.html'><img src="/user/images/blog/blog3.jpg" alt=""></a>
                        </div>
                        <div class="blog-text">
                            <h4><a href='blog-single.html'>Lorem ipsum dolor sit amet.</a>
                            </h4>
                            <a href='blog-single.html'>Read More <i class="ri-arrow-right-line"></i></a>
                            <div class="blog-meta">
                                <span> <i class="las la-calendar"></i> 05 Feb 2022</span>
                                <span> <i class="lar la-heart"></i>Comments (03)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container-->
    </div>
    <!-- /Blog -->

    <!-- Client Logo -->
    <div class="client-logo-area pb-100">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-envato.png" alt=""
                                class="img-fluid"></div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-converkit.png" alt=""
                                class="img-fluid"></div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-buzzumo.png"  alt=""
                                class="img-fluid"></div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-buffer.png"  alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-frame.png"  alt=""
                                class="img-fluid"></div>
                    </div>
                </div>
                <!-- /col -->
                <!-- col -->
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 col-6 text-center">
                    <div class="client-logo">
                        <div class="client-logo-img"> <img src="/user/images/client-logo/logo-clearbit.png"  alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Client Logo -->

    <!-- Cta -->
    <div class="cta-area">
        <!-- Container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class="col-lg-12">
                    <div class="get-start-box">
                        <!-- col -->
                        <div class="col-lg-8">
                            <div class="section-heading">
                                <h5 class="section__meta text-white">#get in touch</h5>
                                <h2 class="section__title">Ready to get started ?</h2>
                                <p class="section__sub">Speak to a Bnker specialist at (800-123-1234)</p>
                            </div>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-lg-4">
                            <div class="button-shared text-end">
                                <a class='btn cta-btn' href='contact.html'>
                                    Request Call Back <span class="la la-caret-right"></span>
                                </a>
                            </div>
                        </div>
                        <!-- /col -->
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /Container -->
    </div>
    <!-- /Cta -->
    
@endsection