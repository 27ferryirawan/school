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