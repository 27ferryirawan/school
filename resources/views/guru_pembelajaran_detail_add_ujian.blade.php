<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main>
        <div class="input-com-full">
            <label>Ujian</label>
            <input type="text" id="ujian" name="ujian">
        </div>
        <div class="input-com-full" style="width:198.5px">
            <label>Tipe Ujian</label>
            <select class="dropdown" name="jenisUjian-dropdown" id="jenisUjian">
                <option value="" selected disabled hidden>

                </option>
                @foreach ($jenisUjian as $dataJenisUjian)
                    <option value="{{ $dataJenisUjian['id'] }}">
                        {{ $dataJenisUjian['jenis_ujian'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-com-full" style="width: 198.5px">
            <label>Kode Ruangan</label>
            <input type="text" id="kodeRuangan" name="kodeRuangan">
        </div>
        <div class="input-com-full" style="width: 148.5px">
            <label>Waktu Pengerjaan</label>
            <div style="display: flex; align-items: center; width: 100%;">
                <input type="text" id="waktuPengerjaan" name="waktuPengerjaan" style="width: 95%;">
                <label for="waktuPengerjaan" style="margin-left: 10px; width: 5%;">menit</label>
            </div>
        </div>
        <div class="input-com-full date-input time-input" style="margin-right: 0px; display: flex; width: 275px">
            <div style="margin-right: 15px">
                <label>Hari Ujian</label>
                <input type="text" id="date" name="date">
            </div>
            <div style="display: column;">
                <label>Jam Ujian</label>
                <input type="text" id="time" name="time">
            </div>
        </div>
    </main>
    <footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto;">
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" onclick="addData()">Tambah</button>
        </div>
    </footer>
    <div id="successOrFailedModal" class="modal">
        <div class="modal-content">
            <p id="successOrFailedText" class="ajax-label"></p>
            <p id="successOrFailedDescriptionText" class="ajax-label-description"></p>
            <button class="confirm-button" onclick="hideSuccessOrFailedModal()">Konnfirmasi</button>
        </div>
    </div>
    <div class="loading">
        <div class="center-body">
            <div class="loader-circle-11">
                <div class="arc"></div>
                <div class="arc"></div>
                <div class="arc"></div>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    flatpickr("#date", {
        dateFormat: "d M Y",
        minDate: "today",
    });

    flatpickr("#time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 10,
    });

    function addData() {
        // Mengumpulkan data dari formulir
        var guru_pembelajaran_id = {{ $guruPembelajaran->id }}
        var ujian = $('#ujian').val();
        var jenisUjian = $('#jenisUjian').val();
        var kodeRuangan = $('#kodeRuangan').val();
        var waktuPengerjaan = $('#waktuPengerjaan').val();
        var date = $('#date').val();
        var time = $('#time').val();
        var tanggalUjian = date + ' ' + time

        // Menyusun data untuk dikirimkan ke server
        var requestData = {
            guru_pembelajaran_id: guru_pembelajaran_id,
            deskripsi: ujian,
            jenis_ujian_id: jenisUjian,
            kode_ruangan: kodeRuangan,
            waktu_pengerjaan: waktuPengerjaan,
            tanggal_ujian: tanggalUjian,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '/guru-pembelajaran/detail/addUjian',
            method: 'POST',
            data: requestData,
            dataType: 'json',
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                document.getElementById("successOrFailedText").innerHTML = response.message;
                document.getElementById("successOrFailedDescriptionText").innerHTML = response
                    .message_description;
            },
            error: function(xhr, status, error) {
                document.getElementById("successOrFailedText").innerHTML = response.message;
                document.getElementById("successOrFailedDescriptionText").innerHTML = response
                    .message_description;
            },
            complete: function() {
                $('.loading').hide();
                successOrFailedModal.style.display = "block";
                document.body.style.overflow = "hidden";
            }
        });
    }

    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedDescriptionText").innerHTML != "") {
            var url = window.location.href;;
            var substring = url.substring(0, url.lastIndexOf('/ujian'));
            window.location.href = substring
        }
    }

    window.onclick = function(event) {
        if (event.target == successOrFailedModal) {
            hideSuccessOrFailedModal();
        }
    }
</script>

<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999;
        background-color: #03549b;
        display: none;
    }
</style>
