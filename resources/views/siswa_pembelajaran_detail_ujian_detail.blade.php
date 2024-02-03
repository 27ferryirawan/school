<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/siswa_navbar')
</head>

<body>
    <main>
        <div class="input-com-full">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <label>Ujian</label>
                <div class="input-com-full" style="margin: 0px; text-align: center">
                    <label><b>Nilai</b></label>
                    <input type="number" id="nilai" name="nilai"
                        style="width: 65px; margin-left: 10px; border: 1px solid black; background-color: #e7e7e7;"
                        min="0" max="100" oninput="validateInput()" value="{{ $ujianJawaban->nilai }}"
                        disabled>
                </div>
            </div>
            <input type="text" id="ujian" name="ujian" value="{{ $ujian->deskripsi }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full" style="width: 198.5px">
            <label>Tipe Ujian</label>
            <select class="dropdown" name="jenisUjian" id="jenisUjian" disabled style="background-color: #e7e7e7;">
                @foreach ($jenisUjian as $data)
                    <option value="{{ $data['id'] }}" @if ($ujian->jenis_ujian_id == $data['id']) selected @endif>
                        {{ $data['jenis_ujian'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="input-com-full" style="width: 198.5px">
            <label>Kode Ruangan</label>
            <input type="text" id="kodeRuangan" name="kodeRuangan" disabled value="{{ $ujian->kode_ruangan }}"
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full" style="width: 148.5px">
            <label>Waktu Pengerjaan</label>
            <div style="display: flex; align-items: center; width: 100%;">
                <input type="text" id="waktuPengerjaan" name="waktuPengerjaan"
                    style="width: 95%; background-color: #e7e7e7;" disabled value="{{ $ujian->waktu_pengerjaan }}">
                <label for="waktuPengerjaan" style="margin-left: 10px; width: 5%;">menit</label>
            </div>
        </div>
        <div class="input-com-full date-input time-input" style="margin-right: 0px; display: flex; width: 275px;">
            <div style="margin-right: 15px">
                <label>Hari Ujian</label>
                <input type="text" id="date" name="date" disabled
                    value="{{ $ujian->formatted_tanggal_ujian_date }}" style="background-color: #e7e7e7;">
            </div>
            <div style="display: column;">
                <label>Jam Ujian</label>
                <input type="text" id="time" name="time" disabled
                    value="{{ $ujian->formatted_tanggal_ujian_time }}" style="background-color: #e7e7e7;">
            </div>
        </div>
    </main>
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
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    <div style="margin-right: 20px;">
        @if (Carbon\Carbon::now() >= Carbon\Carbon::parse($ujian->tanggal_ujian) &&
                Carbon\Carbon::now() <= Carbon\Carbon::parse($ujian->tanggal_ujian)->addMinutes($ujian->waktu_pengerjaan) &&
                ($ujianJawaban->finish_date ?? null) == null)
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" onclick="openData({{ $ujian->id }})">Mulai Ujian</button>
        @else
            <button
                style="width: 125px; height: 35px; background-color: #e7e7e7; border: 3px solid black; color: black; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" disabled>Mulai Ujian</button>
        @endif
    </div>
</footer>
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

    function openData(ujianId) {
        window.location.href = window.location.href + '/soal-list'
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

    .tab th {
        border-bottom: 1px black solid;
    }

    .tab1 th {
        border-bottom: 1px black solid;
    }

    .tab td {
        border-bottom: 1px black solid;
    }

    .tab1 td {
        border-bottom: 1px black solid;
    }

    .tab tr>td {
        padding: 10px 0px;
    }

    .tab1 tr>td {
        padding: 10px 0px;
    }

    .sort-icon {
        display: none;
        width: 12px;
        height: 12px;
        margin-left: 5px;
    }
</style>
