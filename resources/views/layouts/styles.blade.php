
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    #myBtn {
        display: none;
        position: fixed;
        bottom: 30px;
        right: 40px;
        z-index: 99;
        border: none;
        outline: none;
        /* background-color: #555; */
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

    #myBtn:hover {
        /* background-color: black; */
        animation: spin 1s ease-in-out;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    footer{
        width:100%;
        height:10%;
        padding:20px;
        background-color: #D4B0A0;
    }
    .grid{
        display:inline-flex;
        padding:4rem;
        width:100%;
    }
    .grid-item{
        width:50%;
        display:block;
    }
    .grid-item-coffee{
        width:33%;
        display:block;
    }
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


    .payment-button {
        background-color: white;
        border: 1px solid black;
        padding: 4px 0px;
        font-size: 17px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        width: 100%;
        margin: 20px 0px 0px 0px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
    }

    .confirm-button {
        background-color: #392A23;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 17px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .cancel-button {
        background-color: #D4B096;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 17px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .ajax-label{
        text-align: center; 
        font-weight: bold; 
        font-size: 25px;
    }
</style>

<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
