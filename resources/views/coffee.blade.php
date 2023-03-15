<!DOCTYPE html>
<html>
    <head>
        <title>Coffee</title>
    </head>
    <body>
        @include('layouts/navbar')
        <div style="display: flex;">
            <img src="{{ asset('images/bannerKiri.jpg') }}" alt="Logo Kiri" style="width: 50%; height:500px">
            <img src="{{ asset('images/bannerKanan.jpg') }}" alt="Logo Kanan" style="width: 50%; height:500px">
        </div>
        <div style="display: flex; flex-direction: row; width: 100%;">
            <div style="width:28%; height: ">
                <img src="{{ asset('images/0. banner samping 1.jpg') }}" alt="Logo Kiri" style="width: 100%; height: 33.3334%">
                <img src="{{ asset('images/0. banner samping 2.jpg') }}" alt="Logo Kiri" style="width: 100%; height: 33.3334%">
                <img src="{{ asset('images/0. Banner samping 3.jpg') }}" alt="Logo Kiri" style="width: 100%; height: 33.3334%">
            </div>
            <div class="menu-list" style="width: 72%;  padding: 20px; display: flex; flex-direction: column; ">
                <div style="text-align: justify; line-height: 1.2;">
                    <p style="font-size: 17px; font-weight: bold;">SAMAKO COFEE REASTERS</p>
                    <p>
                        A Specialty cofee that offers arange of high-quality coffee blends for coffe lovers around the world. Our CoffeeShop is dedicated to providing our customers with exceptional coffee beans sources from the best coffe-growing regions around the world.
                    </p>
                    <p>
                        With the increasing consumption of coffee, Samanko Coffee Roasters saw an opportunity to bring the best coffee to the people of tanjungpinang, Kepulauan Riau. Our coffee shop offers a variety of indonesian coffee blends and various brewing methods to satisfy the taste preferences of our Customers. At Samanko Cofee Roasters, we believe in creating cozy and comfortable atmosphere where people can gather, relax and enjoy their coffee. 
                    </p>
                    <label>
                        Come visit us at Samanko Coffee Roasters and Experience our exceptional Coffee blends and warm Hospitality.
                    </label><br>
                    <label>
                        We Look forward to serving you!
                    </label>
                </div>
                <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Coffee</label>  
                <div style="display: flex; flex-wrap: wrap; line-height: 1.2;">
                    @foreach($menu->where('menu_type', 'Coffee') as $menuData)
                        <div style="height: 100%; display: flex; flex-direction: column; width: 16.6667%;">
                            <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                            <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                            <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                        </div> 
                        @if(($loop->index + 1) % 6 == 0)
                            </div><div style="display: flex; flex-wrap: wrap; margin-top: 20px;">
                        @endif     
                    @endforeach
                </div>
                <div style="height: 3px; background-color: #D4B096; margin-top: 10px;"></div>
                <div style="display: flex; flex-direction: row; width: 100%;">    
                    <div style="display: flex; flex-direction: column; height: 100%; width: 50%;">            
                        <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Drip Coffee</label>  
                        <div style="display: flex; flex-wrap: wrap; width: 100%; line-height: 1.2;">                    
                            @php $counter = 0; @endphp
                            @foreach($menu->where('menu_type', 'Drip Coffee') as $menuData)
                                @if($counter < 2)
                                <div style="height: 100%; display: flex; flex-direction: column; width: 33.3334%;">
                                    <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                                    <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                                    <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                                </div> 
                                @php $counter++; @endphp    
                                @else
                                    @break
                                @endif
                            @endforeach 
                            <div style="height: 100%; display: flex; flex-direction: column; width: 33.3334%; line-height: 1.5"> 
                                <label style="font-size: 17px;"><u>Single Origins</u></label>
                                @php $counter = 0; @endphp
                                @foreach($menu->where('menu_type', 'Single Origins') as $menuData)
                                    @if($counter < 5)
                                        <label style="font-size: 17px;">{{ $menuData->menu_name }}</label>
                                    @endif
                                    @php $counter++; @endphp  
                                @endforeach 
                            </div>
                        </div>
                    </div>
                    <div style="height: 100%; width: 3px; background-color: #D4B096; margin: 10px 15px 0px 5px;"></div>
                    <div style="display: flex; flex-direction: column; height: 100%; width: 50%;">            
                        <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Ice Cream</label>  
                        <div style="display: flex; flex-wrap: wrap; width: 100%; line-height: 1.2;">                    
                            @php $counter = 0; @endphp
                            @foreach($menu->where('menu_type', 'Ice Cream') as $menuData)
                                @if($counter < 3)
                                <div style="height: 100%; display: flex; flex-direction: column; width: 33.3334%;">
                                    <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                                    <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                                    <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                                </div> 
                                @php $counter++; @endphp    
                                @else
                                    @break
                                @endif
                            @endforeach 
                        </div>
                    </div>
                </div>
                <div style="height: 3px; background-color: #D4B096; margin-top: 20px;"></div>
                <div style="display: flex; flex-direction: column; width: 100%;">            
                    <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Frape</label>  
                    <div style="display: flex; flex-wrap: wrap; width: 100%; line-height: 1.2;">                    
                        @foreach($menu->where('menu_type', 'Frape') as $menuData)
                            <div style="height: 100%; display: flex; flex-direction: column; width: 16.6667%;">
                                <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                                <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                                <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                            </div> 
                            @if(($loop->index + 1) % 6 == 0)
                                </div><div style="display: flex; flex-wrap: wrap; margin-top: 20px;">
                            @endif     
                        @endforeach
                    </div>
                </div>
                <div style="height: 3px; background-color: #D4B096; margin-top: 10px;"></div>
                <div style="display: flex; flex-direction: column; width: 100%;">            
                    <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Smoothies & Milk / Mocktails</label>  
                    <div style="display: flex; flex-wrap: wrap; width: 100%; line-height: 1.2;">    
                        @php $counter = 0; @endphp                
                        @foreach($menu->where('menu_type', 'Smoothies and Milk or Mocktails') as $menuData)
                            @if($counter < 5)
                            <div style="height: 100%; display: flex; flex-direction: column; width: 16.6667%;">
                                <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                                <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                                <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                            </div> 
                            @php $counter++; @endphp    
                            @else
                                @break
                            @endif
                        @endforeach 
                        <div style="height: 100%; display: flex; flex-direction: column; width: 16.6667%; line-height: 1.5"> 
                            @php $counter = 0; @endphp
                            @foreach($menu->where('menu_type', 'Smoothies and Milk or Mocktails') as $menuData)
                                @if($counter >= 5)
                                    <label style="font-size: 17px;">{{ $menuData->menu_name }}</label>
                                @endif
                                @php $counter++; @endphp
                            @endforeach 
                        </div>
                    </div>
                </div>
                <div style="height: 3px; background-color: #D4B096; margin-top: 10px;"></div>
                <div style="display: flex; flex-direction: row; width: 100%;">        
                    <div style="display: flex; flex-direction: column; height: 100%; width: 16.6667%">   
                        <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Yogurt</label>  
                        <div style="display: flex; flex-direction: column; width: 100%; line-height: 1.5"> 
                            @foreach($menu->where('menu_type', 'Yogurt') as $menuData)
                                    <label style="font-size: 17px;">{{ $menuData->menu_name }}</label>
                            @endforeach 
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; height: 100%; width: 16.6667%; line-height: 1.5">   
                        <label style="font-size: 17px; font-weight: bold; margin: 20px 0px 10px 0px">Tea</label> 
                        @php $counter = 0; @endphp 
                        @foreach($menu->where('menu_type', 'Tea') as $menuData)
                            @if($counter % 5 == 0 && $counter > 0)
                                </div>
                                <div style="display: flex; flex-direction: column; width: 16.6667%; line-height: 1.5; margin-top: 55px"> 
                            @endif
                            <label style="font-size: 17px;">{{ $menuData->menu_name }}</label>
                            @php $counter++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="enlargeModal" class="modal">
                <span class="close" onclick="closeModal()">&times;</span>
                <img class="modal-content" id="modalImage">
                <div id="caption"></div>
            </div>
        </div>
        @include('layouts/footer')
    </body>
</html>

<style>

    .menu-list img:hover {
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

<script>
    function enlargeImage(img) {
        document.body.style.overflow = "hidden";
        var modal = document.getElementById("enlargeModal");
        var modalImg = document.getElementById("modalImage");
        var captionHtml = document.getElementById("caption");

        modal.style.display = "block";
        modalImg.src = img.src;
        captionHtml.innerHTML = '<span style="font-size: 17px;">' + img.dataset.name + '</span><br><span style="font-size: 13px;">' + img.dataset.desc + '</span>';
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