@php
    if ((Auth::check() && Auth::user()->role == 'GURU') || !Auth::check()) {
        $pembelajaran_url = '/guru-pembelajaran';
        $nilai_url = '/admin-kelas/list/3';
    } elseif (Auth::check() && (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'SISWA')) {
        $pembelajaran_url = '/';
        $nilai_url = '/';
    }
@endphp

<head>
    <link rel="icon" type="image/png" href="{{ asset('images/coffee_favicon.png') }}">
</head>
<header>
    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/navbar-logo.png') }}" alt="Logo"
                style="margin-left: 30px; width: 100px; height: 80px; ">
        </a>
        <button class="hamburger-btn" onclick="toggleMenu()">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="navbar-nav">
            <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">BERANDA</a></li>
            <li><a class="{{ Request::is('guru-pembelajaran*') ? 'active' : '' }}"
                    href="{{ $pembelajaran_url }}">PEMBELEJARAN</a></li>
            <li><a class="{{ request()->is('guru-siswa') ? 'active' : '' }}" href="/guru-siswa">SISWA</a></li>
            <li><a class="{{ request()->is('tentang-kita') ? 'active' : '' }}" href="/tentang-kita">TENTANG KITA</a>
            </li>
            @guest
                <li><a class="login-button {{ request()->is('login') ? 'active' : '' }}" href="/login">LOGIN</a></li>
            @endguest
            @auth
                <li class="nav-item dropdown" style="margin-right: 20px">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-user form-control-icon" style="color: white"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/guru_profile"
                            style="color: black; font-weight:bold; font-size: 17px">
                            {{ __('PROFIL') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                            style="color: black; font-weight:bold;  font-size: 17px">
                            {{ __('KELUAR') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endauth
        </ul>
    </nav>

    <ul class="navbar-nav1">
        <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">BERANDA</a></li>
        <li><a class="{{ request()->is('guru-pembelajaran') ? 'active' : '' }}"
                href="{{ $pembelajaran_url }}">PEMBELEJARAN</a></li>
        <li><a class="{{ request()->is('guru-siswa') ? 'active' : '' }}" href="/guru-siswa">SISWA</a></li>
        <li><a class="{{ request()->is('tentang-kita') ? 'active' : '' }}" href="/tentang-kita">TENTANG KITA</a>
        </li>
        @guest
            <li><a class="login-button {{ request()->is('login') ? 'active' : '' }}" href="/login">LOGIN</a></li>
        @endguest
        @auth
            <li class="nav-item dropdown" style="margin-right: 20px">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fa fa-user form-control-icon" style="color: white"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/guru_profile" style="color: black; font-weight:bold; font-size: 17px">
                        {{ __('PROFIL') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                        style="color: black; font-weight:bold;  font-size: 17px">
                        {{ __('KELUAR') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endauth
    </ul>
</header>

@include('layouts/styles')

<script>
    var title = document.title;
    var link = document.querySelector("link[rel~='icon']");


    window.addEventListener("focus", () => {
        document.title = title;
        link.href = "{{ asset('images/coffee_favicon.png') }}";
    });

    function toggleMenu() {
        var navbarNav = document.querySelector('.navbar-nav1');
        navbarNav.classList.toggle('show');
    }
</script>
<style>
    .hamburger-btn {
        display: none;
        cursor: pointer;
        background: none;
        border: none;
        padding: 10px;
    }

    .navbar-nav1 {
        display: none;
        font-family: 'SourceSansPro';
        font-weight: bold;
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: auto;
        font-size: 17px;
    }

    .navbar-nav1 li a {
        display: block;
        color: white;
        text-align: center;
        padding: 22px;
        text-decoration: none;
    }

    .navbar-nav1 li a:hover {
        background-color: #4e87b9;
    }

    .navbar-nav1 li a.active {
        background-color: #4e87b9;
    }

    .navbar-nav1 li a.login-button.active {
        background-color: #4e87b9;
        color: white !important;
    }

    @media screen and (min-width: 701px) {
        .navbar-nav1 {
            display: none;
        }
    }

    @media screen and (max-width: 700px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
            justify-content: center;
        }

        .navbar-nav {
            display: none;
            width: 100%;
            text-align: left;
        }

        .navbar-nav1 {
            display: none;
            flex-direction: column;
            background-color: #03549b;
            justify-content: center;
            align-items: center;
        }

        .navbar-nav1.show {
            display: flex;
            flex-direction: column;
            background-color: #03549b;
            justify-content: center;
            align-items: center;
        }

        .navbar-nav1 li {
            width: 100%;
            float: none;
        }

        .navbar-nav1 li a {
            padding: 10px;
            text-align: center;
        }

        .hamburger-btn {
            margin-left: auto;
            display: block;
            cursor: pointer;
            background: none;
            border: none;
            padding: 10px;
        }

        .bar {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #333;
            margin: 5px 0;
        }
    }
</style>
