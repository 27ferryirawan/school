<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main>
        <div class="input-com-full" style="display: flex; align-items: center; margin-bottom: 10px;">
            <label style="margin-right: 10px;">Jawaban <b id="namaSiswa">{{ $siswa->nama_siswa }}</b></label>
            @if ($ujianDetail->ujian_detail_jenis_soal_id == 2)
                @if ($benarSalah !== null)
                    @if ($benarSalah->is_benar)
                        <img src="{{ asset('images/check.png') }}" style="width: 30px; height: 30px">
                    @else
                        <img src="{{ asset('images/cross.png') }}" style="width: 30px; height: 30px">
                    @endif
                @else
                    <img src="{{ asset('images/cross.png') }}" style="width: 30px; height: 30px">
                @endif
            @endif

        </div>
        <div style="display: flex; justify-content: flex-start; align-items: center;">
            <div style="width: 100%">
                <div class="input-com-full">
                    <label>Tipe Soal</label>
                    @foreach ($jenisSoal as $key => $soal)
                        <label style="display: inline">
                            <input type="radio" name="jenis_soal" id="jenis_soal" value="{{ $soal->id }}"
                                @if ($ujianDetail->ujian_detail_jenis_soal_id == $soal->id) checked @endif style="display: inline"
                                style="background-color: #e7e7e7;" disabled>
                            {{ $soal->jenis_soal }}
                        </label>
                        <br>
                    @endforeach
                </div>
                <div class="input-com-full">
                    <label>Deskripsi Soal</label>
                    <textarea type="text" id="deskripsi" name="deskripsi" style="background-color: #e7e7e7;" disabled>{{ $ujianDetail->soal }}</textarea>
                </div>
                <div style="display: flex; align-items: center;">
                    <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                        <label for="fileInput" id="customFileButton" style="background-color: #e7e7e7;">Pilih
                            fail</label>
                        <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                            onchange="displayFileName()" disabled>
                    </div>
                    @if ($ujianDetail->file_path == null)
                        <a href="{{ asset('storage/' . $ujianDetail->file_path) }}" target="_blank" id="fileLink"
                            class="disabled-link" style="cursor: 1t-allowed">
                            <div id="fileNameDisplay" style="margin-top: 13px">Tidak ada fail</div>
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $ujianDetail->file_path) }}" target="_blank" id="fileLink">
                            <div id="fileNameDisplay" style="margin-top: 13px; cursor: pointer;">
                                {{ $ujianDetail->file_name }}
                            </div>
                        </a>
                    @endif

                </div>
                <div id="additionalElements"
                    style="display: @if ($ujianDetail->jenis_soal_id == 1) none @else block @endif; margin-bottom: 30px; margin-top: 30px">
                    @if ($ujianDetail->ujian_detail_jenis_soal_id == 2)
                        @if ($ujianDetailPilgan->isEmpty())
                            @php $alphabet = range('a', 'd'); @endphp
                            @foreach ($alphabet as $letter)
                                <div class="input-com-full"
                                    style="display: flex; align-items: center; margin-right: 10px;">
                                    <label for="option{{ $letter }}"
                                        style="margin-right: 5px;">{{ strtoupper($letter) }}.</label>
                                    <input type="radio" id="option{{ $letter }}" name="options"
                                        value="{{ strtoupper($letter) }}"
                                        style="display: inline-block; margin-right: 5px;">
                                    <input type="text" id="option{{ $letter }}Description"
                                        name="option{{ $letter }}Description"
                                        placeholder="Description for Option {{ strtoupper($letter) }}"
                                        style="margin-right: 50px">
                                </div>
                            @endforeach
                        @else
                            @php $alphabet = range('a', 'd'); @endphp
                            @foreach ($ujianDetailPilgan as $detail)
                                @php
                                    $letter = $alphabet[$detail->no_jawaban - 1];
                                @endphp
                                <div class="input-com-full"
                                    style="display: flex; align-items: center; margin-right: 10px;">
                                    <label for="option{{ $letter }}"
                                        style="margin-right: 5px;">{{ strtoupper($letter) }}.</label>
                                    <input type="radio" id="option{{ $letter }}" name="options"
                                        value="{{ strtoupper($letter) }}"
                                        style="display: inline-block; margin-right: 5px;background-color: #e7e7e7;"
                                        disabled @if ($detail->is_jawaban_siswa == 1) checked @endif;>
                                    <input type="text" id="option{{ $letter }}Description"
                                        name="option{{ $letter }}Description"
                                        placeholder="Description for Option {{ strtoupper($letter) }}"
                                        style="margin-right: 50px;background-color: #e7e7e7; @if ($detail->is_jawaban == 1) text-decoration: underline;
                                    text-decoration-color: green; border:2px solid green; color: green; font-weight: bold; @endif"
                                        disabled value="{{ $detail->jawaban }}">
                                </div>
                            @endforeach
                        @endif
                    @elseif ($ujianDetail->ujian_detail_jenis_soal_id == 1)
                        <div class="input-com-full">
                            <label>Deskripsi Jawaban</label>
                            <textarea type="text" id="deskripsiJawaban" name="deskripsiJawaban" style="background-color: #e7e7e7;" disabled>{{ $ujianDetail->jawaban_deskripsi }}</textarea>
                        </div>
                    @endif
                    <input type="hidden" id="selectedOptions" name="selectedOptions" value="">
                </div>
            </div>
        </div>
    </main>

</body>
<div class="loading">
    <div class="center-body">
        <div class="loader-circle-11">
            <div class="arc"></div>
            <div class="arc"></div>
            <div class="arc"></div>
        </div>
    </div>
</div>
<div id="successOrFailedModal" class="modal">
    <div class="modal-content">
        <p id="successOrFailedText" class="ajax-label"></p>
        <p id="successOrFailedDescriptionText" class="ajax-label-description"></p>
        <button class="confirm-button" onclick="hideSuccessOrFailedModal()">Konnfirmasi</button>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    flatpickr("#dueDate", {
        dateFormat: "d M Y",
        minDate: "today",
    });

    flatpickr("#dueTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 30,
    });

    flatpickr("#submitDate", {
        dateFormat: "d M Y",
        minDate: "today",
    });

    flatpickr("#submitTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 30,
    });

    flatpickr("#submitDateUpd", {
        dateFormat: "d M Y",
        minDate: "today",
    });

    flatpickr("#submitTimeUpd", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 30,
    });

    document.addEventListener('DOMContentLoaded', function() {
        var jenisSoalId = -1;
        var jenis_soal = document.querySelectorAll('#jenis_soal');

        jenis_soal.forEach(function(element) {
            if (element.checked) {
                jenisSoalId = element.value;
            }
        });

        toggleAdditionalElements(jenisSoalId);

        document.querySelectorAll('input[name="jenis_soal"]').forEach(function(input) {
            input.addEventListener('change', function() {
                var selectedValue = this.value;
                toggleAdditionalElements(selectedValue);
            });
        });
    });

    function toggleAdditionalElements(selectedValue) {
        var additionalElements = document.getElementById('additionalElements');
        // if (selectedValue == 2) {
        additionalElements.style.display = 'block';
        // } else {
        // additionalElements.style.display = 'none';
        // }
    }



    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedDescriptionText").innerHTML != "") {
            location.reload();
        }
    }

    window.onclick = function(event) {
        if (event.target == successOrFailedModal) {
            hideSuccessOrFailedModal();
        }
    }
</script>
<style>
    #prevButton,
    #nextButton {
        cursor: pointer;
        color: black;
        border: none;
        background-color: transparent;
    }

    .tab th {
        border-bottom: 1px black solid;
    }

    .tab td {
        border-bottom: 1px black solid;
    }

    .tab tr>td {
        padding: 10px 0px;
    }

    .sort-icon {
        display: none;
        width: 12px;
        height: 12px;
        margin-left: 5px;
    }

    .disabled-link {
        color: inherit;
        text-decoration: none;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>
