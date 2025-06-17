@extends('master')

@section('title', 'O Diretor Técnico Nacional')
@section('description', 'O Diretor Técnico Nacional da WJJC Portugal')
@section('canonical', 'https://wjjc.pt/dtn')
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.dtn.dtnnc') }}</li>
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
        <img loading="lazy"src="{{ asset('assets/images/logowhite.png') }}" alt="element">
        <div class="scrollToTop-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                    End Scroll-To-Top
                                                                                                                                                                                                                                                                                                                                                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                    Start Trainer
                                                                                                                                                                                                                                                                                                                                                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="trainer-section trainer-details-section ptb-120">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-30-none">
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="about-thumb">
                        <img loading="lazy"src="{{ asset('assets/images/bg/xx.jpg') }}" alt="about">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-30">
                    <div class="trainer-about-content-area">
                        <div class="trainer-about-header">
                            <h2 class="title" style="font-size: xx-large;">Sensei Pedro Nuno Pimentel</h2>
                            <span class="sub-title">{{ __('messages.dtn.dtnnc') }}</span>
                        </div>
                        <div class="trainer-about-body">
                            <p>{{ __('messages.dtn.jujitsu') }}</p>

                            <p>{{ __('messages.dtn.martial') }}</p>

                        </div>
                        <div class="trainer-about-footer">
                            <div class="trainer-about-social-area">
                                <ul class="trainer-about-social">
                                    <li><a href="https://www.instagram.com/pedro_n_pimentel" target="t_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.facebook.com/PedroPimentel.Kyoosoku/" target="t_blank"><i
                                                class="fab fa-facebook"></i></a></li>
                                </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-widget-area">
                <h3 class="widget-title">{{ __('messages.dtn.sensei') }}</h3>
                <p>{{ __('messages.dtn.2014') }}</p>
                <p>{{ __('messages.dtn.objective') }}</p>
                <div class="about-widget-thumb">
                    <img loading="lazy"src="{{ asset('assets/images/ola.jpg') }}" alt="bg">
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
                                href="https://www.youtube.com/embed/NsXguuZGosQ">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                    End Trainer
                                                                                                                                                                                                                                                                                                                                                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                    Start Trainer
                                                                                                                                                                                                                                                                                                                                                                ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    < <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ End Trainer ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->





    @endsection
