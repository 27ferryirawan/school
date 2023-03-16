<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <header>
            @include('layouts/navbar')
        </header>
        <main>
            <img src="{{ asset('images/samanko_bkg.jpg') }}" alt="Logo" style="width: 100%;">
            <div class="grid" style="display: flex;">
                <div class="grid-item" style="line-height: 1.2;">
                    <label style="font-weight: bold; font-size: 17px; padding-bottom: 15px;">SAMANKO COFFEE ROASTER</label>
                    <p style="font-size: 16px;">
                        The increase in coffee consumption is also closely related to the urban lifestyle of social people.
                        In 2019, Samanko Coffee Roaster appeared in Tanjungpinang, Riau island
                        offering a wide variety of Indonesian coffee and different coffee brewing methods
                        Not only that, but Samanko Coffee Roaster also has its own coffee production facility,
                        making it a place for novice coffee entrepreneurs to start their coffee business.
                    </p>
                </div>
                <div style="margin-left: auto;  line-height: 1.2;">
                    <label style="font-weight: bold; font-size: 17px;">OPEN DAILY</label> 
                    <label style="font-size: 16px; padding: 0px 0px 15px 20px;">08:00 - 23:00</label><br>
                    <label style="font-size: 16px; ">Coffee Supplier & Authorized dealer of Davinci Syrup /</label><br>
                    <label style="font-size: 16px;">Twinnings Tea / ABACA Coffee Filter</label> 
                    <br><br>
                    <label style="font-size: 16px; margin-top: 2px">Jl. Raja H. Fisabililah No. 17, Batu IX Kota Tanjung Pinang</label><br>
                    <label style="font-size: 16px;">Kepulauan Riau 29123</label>
                </div>
            </div>
            <div style="display:block; width: 100%;">
                <div style="position: relative; color: white; font-size: 16px;">
                    <img src="{{ asset('images/samanko_footer.jpg') }}" style="width: 100%; height:300px; object-fit: cover;">
                    <div style="position: absolute; top: 20px; width: 90%; margin: 25px 50px 0px 50px; line-height: 0.2;">
                        <p>"Every specially coffee drink you have here at Samanko Coffee Roaster is made special from</p> 
                        <p>un-roasted green beans sourced ethically from the farmer from all over the world to roasted fresh onsite on our roaster.</p>
                        <lapbel>This ensures freshness, quality control, and allows us to roast to taste."</p>
                    </div>        
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap; line-height: 1.2; margin: 20px 20px 40px 20px;">
                <div style="height: 100%; display: flex; flex-direction: column; width: 25%; margin: 0px 0px">
                    <img src="{{ asset('images/banner bottom.jpg') }}" onclick="enlargeImage(this)" alt="Banner Bottom"  data-caption="Stock up your Coffee Bean for the end of the year! Dont let your day messed up without Coffee. We do supplies Coffee / Syrup to Hotel / Coffee Shops with special offers, available for Tanjungpinang & Batam" style="margin: 0px 5px;">
                    <div class="grid-item" style="width: 100%; margin-top: 20px; line-height: 1.2;">
                        <p>Stock up your Coffee Bean for the end of the year!
                        Dont let your day messed up without Coffee.
                        We do supplies Coffee / Syrup to Hotel / Coffee
                        Shops with special offers, available for
                        Tanjungpinang & Batam
                    </p>
                    </div>
                </div>
                <div style="height: 100%; display: flex; flex-direction: column; width: 25%; margin: 0px 0px">
                    <img src="{{ asset('images/banner bottom 2.jpg') }}" onclick="enlargeImage(this)" alt="Banner Bottom 2" data-caption="Who doesnt love sourdough sandwiches ? Yes ! We add Breakfast Menu Available from 08:00 - 14:00 Everyday! Boost up your day by having breakfast with us!" style="margin: 0px 5px;">
                    <div class="grid-item" style="width: 100%; margin-top: 20px; line-height: 1.2;">
                        <p>
                            Who doesnt love sourdough sandwiches ?
                            Yes ! We add Breakfast Menu Available from
                            08:00 - 14:00 Everyday!
                            Boost up your day by having breakfast with us!
                        </p>
                    </div>
                </div>
                <div style="height: 100%; display: flex; flex-direction: column; width: 25%; margin: 0px 0px">
                    <img src="{{ asset('images/banner bottom 4.jpg') }}" onclick="enlargeImage(this)" alt="Banner Bottom 4" data-caption="Stress less and enjoy the best coffee in town" style="margin: 0px 5px;">
                    <div class="grid-item" style="width: 100%; margin-top: 20px; line-height: 1.2;">
                        <p>Stress less and enjoy the best coffee in town</p>
                    </div>
                </div>
                <div style="height: 100%; display: flex; flex-direction: column; width: 25%; margin: 0px 0px">
                    <img src="{{ asset('images/banner bottom 3.jpg') }}" onclick="enlargeImage(this)" alt="Banner Bottom 3" data-caption="Save your Weekend for the best !" style="margin: 0px 5px;">
                    <div class="grid-item" style="width: 100%; margin-top: 20px; line-height: 1.2;">
                        <p>Save your Weekend for the best !</p>
                    </div>
                </div>
                <div id="enlargeModal" class="modal">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <img class="modal-content" id="modalImage">
                    <div id="caption"></div>
                </div>
            </div>
        </main>
        @include('layouts/footer')
    </body>
</html>


<script>
    function enlargeImage(img) {
        document.body.style.overflow = "hidden";
        var modal = document.getElementById("enlargeModal");
        var modalImg = document.getElementById("modalImage");
        var captionHtml = document.getElementById("caption");

        modal.style.display = "block";
        modalImg.src = img.src;
        captionHtml.innerHTML = '<p style="font-size: 17px; line-height: 1.2; text-align: justify;">' + img.dataset.caption + '</p>'
    }

    function closeModal() {
        var modal = document.getElementById("enlargeModal");
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }
    window.onclick = function(event) {
        if (event.target == enlargeModal) {
            closeModal();
        }
    }

</script>


<style>
    .grid-item img:hover {
        opacity: 0.8;
    }
        
    #modalImage {
        border-radius: 5px;
        transition: 0.3s;
    }

    .modal {
        display: none; 
        position: fixed;
        z-index: 1; 
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.9);
        overflow: hidden;
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 400px;
    }

    #caption{
        margin: auto;
        display: block;
        width: 80%;
        max-width: 400px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    .modal-content, #caption {  
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

