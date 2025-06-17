<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description', __('messages.description'))">
    <meta name="keywords" content="@yield('keywords', __('messages.keywords'))">
    <meta name="author" content="WJJC PORTUGAL">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="{{ asset('assets/images/LOGO.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/LOGO.png') }}" type="image/x-icon">
    <meta property="og:image" content="{{ asset('assets/images/LOGO.png') }}">

    <meta property="og:title" content="{{ __('messages.title') }}">
    <meta property="og:description" content="WJJC Portugal">
    <meta property="og:image" content="https://wjjc.pt/assets/images/LOGO.png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="200">
    <meta property="og:url" content="https://wjjc.pt">
    <meta property="og:type" content="website">
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif
    <title>@yield('title', __('messages.title'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- fontawesome css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/LOGO.png') }}" type="image/x-icon">
    <!-- swipper css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}">
    <!-- lightcase css links -->
    <link rel="stylesheet" href="{{ asset('assets/css/lightcase.css') }}">
    <!-- odometer css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
    <!-- line-awesome-icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <!-- line-awesome-icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- aos.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <!-- nice select css -->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
    <!-- flipclock css -->
    <link rel="stylesheet" href="{{ asset('assets/css/flipclock.css') }}">
    <!-- main style css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- main2 style css link -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.personalize.css') }}">

    <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "name": "Wjjc Portugal",
          "url": "https://wjjc.pt",
          "logo": "https://wjjc.pt/assets/images/LOGO.png",
          "contactPoint": {
            "@type": "ContactPoint",
            "email": "wjjcportugal@gmail.com",
            "contactType": "Contacte-nos"
          },
          "sameAs": [
            "https://www.facebook.com/profile.php?id=61557533270967",
            "https://www.instagram.com/wjjc_portugal/"
          ]
        }
        </script>
    <!-- Google tag (gtag.js) --><!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GE6N71R6VY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-GE6N71R6VY');
    </script>
</head>

<body>


    <div class="cursor"></div>



    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="preloader" id="preloader">
        <div class="loader">
            <div class="loader-thumb">
                <img src="{{ asset('assets/images/LOGO.png') }}" alt="logo">
            </div>
        </div>
    </div>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Preloader
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <header class="header-section header-section-two">
        <div class="header">
            <div class="header-bottom-area">
                <div class="container-fluid">
                    <div class="header-menu-content">
                        <nav class="navbar navbar-expand-xl p-0">
                            <a class="site-logo site-title d-block d-xl-none" href="{{ route('index') }}">
                                <img src="{{ asset('assets/images/LOGO.png') }}" width="150" height="150"
                                    alt="site-logo">
                            </a>
                            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="fas fa-bars"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav main-menu ml-auto mr-auto">
                                    <li class="menu_has_children">
                                        <a href="#">WJJC</a>
                                        <ul class="sub-menu">
                                            <li class="menu_has_children">
                                            <li><a
                                                    href="{{ route('wjjc.show') }}">{{ __('messages.navbar.history_wjjc') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('certification.show') }}">{{ __('messages.navbar.certification') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('logo.show') }}">{{ __('messages.navbar.logo') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu_has_children"><a
                                            href="{{ route('founder.show') }}">{{ __('messages.navbar.founder') }}</a>
                                    </li>
                                    <li class="menu_has_children"><a
                                            href="{{ route('kishido.show') }}">{{ __('messages.navbar.ju-jitsu') }}</a>
                                    </li>
                                    <li class="menu_has_children"><a
                                            href="{{ route('dtn.show') }}">{{ __('messages.navbar.diretor_tec') }}</a>
                                    </li>
                                    <li><a class="site-logo site-title d-none d-xl-block"
                                            href="{{ route('index') }}">
                                            <img src="{{ asset('assets/images/LOGO.png') }}" width="150"
                                                height="150" alt="logo">
                                        </a></li>
                                        <li class="menu_has_children">
                                            <a href="{{ route('wjjcpt.show') }}">WJJC Portugal</a>
                                            <ul class="sub-menu">
                                                <li class="menu_has_children">
                                                <li><a
                                                        href="{{ route('association.show') }}">{{ __('messages.navbar.association') }}</a>
                                                </li>
                                                <li><a
                                                        href="{{ route('affiliations.show') }}">{{ __('messages.navbar.affiliations') }}</a>
                                                </li>

                                                <li><a
                                                    href="{{ route('sponsors.show') }}">{{ __('messages.navbar.sponsors') }}</a>
                                            </li>
                                            </ul>
                                        </li>
                                    <li><a href="{{ route('dojos.show') }}">{{ __('messages.navbar.dojos') }}</a>
                                    </li>
                                    <li class="menu_has_children">
                                        <a href="#">{{ __('messages.navbar.gallery') }}</a>
                                        <ul class="sub-menu">
                                            <li><a href="#">WJJC</a></li>
                                            <li class="menu_has_children">
                                                <a
                                                    href="{{ route('event.show') }}">{{ __('messages.navbar.eventos') }}</a>
                                            </li>
                                            <li><a
                                                    href="{{ route('workout.show') }}">{{ __('messages.navbar.training') }}</a>
                                            </li>
                                            <li><a href="{{ route('competition.show') }}">{{ __('messages.navbar.competion') }}</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('contact.show') }}">{{ __('messages.navbar.contact') }}</a>
                                    </li>
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-globe"></i> <!-- Ícone para representar o idioma -->
                                            </a>
                                            <div class="dropdown-menu" style="min-width: 0;"
                                                aria-labelledby="languageDropdown">
                                                <a class="dropdown-item"
                                                    href="{{ route('change.language', ['locale' => 'en']) }}">
                                                    <svg width="20px" height="20px" viewBox="0 -4 28 28"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_503_2952)">
                                                            <rect width="28" height="20" rx="2"
                                                                fill="white" />
                                                            <mask id="mask0_503_2952" style="mask-type:alpha"
                                                                maskUnits="userSpaceOnUse" x="0" y="0" width="28"
                                                                height="20">
                                                                <rect width="28" height="20" rx="2"
                                                                    fill="white" />
                                                            </mask>
                                                            <g mask="url(#mask0_503_2952)">
                                                                <rect width="28" height="20" fill="#0A17A7" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M-1.28244 -1.91644L10.6667 6.14335V-1.33333H17.3334V6.14335L29.2825 -1.91644L30.7737 0.294324L21.3263 6.66667H28V13.3333H21.3263L30.7737 19.7057L29.2825 21.9165L17.3334 13.8567V21.3333H10.6667V13.8567L-1.28244 21.9165L-2.77362 19.7057L6.67377 13.3333H2.95639e-05V6.66667H6.67377L-2.77362 0.294324L-1.28244 -1.91644Z"
                                                                    fill="white" />
                                                                <path d="M18.668 6.33219L31.3333 -2" stroke="#DB1F35"
                                                                    stroke-width="0.666667" stroke-linecap="round" />
                                                                <path d="M20.0128 13.6975L31.3666 21.3503"
                                                                    stroke="#DB1F35" stroke-width="0.666667"
                                                                    stroke-linecap="round" />
                                                                <path d="M8.00555 6.31046L-3.83746 -1.67099"
                                                                    stroke="#DB1F35" stroke-width="0.666667"
                                                                    stroke-linecap="round" />
                                                                <path d="M9.29006 13.6049L-3.83746 22.3105"
                                                                    stroke="#DB1F35" stroke-width="0.666667"
                                                                    stroke-linecap="round" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0 12H12V20H16V12H28V8H16V0H12V8H0V12Z"
                                                                    fill="#E6273E" />
                                                            </g>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_503_2952">
                                                                <rect width="28" height="20" rx="2"
                                                                    fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('change.language', ['locale' => 'pt']) }}">
                                                    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                                    <svg width="20px" height="20px" viewBox="0 -4 28 28"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_503_4163)">
                                                            <rect width="28" height="20" rx="2"
                                                                fill="white" />
                                                            <mask id="mask0_503_4163" style="mask-type:alpha"
                                                                maskUnits="userSpaceOnUse" x="0" y="0" width="28"
                                                                height="20">
                                                                <rect width="28" height="20" rx="2"
                                                                    fill="white" />
                                                            </mask>
                                                            <g mask="url(#mask0_503_4163)">
                                                                <rect width="28" height="20" fill="#FF2936" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0 20H10.6667V0H0V20Z" fill="#128415" />
                                                                <path
                                                                    d="M10.6667 13.3333C12.5076 13.3333 14 11.8409 14 9.99999C14 8.15905 12.5076 6.66666 10.6667 6.66666C8.82572 6.66666 7.33333 8.15905 7.33333 9.99999C7.33333 11.8409 8.82572 13.3333 10.6667 13.3333Z"
                                                                    stroke="#FAF94F" stroke-width="1.33333" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9.3335 8.33333C9.3335 8.14924 9.48273 8 9.66683 8H11.6668C11.8509 8 12.0002 8.14924 12.0002 8.33333V10.6667C12.0002 11.403 11.4032 12 10.6668 12V12C9.93045 12 9.3335 11.403 9.3335 10.6667V8.33333Z"
                                                                    fill="white" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M10.6667 10.6667C11.0349 10.6667 11.3333 9.70153 11.3333 9.33334C11.3333 8.96515 11.0349 8.66667 10.6667 8.66667C10.2985 8.66667 10 8.96515 10 9.33334C10 9.70153 10.2985 10.6667 10.6667 10.6667Z"
                                                                    fill="#1D50B5" />
                                                            </g>
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_503_4163">
                                                                <rect width="28" height="20" rx="2"
                                                                    fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                                <!-- Adicione mais bandeiras conforme necessário -->
                                            </div>
                                        </li>
                                    </ul>

                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    End Header
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

    @yield('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Start Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <footer class="footer-section footer-section-two pt-120">
        <div class="footer-bg">
            <img src="{{ asset('assets/images/bg/bg-4.png') }}" alt="bg">
        </div>
        <div class="container">
            <div class="row mb-30-none">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a class="site-logo site-title" href="index.html"><img
                                    src="{{ asset('assets/images/LOGO.png') }}" width="20%" height="20%"
                                    alt="site-logo"></a>
                        </div>
                        <ul class="footer-social">
                            <li><a href="https://www.facebook.com/profile.php?id=61557533270967"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/wjjc_portugal"><i class="fab fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <h4 class="title">{{ __('messages.footer.affiliation') }}</h4>
                        <br>
                        <h3 class="title">{{ __('messages.footer.wjjc_portugal') }}</h3>
                        <ul class="footer-list">
                            <li><span>{{ __('messages.footer.email') }}</span> wjjcportugal@gmail.com</li>
                        </ul>
                    </div>
                    <br>
                    <div class="footer-widget">
                        <h3 class="title">{{ __('messages.footer.wjjc_international') }}</h3>
                        <ul class="footer-list">
                            <li><span>{{ __('messages.footer.website') }}</span> https://wjjc.biz/</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <h4 class="title">{{ __('messages.footer.contact_us') }}</h4>
                        <ul class="footer-list">
                            <li><span>{{ __('messages.footer.email') }}</span> wjjcportugal@gmail.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrapper">
            <div class="row justify-content-center">
                <div class="col-xl-12 text-center">
                    <div class="copyright-area">
                        <p>Copyright 2024 WJJC PORTUGAL</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
End Footer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


    <script>
        const cursor = document.querySelector(".cursor");
        var timeout;

        //follow cursor on mousemove
        document.addEventListener("mousemove", (e) => {
            let x = e.pageX;
            let y = e.pageY;

            cursor.style.top = y + "px";
            cursor.style.left = x + "px";
            cursor.style.display = "block";

            //cursor effects when mouse stopped
            function mouseStopped() {
                cursor.style.display = "none";
            }
            clearTimeout(timeout);
            timeout = setTimeout(mouseStopped, 5000);
        });

        //cursor effects when mouseout
        document.addEventListener("mouseout", () => {
            cursor.style.display = "none";
        });
    </script>


    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- swipper js -->
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <!-- lightcase js-->
    <script src="{{ asset('assets/js/lightcase.js') }}"></script>
    <!-- odometer js -->
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <!-- viewport js -->
    <script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
    <!-- progress js -->
    <script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
    <!-- aos js file -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <!-- nice select js -->
    <script src="{{ asset('assets/js/jquery.nice-select.js') }}"></script>
    <!-- paroller js -->
    <script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
    <!-- flipclock js -->
    <script src="{{ asset('assets/js/flipclock.min.js') }}"></script>
    <!-- countdown js -->
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <!-- easypiechart js -->
    <script src="{{ asset('assets/js/jquery.easypiechart.js') }}"></script>
    <!-- isotope js -->
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- preloader js -->
    <script src="{{ asset('assets/js/preloader.js') }}"></script>
    <!-- main -->
    <script src="{{ asset('assets/js/main.js') }}"></script>


</body>

</html>
