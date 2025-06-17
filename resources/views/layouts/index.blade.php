@extends('master')
@section('title', 'Home')
@section('description', 'Página inicial da WJJC Portugal')
@section('canonical', 'https://wjjc.pt/')
@section('content')
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Start Banner
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="banner">
        <div class="slider-prev">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="slider-next">
            <i class="fas fa-chevron-right"></i>
        </div>
        <div class="banner-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="banner-section banner-section-two">
                        <div class="banner-bg bg-overlay-black bg_img"
                            data-background="{{ asset('assets/images/gallery5.jpg') }}" style="background-position: center">
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-center align-items-end mb-30-none">
                                <div class="col-xl-12 col-lg-12 text-center mb-30">
                                    <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                                        <img class="img-fluid" src="{{ asset('assets/images/corporation.png') }}"
                                            width="300" height="300">
                                        <h1 class="title">{{ __('messages.index.allgreat') }}</h1>
                                        <h3 class="inner-title">{{ __('messages.index.journeys') }}</h3>
                                        <p>WORLD JU-JITSU CORPORATION</p>
                                        <div class="banner-btn">
                                            <a href="{{ route('contact.show') }}"
                                                class="btn--base">{{ __('messages.index.joinus') }}<i
                                                    class="fas fa-arrow-right ml-2"></i></a>
                                            <a href="https://wjjc.biz/" target="_blank"
                                                class="btn--base active">{{ __('messages.index.international') }}<i
                                                    class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <section class="video-section2 bg-overlay-red">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-12 text-center">
                                                <div class="video-area">
                                                    <div class="video-main">
                                                        <div class="promo-video">
                                                            <div class="waves-block">
                                                                <div class="waves wave-1"></div>
                                                                <div class="waves wave-2"></div>
                                                                <div class="waves wave-3"></div>
                                                            </div>
                                                        </div>
                                                        <a class="video-icon" data-rel="lightcase:myCollection"
                                                            href="https://www.youtube.com/embed/c15EZ0KLfL0">
                                                            <i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="banner-section banner-section-two">
                        <div class="banner-bg bg-overlay-black bg_img"
                            data-background="{{ asset('assets/images/gallery2.jpg') }}" style="background-position: center">
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-center align-items-end mb-30-none">
                                <div class="col-xl-12 col-lg-12 text-center mb-30">
                                    <div class="banner-content" data-aos="fade-up" data-aos-duration="1800">
                                        <img class="img-fluid" src="{{ asset('assets/images/corporation.png') }}"
                                            width="300" height="300">
                                        <h1 class="title">{{ __('messages.index.allgreat') }}</h1>
                                        <h3 class="inner-title">{{ __('messages.index.journeys') }}</h3>
                                        <p>WJJC PORTUGAL</p>
                                        <div class="banner-btn">
                                            <a href="{{ route('contact.show') }}"
                                                class="btn--base">{{ __('messages.index.joinus') }}<i
                                                    class="fas fa-arrow-right ml-2"></i></a>
                                            <a href="https://wjjc.biz/" target="_blank" class="btn--base active">WJJC
                                                Internacional<i class="fas fa-arrow-right ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <section class="video-section2 bg-overlay-red">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-12 text-center">
                                                <div class="video-area">
                                                    <div class="video-main">
                                                        <div class="promo-video">
                                                            <div class="waves-block">
                                                                <div class="waves wave-1"></div>
                                                                <div class="waves wave-2"></div>
                                                                <div class="waves wave-3"></div>
                                                            </div>
                                                        </div>
                                                        <a class="video-icon" data-rel="lightcase:myCollection"
                                                            href="https://www.youtube.com/embed/c15EZ0KLfL0">
                                                            <i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <a href="#" class="scrollToTop">
        <img src="{{ asset('assets/images/logowhite.png') }}" style="width: 100px;" alt="element">
        <div class="scrollToTop-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>

    <section class="service-section ptb-120">
        <div class="container">
            <div class="service-area">
                <div class="service-element">
                    <img src="{{ asset('assets/images/element/element-24.png') }}" alt="element">
                </div>
                <div class="row justify-content-center mb-10-none">
                    <div class="col-xl-12">
                        <div class="service-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-thumb">
                                            <img loading="lazy" src="{{ asset('assets/images/gallery12.jpg') }}"
                                                alt="service">
                                            <div class="service-overlay">
                                                <div class="service-overlay-content">
                                                    <h3 class="title"><a href="{{ route('founder.show') }}">Shodai Soke
                                                            Adriano
                                                            Busà</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-thumb">
                                            <img loading="lazy" src="{{ asset('assets/images/jutsu.jpg') }}"
                                                alt="service">
                                            <div class="service-overlay">
                                                <div class="service-overlay-content">
                                                    <h3 class="title"><a href="{{ route('founder.show') }}">Shodai Soke
                                                            Adriano
                                                            Busà</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-thumb">
                                            <img loading="lazy" src="{{ asset('assets/images/pedropedro.jpg') }}"
                                                style="height: 463px" alt="service">
                                            <div class="service-overlay">
                                                <div class="service-overlay-content">
                                                    <h3 class="title"><a href="{{ route('dtn.show') }}">Sensei Pedro
                                                            Nuno
                                                            Pimentel</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-thumb">
                                            <img loading="lazy" src="{{ asset('assets/images/ss.jpg') }}"
                                                alt="service">
                                            <div class="service-overlay">
                                                <div class="service-overlay-content">
                                                    <h3 class="title"><a href="{{ route('dtn.show') }}">Sensei Pedro
                                                            Nuno
                                                            Pimentel</a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            Start Blog
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="blog-section blog-section-two ptb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 text-center">
                    <div class="section-header" data-aos="fade-up" data-aos-duration="1200">
                        <h2 class="section-title">{{ __('messages.index.latest') }}<span>
                                {{ __('messages.index.news') }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="blog-area">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="blog-item" data-aos="zoom-in" data-aos-duration="1200">
                            <div class="blog-thumb">
                                <img loading="lazy" src="{{ asset('assets/images/blog/new1.jpg') }}" alt="blog">
                                {{-- <div class="blog-date">
                                    <span>24-25, 2024</span>
                                </div> --}}
                            </div>
                            <div class="blog-content">
                                <div class="blog-post-meta">
                                    <span class="user">BY: WJJC PORTUGAL</span>
                                    <span class="category"><a href="#">JU-JITSU</a></span>
                                </div>
                                <h3 class="title"><a href="#">{{ __('messages.index.welcome') }}</a></h3>
                                <p>
                                    {{ __('messages.index.worldjujitsu') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="blog-item" data-aos="zoom-in" data-aos-duration="1200">
                            <div class="blog-thumb">
                                <img loading="lazy" src="{{ asset('assets/images/blog/new2.jpg') }}" alt="blog">
                                <div class="blog-date">
                                    <span>{{ __('messages.index.may') }} 16-23, 2024</span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-post-meta">
                                    <span class="user">BY: WJJC PORTUGAL</span>
                                    <span class="category"><a href="#">JU-JITSU</a></span>
                                </div>
                                <h3 class="title"><a href="#">{{ __('messages.index.seminary') }}</a>
                                </h3>
                                <p>{{ __('messages.index.exclusive') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="blog-item" data-aos="zoom-in" data-aos-duration="1200">
                            <div class="blog-thumb">
                                <img loading="lazy" src="{{ asset('assets/images/blog/new3.jpg') }}" alt="blog">
                                <div class="blog-date">
                                    <span>{{ __('messages.index.Julho') }} 25-26, 2024</span>
                                </div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-post-meta">
                                    <span class="user">BY: WJJC PORTUGAL</span>
                                    <span class="category"><a href="#">JU-JITSU</a></span>
                                </div>
                                <h3 class="title"><a
                                        href="{{ route('event.show') }}">{{ __('messages.index.masterclass') }}</a>
                                </h3>
                                <p>{{ __('messages.index.blackbelts') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            End Blog
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
