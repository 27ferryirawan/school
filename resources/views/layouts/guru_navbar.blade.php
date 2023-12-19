@php
    if ((Auth::check() && Auth::user()->role == 'GURU') || !Auth::check()) {
        $pembelajaran_url = '/guru-pembelajaran';
        $ujian_url = '/guru-ujian';
        $nilai_url = '/admin-kelas/list/3';
    } elseif (Auth::check() && (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'SISWA')) {
        $pembelajaran_url = '/';
        $ujian_url = '/';
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
        <ul class="navbar-nav">
            <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">BERANDA </a></li>
            {{-- <li><a class="{{ request()->is('admin-siswa') ? 'active' : '' }}" href="/admin-siswa">SISWA</a></li> --}}
            <li><a class="{{ request()->is($pembelajaran_url) ? 'active' : '' }}"
                    href="{{ $pembelajaran_url }}">PEMBELEJARAN</a>
            </li>
            <li><a class="{{ request()->is('admin-nilai') ? 'active' : '' }}" href="/admin-kelas/list/3">SISWA</a>
            </li>
            <li><a class="{{ request()->is('tentang-kita') ? 'active' : '' }}" href="/tentang-kita">NILAI</a>
            </li>
            @guest
                <li><a class="login-button {{ request()->is('login') ? 'active' : '' }}" href="/login">LOGIN</a></li>
            @endguest

            @auth
                @if (
                    (Auth::user()->role == 'MANAJER' || (Auth::check() && Auth::user()->role == 'KASIR')) &&
                        request()->is('reservation'))
                    <script>
                        window.location.href = '/manager-reservation';
                    </script>
                @endif
                <li class="nav-item dropdown" style="margin-right: 20px">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-user form-control-icon" style="color: white"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile" style="color: black; font-weight:bold; font-size: 17px">
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
</header>
@include('layouts/styles')

<script>
    var title = document.title;
    var link = document.querySelector("link[rel~='icon']");

    // window.addEventListener("blur", () => {
    //     document.title = "SAMANKO KUY";
    //     link.href = "{{ asset('images/angry_favicon.png') }}";
    //     // document.head.appendChild(link);
    // });

    window.addEventListener("focus", () => {
        document.title = title;
        link.href = "{{ asset('images/coffee_favicon.png') }}";
    });
</script>
