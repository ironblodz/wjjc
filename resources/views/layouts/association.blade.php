@extends('master')

@section('title', 'The Association')
@section('description', 'The Association')
@section('canonical', 'https://wjjc.pt/association')
@section('content')


 <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                            Start Banner
                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="banner-section banner-section-two inner-banner-section bg-overlay-red bg_img"
        data-background="{{ asset('assets/images/spacesamurai.jpg') }}">
        <div class="section-logo-text">
            <span class="title">{{ __('messages.association.association') }}</span>
        </div>
    </section>
    <div class="breadcrumb-area">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">{{ __('messages.association.association') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.wjjcpt.wjjc-internacional') }}</li>
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
            <img loading="lazy" src="assets/images/samurai2.jpg" style="opacity: 0.3" alt="element">
        </div>
        <div class="about-element-two my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="assets/images/samurai1.jpg" style="opacity: 0.3" alt="element">
        </div>
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img loading="lazy" src="{{ asset('assets/images/LOGO.png') }}" alt="about">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-content-area">
                        <div class="section-header">
                            <h2 class="section-title">{{ __('messages.wjjcpt.we') }}
                                <span>{{ __('messages.wjjcpt.history') }}</span>
                            </h2>
                            <p> {{ __('messages.association.world') }}</p>

                            <p>{{ __('messages.wjjcpt.organization') }}
                            </p>

                            <p>{{ __('messages.wjjcpt.english') }}
                            </p>

                            <p>{{ __('messages.wjjcpt.training') }}</p>
                        </div>
                        <ul class="about-list">
                            <li>{{ __('messages.wjjcpt.tradicional') }}</li>
                            <li>{{ __('messages.wjjcpt.studing') }}</li>
                            <li>{{ __('messages.wjjcpt.tecnics') }}</li>
                            <li>{{ __('messages.wjjcpt.program') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="about-item-area about-item-area-two pt-120">
                <div class="row justify-content-center mb-30-none">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="about-item">
                            <div class="about-icon">
                                <img loading="lazy" loading="lazy" src="assets/images/icon/icon-23.png" alt="icon">
                            </div>
                            <div class="about-content">
                                <h4 class="title">{{ __('messages.wjjcpt.strong') }}</h4>
                                <p>{{ __('messages.wjjcpt.strong-p') }}
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
                                <h4 class="title">{{ __('messages.wjjcpt.geral') }}</h4>
                                <p>{{ __('messages.wjjcpt.geral-p') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="about-item">
                            <div class="about-icon">
                                <img loading="lazy" src="assets/images/icon/icon-25.png" alt="icon">
                            </div>
                            <div class="about-content">
                                <h4 class="title">{{ __('messages.wjjcpt.etics') }}</h4>
                                <p>{{ __('messages.wjjcpt.etics-p') }}</p>
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
    <section class="video-section bg-overlay-red bg_img" data-background="{{ asset('assets/images/pt.jpg') }}">
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
                                href="https://www.youtube.com/embed/c15EZ0KLfL0?si=XxjYiVmbHPMTyLUx&amp;start=1">
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


@endsection
