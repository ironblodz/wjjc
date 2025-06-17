@extends('master')

@section('title', 'Contacto')
@section('description', 'Contacte-nos')
@section('canonical', 'https://wjjc.pt/contact')
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
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.contacts.contact') }}</li>
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
        <img loading="lazy" src="{{ asset('assets/images/logowhite.png') }}" style="width: 100px;" alt="element">
        <div class="scrollToTop-icon">
            <i class="fas fa-arrow-up"></i>
        </div>
    </a>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            End Scroll-To-Top
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            Start Contact-item
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="contact-item-section ptb-120">
        <div class="contact-element-one my-paroller" data-paroller-factor="0.2" data-paroller-type="foreground"
            data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai2.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="contact-element-two my-paroller" class="" data-paroller-factor="0.2"
            data-paroller-type="foreground" data-paroller-direction="vertical">
            <img loading="lazy" src="{{ asset('assets/images/samurai1.jpg') }}" style="opacity: 0.3" alt="element">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 text-center">
                    <div class="section-header">
                        <h2 class="section-title">{{ __('messages.contacts.done') }} <span>
                                {{ __('messages.contacts.information') }}</span></h2>
                        <p>{{ __('messages.contacts.art') }}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="contact-item">
                        <div class="contact-icon-area">
                            <div class="contact-icon">
                                <img loading="lazy" src="assets/images/icon/icon-64.png" alt="icon">
                            </div>
                        </div>
                        <div class="contact-content">
                            <h4 class="title">{{ __('messages.contacts.address') }}</h4>
                            <p>Av. dos Bombeiros Voluntários de Penela, edifício 11, 1 Frente centro, 3230-274 Penela<br> <a
                                    href="https://www.google.pt/maps/place/Nihon+Seishin+Dojo/@40.0272594,-8.3896581,17z/data=!3m1!4b1!4m6!3m5!1s0xd22f300579cccab:0x618a61da8f50920f!8m2!3d40.0272553!4d-8.3870832!16s%2Fg%2F11vqqk9tfc?hl=pt-PT&entry=ttu"
                                    target="_blank">{{ __('messages.contacts.watchmap') }}</a> </p>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="contact-item">
                        <div class="contact-icon-area">
                            <div class="contact-icon">
                                <img loading="lazy" src="assets/images/icon/icon-65.png" alt="icon">
                            </div>
                        </div>
                        <div class="contact-content">
                            <h4 class="title">Número Telemóvel</h4>
                            <p>+351 (800)-123-4567 <br> <a href="tel:11234567">chamar agora</a> </p>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                    <div class="contact-item">
                        <div class="contact-icon-area">
                            <div class="contact-icon">
                                <img loading="lazy" src="assets/images/icon/icon-66.png" alt="icon">
                            </div>
                        </div>
                        <div class="contact-content">
                            <h4 class="title">{{ __('messages.contacts.mail') }}</h4>
                            <p>wjjcportugal@gmail.com<br> <a href="mailto:">{{ __('messages.contacts.sendnow') }}</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            End Contact-item
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            Start Account widget
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="account-widget-section account-widget-section-two account-widget-section--style ptb-120">
        <div class="container">
            <div class="row justify-content-center align-items-center mb-60-none">
                <div class="col-xl-6 col-lg-6 mb-60">
                    <div class="account-widget-left">
                        <div class="section-header">
                            <h2 class="section-title">
                                {{ __('messages.contacts.question') }}<span>{{ __('messages.contacts.contactus') }}</span>
                            </h2>
                            {{-- <p>If you have any questions or need more information, please use the form below to send us a
                                message There were twelve rules in all, and they specified that fights should be "a fair
                                stand-up boxing match" in a 24-foot-square or similar ring. </p> --}}
                        </div>
                        <div class="banner-widget">
                            <div class="banner-widget-wrapper">
                                <div class="banner-widget-left">
                                    <div class="banner-widget-thumb">
                                        <img loading="lazy" src="{{ asset('assets/images/LOGO.png') }}" width="107"
                                            height="36" alt="element">
                                    </div>
                                </div>
                                <div class="banner-widget-middle">
                                    <div class="banner-widget-content">
                                        <p>{{ __('messages.contacts.join') }}
                                            <span>{{ __('messages.contacts.we') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-social-area">
                            <span>{{ __('messages.contacts.follow') }}</span>
                            <ul class="contact-social">
                                <li><a href="https://www.facebook.com/profile.php?id=61557533270967" target="t_blank"><i
                                            class="fab fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/wjjc_portugal"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 mb-60">
                    <div class="account-widget-form-area">
                        <h2>{{ __('messages.contacts.informations') }}</h2>
                        <p> <a
                                href="mailto:wjjcportugal@gmail.com?subject=Assunto%20do%20Email&body=Este%20é%20o%20corpo%20do%20email.">wjjcportugal@gmail.com</a></a>
                        </p>
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{-- <form class="account-widget-form" action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div style="display:none;">
                                <input type="text" name="website" value="" />
                            </div>

                            <div class="row justify-content-center mb-25-none">
                                <div class="col-xl-12 form-group">
                                    <input type="text" class="form--control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="O teu Nome*" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-12 form-group">
                                    <input type="email" class="form--control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="O teu Email*" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-12 form-group">
                                    <input type="text" class="form--control" id="phone" name="phone"
                                        value="{{ old('phone') }}" placeholder="O teu número*" required>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-xl-12 form-group">
                                    <textarea class="form--control" id="message" name="message" placeholder="A tua mensagem*" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-xl-12 form-group">
                                    <button type="submit" class="btn--base">Envia agora <i
                                            class="fas fa-arrow-right ml-2"></i></button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            End Account widget
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            Start Map
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="map-section ptb-120">
        <div class="container">
            <div class="row justify-content-center mb-5-none">
                <div class="col-xl-12">
                    <div class="map-area">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3055.1576587500294!2d-8.391954105290383!3d40.02725930578599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd22f300579cccab%3A0x618a61da8f50920f!2sNihon%20Seishin%20Dojo!5e0!3m2!1spt-PT!2spt!4v1718236126746!5m2!1spt-PT!2spt"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                                                                                                                                                                                                                                                                                                                                                            End Map
                                                                                                                                                                                                                                                                                                                                                                                                        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

@endsection
