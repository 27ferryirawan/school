<!DOCTYPE html>
<html>
    <head>
        <title>Coffee</title>
    </head>
    <body>
        @include('layouts/navbar')
        <div style="display: flex; flex-direction: column;">
            <div style="display: flex; flex-direction: column; column; justify-content: center; align-items: center;line-height: 1.2; font-size: 17px; text-align: center; margin-bottom: 20px;0">
                <img src="{{ asset('images/the-rolling-pin.png') }}" alt="Logo Kiri" style="width: 35%;">
                <div style="margin-top: 10px;">
                    <label>Rolling Pin is a bakery and pastisserie that is dedicated to providing high-quality baked 
                    goods to their customers. They offer a wide variety of baked </label><br>
                    <label>goods, including croissants, craffles,cheesecakes, and carrot cakes, all made with the finest ingredients and baked perfections. The store's</label><br>
                    <label>commitment to quality is apparent in every product they make, and they strive to deliver the best possible baking and pastry experience to their</label><br>
                    <label>customers. In addition to their dedication to quality, Rolling Pin is also devoted to innovation, constantly exploring new flavors and techniques to create</label><br>
                    <label>unique and delicious baked goods that delight their customers. From classic croissants to creative new creations, Rolling Pin's baked goods are always</label><br>
                    <label>fresh, delicious, and top-notch.</label><br>
                </div>
            </div>
            <div style="display: flex; flex-direction: row;">
                <img src="{{ asset('images/top1.jpg') }}" alt="Logo Kiri" style="width: 50%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/top2.jpg') }}" alt="Logo Kanan" style="width: 50%; height: 300px; object-fit: cover;">
            </div>     
            <div style="display: flex; flex-direction: row;">
                <img src="{{ asset('images/top3.jpg') }}" alt="Logo Kiri" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/top4.jpg') }}" alt="Logo Kanan" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/top5.jpg') }}" alt="Logo Kiri" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/top6.jpg') }}" alt="Logo Kanan" style="width: 25%; height: 300px; object-fit: cover;">
            </div> 
            <div style="display: flex; flex-wrap: wrap; line-height: 1.2; margin: 20px 0px 0px 60px">
                @php $counter = 0; @endphp  
                @foreach($menu->where('menu_type', 'Burger') as $menuData)
                    @if($counter < 2)
                        <div style="height: 100%; display: flex; flex-direction: column; width: 12.5%;">
                            <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                            <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                            <!-- <label style="font-size: 13px;">{{ $menuData->menu_description }}</label> -->
                        </div>
                    @endif 
                    @php $counter++; @endphp          
                @endforeach
                <div style="height: 100%; display: flex; flex-direction: column; width: 25%;"> 
                    <label style="font-size: 17px; font-weight: bold">Best Burger in Town</label><br>
                    @php $counter = 0; @endphp
                    @foreach($menu->where('menu_type', 'Burger') as $menuData)
                        @if($counter >= 0 && $counter <=2)
                            <label style="font-size: 17px;">{{ $menuData->menu_name }}</label>
                            <label style="font-size: 13px;">{{ $menuData->menu_description }}</label><br>
                        @endif
                        @php $counter++; @endphp
                    @endforeach 
                </div>
                <div style="height: 100%; display: flex; flex-direction: column; width: 37.5%; margin-left: auto; margin-right: 0;"> 
                    <img src="{{ asset('images/top7.jpg') }}" data-name="" data-desc="" style="width: 100% ;height: 172px; border-top-left-radius: 100px; border-bottom-left-radius: 100px; object-fit: cover"  onclick="enlargeImage(this)"> 
                </div>
            </div>
            <div style="display: flex; flex-wrap: wrap; line-height: 1.2; margin: 20px 60px 0px 60px">
                @foreach($menu->where('menu_type', 'Bakery') as $menuData)
                    <div style="height: 100%; display: flex; flex-direction: column; width: 12.5%;">
                        <img src="{{ $menuData->menu_image_path }}" data-name="{{ $menuData->menu_name }}" data-desc="{{ $menuData->menu_description }}" style="width: 150px; height: 150px; border-radius: 15px;" onclick="enlargeImage(this)"> 
                        <label style="font-size: 17px; margin-top: 5px; width: 98%">{{ $menuData->menu_name }}</label>
                        <label style="font-size: 13px;">{{ $menuData->menu_description }}</label>
                    </div> 
                    @if(($loop->index + 1) % 8 == 0)
                        </div><div style="display: flex; flex-wrap: line-height: 1.2; margin: 20px 60px 0px 60px">
                    @endif     
                @endforeach
            </div>
            <div style="display: flex; flex-direction: row;">
                <img src="{{ asset('images/bottom1.jpg') }}" alt="Logo Kiri" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/bottom2.jpg') }}" alt="Logo Kanan" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/bottom3.jpg') }}" alt="Logo Kiri" style="width: 25%; height: 300px; object-fit: cover;">
                <img src="{{ asset('images/bottom4.jpg') }}" alt="Logo Kanan" style="width: 25%; height: 300px; object-fit: cover;">
            </div> 
        </div>
        <div style="display: flex; flex-direction: row; width: 100%;">
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