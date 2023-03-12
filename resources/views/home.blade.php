<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        @include('layouts/navbar')
        <img src="{{ asset('images/samanko_bkg.jpg') }}" alt="Logo" style="width: 100%;">
        <div class="grid" style="display: flex; line-height: 0.5;">
            <div class="grid-item">
                <p style="font-weight: bold; font-size: 17px;">SAMANKO COFFEE ROASTER</p>
                <p style="font-size: 16px;">The increase in coffee consumption is also closely related to the urban lifestyle of social people.</p>
                <p style="font-size: 16px;">In 2019, Samanko Coffee Roaster appeared in Tanjungpinang, Riau island</p>
                <p style="font-size: 16px;">offering a wide variety of Indonesian coffee and different coffee brewing methods</p>
                <p style="font-size: 16px;">Not only that, but Samanko Coffee Roaster also has its own coffee production facility,</p>
                <p style="font-size: 16px;">making it a place for novice coffee entrepreneurs to start their coffee business.</p>
            </div>
            <div style="margin-left: auto;">
                <label style="font-weight: bold; font-size: 17px;">OPEN DAILY</label> 
                <label style="font-size: 16px; padding-left: 20px;">08:00 - 23:00</label> 
                <p></p>
                <p style="font-size: 16px;">Coffee Supplier & Authorized dealer of Davinci Syrup /</p>
                <p style="font-size: 16px;">Twinnings Tea / ABACA Coffee Filter</p> <br>
                <p></p>
                <p style="font-size: 16px;">Jl. Raja H. Fisabililah No. 17, Batu IX Kota Tanjung Pinang</p>
                <p style="font-size: 16px;">Kepulauan Riau 29123</p>
            </div>
        </div>
        <div style="display:block; width: 100%">
            <div style="position: relative; color: white; font-size: 16px;">
                <img src="{{ asset('images/samanko_footer.jpg') }}" style="width: 100%; height:300px; object-fit: cover;">
                <div style="position: absolute; top: 20px; width: 90%; margin: 25px 50px 0px 50px;">
                    <p>"Every specially coffee drink you have here at Samanko Coffee Roaster is made special from</p>
                    
                    <p>un-roasted green beans sourced ethically from the farmer from all over the world to roasted fresh onsite on our roaster.</p>
                    
                    <p>This ensures freshness, quality control, and allows us to roast to taste."</p>
                </div>        
            </div>
        </div>
        <div class="grid">
            <div class="grid-item">
                <img src="{{ asset('images/banner bottom.jpg') }}" alt="Banner Bottom" style="width: 22em; height:30em">
                <p style="width: 22em;">
                    Stock up your Coffee Bean for the end of the year ! 
                    Dont let your day Messed up without Coffee.
                    We do Supplies Coffee / Syrup to Hotel / Coffee Shops With special offers, Available for Tanjungpinang & Batam
                </p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/banner bottom 2.jpg') }}" alt="Banner Bottom 2" style="width: 22em; height:30em">
                <p style="width: 22em;">
                    Who Doesnt Love Sourdough Sandwiches ? 
                    Yes ! We add Breakfast Menu Available from 08:00 - 14:00 Everyday! 
                    Boost up your day by having breakfast with us!
                </p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/banner bottom 4.jpg') }}" alt="Banner Bottom 4" style="width: 22em; height:30em">
                <p style="width: 22em;">
                    Stress less and enjoy the best coffee in town
                </p>
            </div>
            <div class="grid-item">
                <img src="{{ asset('images/banner bottom 3.jpg') }}" alt="Banner Bottom 3" style="width: 22em; height:30em">
                <p style="width: 22em;">
                    Save your Weekend for the best !
                </p>
            </div>
        </div>
        @include('layouts/footer')
    </body>
</html>
