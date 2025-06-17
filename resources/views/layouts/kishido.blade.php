@extends('master')

@section('title', 'Kishido')
@section('description', 'Kishido Ju-Jitsu da WJJC Portugal')
@section('canonical', 'https://wjjc.pt/kishido')
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
                <li class="breadcrumb-item active" aria-current="page">Kishido</li>
            </ol>
        </nav>
    </div>
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

    <!--~~~~~~~~~~~~~
                                                                                                                                                                                                                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                        Start Training
                                                                                                                                                                                                                    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="training-section training-section--style training-details-section ptb-120">
        <div class="container">
            <div class="row justify-content-center mb-10-none" data-aos="fade-up" data-aos-duration="1200">
                <div class="col-xl-12">
                    <div class="training-item">
                        <div class="training-thumb">
                            <img loading="lazy" src="assets/images/workout/kishido1.png" alt="bg">
                        </div>
                        <div class="training-content">
                            <div class="training-content-header">
                                <h2 class="title">KISHIDO JU-JITSU</h2>
                            </div>
                            <p>{{ __('messages.kishido.cav') }}</p>
                            <br>
                            <p>{{ __('messages.kishido.inglesa') }}</p>
                            <br>
                            <p>{{ __('messages.kishido.movements') }}</p>
                            <br>
                            <p>{{ __('messages.kishido.work') }}</p>

                            <div
                                class="feature-widget-area feature-section-two feature-section--style feature-section--style-two mt-60">
                                <h2 class="widget-title">
                                    {{ __('messages.kishido.we') }} <span>KISHIDO JU-JITSU</span></h2>
                                <div class="row justify-content-center">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="feature-item-area">
                                            <div class="row justify-content-center mb-30-none">
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-56.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>01.</span>
                                                                {{ __('messages.kishido.aprimora') }}</h4>
                                                            <p> {{ __('messages.kishido.musculs') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-57.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>02.</span>
                                                                {{ __('messages.kishido.geral') }}
                                                            </h4>
                                                            <p>{{ __('messages.kishido.strong') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-58.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>03.</span>
                                                                {{ __('messages.kishido.weigh') }}</h4>
                                                            <p>{{ __('messages.kishido.help') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-59.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>04.</span>
                                                                {{ __('messages.kishido.value') }}</h4>
                                                            <p>{{ __('messages.kishido.pride') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-60.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>05.</span>
                                                                {{ __('messages.kishido.autocontrol') }}
                                                            </h4>
                                                            <p>{{ __('messages.kishido.ju') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                                                    <div class="feature-item">
                                                        <div class="feature-icon-area">
                                                            <div class="feature-icon">
                                                                <img loading="lazy" src="assets/images/icon/icon-61.png"
                                                                    alt="icon">
                                                            </div>
                                                        </div>
                                                        <div class="feature-content">
                                                            <h4 class="title"><span>06.</span>
                                                                {{ __('messages.kishido.defesa') }}
                                                            </h4>
                                                            <p>{{ __('messages.kishido.tecnic') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="training-widget-footer mt-60">
                                    <h2 class="widget-title">{{ __('messages.kishido.this') }} <span>
                                            {{ __('messages.kishido.martial') }}</span></h2>
                                    <p>{{ __('messages.kishido.benefic') }}</p>
                                    <br>
                                    <p>{{ __('messages.kishido.training') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>




@endsection
