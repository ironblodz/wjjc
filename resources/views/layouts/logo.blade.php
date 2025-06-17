@extends('master')

@section('title', 'WJJC Logo')
@section('description', 'WJJC Logo')
@section('canonical', 'https://wjjc.pt/logo')
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
                <li class="breadcrumb-item active" aria-current="page">Logo</li>
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

    <section class="feature-section feature-section-two feature-section--style pt-120 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 text-center">
                    <div class="section-header" data-aos="fade-up" data-aos-duration="1200">
                        <h2 class="section-title">{{ __('messages.logo.logo_title') }}
                            <span>{{ __('messages.logo.logo_title2') }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-8 col-lg-8 mb-30">
                    <div class="feature-item-area">
                        <div class="row justify-content-center mb-60-none">
                            <p>{{ __('messages.logo.logo_s') }}</p>

                            <p>{{ __('messages.logo.history') }}</p>

                            <p>{{ __('messages.logo.king') }}</p>

                            <p>{{ __('messages.logo.george') }}</p>

                            <p>{{ __('messages.logo.speak') }}</p>

                            <p>{{ __('messages.logo.sao') }}</p>

                            <p>{{ __('messages.logo.302') }}</p>

                            <p>{{ __('messages.logo.big') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 mb-30">
                    <div class="feature-thumb-area" data-aos="fade-left" data-aos-duration="1200">
                        <div class="feature-thumb">
                            <img loading="lazy" src="{{ asset('assets/images/LOGO-WJJC.png') }}" alt="element">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
