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

    .time-input{
        margin: 30px 50px 0px 50px; 
    }

    .time-input label, .date-time input {
        display: block;   
    }
    
    .time-input input[type="text"] {
        padding-left: 30px;
        background-image: url('/images/clock.png');
        background-repeat: no-repeat;
        background-position: 5px center;
        background-size: auto 50%;
        height: 25px;
        border: 1px solid black;
    }

    .date-input{
        margin: 50px 50px 0px 50px; 
    }

    .date-input label, .date-input input {
        display: block;   
    }
    
    .date-input input[type="text"] {
        padding-left: 30px;
        background-image: url('/images/calendar.png');
        background-repeat: no-repeat;
        background-position: 5px center;
        background-size: auto 50%;
        height: 25px;
        border: 1px solid black;
    }

    body {
        margin: 0;
    }

</style>