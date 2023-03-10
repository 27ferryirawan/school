<!DOCTYPE html>
<html>
    <head>
        <title>Reservation</title>
    </head>
    <body>
        @include('layouts/navbar')
        <main>
            <div class="date-input">
                <label>Pilih Tanggal</label>        
                <input type="text" id="reservationDate" name="reservationDate">
            </div>
            <div class="time-input">
                <label>Pilih Waktu</label>        
                <input type="text" id="reservationTime" name="reservationTime">
            </div>
            <div class="time-input">
                <label>Pilih Waktu</label>        
                <input type="text" id="reservationTime" name="reservationTime">
            </div>
            
            <div id="cafe-map">
                <!-- <img src="{{ asset('images/cafe-map.jpg') }}" alt="Cafe Map" usemap="#cafe-map"> -->
                <area shape="rect" coords="20,20,450,450" href="#" alt="Seating Area" style="border: 10px solid red;">
                <div class="tooltip">Seating Area</div>
                <div class="tooltip">Counter</div>
                <div class="tooltip">Kitchen</div>
            </div>
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
</script>


<style>
		#cafe-map {
			position: relative;
			width: 800px;
			height: 600px;
			/* background-image: url('/images/cafe-map.jpg'); */
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
		}
	</style>