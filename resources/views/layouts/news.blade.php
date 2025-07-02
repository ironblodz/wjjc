@extends('master')
@section('title', 'Notícias')
@section('description', 'Todas as notícias da WJJC Portugal')
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
        <li class="breadcrumb-item active" aria-current="page">Dojos</li>
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


<section class="blog-section blog-section-two ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 text-center">
                <div class="section-header" data-aos="fade-up" data-aos-duration="1200">
                    <h2 class="section-title">Todas as <span>Notícias</span></h2>
                </div>
            </div>
        </div>
        <div class="blog-area">
            <!-- Destaques -->
            @if(isset($featured) && $featured->count())
            <div class="row justify-content-center mb-4">
                @foreach($featured as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="blog-item border border-danger shadow" data-aos="zoom-in" data-aos-duration="1200">
                            <div class="blog-thumb">
                                @if($item->image)
                                    <img loading="lazy" src="{{ asset('storage/' . $item->image) }}" alt="blog">
                                @else
                                    <img loading="lazy" src="{{ asset('assets/images/blog/default.jpg') }}" alt="blog">
                                @endif
                                @php
                                    $start = $item->start_date ? \Illuminate\Support\Carbon::parse($item->start_date) : null;
                                    $end = $item->end_date ? \Illuminate\Support\Carbon::parse($item->end_date) : null;
                                @endphp
                                @if($start)
                                    <div class="blog-date">
                                        <span>
                                            @if($end && $end->isSameMonth($start) && $end->isSameYear($start) && !$end->equalTo($start))
                                                {{ __(ucfirst($start->translatedFormat('F'))) }} {{ $start->format('d') }}-{{ $end->format('d') }} {{ $start->format('Y') }}
                                            @else
                                                {{ __(ucfirst($start->translatedFormat('F'))) }} {{ $start->format('d') }} {{ $start->format('Y') }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-danger text-white rounded-pill small shadow fw-bold d-flex align-items-center" style="font-size:0.95rem; letter-spacing:1px; z-index:2;">
                                    <i class="fas fa-star me-2"></i> Destaque
                                </div>
                            </div>
                            <div class="blog-content">
                                <div class="blog-post-meta">
                                    <span class="user">BY: WJJC PORTUGAL</span>
                                    <span class="category"><a href="#">JU-JITSU</a></span>
                                </div>
                                <h3 class="title">{{ $item->title }}</h3>
                                <p>{!! $item->excerpt ?? $item->body !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
            <!-- Notícias paginadas -->
            <div class="row justify-content-center mb-30-none">
                @foreach($news as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb-30">
                        <div class="blog-item" data-aos="zoom-in" data-aos-duration="1200">
                            <div class="blog-thumb">
                                @if($item->image)
                                    <img loading="lazy" src="{{ asset('storage/' . $item->image) }}" alt="blog">
                                @else
                                    <img loading="lazy" src="{{ asset('assets/images/blog/default.jpg') }}" alt="blog">
                                @endif
                                @php
                                    $start = $item->start_date ? \Illuminate\Support\Carbon::parse($item->start_date) : null;
                                    $end = $item->end_date ? \Illuminate\Support\Carbon::parse($item->end_date) : null;
                                @endphp
                                @if($start)
                                    <div class="blog-date">
                                        <span>
                                            @if($end && $end->isSameMonth($start) && $end->isSameYear($start) && !$end->equalTo($start))
                                                {{ __(ucfirst($start->translatedFormat('F'))) }} {{ $start->format('d') }}-{{ $end->format('d') }} {{ $start->format('Y') }}
                                            @else
                                                {{ __(ucfirst($start->translatedFormat('F'))) }} {{ $start->format('d') }} {{ $start->format('Y') }}
                                            @endif
                                        </span>
                                    </div>
                                @endif
                                @if($item->featured)
                                    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-danger text-white rounded-pill small shadow fw-bold d-flex align-items-center" style="font-size:0.95rem; letter-spacing:1px; z-index:2;">
                                        <i class="fas fa-star me-2"></i> Destaque
                                    </div>
                                @endif
                            </div>
                            <div class="blog-content">
                                <div class="blog-post-meta">
                                    <span class="user">BY: WJJC PORTUGAL</span>
                                    <span class="category"><a href="#">JU-JITSU</a></span>
                                </div>
                                <h3 class="title">{{ $item->title }}</h3>
                                <p>{!! $item->excerpt ?? $item->body !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-auto">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
