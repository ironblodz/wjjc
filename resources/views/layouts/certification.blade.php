@extends('master')

@section('title', 'WJJC Certificação')
@section('description', 'WJJC Certificação')
@section('canonical', 'https://wjjc.pt/certification')
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.certification.certification') }} </li>
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

    <section class="about-section about-section--style ptb-120">
        <div class="about-element-one my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="assets/images/samurai2.jpg" style="opacity: 0.3" alt="element">
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="row justify-content-center align-items-center mb-30-none">
                    <div class="col-xl-6 col-lg-6 mb-30">
                        <div class="about-thumb">
                            <img loading="lazy" src="{{ asset('assets/images/bg/certificado.jpg') }}" alt="about">
                            {{-- <div class="about-overlay-content">
                            <img loading="lazy" src="assets/images/icon/icon-22.png" alt="icon">
                            <h4 class="title">WJJC Internacional</h4>
                        </div> --}}
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 mb-30">
                        <div class="about-content-area">
                            <div class="section-header">
                                <h2 class="section-title" style="font-size:2.5rem;">
                                    {{ __('messages.certification.wjjc_certification') }} <span> WJJC</span>
                                </h2>
                                <p>{{ __('messages.certification.september') }}</p>

                                <p>{{ __('messages.certification.course') }}</p>
                            </div>
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
