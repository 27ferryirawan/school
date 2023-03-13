<!DOCTYPE html>
<html>
    <head>
        <title>Coffee</title>
    </head>
    <body>
        @include('layouts/navbar')
        <div style="display:flex;">
            <img src="{{ asset('images/bannerKiri.jpg') }}" alt="Logo Kiri" style="width: 50%; height:500px">
            <img src="{{ asset('images/bannerKanan.jpg') }}" alt="Logo Kanan" style="width: 50%; height:500px">
        </div>
        <div class="grid">
            <div class="grid-item-coffee">
                <img src="{{ asset('images/0. banner samping 1.jpg') }}" alt="Logo Kiri" style="width: 100%; height:500px">
                <img src="{{ asset('images/0. banner samping 2.jpg') }}" alt="Logo Kiri" style="width: 100%; height:500px">
                <img src="{{ asset('images/0. Banner samping 3.jpg') }}" alt="Logo Kiri" style="width: 100%; height:500px">
            </div>
            <div class="grid-item" style="padding-left:10px;">
                <h2>SAMAKO COFEE REASTERS </h2>
                <p>
                    A Specialty cofee that offers arange of high-quality coffee blends for coffe lovers around the world. Our CoffeeShop is dedicated to providing our customers with exceptional coffee beans sources from the best coffe-growing regions around the world.
                </p>
                <p>
                    With the increasing consumption of coffee, Samanko Coffee Roasters saw an opportunity to bring the best coffee to the people of tanjungpinang, Kepulauan Riau. Our coffee shop offers a variety of indonesian coffee blends and various brewing methods to satisfy the taste preferences of our Customers. At Samanko Cofee Roasters, we believe in creating cozy and comfortable atmosphere where people can gather, relax and enjoy their coffee. 
                </p>
                <p>
                    Come visit us at Samanko Coffee Roasters and Experience our exceptional Coffee blends and warm Hospitality.
                </p>
                <p>
                    We Look forward to serving you!
                </p>
            </div>
        </div>
        @include('layouts/footer')
    </body>
</html>
