<nav class="navbar">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/samanko.png') }}" alt="Logo" style="margin: 0px 0px 0px 30px; width: 110px; height: 90px;">
    </a>
    <ul class="navbar-nav">
        <li><a href="#">HOME</a></li>
        <li><a href="#">COFFEE</a></li>
        <li><a href="#">BAKERY </a></li>
        <li><a href="#">OUR MENU</a></li>
        <li><a href="#">RESERVATION</a></li>
        <li><a href="#">ABOUT US</a></li>
        <li><a class="login-button" href="#">Login</a></li>
    </ul>
</nav>

<style>
    .navbar {
        background-color: #392A23;
        display: flex;
        align-items: center;
        height: 110px;
        font-family: 'SourceSansPro';
    }
    .navbar-nav {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-left: auto;
    }
    .navbar li {
        float: left;
    }
    .navbar li a {
        display: block;
        color: white;
        text-align: center;
        padding: 16px;
        text-decoration: none;
    }
    .navbar li a:hover {
        background-color: #614d43;
    }
    .login-button {
        background-color: white;
        color: #392A23 !important;
        margin-left: 20px;
        margin-right: 20px;
        text-align: center;
        font-size: 15px;
        height: 0.5px;
        line-height: 0.5px; /* Should match the height value */
        font-weight: bold;
    }

    .login-button:hover {
        background-color: #614d43 !important;
        color: white !important;
    }

    @font-face {
        font-family: 'SourceSansPro';
        src: url('/font/Source_Sans_Pro/SourceSansPro-Regular.woff') format('woff');
    }

</style>
