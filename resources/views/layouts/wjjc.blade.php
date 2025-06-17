@extends('master')

@section('title', 'WJJC International')
@section('description', 'WJJC Internacional')
@section('canonical', 'https://wjjc.pt/wjjc')
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.wjjc.wjjc-internacional') }}</li>
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
                                                                                                                                                                                                                                                                                                                                                                                                Start About
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="about-section about-section--style ptb-120">
        <div class="about-element-one my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai2.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="about-element-two my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai1.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img loading="lazy" src="{{ asset('assets/images/LOGO-WJJC.png') }}" alt="about">
                        {{-- <div class="about-overlay-content">
                            <img loading="lazy" src="assets/images/icon/icon-22.png" alt="icon">
                            <h4 class="title">WJJC Internacional</h4>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-content-area">
                        <div class="section-header">
                            <h2 class="section-title">{{ __('messages.wjjc.history') }}<span>WJJC</span></h2>
                            <p>{{ __('messages.wjjc.world') }}</p>

                            <p>{{ __('messages.wjjc.organization') }}</p>

                            <p>{{ __('messages.wjjc.english') }}</p>

                            <p> {{ __('messages.wjjc.training') }}</p>
                        </div>
                        <ul class="about-list">
                            <li>{{ __('messages.wjjc.tradicional') }}</li>
                            <li>{{ __('messages.wjjc.studing') }}</li>
                            <li>{{ __('messages.wjjc.tecnics') }}</li>
                            <li>{{ __('messages.wjjc.program') }}</li>
                        </ul>
                        <div class="about-user-area">
                            <div class="about-user-wrapper">
                                <div class="about-user-thumb">
                                    <img loading="lazy" src="{{ asset('assets/images/logolittle.png') }}" alt="user">
                                </div>
                                <div class="about-user-content">
                                    <h6 class="title">Soke Adriano Busà</h6>
                                    <span class="sub-title">{{ __('messages.wjjc.fund') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-item-area about-item-area-two pt-120">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="about-item">
                            <div class="about-icon">
                                <img loading="lazy" src="assets/images/icon/icon-23.png" alt="icon">
                            </div>
                            <div class="about-content">
                                <h4 class="title">{{ __('messages.wjjc.strong') }}</h4>
                                <p>{{ __('messages.wjjc.strong-p') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="about-item">
                            <div class="about-icon">
                                <img loading="lazy" src="assets/images/icon/icon-24.png" alt="icon">
                            </div>
                            <div class="about-content">
                                <h4 class="title">{{ __('messages.wjjc.geral') }}</h4>
                                <p>{{ __('messages.wjjc.geral-p') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="about-item">
                            <div class="about-icon">
                                <img loading="lazy" src="assets/images/icon/icon-25.png" alt="icon">
                            </div>
                            <div class="about-content">
                                <h4 class="title"> {{ __('messages.wjjc.etics') }}</h4>
                                <p>{{ __('messages.wjjc.etics-p') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                End About
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                Start Video
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="video-section bg-overlay-red bg_img" data-background="{{ asset('assets/images/bannerwjjc.png') }}">
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
                                href="https://www.youtube.com/embed/e_XRFX774Ng">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                End Video
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                Start Statistics
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="statistics-section">
        <div class="container">
            <div class="statistics-area">
                <div class="row mt-20-none mb-30-none">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="statistics-item">
                            <div class="statistics-content">
                                <div class="odo-area">
                                    <h3 class="odo-title odometer" data-odometer-final="5">5</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <p>{{ __('messages.wjjc.continent') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="statistics-item">
                            <div class="statistics-content">
                                <div class="odo-area">
                                    <h3 class="odo-title odometer" data-odometer-final="14">14</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <p>{{ __('messages.wjjc.country') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="statistics-item">
                            <div class="statistics-content">
                                <div class="odo-area">
                                    <h3 class="odo-title odometer" data-odometer-final="100">100</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <p>{{ __('messages.wjjc.friends') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                End Statistics
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                Start Feature
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                End Feature
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                Start Trainer
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                End Client
                                                                                                                                                                                                                                                                                                                                                                                            ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->



@endsection
