<nav class="navbar">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/samanko.png') }}" alt="Logo" style="margin: 0px 0px 0px 30px; width: 110px; height: 90px;">
    </a>
    <ul class="navbar-nav">
        <li><a href="{{ route('home') }}">HOME</a></li>
        <li><a href="#">COFFEE</a></li>
        <li><a href="#">BAKERY </a></li>
        <li><a href="#">OUR MENU</a></li>
        <li><a href="{{ route('reservation') }}">RESERVATION</a></li>
        <li><a href="#">ABOUT US</a></li>
        <li><a class="login-button" href="#">Login</a></li>
    </ul>
</nav>
@include('layouts/styles')
