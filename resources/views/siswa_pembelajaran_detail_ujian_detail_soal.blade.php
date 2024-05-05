<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/siswa_navbar')
</head>

<body>
    <main>
        <div id="timer">
        </div>
        <div style="display: flex; justify-content: flex-start; align-items: center;">
            <div style="width: 100%">
                <div class="input-com-full">
                    <label>Deskripsi Soal</label>
                    <textarea type="text" id="deskripsi" name="deskripsi" style="background-color: #e7e7e7;" disabled>{{ $ujianDetail->soal }}</textarea>
                </div>
                <div style="display: flex; align-items: center;">
                    <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 40px;">
                        <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                            onchange="displayFileName()" disabled>
                    </div>
                    @if ($ujianDetail->file_path == null)
                        <a href="{{ asset('storage/' . $ujianDetail->file_path) }}" target="_blank" id="fileLink"
                            class="disabled-link" style="cursor: not-allowed">
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
                                        style="display: inline-block; margin-right: 5px;"
                                        onclick="updateSelectedOption({{ $detail->id }})">
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
                                        style="display: inline-block; margin-right: 5px;"
                                        @if ($detail->is_jawaban_siswa == 1) checked @endif;
                                        onclick="updateSelectedOption({{ $detail->id }})">
                                    <input type="text" id="option{{ $letter }}Description"
                                        name="option{{ $letter }}Description"
                                        placeholder="Description for Option {{ strtoupper($letter) }}"
                                        style="margin-right: 50px; border: none; background: none" disabled
                                        value="{{ $detail->jawaban }}">
                                </div>
                            @endforeach
                        @endif
                    @elseif ($ujianDetail->ujian_detail_jenis_soal_id == 1)
                        <div class="input-com-full">
                            <label>Deskripsi Jawaban</label>
                            <textarea type="text" id="deskripsiJawaban" name="deskripsiJawaban">{{ $ujianDetail->jawaban_deskripsi }}</textarea>
                        </div>
                    @endif
                    <input type="hidden" id="selectedOptions" name="selectedOptions" value="">
                    <input type="hidden" id="selectedUjianDetailPilganid" name="selectedUjianDetailPilganid"
                        value="">
                </div>
            </div>
        </div>
    </main>
</body>
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    <div style="margin-right: 20px;">
        <button
            style="width: 155px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton"
            onclick="saveData({{ $ujianJawaban->id }}, {{ $ujianDetail->ud_ujian_detail_id }})">Simpan
            Jawaban</button>
    </div>
</footer>
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
    var ujianJenisSoal = {{ $ujianDetail->ujian_detail_jenis_soal_id }};
    var jawabanPilganId = {{ $ujianJawaban->ujian_detail_pilgan_id ?? 'null' }};

    window.onload = function() {
        // Replace 'ujianDetailPilganidValue' with the actual value you want to set
        var ujianDetailPilganidValue = jawabanPilganId;
        updateSelectedOption(ujianDetailPilganidValue);
    };

    function updateSelectedOption(ujianDetailPilganid) {
        document.getElementById('selectedUjianDetailPilganid').value = ujianDetailPilganid;
    }


    function saveData(ujianJawabanId, ujianDetailId) {
        if (ujianJenisSoal == 2) {
            var jawabanUjianDetailPilganId = document.getElementById('selectedUjianDetailPilganid').value;
            var deskripsiJawaban = null;
        } else {
            var jawabanUjianDetailPilganId = null;
            var deskripsiJawaban = document.getElementById('deskripsiJawaban').value;
        }

        $.ajax({
            url: '/siswa-pembelajaran/detail/updateInsertUjianJawaban',
            method: 'POST',
            data: {
                ujian_jawaban_id: ujianJawabanId,
                ujian_detail_id: ujianDetailId,
                jawaban_ujian_detail_pilgan_id: jawabanUjianDetailPilganId,
                jawaban_deskripsi: deskripsiJawaban,
                jenis_soal_id: ujianJenisSoal,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                // document.getElementById("successOrFailedText").innerHTML = response.message;
                // document.getElementById("successOrFailedDescriptionText").innerHTML = response
                //     .message_description;
                var currentUrl = window.location.href;
                var position = currentUrl.lastIndexOf('/soal');
                var newUrl = currentUrl.substring(0, position);
                window.location.href = newUrl;
            },
            error: function(xhr, status, error) {
                // document.getElementById("successOrFailedText").innerHTML = response.message;
                // document.getElementById("successOrFailedDescriptionText").innerHTML = response
                //     .message_description;
            },
            complete: function() {
                $('.loading').hide();
                // successOrFailedModal.style.display = "block";
                // document.body.style.overflow = "hidden";
            }
        });
    }


    var tanggalUjian = "{{ $ujian->tanggal_ujian }}";
    var waktuPengerjaan = {{ $ujian->waktu_pengerjaan }};

    var targetDate = new Date(tanggalUjian);
    targetDate.setMinutes(targetDate.getMinutes() + waktuPengerjaan);

    var timerInterval = setInterval(function() {
        var currentDate = new Date().getTime();
        var timeDifference = targetDate - currentDate;

        var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        var totalMinutes = days * 24 * 60 + hours * 60 + minutes;

        $("#timer").html(totalMinutes + " menit dan " + seconds + " detik tersisa");

        if (timeDifference <= 0) {
            clearInterval(timerInterval);
            $("#timer").html("Waktu Habis");

            saveData({{ $ujianJawaban->id }});
        }
    }, 1000);


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
        additionalElements.style.display = 'block';
    }

    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedDescriptionText").innerHTML != "") {
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/soal');
            var newUrl = currentUrl.substring(0, position);
            window.location.href = newUrl;
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

    #timer {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0px 10px 60px;
    }
</style>
