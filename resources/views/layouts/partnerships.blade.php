@extends('master')

@section('title', 'partnerships')
@section('description', 'Partnerships')
@section('canonical', 'https://wjjc.pt/partnerships')

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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.navbar.sponsors') }}</li>
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
                                <a href="https://nerdycorexp.com" target="_blank" class="animated-link">Nerdy Core XP</a>
                            </h3>
                            <p><a href="https://nerdycorexp.com" target="_blank"><i class="fas fa-globe"></i> Visite o nosso website</a></p>
                        </div>
                    </div>
                    <br>
                    <div class="training-thumb">
                        <img loading="lazy" src="{{ asset('assets/images/flags/ncxp2025.png') }}" alt="Nerdy Core XP Logo"
                            class="img-fluid" style="max-width: 400px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
