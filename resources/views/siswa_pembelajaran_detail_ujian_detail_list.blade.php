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
        <div style="margin: 0px 60px 30px 60px; border: 1px solid black; padding: 10px;">
            <table id="table" class="tab" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 3%;" class="sortable" data-column="nomor">No
                            <img class="sort-icon" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 89%;" class="sortable" data-column="soal">Soal
                            <img class="sort-icon" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 8%; text-align: center">Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujianDetail as $data)
                        <tr class="tugas-row" style="margin: 10px;" data-id="{{ $data->id }}"
                            onclick="openSoalDetail({{ $data->id }})">
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false"
                                        name='formatted_submit_date'>{{ $data->row_num }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false" name='materi'>{{ $data->soal }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: center;">
                                <img style=" width: 20px; height: 20px;"
                                    src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending" data-order="asc">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        <button
            style="width: 155px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton" onclick="saveData({{ $ujianJawaban->id }})">Selesaikan
            Ujian</button>
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    var tanggalUjian = "{{ $ujian->tanggal_ujian }}";
    var waktuPengerjaan = {{ $ujian->waktu_pengerjaan }};

    function saveData(ujianJawabanId) {

        $.ajax({
            url: '/siswa-pembelajaran/detail/finishUjian',
            method: 'POST',
            data: {
                ujian_jawaban_id: ujianJawabanId,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                document.getElementById("successOrFailedText").innerHTML = response.message;
                document.getElementById("successOrFailedDescriptionText").innerHTML = response
                    .message_description;
            },
            error: function(xhr, status, error) {
                // document.getElementById("successOrFailedText").innerHTML = response.message;
                // document.getElementById("successOrFailedDescriptionText").innerHTML = response
                //     .message_description;
            },
            complete: function() {
                $('.loading').hide();
                successOrFailedModal.style.display = "block";
                document.body.style.overflow = "hidden";
            }
        });
    }

    function saveDataTimeOut(ujianJawabanId) {

        $.ajax({
            url: '/siswa-pembelajaran/detail/finishUjian',
            method: 'POST',
            data: {
                ujian_jawaban_id: ujianJawabanId,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                document.getElementById("successOrFailedText").innerHTML = "Waktu Habis!";
                document.getElementById("successOrFailedDescriptionText").innerHTML = "Jawaban sudah dikumpulkan";
            },
            error: function(xhr, status, error) {
                // document.getElementById("successOrFailedText").innerHTML = response.message;
                // document.getElementById("successOrFailedDescriptionText").innerHTML = response
                //     .message_description;
            },
            complete: function() {
                $('.loading').hide();
                successOrFailedModal.style.display = "block";
                document.body.style.overflow = "hidden";
            }
        });
    }

    // Combine tanggalUjian and waktuPengerjaan to create the targetDate
    var targetDate = new Date(tanggalUjian);
    targetDate.setMinutes(targetDate.getMinutes() + waktuPengerjaan);

    var timerInterval = setInterval(function() {
        var currentDate = new Date().getTime();
        var timeDifference = targetDate - currentDate;

        var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        // Convert days and hours to minutes
        var totalMinutes = days * 24 * 60 + hours * 60 + minutes;

        $("#timer").html(totalMinutes + " menit dan " + seconds + " detik tersisa");

        if (timeDifference <= 0) {
            clearInterval(timerInterval);
            $("#timer").html("Waktu Habis");

            saveDataTimeOut({{ $ujianJawaban->id }});
        }
    }, 1000);

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

    function openSoalDetail(soalId) {
        window.location.href = window.location.href + '/soal/' + soalId
    }

    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedDescriptionText").innerHTML != "") {
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/soal-list');
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

    #timer {
        font-size: 24px;
        font-weight: bold;
        margin: 10px 0px 10px 60px;
    }
</style>
