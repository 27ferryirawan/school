
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    html::-webkit-scrollbar {
        display: none;
    }
    body {
        margin: 0;
        font-family: 'SourceSansPro';
        overflow-x: hidden;
    }
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
        padding: 22px;
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

    @font-face {
        font-family: 'SourceSansPro';
        src: url('/font/Source_Sans_Pro/SourceSansPro-Regular.woff') format('woff');
        font-weight: normal;
    }
    @font-face {
        font-family: 'SourceSansPro';
        src: url('/font/Source_Sans_Pro/SourceSansPro-Bold.woff') format('woff');
        font-weight: bold;
    }
    @font-face {
        font-family: 'Inter';
        src: url('/font/Inter/Inter-Regular.woff') format('woff');
        font-weight: normal;
    }
    @font-face {
        font-family: 'Inter';
        src: url('/font/Inter/Inter-Bold.woff') format('woff');
        font-weight: bold;
    }

    .time-input{
        margin: 10px 50px 0px 80px; 
    }

    .time-input label, .time-input input {
        display: block;   
        font-size: 17px;
    }
    
    .time-input input[type="text"] {
        padding-left: 30px;
        background-image: url('/images/clock.png');
        background-repeat: no-repeat;
        background-position: 5px center;
        background-size: auto 50%;
        height: 35px;
        width: 325px;
        border: 1px solid black;
    }

    .date-input{
        margin: 50px 50px 0px 80px; 
    }

    .date-input label, .date-input input {
        display: block;   
        font-size: 17px;
    }
    
    .date-input input[type="text"] {
        padding-left: 30px;
        background-image: url('/images/calendar.png');
        background-repeat: no-repeat;
        background-position: 5px center;
        background-size: auto 50%;
        height: 35px;
        width: 325px;
        border: 1px solid black;
    }

    tr:last-child {
        border-top: 1px solid black;
    }

    .map-canvas{
        margin: 20px 50px 0px 80px; 
        font-size: 17px;
    }

    #mapCanvas{
        background-image: url('/images/cafe-map.png'); 
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width: 1300px;
        height: 530px;
        margin: -30px 39px 0px -11px;
        display: block;
        /* background-color: blue; */
    }

    .reserve-div{
        font-size: 17px;
        margin: 50px 50px 0px 450px; 
        width: 250px
    }
</style>
