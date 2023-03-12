<!DOCTYPE html>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        @include('layouts/navbar')
            <img src="{{ asset('images/Menu Makanan.jpg') }}" alt="Logo" style="width: 100%;">
            <img src="{{ asset('images/Menu Minuman.jpg') }}" alt="Logo" style="width: 100%;">
            <a onclick="topFunction()" id="myBtn" title="Go to top">
                <img src="{{ asset('images/up-arrow.png') }}" alt="Logo" style="width: 30px; height:30px">
            </a>
        @include('layouts/footer')
    </body>
</html>
