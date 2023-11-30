<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="visibility: hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>Tai Loc Hostel - @yield('title')</title>
    <meta name="theme-color" content="#062639">
    <meta name="author" content="Tai Loc Hostel">
    <meta name="description" content="Tai Loc Hostel" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-title" content="Tai Loc Hostel">
    <meta name="application-name" content="Tai Loc Hostel">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/logo.png') }}">
    {{-- <link rel="manifest" crossorigin="use-credentials" href="/manifest.json"> --}}
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/style.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg shadow fixed-top rounded-bottom">
            <div class="container-fluid">
                <a class="navbar-brand me-0 me-lg-3 fw-bold" href="/"><span class="d-flex align-items-center"><img
                            src="/assets/img/logo.png" width="40px" height="auto"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'admin' ? 'active' : '' }}"
                                    href="/admin">Dashboard</a>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() === 'viewRoom' ? 'active' : '' }}"
                                href="/rooms/available">Rooms</a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Manage
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ Request::path() == 'admin/manage/rooms' ? 'active' : '' }}"
                                            href="/admin/manage/rooms">Room</a></li>
                                </ul>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() === 'searchRoom' ? 'active' : '' }}"
                                    href="/rooms/search">Search room</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'rooms/status/pending' ? 'active' : '' }}"
                                    href="/rooms/status/pending">Pending
                                    rooms <span class="badge bg-danger">{{ $countPending }}</span></a>
                            </li>
                        @endauth
                    </ul>
                    {{-- <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <form class="d-none d-lg-block rounded-2" role="search" action="/search">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Search room"
                                    aria-label="Search" name="keyword">
                                <button class="btn btn-success" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </ul> --}}
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                        {{-- @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() == 'login' ? 'active' : '' }}" href="/login"><i
                                        class="fa-solid fa-right-to-bracket me-2"></i>Log in</a>
                            </li>
                        @endguest --}}
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"><span class="me-2"><img
                                            data-src="/assets/img/avatar/{{ Auth::user()->avatar }}"
                                            class="me-2 lazyload rounded-circle" width="32" height="auto"
                                            alt="Avatar">{{ Auth::user()->fullname }}</span></a>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item {{ Request::path() == 'user/view' ? 'active' : '' }}"
                                            href="/user/view"><i class="fa-solid fa-user me-2"></i>View profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="/logout" no-data-pjax="true"><i
                                                class="fa-solid fa-right-from-bracket me-2"></i>Log out</a>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                        {{-- <li class="nav-item dropdown me-0 me-lg-2">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                @if (app()->getLocale() == 'vi')
                                <img src="/assets/img/vn.svg" style="width: auto;height:1.25rem;">
                                @else
                                <img src="/assets/img/us.svg" style="width: auto;height:1.25rem;">
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                <li><a class="dropdown-item" href="/lang/vi">
                                        @if (app()->getLocale() == 'vi')
                                        <span class="fw-bold d-flex align-items-center"><img class="me-2"
                                                src="/assets/img/vn.svg" style="width: auto;height:1.25rem;">VN<i
                                                class="fa-solid fa-check ms-2 text-success"></i></span>
                                        @else
                                        <span class="d-flex align-items-center"><img class="me-2"
                                                src="/assets/img/vn.svg" style="width: auto;height:1.25rem;">VN</span>
                                        @endif
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/lang/en">
                                        @if (app()->getLocale() == 'en')
                                        <span class="fw-bold d-flex align-items-center"><img class="me-2"
                                                src="/assets/img/us.svg" style="width: auto;height:1.25rem;">EN<i
                                                class="fa-solid fa-check ms-2 text-success"></i></span>
                                        @else
                                        <span class="d-flex align-items-center"><img class="me-2"
                                                src="/assets/img/us.svg" style="width: auto;height:1.25rem;">EN</span>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid mt-2">
            {{-- <form class="d-flex d-lg-none mb-3" role="search" action="/search">
                <div class="input-group border border-dark rounded-2">
                    <input class="form-control" type="search" placeholder="Search"
                        aria-label="Search room" name="keyword">
                    <button class="btn btn-success" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form> --}}
            {{-- <div class="dropup">
                <button class="animated-btn shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa-solid fa-comment"></i></button>
                <ul class="dropdown-menu dropdown-menu-lg-end" id="floatingBtnShow">
                    <li><a href="https://www.messenger.com/t/100049253115031" target="_blank"
                            class="dropdown-item p-2 d-flex align-items-center"><img class="me-2"
                                src="/assets/img/messenger.svg" width="56px" height="auto">Messenger</a></li>
                    <li><a href="https://zalo.me/0886623971" target="_blank"
                            class="dropdown-item p-2 d-flex align-items-center"><img class="me-2"
                                src="/assets/img/zalo.svg" width="56px" height="auto">Zalo</a></li>
                </ul>
            </div> --}}
            @yield('content')
        </div>
    </main>
    <footer class="py-4 text-light mt-3 rounded-top">
        <div class="container mb-3">
            @guest
                <div class="row row-cols-1 row-cols-lg-3 g-3">
                @endguest
                @auth
                    <div class="row row-cols-1 row-cols-lg-4 g-3">
                    @endauth
                    <div class="col text-center text-lg-start">
                        <img class="mb-2" src="/assets/img/logo.png" width="40px" height="auto">
                        <h5 class="fw-bold mb-2" style="color:rgba(248, 177, 21, 1);">Tai Loc Hostel</h5>
                        <p class="mb-0"><b>Tai Loc Hostel</b> is a hostel for <b>students</b> with
                            <b>good price</b>.
                        </p>
                    </div>
                    <div class="col text-center text-lg-start">
                        <h5 class="fw-bold" style="color:rgba(248, 177, 21, 1);">Quick links</h5>
                        <div class="mb-2"><a href="/">Home</a></div>
                        @auth
                            <div class="mb-2"><a href="/rooms/all">All rooms</a></div>
                        @endauth
                        <div class="mb-2"><a href="/rooms/available">Available rooms</a></div>
                        @guest
                            <div class="mb-2"><a href="/rooms/search">Search room</a></div>
                        @endguest
                        @auth
                            <div><a href="/rooms/rented">Rented rooms</a></div>
                        @endauth
                    </div>
                    @auth
                        <div class="col text-center text-lg-start">
                            <h5 class="fw-bold" style="color:rgba(248, 177, 21, 1);">Manage</h5>
                            <div class="mb-2"><a href="/admin/manage/rooms">Manage rooms</a></div>
                            <div><a href="/rooms/status/pending">Pending rooms</a></div>
                        </div>
                    @endauth
                    @auth
                        <div class="col text-center text-lg-start">
                            <h5 class="fw-bold" style="color:rgba(248, 177, 21, 1);">Account</h5>
                            <div>
                                <a href="/user/view">View profile</a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="container">
                <div class="text-center">
                    <span>
                        <i class="fa-regular fa-copyright"></i> 2023
                        <b>Tai Loc Hostel</b>.
                        All rights reserved.
                    </span>
                </div>
            </div>
            {{-- <div class="container">
                <div class="text-center">
                    <a href=""><i class="fa-solid fa-sitemap me-2"></i>Sitemap</a>
                    <span>|</span>
                    <a href=""><i class="fa-solid fa-scale-balanced me-2"></i>License</a>
                </div>
            </div> --}}
    </footer>
    <button class="shadow-lg position-fixed bottom-0 end-0 btn btn-primary rounded-3 me-3 mb-3" id="topBtn"><i
            class="fa-solid fa-chevron-up"></i></button>
    <script src="{{ mix('assets/js/app.js') }}" data-pagespeed-no-defer></script>
    <script src="{{ mix('assets/js/script.js') }}" data-pagespeed-no-defer></script>
    @yield('js')
    {{-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js');
        }
    </script> --}}
</body>

</html>
