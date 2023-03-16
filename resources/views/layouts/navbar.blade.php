@php
if (Auth::check() && Auth::user()->role == 'MANAJER') {
    $reservation_url = '/manager-reservation';
} else {
    $reservation_url = '/reservation';
}
@endphp

<header>
    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/samanko.png') }}" alt="Logo" style="margin-left: 30px; width: 100px; height: 80px; ">
        </a>
        <ul class="navbar-nav">
            <li><a class="{{ request()->is('/') ? 'active' : ''}}" href="/">HOME </a></li>
            <li><a class="{{ request()->is('coffee') ? 'active' : ''}}" href="/coffee">COFFEE</a></li>
            <li><a class="{{ request()->is('bakery') ? 'active' : ''}}" href="/bakery">BAKERY</a></li>
            <li><a class="{{ request()->is('menu') ? 'active' : ''}}" href="/menu">OUR MENU</a></li>
            <li><a class="{{ request()->is($reservation_url) ? 'active' : ''}}" href="{{ $reservation_url }}">RESERVATION</a></li>
            <li><a class="{{ request()->is('about-us') ? 'active' : ''}}" href="/about-us">ABOUT US</a></li>
            @guest
            <li><a class="login-button" href="/login">LOGIN</a></li>
            @endguest

            @auth
            @if (Auth::user()->role == 'MANAJER')
                <script>window.location.href = '/manager-reservation';</script>
            @else
                <li><a class="{{ request()->is($reservation_url) ? 'active' : ''}}" href="{{ $reservation_url }}">RESERVATION</a></li>
            @endif
                <li class="nav-item dropdown" style="margin-right: 20px">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="fa fa-user form-control-icon" style="color: white"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile" style="color: black; font-weight:bold; font-size: 17px">
                            {{ __('PROFILE') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" style="color: black; font-weight:bold;  font-size: 17px">
                            {{ __('LOGOUT') }}
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
