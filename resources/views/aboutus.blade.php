<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        @include('layouts/navbar')
        <main>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1802188142865!2d106.62838071444747!3d-6.239963062839924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbf5c7e12ad7%3A0x65a9b6d1ff732b0c!2sCluster%20ALEXANDRITE%20RESIDENCE%20Serpong!5e0!3m2!1sen!2sid!4v1678461803985!5m2!1sen!2sid" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <br>
            <div class="grid">
                <div class="grid-item">
                    <h3><b>SAMANKO COFFEE ROASTERS</b></h3><br><br>
                    <h4><b>Open Daily</b> &emsp; 08:00 - 23:00</h4><br>
                    <h5>Coffee Supplier & Authorize dealer of Davinci Syrup / Twinings Tea/ABACA Coffee Filter</h5><br>
                    <h5>Jl. Raja H. Fisabililah No.17, Baru IX Kota Tanjung Pinang Kepulauan Riau 29123</h4>
                </div>
                <div class="grid-item" style="padding-left:6rem">
                    <h3><b>Find Us</b></h3><br>
                    <span style="display:flex">
                        <img src="{{ asset('images/instagram.png') }}" alt="Logo" style="width: 20px; height:20px; margin-top:5px; margin-right:10px">
                        <h4>@samanko.roasters</h4>
                    </span>
                    <span style="display:flex">
                        <img src="{{ asset('images/whatsapp.png') }}" alt="Logo" style="width: 20px; height:20px; margin-top:5px; margin-right:10px">
                        <h4>0811-7752-933</h4>
                    </span>
                </div>
            </div>
            @include('layouts/footer2')
        </main>
    </body>
</html>