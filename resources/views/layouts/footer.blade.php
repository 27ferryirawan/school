<a onclick="topFunction()" id="myBtn" title="Go to top">
    <img src="{{ asset('images/up-arrow.png') }}" alt="Logo" style="width: 30px; height:30px; margin: 0px -24px 0px 0px;">
</a>
<footer style="display:flex; align-items:center; height: 70px;">
    <a style="background-color: #D9D9D9; color:black; text-decoration: none; border-radius: 15px; padding:5px 20px; margin-left:50px" class="{{ request()->is('reservation') ? 'active' : ''}}" href="/reservation">
        Make a Reservation!
    </a>
    <a style="right:0; position:absolute; margin-right: 6rem;" href="https://www.instagram.com/samanko.roasters/" target="_blank">
        <img src="{{ asset('images/instagram.png') }}"  style="width: 30px; height:30px">
    </a>

    <a style="right:0; position:absolute; margin-right:2rem;" href="https://www.facebook.com/samanko.roasters" target="_blank">
        <img src="{{ asset('images/facebook.png') }}" style="width: 30px; height:30px">
    </a>
</footer>