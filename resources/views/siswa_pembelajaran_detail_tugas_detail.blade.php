<!DOCTYPE html>
<html>

<head>
    <title>Tugas</title>
    @include('layouts/siswa_navbar')
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
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <label>Tugas</label>
                <div class="input-com-full" style="margin: 0px; text-align: center">
                    <label><b>Nilai</b></label>
                    <input type="number" id="nilai" name="nilai"
                        style="width: 65px; margin-left: 10px; border: 1px solid black; background-color: #e7e7e7;"
                        min="0" max="100" oninput="validateInput()" value="{{ $tugasJawaban->nilai }}"
                        disabled>
                </div>
            </div>
            <input type="text" id="tugas" name="tugas" value="{{ $tugas->title }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full">
            <label>Deskripsi</label>
            <textarea type="text" id="deskripsi" name="deskripsi" disabled style="background-color: #e7e7e7;">{{ $tugas->description }}</textarea>
        </div>
        <div style="display: flex; align-items: center;">
            <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                <label for="fileInput" id="customFileButton" style="background-color: #e7e7e7;">Pilih fail</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()" disabled>
            </div>
            @if ($tugas->file_path == null)
                <div id="fileNameDisplay" style="margin-top: 13px">Tidak ada fail</div>
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
        <div class="input-com-full" style="margin-top: 0px">
            <label>Jawaban</label>
        </div>
        <div style="display: flex; justify-content: flex-start; align-items: center; margin: 0px 60px 0px 60px;">
            <div style="margin:
            0px 0px 30px 0px; border: 1px solid black; padding: 10px; width: 100%">
                <div class="input-com-full" style="margin-left: 0px; margin-right: 0px; margin-top: 0px">
                    <label>Deskripsi</label>
                    <textarea type="text" id="deskripsiJawaban" name="deskripsiJawaban" disabled style="background-color: #e7e7e7;">{{ $tugasJawaban ? $tugasJawaban->description : '' }}</textarea>
                </div>
                <div style="display: flex; align-items: center;">
                    <div enctype="multipart/form-data" style="margin-right: 20px;">
                        <label for="fileInputJawaban" id="customFileButtonJawaban"
                            style="background-color: #e7e7e7; font-size: 17px">Pilih fail</label>
                        <input type="file" id="fileInputJawaban" name="fileInputJawavan"
                            accept=".txt, .pdf, .docx, .png, .jpg" onchange="displayFileNameJawaban()" disabled>
                    </div>
                    @if ($tugasJawaban)
                        @if ($tugasJawaban->file_path == null)
                            <div id="fileNameDisplayJawaban" style="margin-top: 13px">Tidak ada fail</div>
                        @else
                            <a href="{{ asset('storage/' . $tugasJawaban->file_path) }}" target="_blank">
                                <div id="fileNameDisplayJawaban" style="margin-top: 13px; cursor: pointer;">
                                    {{ $tugasJawaban->file_name }}
                                </div>
                            </a>
                        @endif
                    @else
                        <div id="fileNameDisplayJawaban" style="margin-top: 13px">Tidak ada fail</div>
                    @endif
                </div>
                <div class="input-com-full date-input time-input"
                    style="margin-left: 0px; margin-right: 0px; display: flex; width: 275px">
                    <div style="margin-right: 15px">
                        <label>Hari Kumpul</label>
                        <input type="text" id="submitDate" name="submitDate"
                            value="{{ $tugasJawaban ? $tugasJawaban->formatted_submit_date : '' }}" disabled
                            style="background-color: #e7e7e7;">
                    </div>
                    <div style="display: column;">
                        <label>Jam Kumpul</label>
                        <input type="text" id="submitTime" name="submitTime"
                            value="{{ $tugasJawaban ? $tugasJawaban->formatted_submit_time : '' }}" disabled
                            style="background-color: #e7e7e7;">
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    @if (Carbon\Carbon::now()->gte(Carbon\Carbon::parse($tugas->due_date)) && $tugasJawaban->submit_date == null)
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" onclick="openData({{ $tugas->id }})">Isi Jawaban</button>
        </div>
    @else
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #e7e7e7; border: 3px solid black; color: black; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" disabled>Isi Jawaban</button>
        </div>
    @endif
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
        // maxDate: "today", 
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
        // maxDate: "today", 
        minDate: "today",
    });

    flatpickr("#submitTime", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 30,
    });

    function displayFileNameJawaban() {
        var fileInput = document.getElementById('fileInputJawaban');
        var fileNameDisplay = document.getElementById('fileNameDisplayJawaban');

        if (fileInput.files.length > 0) {
            var fileName = fileInput.files[0].name;
            fileNameDisplay.innerHTML = fileName;
        } else {
            fileNameDisplay.innerHTML = '';
        }
    }

    function openJawabanDetail(siswaId) {
        window.location.href = window.location.href + '/jawaban/' + siswaId
    }

    function openData(tugasId) {
        var updSaveButton = document.getElementById('updSaveButton');
        var deskripsi = document.getElementById('deskripsiJawaban');
        var defaultColor = '#ffffff';
        var disabledColor = '#e7e7e7';
        var customFileButton = document.getElementById('customFileButtonJawaban');
        var fileInput = document.getElementById('fileInputJawaban');

        if (updSaveButton.innerHTML == "Isi Jawaban") {
            updSaveButton.innerHTML = "Simpan";
            deskripsi.disabled = false;
            fileInput.disabled = false;
            dueDate.disabled = false;
            dueTime.disabled = false;
            deskripsi.style.backgroundColor = defaultColor;
            customFileButton.style.backgroundColor = defaultColor;
        } else {
            this.updateData(tugasId);
            updSaveButton.innerHTML = "Isi Jawaban";
            deskripsi.disabled = true;
            fileInput.disabled = true;
            dueDate.disabled = true;
            dueTime.disabled = true;
            deskripsi.style.backgroundColor = disabledColor;
            customFileButton.backgroundColor = disabledColor;
        }
    }

    function updateData(tugasId) {
        var fileInput = document.getElementById('fileInputJawaban');
        var formData = new FormData();
        if (fileInput.files.length > 0) {
            formData.append('file_path', fileInput.files[0]);
        }

        var urlString = window.location.href;
        var fileNameDisplay = document.getElementById('fileNameDisplayJawaban').innerHTML;
        const nameWithoutExtension = fileNameDisplay.split(".")[0];

        formData.append('id', tugasId);
        formData.append('description', document.getElementById('deskripsiJawaban').value);
        formData.append('file_name_no_ext', nameWithoutExtension);
        formData.append('file_name', fileNameDisplay);
        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token for Laravel

        $.ajax({
            type: 'POST',
            url: '/siswa-pembelajaran/detail/updateInsertTugasJawaban',
            data: formData,
            processData: false,
            contentType: false,
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

    function deleteData(id) {
        $.ajax({
            url: '/guru-pembelajaran/detail/deleteTugas',
            method: 'POST',
            data: {
                id: id,
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

    #fileInputJawaban {
        display: none;
    }

    #customFileButtonJawaban {
        background-color: white;
        color: black;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        text-align: center;
        border: 3px solid black;
        box-shadow: 5px 5px 5px black;
        width: 150px;
    }
</style>
