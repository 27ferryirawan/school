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
            <label style="margin-right: 30px;">Jawaban <b>{{ $tugasJawaban->nama_siswa }}</b></label>
            <div class="input-com-full" style="margin: 0px; text-align: center">
                <label><b>Nilai</b></label>
                <input type="number" id="nilai" name="nilai" style="width: 55px;" min="0" max="100"
                    oninput="validateInput()">
            </div>
        </div>

        <div style="margin: 0px 60px 30px 60px; border: 1px solid black; padding: 10px;">
            <div class="input-com-full" style="margin-left: 0px; margin-right: 0px; margin-top: 0px">
                <label>Deskripsi</label>
                <textarea type="text" id="deskripsi" name="deskripsi" disabled style="background-color: #e7e7e7;">{{ $tugasJawaban->description }}</textarea>
            </div>
            <div style="display: flex; align-items: center;">
                <div>
                    <div class="input-com-full" style="margin: 0px;">
                        <label>Fail</label>
                    </div>
                    @if ($tugas->file_path == null)
                        <div id="fileNameDisplay">Tidak ada fail
                        </div>
                    @else
                        <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank">
                            <div id="fileNameDisplay" style="cursor: pointer;">
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
                    <input type="text" id="submitDate" name="submitDate" value="{{ $tugas->formatted_due_date }}"
                        disabled style="background-color: #e7e7e7;">
                </div>
                <div style="display: column;">
                    <label>Jam Kumpul</label>
                    <input type="text" id="submitTime" name="submitTime" value="{{ $tugas->formatted_due_time }}"
                        disabled style="background-color: #e7e7e7;">
                </div>
            </div>
            <div class="input-com-full date-input time-input"
                style="margin-left: 0px; margin-right: 0px; display: flex; width: 275px">
                <div style="margin-right: 15px">
                    <label>Hari Ubah</label>
                    <input type="text" id="submitDateUpd" name="submitDateUpd"
                        value="{{ $tugas->formatted_due_date }}" disabled style="background-color: #e7e7e7;">
                </div>
                <div style="display: column;">
                    <label>Jam Ubah</label>
                    <input type="text" id="submitTimeUpd" name="submitTimeUpd"
                        value="{{ $tugas->formatted_due_time }}" disabled style="background-color: #e7e7e7;">
                </div>
            </div>

        </div>
    </main>

</body>
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    <div style="margin-right: 20px;">
        <button
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton" onclick="openData({{ $tugas->id }})">Ubah</button>
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

    flatpickr("#submitDateUpd", {
        dateFormat: "d M Y",
        // maxDate: "today", 
        minDate: "today",
    });

    flatpickr("#submitTimeUpd", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 30,
    });

    function validateInput() {
        var inputElement = document.getElementById('nilai');
        var value = parseInt(inputElement.value);

        // Ensure the value is within the range of 0 to 100
        if (isNaN(value) || value < 0) {
            inputElement.value = 0;
        } else if (value > 100) {
            inputElement.value = 100;
        }
    }

    function openJawabanDetail(id) {
        window.location.href = window.location.href + '/tugas-detail/' + id
    }

    function openData(tugasId) {
        var updSaveButton = document.getElementById('updSaveButton');
        var tugas = document.getElementById('tugas');
        var deskripsi = document.getElementById('deskripsi');
        var defaultColor = '#ffffff';
        var disabledColor = '#e7e7e7';
        var customFileButton = document.getElementById('customFileButton');
        var fileInput = document.getElementById('fileInput');
        var dueDate = document.getElementById('dueDate');
        var dueTime = document.getElementById('dueTime');

        // Use '==' for comparison, not '=' which is for assignment
        if (updSaveButton.innerHTML == "Ubah") {
            // Correct the typo: 'dupdSaveButton' to 'updSaveButton'
            updSaveButton.innerHTML = "Simpan";
            tugas.disabled = false;
            deskripsi.disabled = false;
            fileInput.disabled = false;
            dueDate.disabled = false;
            dueTime.disabled = false;
            tugas.style.backgroundColor = defaultColor;
            deskripsi.style.backgroundColor = defaultColor;
            customFileButton.style.backgroundColor = defaultColor;
            dueDate.style.backgroundColor = defaultColor;
            dueTime.style.backgroundColor = defaultColor;
        } else {
            this.updateData(tugasId);
            updSaveButton.innerHTML = "Ubah";
            tugas.disabled = true;
            deskripsi.disabled = true;
            fileInput.disabled = true;
            dueDate.disabled = true;
            dueTime.disabled = true;
            tugas.style.backgroundColor = disabledColor;
            deskripsi.style.backgroundColor = disabledColor;
            customFileButton.backgroundColor = disabledColor;
            dueDate.style.backgroundColor = disabledColor;
            dueTime.style.backgroundColor = disabledColor;
        }
    }

    function updateData(tugasId) {
        var fileInput = document.getElementById('fileInput');
        var formData = new FormData();
        if (fileInput.files.length > 0) {
            formData.append('file_path', fileInput.files[0]);
        }

        var urlString = window.location.href;
        var parts = urlString.split('/');
        var id = parts[parts.indexOf('guru-pembelajaran') + 1];
        var fileNameDisplay = document.getElementById('fileNameDisplay').innerHTML;
        var dueDate = document.getElementById('dueDate').value;
        var dueTime = document.getElementById('dueTime').value;
        const nameWithoutExtension = fileNameDisplay.split(".")[0];

        formData.append('id', tugasId);
        formData.append('title', document.getElementById('tugas').value);
        formData.append('description', document.getElementById('deskripsi').value);
        formData.append('guru_pembelajaran_id', id);
        formData.append('file_name_no_ext', nameWithoutExtension);
        formData.append('file_name', fileNameDisplay);
        formData.append('due_date', dueDate + ' ' + dueTime);
        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token for Laravel

        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/updateTugas',
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
        if (document.getElementById("successOrFailedDescriptionText").innerHTML == "Mengubah tugas Berhasil!") {
            location.reload();
        } else {
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/tugas-detail');
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
</style>
