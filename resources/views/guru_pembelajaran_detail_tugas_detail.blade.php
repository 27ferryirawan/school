<!DOCTYPE html>
<html>

<head>
    <title>Tugas</title>
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
            <label>Tugas</label>
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
        <div class="input-com-full">
            <label>Jawaban</label>
        </div>
        <div style="margin: 0px 60px 30px 60px; border: 1px solid black; padding: 10px;">
            <table id="table" class="tab" style="width: 100%" data-id={{ $guruPembelajaran->id }}>
                <thead>
                    <tr>
                        <th style="width: 80%;" class="sortable" data-column="title">Siswa
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                data-order="asc">
                        </th>
                        <th style="width: 12%;" class="sortable" data-column="created_at">Tanggal Kumpul
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                data-order="asc">
                        </th>
                        <th style="width: 8%; text-align: center">Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugasJawaban as $data)
                        <tr class="tugas-row" style="margin: 10px;" data-id="{{ $data->id }}"
                            onclick="openJawabanDetail({{ $data->siswa_id_siswa }})">
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false" name='materi'>{{ $data->nama_siswa }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false"
                                        name='formatted_submit_date'>{{ $data->formatted_submit_date }}</label>
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

</body>
<footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
    <div style="margin-right: 20px;">
        <button
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            onclick="deleteData({{ $tugas->id }})">Hapus</button>
    </div>
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

    function openJawabanDetail(siswaId) {
        window.location.href = window.location.href + '/jawaban/' + siswaId
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
        if (document.getElementById("successOrFailedDescriptionText").innerHTML == "Mengubah Tugas Berhasil!") {
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
