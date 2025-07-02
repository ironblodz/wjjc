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

    @php
        $partnerships = \App\Models\Partnership::active()->ordered()->get();
    @endphp

    @forelse($partnerships as $partnership)
        <section class="training-section training-section--style training-details-section {{ $loop->first ? 'ptb-30' : 'ptb-120' }}">
            <div class="container">
                <div class="row justify-content-center mb-10-none" data-aos="fade-up" data-aos-duration="1200">
                    <div class="col-xl-12 text-center">
                        <div class="training-item">
                            <div class="training-content">
                                <h3>
                                    @if($partnership->website_url)
                                        <a href="{{ $partnership->website_url }}" target="_blank" class="animated-link">{{ $partnership->name }}</a>
                                    @else
                                        {{ $partnership->name }}
                                    @endif
                                </h3>
                                @if($partnership->description)
                                    <span style="font-size: 0.9em; display: block; color: #888;">{{ $partnership->description }}</span>
                                @endif
                                @if($partnership->website_url)
                                    <p><a href="{{ $partnership->website_url }}" target="_blank"><i class="fas fa-globe"></i> Visite o nosso website</a></p>
                                @endif
                            </div>
                        </div>
                        <br>
                        @if($partnership->logo_path)
                            <div class="training-thumb {{ $loop->first ? 'mt-5' : '' }}">
                                <img loading="lazy" src="{{ asset('storage/' . $partnership->logo_path) }}"
                                     alt="{{ $partnership->name }} Logo"
                                     class="img-fluid" style="max-width: 300px;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @empty
        <section class="training-section training-section--style training-details-section ptb-120">
            <div class="container">
                <div class="row justify-content-center mb-10-none" data-aos="fade-up" data-aos-duration="1200">
                    <div class="col-xl-12 text-center">
                        <div class="training-item">
                            <div class="training-content">
                                <h3>Nenhuma parceria disponível</h3>
                                <p>Em breve teremos novidades sobre nossas parcerias.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforelse

@endsection
