<header>
    <nav class="navbar">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/samanko.png') }}" alt="Logo" style="margin-left: 30px; width: 110px; height: 90px;">
        </a>
        <ul class="navbar-nav">
            <li><a class="{{ request()->is('/') ? 'active' : ''}}" href="/">HOME</a></li>
            <li><a class="{{ request()->is('/coffee') ? 'active' : ''}}" href="/coffee">COFFEE</a></li>
            <li><a class="{{ request()->is('/bakery') ? 'active' : ''}}" href="/bakery">BAKERY</a></li>
            <li><a class="{{ request()->is('/menu') ? 'active' : ''}}" href="/menu">OUR MENU</a></li>
            <li><a class="{{ request()->is('/reservation') ? 'active' : ''}}" href="/reservation">RESERVATION</a></li>
            <li><a class="{{ request()->is('/about-us') ? 'active' : ''}}" href="/about-us">ABOUT US</a></li>
            @guest
            <li><a class="login-button" href="/login">Login</a></li>
            @endguest

            @auth
                <li>
                    <a class="login-button" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
</header>
@include('layouts/styles')
