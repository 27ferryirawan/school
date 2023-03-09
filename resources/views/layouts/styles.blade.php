<style>
    body {
        margin: 0;
    }
    .navbar {
        background-color: #392A23;
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
    .navbar li a.active {
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

</style>