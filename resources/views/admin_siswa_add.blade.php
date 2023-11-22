<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    @include('layouts/admin_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="display: flex;">
            <div>
                <div class="input-com">
                    <label>Nama Siswa</label>
                    <input type="text" id="namaSiswa" name="namaSiswa">
                </div>
                <div class="input-com">
                    <label>NISN</label>
                    <input type="text" id="nisn" name="reservanisntionTime">
                </div>
                <div class="input-com">
                    <label>NISN</label>
                    <input type="text" id="nisn" name="reservanisntionTime">
                </div>
            </div>
            <div class="reserve-div">
                <label class="ket-reserv-label">Keterangan Reservasi</label>
                <br>
                <table id="reservationTable" style="border-collapse: collapse;">
                </table>
                <button class="payment-button" onclick="showModal()">Payment</button>
            </div>
        </div>
    </main>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script></script>

<style>
</style>
