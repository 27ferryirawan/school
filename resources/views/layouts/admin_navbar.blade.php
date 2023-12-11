@php
    if ((Auth::check() && Auth::user()->role == 'ADMIN') || !Auth::check()) {
        $siswa_url = '/admin-kelas/list/1';
        $guru_url = '/admin-mata-pelajaran/list/2/0';
        $nilai_url = '/admin-kelas/list/3';
    } elseif (Auth::check() && (Auth::user()->role == 'GURU' || Auth::user()->role == 'SISWA')) {
        $siswa_url = '/';
        $guru_url = '/';
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
            <li><a class="{{ request()->is($siswa_url) ? 'active' : '' }}" href="{{ $siswa_url }}">SISWA</a>
            </li>
            <li><a class="{{ request()->is($guru_url) ? 'active' : '' }}" href="{{ $guru_url }}">GURU</a></li>
            <li><a class="{{ request()->is($nilai_url) ? 'active' : '' }}" href="{{ $nilai_url }}">NILAI</a>
            </li>
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
