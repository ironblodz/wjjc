@extends('master')

@section('title', 'Dojos')
@section('description', 'Dojos da WJJC Portugal')
@section('canonical', 'https://wjjc.pt/dojos')

@section('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                Start Banner
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img"
        data-background="{{ asset('assets/images/spacesamurai.jpg') }}">
        <div class="section-logo-text">
            <span class="title">WJJC</span>
        </div>

    </section>
    <div class="breadcrumb-area">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">WJJC</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dojos</li>
            </ol>
        </nav>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                End Banner
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                Start Scroll-To-Top
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <a href="#" class="scrollToTop">
        <img loading="lazy" src="{{ asset('assets/images/logowhite.png') }}" alt="element">
        <div class="scrollToTop-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                End Scroll-To-Top
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                Start Training
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="training-section training-section--style ptb-120">
        <div class="training-element-one my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai2.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="training-element-three my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai1.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 text-center">
                    <div class="section-header" data-aos="fade-up" data-aos-duration="1200">
                        <h2 class="section-title h2">
                            <span>{{ __('messages.dojos.wjjc') }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="training-item" data-aos="zoom-in" data-aos-duration="1200">
                        <div class="training-thumb">
                            <img loading="lazy" src="{{ asset('assets/images/logoptpts.jpg') }}" alt="training">
                        </div>
                        <div class="training-content">
                           <div>
                                <h3 class="title mb-0">Nihon Seishin Dojo</h3>
                                <span>Sede Nacional</span>
                            </div>
                            <br>
                            <p>Av. Infante Dom Pedro 1, 3230 -277 Penela</p>
                            <div class="contact-social-area">
                                <span>{{ __('messages.dojos.follow') }}</span>
                                <ul class="contact-social">
                                    <li><a href="https://www.facebook.com/nihonseishindojo/" target="t_blank"><i
                                                class="fab fa-facebook"></i></a></li>
                                </ul>
                            </div>
                            <div class="training-footer-area">
                                <div class="training-price">
                                    <h4 class="title">{{ __('messages.dojos.email') }}</h4>
                                </div>
                                <div class="training-footer-btn">
                                    <a href="mailto:pedro.nuno.jujitsu@gmail.com"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <section class="map-section ptb-20">
                            <div class="container">
                                <div class="row justify-content-center mb-5-none">
                                    <div class="col-xl-12">
                                        <div class="map-area">
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3055.1576554598555!2d-8.389658122792753!3d40.027259379250005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22f300579cccab%3A0x618a61da8f50920f!2sNihon%20Seishin%20Dojo!5e0!3m2!1spt-PT!2spt!4v1719389978401!5m2!1spt-PT!2spt"
                                                width="600" height="450" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                End Training
                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->







@endsection
