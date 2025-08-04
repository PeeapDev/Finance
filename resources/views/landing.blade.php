<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acculance | POS, Inventory, Accounting Application</title>
    <meta name="description"
        content="Acculance is an all-in-one management system that enables you to manage expenses, purchases, sales, payments, accounting, loans, assets, payroll, and many more." />
    <meta name="author" content="CODESHAPER">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing-assets/images/favicon.svg') }}" />
    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('landing-assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="{{ asset('landing-assets/css/main.css') }}" />
    <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "ee891f0f-3dd8-4bcb-bb49-948a93ad1fa8";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>
    <style>
        .hero-bg-pattern {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            opacity: .2;
        }

        .macbook-container {
            position: relative;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }

        .macbook-svg {
            width: 100%;
            height: auto;
            display: block;
        }

        .video-container {
            position: absolute;
            top: 6.5%;
            left: 12.3%;
            width: 75.5%;
            height: 81.2%;
            overflow: hidden;
            border-radius: 10px;
            z-index: 1;
        }

        .video-player {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Media queries for smaller screens */
        @media (max-width: 768px) {
            .video-container {
                top: 6.7%;
                /* Adjust if necessary */
                left: 12.5%;
                /* Adjust if necessary */
                width: 75%;
                height: 80%;
            }
        }
    </style>

</head>

<body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
    </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('landing-assets/images/logo/white-logo.svg') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="#home" class="page-scroll active"
                                            aria-label="Toggle navigation">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#features" class="page-scroll"
                                            aria-label="Toggle navigation">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#pricing" class="page-scroll"
                                            aria-label="Toggle navigation">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="https://codeshaper.net/contact-us" target="_blank"
                                            aria-label="Toggle navigation">Support</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            <div class="button add-list-button">
                                <a href="https://1.envato.market/y2jezW" target="_blank" class="btn">Buy now</a>
                            </div>
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="hero-content">
                        <h1 class="wow fadeInLeft" data-wow-delay=".4s">Welcome to Acculance🎉</h1>
                        <p class="wow fadeInLeft" data-wow-delay=".6s">Acculance is a comprehensive web application
                            designed for Point of Sale (POS), Inventory management, and Accounting. Built using Laravel
                            and Vue.js, it addresses the requirements of small and medium-sized businesses and
                            organizations.</p>
                        <!-- <p>With the newly released version v4.0.0, we have undergone significant enhancements to the
                            application, rendering it even more versatile and suitable for a diverse spectrum of
                            businesses.</p> -->
                        <ul class="header-features">
                            <li class="wow fadeInLeft" data-wow-delay=".6s">
                                <a href="#">Individual client, Supplier & Account ledger.</a>
                            </li>
                            <!-- <li class="wow fadeInLeft" data-wow-delay=".7s">
                                <a href="#">Individual Supplier ledger.</a>
                            </li>
                            <li class="wow fadeInLeft" data-wow-delay=".7s">
                                <a href="#">Individual Account ledger.</a>
                            </li> -->
                            <li class="wow fadeInLeft" data-wow-delay=".7s">
                                <a href="#">Email & SMS Notification.</a>
                            </li>
                            <li class="wow fadeInLeft" data-wow-delay=".7s">
                                <a href="#">Realtime Insights & Versatile Reports.</a>
                            </li>
                            <li class="wow fadeInLeft" data-wow-delay=".9s">
                                <a href="#">Responsive, Fast, Secure and Multilingual.</a>
                            </li>
                        </ul>
                        <div class="button wow fadeInLeft" data-wow-delay="1s">
                            <a href="/login" target="_blank" class="btn">Try Demo</a>
                            <a href="http://docs.codeshaper.tech/acculance/" target="_blank" class="btn btn-alt">
                                Documentation
                            </a>
                        </div>
                        <div class="hero_review">
                            <img src="{{ asset('landing-assets/images/hero/envato_review.svg') }}" alt="" />
                            <img src="{{ asset('landing-assets/images/hero/google_review.svg') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                        <div class="macbook-container">
                            <!-- SVG MacBook Mockup -->
                            <svg class="macbook-svg" viewBox="0 0 1074 629" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path d="M99 27.8797C99 13.2002 110.641 1.29999 125 1.29999H948C962.359 1.29999 974 13.2002 974 27.8797V591.3C974 594.614 971.314 597.3 968 597.3H105C101.686 597.3 99 594.614 99 591.3V27.8797Z" fill="black" />
                                <circle cx="537" cy="23.3" r="2.9" fill="#0F0F0F" stroke="#151515" stroke-width="0.2" />
                                <circle cx="536.7" cy="24" r="0.7" fill="#16181E" />
                                <circle cx="536.7" cy="23" r="0.7" fill="#0A0B0D" />
                                <circle opacity="0.6" cx="537" cy="23.3" r="1" fill="#1F2531" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M97.7002 27.8798C97.7002 12.5094 109.896 0 125 0H948C963.104 0 975.3 12.5094 975.3 27.8798V591.3C975.3 595.332 972.032 598.6 968 598.6H105C100.969 598.6 97.7002 595.332 97.7002 591.3V27.8798ZM125 2.6C111.386 2.6 100.3 13.891 100.3 27.8798V591.3C100.3 593.896 102.404 596 105 596H968C970.596 596 972.7 593.896 972.7 591.3V27.8798C972.7 13.891 961.615 2.6 948 2.6H125Z" fill="#6A6B6F" />
                                <path d="M915.993 612C926.874 612 996.004 629 968.64 629H104.36C76.9961 629 146.126 612 157.007 612H915.993Z" fill="url(#paint0_linear_101_254)" />
                                <path d="M629 602.3V596.8H445V602.3C445.833 603.467 449.5 605.8 457.5 605.8H616.5C624.5 605.8 628.167 603.467 629 602.3Z" fill="url(#paint1_linear_101_254)" />
                                <path d="M445 596.8H0V603.3H446.121C445.568 602.932 445.201 602.582 445 602.3V596.8Z" fill="url(#paint2_linear_101_254)" />
                                <path d="M629 596.8V602.3C628.799 602.582 628.432 602.932 627.88 603.3H1074V596.8H629Z" fill="url(#paint3_linear_101_254)" />
                                <path d="M445.465 602.8C446.847 604.028 450.528 605.8 457.5 605.8H616.5C623.472 605.8 627.153 604.028 628.535 602.8H1074C1064.83 609.133 1032.2 620.8 975 620.8H99C41.8 620.8 9.16669 609.133 0 602.8H445.465Z" fill="url(#paint4_linear_101_254)" />
                                <path d="M100 575.3H973V591.3C973 594.061 970.761 596.3 968 596.3H105C102.239 596.3 100 594.061 100 591.3V575.3Z" fill="#101010" />
                                <defs>
                                    <linearGradient id="paint0_linear_101_254" x1="536.5" y1="629" x2="536.5" y2="612" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#9B9EA0" stop-opacity="0" />
                                        <stop offset="1" stop-color="#1B1D1E" />
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_101_254" x1="445" y1="599.8" x2="629" y2="599.8" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#2E2F34" />
                                        <stop offset="0.116817" stop-color="#5C5D62" />
                                        <stop offset="0.253445" stop-color="#7E7F84" />
                                        <stop offset="0.505951" stop-color="#7E7F84" />
                                        <stop offset="0.734504" stop-color="#7E7F84" />
                                        <stop offset="0.908586" stop-color="#57585D" />
                                        <stop offset="1" stop-color="#303136" />
                                    </linearGradient>
                                    <linearGradient id="paint2_linear_101_254" x1="5.97538e-06" y1="600.306" x2="1074" y2="600.302" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3E3F43" />
                                        <stop offset="0.0244084" stop-color="#8A8B8F" />
                                        <stop offset="0.979558" stop-color="#8A8B8F" />
                                        <stop offset="1" stop-color="#46474B" />
                                    </linearGradient>
                                    <linearGradient id="paint3_linear_101_254" x1="5.97538e-06" y1="600.306" x2="1074" y2="600.302" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3E3F43" />
                                        <stop offset="0.0244084" stop-color="#8A8B8F" />
                                        <stop offset="0.979558" stop-color="#8A8B8F" />
                                        <stop offset="1" stop-color="#46474B" />
                                    </linearGradient>
                                    <linearGradient id="paint4_linear_101_254" x1="537" y1="603.3" x2="537" y2="631.8" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#55565A" />
                                        <stop offset="1" />
                                    </linearGradient>
                                    <clipPath id="clip0_101_254">
                                        <rect width="811" height="511" fill="white" transform="translate(132 46.3)" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <!-- Video element positioned inside the SVG -->
                            <div class="video-container">
                                <video id="player" class="video-player" playsinline controls data-poster="{{ asset('landing-assets/images/hero/Acculance.png') }}">
                                    <source src="https://products.codeshaper.tech/acculance/acculance-teaser.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>

                        <!-- <img src="{{ asset('landing-assets/images/hero/laptop.png') }}" alt="#"> -->
                        <!-- <video id="player" playsinline controls data-poster="{{ asset('landing-assets/images/hero/laptop.png') }}">
                            <source src="https://products.codeshaper.tech/acculance/acculance-teaser.mp4" type="video/mp4" />
                        </video> -->
                    </div>
                    <div class="language-used">
                        <!-- <ul>
                            <li>
                                <a href="https://www.php.net/" target="_blank">
                                    <img src="{{ asset('landing-assets/images/php.svg') }}">
                                </a>
                            </li>
                            <li>
                                <a href="https://laravel.com" target="_blank">
                                    <img src="{{ asset('landing-assets/images/laravel.svg') }}">
                                </a>
                            </li>
                            <li>
                                <a href="https://vuejs.org/" target="_blank">
                                    <img src="{{ asset('landing-assets/images/vuejs.svg') }}">
                                </a>
                            </li>
                            <li>
                                <a href="https://vuejs.org/" target="_blank">
                                    <img src="{{ asset('landing-assets/images/bootstrap.svg') }}">
                                </a>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-bg-pattern">
            <svg width="1920" height="602" viewBox="0 0 1920 602" fill="none" xmlns="http://www.w3.org/2000/svg" style="">
                <g opacity="0.4">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-534.004 661L-534.004 -99L-532.796 -99L-532.796 661H-534.004Z" fill="url(#paint0_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-494.135 661L-494.135 -99L-492.927 -99L-492.927 661H-494.135Z" fill="url(#paint1_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-454.267 661L-454.266 -99L-453.058 -99L-453.058 661H-454.267Z" fill="url(#paint2_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-414.398 661L-414.398 -99L-413.189 -99L-413.189 661H-414.398Z" fill="url(#paint3_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-374.529 661L-374.529 -99L-373.32 -99L-373.32 661H-374.529Z" fill="url(#paint4_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-334.66 661L-334.66 -99L-333.451 -99L-333.451 661H-334.66Z" fill="url(#paint5_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-294.791 661L-294.791 -99L-293.583 -99L-293.583 661H-294.791Z" fill="url(#paint6_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-254.922 661L-254.922 -99L-253.714 -99L-253.714 661H-254.922Z" fill="url(#paint7_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-215.053 661L-215.053 -99L-213.845 -99L-213.845 661H-215.053Z" fill="url(#paint8_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-175.184 661L-175.184 -99L-173.976 -99L-173.976 661H-175.184Z" fill="url(#paint9_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-135.315 661L-135.315 -99L-134.107 -99L-134.107 661H-135.315Z" fill="url(#paint10_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-95.446 661L-95.4459 -99L-94.2377 -99L-94.2378 661H-95.446Z" fill="url(#paint11_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-55.577 661L-55.577 -99L-54.3688 -99L-54.3689 661H-55.577Z" fill="url(#paint12_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M-15.7081 661V-99L-14.4999 -99V661H-15.7081Z" fill="url(#paint13_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.1609 661V-99L25.3691 -99L25.369 661H24.1609Z" fill="url(#paint14_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M64.0299 661V-99L65.238 -99V661H64.0299Z" fill="url(#paint15_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M103.899 661L103.899 -99L105.107 -99V661H103.899Z" fill="url(#paint16_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M143.768 661L143.768 -99L144.976 -99L144.976 661H143.768Z" fill="url(#paint17_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M183.637 661L183.637 -99L184.845 -99L184.845 661H183.637Z" fill="url(#paint18_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M223.505 661L223.506 -99L224.714 -99L224.714 661H223.505Z" fill="url(#paint19_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M263.374 661L263.374 -99L264.583 -99L264.583 661H263.374Z" fill="url(#paint20_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M303.243 661L303.243 -99L304.452 -99L304.451 661H303.243Z" fill="url(#paint21_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M343.112 661L343.112 -99L344.32 -99L344.32 661H343.112Z" fill="url(#paint22_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M382.981 661V-99L384.189 -99V661H382.981Z" fill="url(#paint23_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M422.85 661L422.85 -99L424.058 -99L424.058 661H422.85Z" fill="url(#paint24_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M462.719 661L462.719 -99L463.927 -99L463.927 661H462.719Z" fill="url(#paint25_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M502.588 661V-99L503.796 -99L503.796 661H502.588Z" fill="url(#paint26_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M542.457 661V-99L543.665 -99V661H542.457Z" fill="url(#paint27_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M582.326 661V-99L583.534 -99V661H582.326Z" fill="url(#paint28_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M622.195 661V-99L623.403 -99V661H622.195Z" fill="url(#paint29_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M662.064 661V-99L663.272 -99V661H662.064Z" fill="url(#paint30_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M701.932 661V-99L703.141 -99V661H701.932Z" fill="url(#paint31_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M741.802 661V-99L743.01 -99V661H741.802Z" fill="url(#paint32_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M781.67 661V-99L782.879 -99V661H781.67Z" fill="url(#paint33_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M821.539 661V-99L822.747 -99V661H821.539Z" fill="url(#paint34_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M861.408 661V-99L862.616 -99V661H861.408Z" fill="url(#paint35_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M901.277 661V-99L902.485 -99V661H901.277Z" fill="url(#paint36_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M941.146 661V-99L942.354 -99V661H941.146Z" fill="url(#paint37_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M981.015 661V-99L982.223 -99V661H981.015Z" fill="url(#paint38_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1020.88 661V-99L1022.09 -99V661H1020.88Z" fill="url(#paint39_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1060.75 661V-99L1061.96 -99V661H1060.75Z" fill="url(#paint40_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 639.287H-563V638.081H1088.54V639.287Z" fill="url(#paint41_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 599.477H-563V598.271H1088.54V599.477Z" fill="url(#paint42_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 559.667H-563V558.461H1088.54V559.667Z" fill="url(#paint43_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 519.858H-563V518.651H1088.54V519.858Z" fill="url(#paint44_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 480.048H-563V478.842H1088.54V480.048Z" fill="url(#paint45_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 440.239H-563V439.032H1088.54V440.239Z" fill="url(#paint46_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 400.429H-563V399.223H1088.54V400.429Z" fill="url(#paint47_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 360.62H-563V359.413H1088.54V360.62Z" fill="url(#paint48_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 320.81H-563V319.604H1088.54V320.81Z" fill="url(#paint49_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 281H-563V279.794H1088.54V281Z" fill="url(#paint50_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 241.19H-563V239.984H1088.54V241.19Z" fill="url(#paint51_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 201.381H-563V200.175H1088.54V201.381Z" fill="url(#paint52_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 161.571H-563V160.365H1088.54V161.571Z" fill="url(#paint53_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 121.762H-563V120.556H1088.54V121.762Z" fill="url(#paint54_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 81.9524H-563V80.746H1088.54V81.9524Z" fill="url(#paint55_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 42.1429H-563V40.9365H1088.54V42.1429Z" fill="url(#paint56_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 2.33334H-563V1.12698H1088.54V2.33334Z" fill="url(#paint57_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 -37.4762H-563V-38.6825H1088.54V-37.4762Z" fill="url(#paint58_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1088.54 -77.2863H-563V-78.4927H1088.54V-77.2863Z" fill="url(#paint59_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M861.336 661V-99L862.544 -99V661H861.336Z" fill="url(#paint60_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M901.205 661L901.205 -99L902.413 -99L902.413 661H901.205Z" fill="url(#paint61_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M941.074 661V-99L942.282 -99V661H941.074Z" fill="url(#paint62_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M980.943 661V-99L982.151 -99V661H980.943Z" fill="url(#paint63_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1020.81 661V-99L1022.02 -99L1022.02 661H1020.81Z" fill="url(#paint64_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1060.68 661V-99L1061.89 -99V661H1060.68Z" fill="url(#paint65_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1100.55 661L1100.55 -99L1101.76 -99L1101.76 661H1100.55Z" fill="url(#paint66_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1140.42 661L1140.42 -99L1141.63 -99L1141.63 661H1140.42Z" fill="url(#paint67_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1180.29 661V-99L1181.5 -99V661H1180.29Z" fill="url(#paint68_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1220.16 661V-99L1221.36 -99V661H1220.16Z" fill="url(#paint69_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1260.03 661L1260.03 -99L1261.23 -99L1261.23 661H1260.03Z" fill="url(#paint70_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1299.89 661V-99L1301.1 -99V661H1299.89Z" fill="url(#paint71_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1339.76 661V-99L1340.97 -99V661H1339.76Z" fill="url(#paint72_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1379.63 661V-99L1380.84 -99V661H1379.63Z" fill="url(#paint73_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1419.5 661V-99L1420.71 -99V661H1419.5Z" fill="url(#paint74_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1459.37 661V-99L1460.58 -99V661H1459.37Z" fill="url(#paint75_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1499.24 661V-99L1500.45 -99V661H1499.24Z" fill="url(#paint76_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1539.11 661V-99L1540.32 -99V661H1539.11Z" fill="url(#paint77_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1578.98 661L1578.98 -99L1580.19 -99V661H1578.98Z" fill="url(#paint78_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1618.85 661L1618.85 -99L1620.05 -99L1620.05 661H1618.85Z" fill="url(#paint79_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1658.71 661L1658.71 -99L1659.92 -99L1659.92 661H1658.71Z" fill="url(#paint80_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1698.58 661V-99L1699.79 -99V661H1698.58Z" fill="url(#paint81_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1738.45 661V-99L1739.66 -99V661H1738.45Z" fill="url(#paint82_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1778.32 661V-99L1779.53 -99V661H1778.32Z" fill="url(#paint83_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1818.19 661V-99L1819.4 -99V661H1818.19Z" fill="url(#paint84_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1858.06 661V-99L1859.27 -99V661H1858.06Z" fill="url(#paint85_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1897.93 661L1897.93 -99L1899.14 -99L1899.14 661H1897.93Z" fill="url(#paint86_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1937.8 661L1937.8 -99L1939.01 -99L1939.01 661H1937.8Z" fill="url(#paint87_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1977.67 661V-99L1978.87 -99V661H1977.67Z" fill="url(#paint88_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2017.54 661V-99L2018.74 -99V661H2017.54Z" fill="url(#paint89_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2057.4 661V-99L2058.61 -99V661H2057.4Z" fill="url(#paint90_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2097.27 661V-99L2098.48 -99V661H2097.27Z" fill="url(#paint91_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2137.14 661V-99L2138.35 -99V661H2137.14Z" fill="url(#paint92_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2177.01 661V-99L2178.22 -99V661H2177.01Z" fill="url(#paint93_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2216.88 661V-99L2218.09 -99V661H2216.88Z" fill="url(#paint94_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2256.75 661V-99L2257.96 -99V661H2256.75Z" fill="url(#paint95_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2296.62 661V-99L2297.83 -99V661H2296.62Z" fill="url(#paint96_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2336.49 661V-99L2337.69 -99V661H2336.49Z" fill="url(#paint97_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2376.36 661V-99L2377.56 -99V661H2376.36Z" fill="url(#paint98_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2416.22 661V-99L2417.43 -99V661H2416.22Z" fill="url(#paint99_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2456.09 661V-99L2457.3 -99V661H2456.09Z" fill="url(#paint100_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 639.287H832.34V638.081H2483.88V639.287Z" fill="url(#paint101_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 599.477H832.34V598.271H2483.88V599.477Z" fill="url(#paint102_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 559.667H832.34V558.461H2483.88V559.667Z" fill="url(#paint103_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 519.858H832.34V518.651H2483.88V519.858Z" fill="url(#paint104_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 480.048H832.34V478.842H2483.88V480.048Z" fill="url(#paint105_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 440.239H832.34V439.032H2483.88V440.239Z" fill="url(#paint106_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 400.429H832.34V399.223H2483.88V400.429Z" fill="url(#paint107_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 360.62H832.34V359.413H2483.88V360.62Z" fill="url(#paint108_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 320.81H832.34V319.604H2483.88V320.81Z" fill="url(#paint109_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 281H832.34V279.794H2483.88V281Z" fill="url(#paint110_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 241.19H832.34V239.984H2483.88V241.19Z" fill="url(#paint111_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 201.381H832.34V200.175H2483.88V201.381Z" fill="url(#paint112_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 161.571H832.34V160.365H2483.88V161.571Z" fill="url(#paint113_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 121.762H832.34V120.556H2483.88V121.762Z" fill="url(#paint114_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 81.9524H832.34V80.746H2483.88V81.9524Z" fill="url(#paint115_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 42.1429H832.34V40.9365H2483.88V42.1429Z" fill="url(#paint116_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 2.33334H832.34V1.12698H2483.88V2.33334Z" fill="url(#paint117_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 -37.4762H832.34V-38.6825H2483.88V-37.4762Z" fill="url(#paint118_linear_174_5412)"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2483.88 -77.2863H832.34V-78.4927H2483.88V-77.2863Z" fill="url(#paint119_linear_174_5412)"></path>
                </g>
                <defs>
                    <linearGradient id="paint0_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint1_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint2_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint3_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint4_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint5_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint6_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint7_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint8_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint9_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint10_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint11_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint12_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint13_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint14_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint15_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint16_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint17_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint18_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint19_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint20_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint21_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint22_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint23_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint24_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint25_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint26_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint27_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint28_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint29_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint30_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint31_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint32_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint33_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint34_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint35_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint36_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint37_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint38_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint39_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint40_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint41_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint42_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint43_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint44_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint45_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint46_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint47_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint48_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint49_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint50_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint51_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint52_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint53_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint54_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint55_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint56_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint57_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint58_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint59_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint60_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint61_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint62_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint63_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint64_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint65_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint66_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint67_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint68_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint69_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint70_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint71_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint72_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint73_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint74_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint75_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint76_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint77_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint78_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint79_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint80_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint81_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint82_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint83_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint84_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint85_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint86_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint87_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint88_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint89_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint90_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint91_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint92_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint93_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint94_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint95_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint96_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint97_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint98_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint99_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint100_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint101_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint102_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint103_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint104_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint105_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint106_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint107_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint108_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint109_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint110_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint111_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint112_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint113_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint114_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint115_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint116_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint117_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint118_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                    <linearGradient id="paint119_linear_174_5412" x1="960.44" y1="203.452" x2="960.44" y2="609.02" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#E5EAF0" stop-opacity="0"></stop>
                        <stop offset="1" stop-color="#E5EAF0"></stop>
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Features Area -->
    <section id="features" class="features section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Main Features</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Unlock the Power of Seamless Business Management
                            with Acculance
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <i class="lni lni-calculator"></i>
                        <h3>Expense Management</h3>
                        <p>The Expense module empowers efficient company expense management. Categorize and
                            subcategorize all expenses, ensuring meticulous accounting for every expenditure.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <i class="lni lni-shopping-basket"></i>
                        <h3>Purchase Management</h3>
                        <p>The Purchase module facilitates product procurement and returns. Creating purchases boosts
                            product stock, while deleting or returning purchases reduces stock levels.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <i class="lni lni-cart"></i>
                        <h3>Sales Management</h3>
                        <p>The Sales module streamlines sales quotations, product transactions, and returns. Creating
                            sales reduces stock quantities, and deleting sales increases them.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-book"></i>
                        <h3>Accounting Management</h3>
                        <p>The Accounting module oversees transactions and accounts, with each transaction linked to
                            cash or bank accounts. Credit transactions bolster balances, while debit transactions
                            diminish them.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <i class="lni lni-customer"></i>
                        <h3>Loan Management</h3>
                        <p>The Loan module simplifies loan administration, including authorities, loans, and payments.
                            Acculance accommodates both CC loans and term loans, with funds seamlessly integrated into
                            accounts.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <i class="lni lni-hammer"></i>
                        <h3>Asset Management</h3>
                        <p>The Asset module effectively administers company assets and their depreciation, employing a
                            straight-line depreciation method. Asset creation options include assets without
                            depreciation.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-wallet"></i>
                        <h3>Payroll Management</h3>
                        <p>The Payroll module streamlines monthly salary management. Generate employee salaries,
                            ensuring meticulous accounting, and integration with accounts. It also generate the payslip.
                        </p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-restaurant"></i>
                        <h3>Inventory Management</h3>
                        <p>The Inventory module provides precise control over product stocks, enabling stock
                            adjustments. It also offers insights into average purchase prices
                            and comprehensive inventory history.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-bar-chart"></i>
                        <h3>Versatile Reports</h3>
                        <p>Acculance offers a range of critical reports for tracking business performance. Easily access
                            balance sheets, summary reports, profit/loss statements, expense, & inventory
                            insights.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Achievement Area -->
    <section class="our-achievement section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                    <div class="title">
                        <h2>More Awesome Features</h2>
                        <p>Acculance comes equipped with a plethora of valuable features, some of which are highlighted
                            below.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".2s">
                                <i class="lni lni-users"></i>
                                <p>Customer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-user"></i>
                                <p>Supplier</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".6s">
                                <i class="lni lni-unlock"></i>
                                <p>Role-based Permissions</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".8s">
                                <i class="lni lni-book"></i>
                                <p>Non-invoice Transactions</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".2s">
                                <i class="lni lni-book"></i>
                                <p>Non-purchase Transactions</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-dropbox"></i>
                                <p>Inventory Adjustment</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".6s">
                                <i class="lni lni-codepen"></i>
                                <p>Barcode Generator</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".8s">
                                <i class="lni lni-cloud-download"></i>
                                <p>PDF Export</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".2s">
                                <i class="lni lni-keyword-research"></i>
                                <p>Dynamic Search</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".4s">
                                <i class="lni lni-angellist"></i>
                                <p>Multilingual Support</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".6s">
                                <i class="lni lni-database"></i>
                                <p>Database Backup</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="single-mfeature wow fadeInUp" data-wow-delay=".8s">
                                <i class="lni lni-power-switch"></i>
                                <p>Dark mode & Style customizer</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Achievement Area -->

    <!-- Start Pricing Table Area -->
    <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">pricing</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Pricing Plan</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">We are offering two types of license for our
                            software such as Regular license and Extended license</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".2s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Regular License</h4>
                            <p>All the basics for your business. Permitted for one domain for personal use only.</p>
                            <div class="price">
                                <h2 class="amount">$39 <del>$49</del></h2>
                            </div>
                            <div class="button">
                                <a target="_blank" href="https://1.envato.market/ZQYj6R"
                                    class="btn">Buy Regular License</a>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">What's Included</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Quality checked by Envato.</li>
                                <li><i class="lni lni-checkmark-circle"></i> Life time update.</li>
                                <li><i class="lni lni-checkmark-circle"></i> 6 Month support <a
                                        href="https://codecanyon.net/page/item_support_policy?_ga=2.184920874.260634607.1652244325-1968967188.1652244325"
                                        traget="__blank">(Please check here what included in support)</a></li>
                                <li><i class="lni lni-checkmark-circle"></i> For one domain for personal use only.</li>
                                <li><i class="lni lni-checkmark-circle"></i> For Personal Project only.</li>
                                <li><i class="lni lni-checkmark-circle"></i> Support (2 Business day).</li>
                                <li>
                                    <i class="lni lni-cross-circle"></i>
                                    Full Source Code.
                                </li>
                                <li><i class="lni lni-cross-circle" style="color: red;"></i> Skype Support</li>
                                <li><i class="lni lni-cross-circle" style="color: red;"></i> Anydesk/Teamviewer
                                    Support</li>
                                <li><i class="lni lni-cross-circle" style="color: red;"></i> Free installation</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".4s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Extended License</h4>
                            <p>All the basics for your business. Permitted for multiple domains for commercial use only.
                            </p>
                            <div class="price">
                                <h2 class="amount">$199 <del>$499</del></h2>
                            </div>
                            <div class="button">
                                <a target="_blank" href="https://1.envato.market/21V0aD"
                                    class="btn">Buy Extended License</a>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">What's Included</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> Quality checked by Envato.</li>
                                <li><i class="lni lni-checkmark-circle"></i> Life time update.</li>
                                <li><i class="lni lni-checkmark-circle"></i> 6 Month support <a
                                        href="https://codecanyon.net/page/item_support_policy?_ga=2.184920874.260634607.1652244325-1968967188.1652244325"
                                        traget="__blank">(Please check here what included in support)</a></li>
                                <li><i class="lni lni-checkmark-circle"></i> For multiple domains for commercial uses.
                                </li>
                                <li><i class="lni lni-checkmark-circle"></i> For Personal & Commercial Project.</li>
                                <li><i class="lni lni-checkmark-circle"></i> Support (1 Business day).</li>
                                <li>
                                    <i class="lni lni-cross-circle"></i>
                                    Full Source Code
                                </li>
                                <li><i class="lni lni-checkmark-circle"></i> Skype Support</li>
                                <li><i class="lni lni-checkmark-circle"></i> Anydesk/Teamviewer Support</li>
                                <li><i class="lni lni-checkmark-circle"></i> Free Installation</li>
                                <li><i class="lni lni-checkmark-circle"></i> 4 Hours Free Customization Work</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".6s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">For any custom work</h4>
                            <p>We will be happy if we can assist you with any of your custom work. We love hearing from
                                you! Feel free to leave us a message. Use the contact form to get in touch with us.
                                We'll reply back within the next 24 hour.</p>
                            <div class="button mt-5">
                                <a href="https://codeshaper.net/contact-us" target="_blank" class="btn">Contact
                                    Us</a>
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">WE WOULD LOVE TO ASSIST YOU VIA</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> UI & UX Design</li>
                                <li><i class="lni lni-checkmark-circle"></i> Ecommerce Solutions</li>
                                <li><i class="lni lni-checkmark-circle"></i> Web Development</li>
                                <li><i class="lni lni-checkmark-circle"></i> WordPress Development</li>
                                <li><i class="lni lni-checkmark-circle"></i> Mobile Apps Development</li>
                                <li><i class="lni lni-checkmark-circle"></i> Digital Marketing</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->

    <!-- Start Call To Action Area -->
    <section class="section call-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="cta-content">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">View live demo to explore all the amazing
                            features of Acculance
                        </h2>
                        <div class="button wow fadeInUp" data-wow-delay=".6s">
                            <a href="/login" class="btn">View Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call To Action Area -->

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center col-12">
                        <!-- Single Widget -->
                        <div class="single-footer f-about">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ asset('landing-assets/images/logo/white-logo.svg') }}"
                                        alt="#">
                                </a>
                            </div>
                            <p>Ultimate Sales, Inventory, Accounting Management System</p>
                            <ul class="social">
                                <li><a href="https://codeshaper.net" target="_blank"><i
                                            class="lni lni-website"></i></a></li>
                                <li><a href="https://www.facebook.com/Codeshaperbd" target="_blank"><i
                                            class="lni lni-facebook-filled"></i></a></li>
                                <li><a href="https://twitter.com/codeshaperbd" target="_blank"><i
                                            class="lni lni-twitter-original"></i></a></li>
                                <li><a href="https://www.instagram.com/codeshaper_int/" target="_blank"><i
                                            class="lni lni-instagram"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/code-shaper-7b8a0513b" target="_blank"><i
                                            class="lni lni-linkedin-original"></i></a></li>
                                <li><a href="https://www.pinterest.com/codeshaperbd/" target="_blank"><i
                                            class="lni lni-pinterest"></i></a></li>
                            </ul>
                            <p class="copyright-text">&copy; {{ date('Y')}} <a href="https://codeshaper.net/"
                                    rel="nofollow" target="_blank">Codeshaper</a>. All Rights Reserved.
                            </p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="{{ asset('landing-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('landing-assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/count-up.min.js') }}"></script>
    <script src="{{ asset('landing-assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script type="text/javascript">
        const player = new Plyr('#player');
        //====== counter up
        var cu = new counterUp({
            start: 0,
            duration: 2000,
            intvalues: true,
            interval: 100,
            append: " ",
        });
        cu.start();

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>