<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
    </head>
    <body>
        <header>
            @include('layouts/navbar')
        </header>
        <main>
            <div class="date-input">
                <label>Pilih Tanggal</label>        
                <input type="text" id="reservationDate" name="reservationDate">
            </div>
            <div class="time-input">
                <label>Pilih Waktu</label>        
                <input type="text" id="reservationTime" name="reservationTime">
            </div>
            <div>
                <label>Pilih Waktu</label>        
                <canvas id="mapCanvas"></canvas>
        </main>
        <footer>
        </footer>        
    </body>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</html>

<script>
    flatpickr("#reservationDate", {
        dateFormat: "d M Y", 
        // maxDate: "today", 
        minDate: "today",
    });
    flatpickr("#reservationTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        maxTime: "18:00",
        minTime: "11:00"
    });

    const canvas = document.getElementById('mapCanvas');
    const ctx = canvas.getContext('2d');
    
    // // ctx.fillStyle = "rgba(255, 0, 0, 0)";
    // ctx.fillStyle = "red";
    // const rects = [
    //     // {x: 7.5, y: 27, width: 11.5, height: 16}, //out 4
    //     // {x: 7.5, y: 53, width: 11.5, height: 16}, //out 3
    //     // {x: 7.5, y: 79, width: 11.5, height: 16}, //out 2
    //     // {x: 7.5, y: 105, width: 11.5, height: 16}, //out 1
    //     // {x: 64.3, y: 16.5, width: 11.5, height: 16}, //out 5
    //     // {x: 84.3, y: 16.5, width: 11.5, height: 16}, //out 6
    //     // {x: 36.8, y: 68.3, width: 26.2, height: 16}, //long 4
    //     // {x: 70, y: 68.3, width: 26.2, height: 16}, //long 3
    //     // {x: 101.1, y: 56.3, width: 11.5, height: 16}, //out 7
    //     // {x: 101.1, y: 86.3, width: 11.5, height: 16}, //out 8
    //     // {x: 90.4, y: 116.7, width: 11.5, height: 16}, //out 9
    //     // {x: 70.2, y: 116.7, width: 11.5, height: 16}, //out 10
    //     // {x: 50.0, y: 116.7, width: 11.5, height: 16}, //out 11
    //     // {x: 29.8, y: 116.7, width: 11.5, height: 16}, //out 12
    // ];
    
    // rects.forEach(rect => {
    //     ctx.fillRect(rect.x, rect.y, rect.width, rect.height);
    // });

    canvas.addEventListener('click', function(event) {
        const rect = canvas.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        if (x >= 24 && x <= 55 && y >= 62 && y <= 95) { 
            //out 4
            console.log("out 4")
        } else if (x >= 24 && x <= 55 && y >= 119 && y <= 152) {
            //out 3
            console.log("out 3")
        } else if (x >= 24 && x <= 55 && y >= 176 && y <= 209) {
            //out 2
            console.log("out 2")
        } else if (x >= 24 && x <= 55 && y >= 233 && y <= 266) {
            //out 1
            console.log("out 1")
        } else if (x >= 194.3 && x <= 225.3 && y >= 39 && y <= 71) {
            //out 5
            console.log("out 5")
        } else if (x >= 255.3 && x <= 286 && y >= 39 && y <= 71) {
            //out 6
            console.log("out 6")
        } else if (x >= 112 && x <= 188 && y >= 151.9 && y <= 183.1) {
            //long 4
            console.log("long 4")
        } else if (x >= 210 && x <= 287 && y >= 151.9 && y <= 183.1) {
            //long 3
            console.log("long 3")
        } else if (x >= 304 && x <= 336 && y >= 124.9 && y <= 157.9) {
            //out 7
            console.log("out 7")
        } else if (x >= 304 && x <= 336 && y >= 191.9 && y <= 223.9) {
            //out 8
            console.log("out 8")
        } else if (x >= 272 && x <= 303 && y >= 256.9 && y <= 288.9) {
            //out 9
            console.log("out 9")
        } else if (x >= 211 && x <= 243 && y >= 256.9 && y <= 288.9) {
            //out 10
            console.log("out 10")
        } else if (x >= 151 && x <= 182 && y >= 256.9 && y <= 288.9) {
            //out 11
            console.log("out 11")
        } else if (x >= 90 && x <= 122 && y >= 256.9 && y <= 288.9) {
            //out 12
            console.log("out 12")
        } else if (x >= 364 && x <= 468 && y >= 45.9 && y <= 77.9) {
            //long 2
            console.log("long 2")
        } else if (x >= 364 && x <= 468 && y >= 257.9 && y <= 289.9) {
            //sofa 2
            console.log("sofa 2")
        } else if (x >= 485 && x <= 518 && y >= 37.9 && y <= 69.9) {
            //in 6
            console.log("in 6")
        } else if (x >= 528 && x <= 561 && y >= 37.9 && y <= 69.9) {
            //in 5
            console.log("in 5")
        } else if (x >= 572 && x <= 604 && y >= 37.9 && y <= 69.9) {
            //in 4
            console.log("in 4")
        } else if (x >= 616 && x <= 648 && y >= 37.9 && y <= 69.9) {
            //in 3
            console.log("in 3")
        } else if (x >= 659 && x <= 691 && y >= 37.9 && y <= 69.9) {
            //in 2
            console.log("in 2")
        } else if (x >= 702 && x <= 734 && y >= 37.9 && y <= 69.9) {
            //in 1
            console.log("in 1")
        } else if (x >= 728 && x <= 761 && y >= 175.9 && y <= 280.9) {
            //long 1
            console.log("long 1")
        } else if (x >= 784 && x <= 817 && y >= 175.9 && y <= 280.9) {
            //long 2
            console.log("sofa 1")
        }
    });
</script>


<style>
    #mapCanvas{
        background-image: url('/images/cafe-map.png'); 
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width: 900px;
        height: 330px;
        margin: 20px 39px 0px 39px;
        display: block;
        /* background-color: blue; */
    } 
    /* #cafe-map {
        position: relative;
        width: 800px;
        height: 600px;
        background-image: url('/images/cafe-map.jpg'); 
        background-size: cover;
        background-repeat: no-repeat;
        border: 1px solid #ccc;
    }

    #cafe-map area {
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    #cafe-map area:hover {
        opacity: 1;
    }

    .tooltip {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px;
        background-color: #333;
        color: #fff;
        font-size: 14px;
        border-radius: 5px;
        opacity: 0;
        transition: all 0.3s ease;
    }
    #cafe-map area:hover + .tooltip {
        opacity: 1;
    } */
</style>