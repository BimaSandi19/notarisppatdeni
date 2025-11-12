<!-- *** Header Start *** -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- Styles CSS -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.0.0/iconify.min.js"></script>
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>{{ request()->is('/') ? 'Home' : '' }} {{ request()->is('service') ? 'Service' : '' }}
        {{ request()->is('about') ? 'About Us' : '' }} {{ request()->is('gallery') ? 'Gallery' : '' }} | Kantor Deni
        Nugraha
    </title>
    <link rel="icon" href="{{ asset('images/icon/garuda.png') }}" type="image/png" />
</head>

<body>
    <div id="preloader"></div>
    <header class="vheader bg-white d-none d-md-block">
        <div class="container container-md-fluid d-flex flex-warp justify-content-between align-items-center">
            <ul class="nav me-auto">
                <li class="nav-item me-2">
                    <a href="https://maps.app.goo.gl/nDrmehsvRPEkhcZi7"
                        class="nav-link link-dark px-2 border-start border-end" aria-current="page"><span
                            class="iconify mx-1" data-icon="mdi:location" data-inline="true"></span>
                        Tangerang, Jalan Mutiara Raya 15810</a>
                </li>
                <li class="nav-item me-2">
                    <a href="#sendMail" class="nav-link link-dark px-2 border-end" aria-current="page"><span
                            class="iconify mx-2" data-icon="iconamoon:email-light" data-inline="true"></span>
                        Email : infonotdeninugraha@gmail.com</a>
                </li>
            </ul>
        </div>
    </header>
    <!-- *** Header End *** -->

    <!-- *** Navbar Start *** -->
    <div class="container-fluid bg-white shadow sticky-top">
        <!-- Main Navbar -->
        <div class="container-xxl bg-white">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-3 col-sm-8 col-md-6 d-flex align-items-center">
                        <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand">
                            <img src="{{ asset('images/icon/NavIcon.png') }}" alt="" class="img-fluid" />
                        </a>
                    </div>
                    <div class="col-lg-9 col-sm-6">
                        <div class="collapse navbar-collapse" id="navbarScroll">
                            <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll"
                                style="--bs-scroll-height: 100px">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('landing.index') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('service') ? 'active' : '' }}"
                                        aria-current="page" href="{{ route('landing.service') }}">Service</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" aria-current="page"
                                        href="{{ route('landing.about') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}"
                                        aria-current="page" href="{{ route('landing.gallery') }}">Gallery</a>
                                </li>
                                <li>
                                    <a class="nav-link" aria-current="page" href="{{ route('login') }}">
                                        <span class="iconify" data-icon="ri:admin-line" data-inline="true"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- /Main Navbar -->
    </div>
    <!-- *** Navbar End *** -->