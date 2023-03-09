<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <style>
            body {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <header>
            @include('navbar')
        </header>
        <main>
            <img src="{{ asset('images/samanko_bkg.jpeg') }}" alt="Logo" style="width: 100%;">
            <div style="margin: 100px 50px 100px 50px; display: flex;">
                <div> 
                    <label style="font-weight: bold; font-size: 17px;">SAMANKO COFFEE ROASTER</label>
                    <br>
                    <br>
                    <label style="font-size: 16px;">The increase in coffee consumption is also closely related to the urban lifestyle of social people.</label>
                    <br>
                    <label style="font-size: 16px;">In 2019, Samanko Coffee Roaster appeared in Tanjungpinang, Riau island</label>
                    <br>
                    <label style="font-size: 16px;">offering a wide variety of Indonesian coffee and different coffee brewing methods</label>
                    <br>
                    <label style="font-size: 16px;">Not only that, but Samanko Coffee Roaster also has its own coffee production facility,</label>
                    <br>
                    <label style="font-size: 16px;">making it a place for novice coffee entrepreneurs to start their coffee business.</label>
                </div>
                <div style="margin-left: auto;">
                    <label style="font-weight: bold; font-size: 17px;">OPEN DAILY</label>
                    <label style="font-size: 16px; padding-left: 20px">08:00 - 23:00</label>
                    <br>
                    <br>
                    <label style="font-size: 16px;">Coffee Supplier & Authorized dealer of Davinci Syrup /</label>
                    <br>
                    <label style="font-size: 16px;">Twinnings Tea / ABACA Coffee Filter</label>
                    <br>
                    <br>
                    <label style="font-size: 16px;">Jl. Raja H. Fisabililah No. 17, Batu IX Kota Tanjung Pinang</label>
                    <br>
                    <label style="font-size: 16px;">Kepulauan Riau 29123</label>
                <div>
            </div>
        </main>
        <footer>
            <p>&copy; 2023 Ferry Irawan</p>
        </footer>
    </body>
</html>
