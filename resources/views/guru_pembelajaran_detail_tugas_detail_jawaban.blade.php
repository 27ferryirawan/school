<!DOCTYPE html>
<html>

<head>
    <title>Pembelajaran</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main>
        <div
            style="display: flex; justify-content: flex-start; align-items: center; min-height: 50px; margin-top: auto; background-color: #2EAEE1; font-weight: bold; font-size: 18px;">
            <div style="width: 25%; display: flex; justify-content: center">
                <img src="{{ asset('images/class.png') }}" style="width: 80px; height: 80px">
            </div>

            <label style="width: 25%; display: flex; justify-content: center">{{ $guruPembelajaran->nama_guru }}</label>
            <label
                style="width: 25%; display: flex; justify-content: center">{{ $guruPembelajaran->mata_pelajaran }}</label>
            <label style="width: 25%; display: flex; justify-content: center">{{ $guruPembelajaran->nama_kelas }}</label>
        </div>
        <div class="input-com-full">
            <label>tugas</label>
            <input type="text" id="tugas" name="tugas" value="{{ $tugas->title }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full">
            <label>Deskripsi</label>
            <textarea type="text" id="deskripsi" name="deskripsi" disabled style="background-color: #e7e7e7;">{{ $tugas->description }}</textarea>
        </div>
        <div style="display: flex; align-items: center;">
            <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                <label for="fileInput" id="customFileButton" style="background-color: #e7e7e7;">Pilih
                    fail</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()" disabled>
            </div>
            @if ($tugas->file_path == null)
                <div id="fileNameDisplay" style="margin-top: 13px">No file chosen</div>
            @else
                <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank">
                    <div id="fileNameDisplay" style="margin-top: 13px; cursor: pointer;">
                        {{ $tugas->file_name }}
                    </div>
                </a>
            @endif
        </div>
        <div class="input-com-full date-input time-input" style="margin-bottom: 30px; width: 130px">
            <label>Hari Tenggat</label>
            <input type="text" id="dueDate" name="dueDate" value="{{ $tugas->formatted_due_date }}" disabled
                style="background-color: #e7e7e7;">
            <label>Jam Tenggat</label>
            <input type="text" id="dueTime" name="dueTime" value="{{ $tugas->formatted_due_time }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full" style="display: flex; align-items: center; margin-bottom: 10px;">
            <label style="margin-right: 30px;">Jawaban <b id="namaSiswa">{{ $tugasJawaban->nama_siswa }}</b></label>
            <div class="input-com-full" style="margin: 0px; text-align: center">
                <label><b>Nilai</b></label>
                <input type="number" id="nilai" name="nilai" style="width: 65px;" min="0" max="100"
                    oninput="validateInput()" value="{{ $tugasJawaban->nilai }}">
            </div>
        </div>
        <div style="display: flex; justify-content: flex-start; align-items: center;">
            <button id="prevButton" onclick="loadData('prev')" style="width: 60px;">
                <img src="{{ asset('images/left.png') }}" style="width: 40px; height: 40px">
            </button>
            <div style="margin:
            0px 0px 30px 0px; border: 1px solid black; padding: 10px; width: 100%">
                <div class="input-com-full" style="margin-left: 0px; margin-right: 0px; margin-top: 0px">
                    <label>Deskripsi</label>
                    <textarea type="text" id="deskripsiJawaban" name="deskripsiJawaban" disabled style="background-color: #e7e7e7;">{{ $tugasJawaban->description }}</textarea>
                </div>
                <div style="display: flex; align-items: center;">
                    <div>
                        <div class="input-com-full" style="margin: 0px;">
                            <label>Fail</label>
                        </div>
                        @if ($tugas->file_path == null)
                            <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank" id="fileLink"
                                class="disabled-link" style="cursor: not-allowed">
                                <div id="fileNameDisplayJawaban" style="cursor: pointer;">Tidak ada fail
                                </div>
                            </a>
                        @else
                            <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank" id="fileLink">
                                <div id="fileNameDisplayJawaban" style="cursor: pointer;">
                                    {{ $tugas->file_name }}
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="input-com-full date-input time-input"
                    style="margin-left: 0px; margin-right: 0px; display: flex; width: 275px">
                    <div style="margin-right: 15px">
                        <label>Hari Kumpul</label>
                        <input type="text" id="submitDate" name="submitDate"
                            value="{{ $tugasJawaban->formatted_submit_date_date }}" disabled
                            style="background-color: #e7e7e7;">
                    </div>
                    <div style="display: column;">
                        <label>Jam Kumpul</label>
                        <input type="text" id="submitTime" name="submitTime"
                            value="{{ $tugasJawaban->formatted_submit_date_time }}" disabled
                            style="background-color: #e7e7e7;">
                    </div>
                </div>
            </div>
            <button id="nextButton" onclick="loadData('next')" style="width: 60px;">
                <img src="{{ asset('images/right.png') }}" style="width: 40px; height: 40px">
            </button>
        </div>
    </main>

</body>
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    <div style="margin-right: 20px;">
        <button
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton" data-id="{{ $tugasJawaban->id }}" onclick="saveData()">Simpan Nilai</button>
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
    var siswa_id = {{ $tugasJawaban->siswa_id }}
    var tugas_id = {{ $tugas->id }}
    var tugas_jawaban_id = $('#updSaveButton').data('id')

    function loadData(direction) {
        var url = '/guru-pembelajaran/detail/getNextPrevTugasJawaban';
        var data = {
            tugas_id: tugas_id,
            siswa_id: siswa_id,
            direction: direction,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                if (response.success) {
                    updateUI(response.data);
                } else {
                    console.error('Failed to fetch data');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax request failed');
            },
            complete: function() {
                $('.loading').hide();
            }
        });
    }

    function updateUI(data) {
        siswa_id = data.siswa_id;
        tugas_jawaban_id = data.id;
        // document.getElementById('updSaveButton').setAttribute('data-id', '123');
        document.getElementById('namaSiswa').innerHTML = data.nama_siswa;
        document.getElementById('nilai').value = data.nilai;
        document.getElementById('deskripsiJawaban').value = data.description;

        if (data.file_name == null) {
            document.getElementById('fileNameDisplayJawaban').innerHTML = "Tidak ada fail"
            document.getElementById('fileLink').classList.add('disabled-link');
            document.getElementById('fileLink').removeAttribute('href'); // Removes the href attribute
            document.getElementById('fileLink').style.cursor = 'not-allowed';
        } else {
            document.getElementById('fileNameDisplayJawaban').innerHTML = data.file_name;
            document.getElementById('fileLink').classList.remove('disabled-link');
            document.getElementById('fileLink').setAttribute('href',
                '{{ asset('storage/' . $tugas->file_path) }}');
            document.getElementById('fileLink').style.cursor = 'allowed';
        }

        document.getElementById('submitDate').value = data.formatted_submit_date_date;
        document.getElementById('submitTime').value = data.formatted_submit_date_time;

        document.getElementById('updSaveButton').setAttribute('onclick', 'saveData(' + null +
            ')');

    }

    function validateInput() {
        var inputElement = document.getElementById('nilai');
        var value = parseFloat(inputElement.value);

        if (isNaN(value) || value < 0) {
            inputElement.value = 0;
        } else if (value > 100) {
            inputElement.value = 100;
        } else {

        }
    }

    function openJawabanDetail(id) {
        window.location.href = window.location.href + '/tugas-detail/' + id
    }

    function saveData() {
        var nilai = parseFloat(document.getElementById('nilai').value).toFixed(2);
        $.ajax({
            url: '/guru-pembelajaran/detail/updateTugasNilai',
            method: 'POST',
            data: {
                id: tugas_jawaban_id,
                nilai: nilai,
                tugas_id: tugas_id,
                siswa_id: siswa_id,
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
        /* Set the desired text color */
        text-decoration: none;
        /* Remove underline */
        cursor: not-allowed;
        /* Change cursor to not-allowed */
    }
</style>
