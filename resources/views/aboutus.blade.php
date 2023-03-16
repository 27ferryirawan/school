<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        @include('layouts/navbar')
        <main>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.314657406303!2d104.49086181460552!3d0.9104070993358732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d96df78e6c837d%3A0xb11b500e77e66827!2sSamanko%20Coffee%20Roasters!5e0!3m2!1sen!2sid!4v1678643314853!5m2!1sen!2sid" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="grid" style="display: flex; line-height: 0.5;">
                <div class="grid-item">
                    <p style="font-weight: bold; font-size: 17px;">SAMANKO COFFEE ROASTER</p> <br>
                    <label style="font-weight: bold; font-size: 17px;">OPEN DAILY</label> 
                    <label style="font-size: 16px; padding-left: 20px;">08:00 - 23:00</label> 
                    <p></p>
                    <p style="font-size: 16px;">Coffee Supplier & Authorized dealer of Davinci Syrup /</p>
                    <p style="font-size: 16px;">Twinnings Tea / ABACA Coffee Filter</p> <br>
                    <p></p>
                    <p style="font-size: 16px;">Jl. Raja H. Fisabililah No. 17, Batu IX Kota Tanjung Pinang</p>
                    <p style="font-size: 16px;">Kepulauan Riau 29123</p>
                </div>
                <div style="margin-left: auto;  margin-right: 75px">
                    <label style="font-weight: bold; font-size: 17px;">FIND US</label> 
                    <p></p>
                    <a style="display:flex; text-decoration: none; color: black;" href="https://www.instagram.com/samanko.roasters/" target="_blank">
                        <img src="{{ asset('images/instagram.png') }}" alt="Logo" style="width: 20px; height:20px; margin-top:5px; margin-right:10px">
                        <p style="font-size: 16px; margin-top: 10px;">@samanko.roasters</p>
                    </a>
                    <a style="display:flex; text-decoration: none; color: black;" href="https://api.whatsapp.com/send/?phone=628117752933&text&type=phone_number&app_absent=0" target="_blank">
                        <img src="{{ asset('images/whatsapp.png') }}" alt="Logo" style="width: 20px; height:20px; margin-top:5px; margin-right:10px">
                        <p style="font-size: 16px; margin-top: 10px;">0811-7752-933</p>
                    </a>

                    <a style="display:flex; text-decoration: none; color: black;" href="https://www.facebook.com/samanko.roasters" target="_blank">
                        <img src="{{ asset('images/facebook.png') }}" alt="Logo" style="width: 20px; height:20px; margin-top:5px; margin-right:10px">
                        <p style="font-size: 16px; margin-top: 10px;">Samanko Coffee Roasters</p>
                    </a>
                </div>
            </div>
        </main>
        @include('layouts/footer2')
    </body>
</html>