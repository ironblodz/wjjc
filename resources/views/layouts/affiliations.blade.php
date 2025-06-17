@extends('master')

@section('title', 'affiliations')
@section('description', 'Affiliations')
@section('canonical', 'https://wjjc.pt/affiliations')

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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.affiliations.filition') }}</li>
            </ol>
        </nav>
    </div>

    <section class="training-section training-section--style training-details-section ptb-120">
        <div class="container">
            <div class="row justify-content-center mb-10-none" data-aos="fade-up" data-aos-duration="1200">
                <div class="col-xl-12 text-center">
                    <div class="training-item">
                        <div class="training-content">
                            <h3>
                                <a href="https://wjjc.biz" target="t_blank" class="animated-link">World Ju-Jitsu
                                    Corporation</a>
                            </h3>
                            <p>(Internacional)</p>
                        </div>
                    </div>
                    <br>
                    <div class="training-thumb">
                        <img loading="lazy" src="{{ asset('assets/images/LOGO-WJJC.png') }}" alt="bg"
                            class="img-fluid" style="max-width: 400px;">
                    </div>
                </div>
            </div>

            <!-- Div igual abaixo -->
            <div class="row justify-content-center mb-10-none" data-aos="fade-up" data-aos-duration="1200">
                <div class="col-xl-12 text-center">
                    <div class="training-item">
                        <div class="training-content">
                            <h3>
                                <a href="https://www.fjjdap.pt" target="t_blank"
                                    class="animated-link">{{ __('messages.affiliations.federation') }}</a>
                            </h3>
                            <p>{{ __('messages.affiliations.national') }}</p>
                        </div>
                    </div>
                    <br>
                    <div class="training-thumb">
                        <img loading="lazy" src="{{ asset('assets/images/logoassociation.jpeg') }}" alt="bg"
                            class="img-fluid" style="max-width: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
