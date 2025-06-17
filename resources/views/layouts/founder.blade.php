@extends('master')

@section('title', 'O Fundador')
@section('description', 'O Fundador da WJJC')
@section('canonical', 'https://wjjc.pt/founder')
@section('content')

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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.founder.founder') }}</li>
            </ol>
        </nav>
    </div>


    <a href="#" class="scrollToTop">
        <img loading="lazy"src="{{ asset('assets/images/logowhite.png') }}" alt="element">
        <div class="scrollToTop-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>

    <section class="trainer-section trainer-details-section ptb-120">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img loading="lazy"src="{{ asset('assets/images/gallery12.jpg') }}" alt="about">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="trainer-about-content-area">
                        <div class="trainer-about-header">
                            <h2 class="title">Soke Adriano Busà</h2>
                            <span class="sub-title">{{ __('messages.founder.founder') }}</span>
                        </div>
                        <div class="trainer-about-body">
                            <p>{{ __('messages.founder.jujitsu') }}</p>

                            <p>{{ __('messages.founder.2014') }}</p>

                            <p>{{ __('messages.founder.filosofi') }}</p>

                        </div>
                        <div class="trainer-about-footer">
                            <div class="trainer-about-social-area">
                                <ul class="trainer-about-social">
                                    <li><a href="https://www.instagram.com/soke.adriano.busa" target="t_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-widget-area">
                <h3 class="widget-title">{{ __('messages.founder.soke') }}</h3>
                <p>{{ __('messages.founder.sokeadri') }}</p>
                <p>{{ __('messages.founder.tecnics') }}
                </p>
                <p>{{ __('messages.founder.day') }}</p>
                <div class="about-widget-thumb">
                    <img loading="lazy"src="{{ asset('assets/images/gallery7.jpg') }}" alt="bg">
                    <div class="about-widget-video">
                        <div class="video-main">
                            <div class="promo-video">
                                <div class="waves-block">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div>
                            </div>
                            <a class="video-icon" data-rel="lightcase:myCollection"
                                href="https://www.youtube.com/embed/oF4oNfwlq38">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
