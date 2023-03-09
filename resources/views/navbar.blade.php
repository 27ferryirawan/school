<nav class="navbar">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/samanko.jpeg') }}" alt="Logo" style="margin-left: 30px; width: 160px; height: 110px;">
    </a>
    <ul class="navbar-nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">Coffee Menu</a></li>
        <li><a href="#">Bakery Menu</a></li>
        <li><a href="#">Our Menu</a></li>
        <li><a href="#">Reservation</a></li>
        <li><a href="#">About Us</a></li>
        <li><a class="login-button" href="#">Login</a></li>
    </ul>
</nav>

<style>
    .navbar {
        background-color: #392b23;
        display: flex;
        align-items: center;
        height: 110px;
    }
    .navbar-brand {
        margin-right: auto;
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
        color: #392b23 !important;
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

</style>
