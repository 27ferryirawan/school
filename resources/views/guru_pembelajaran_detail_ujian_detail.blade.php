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
            <input type="text" id="ujian" name="ujian" value="{{ $ujian->deskripsi }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full" style="width: 198.5px">
            <label>Tipe Ujian</label>
            <input type="text" id="tipeUjian" name="tipeUjian" value="{{ $ujian->jenis_ujian }}" disabled
                style="background-color: #e7e7e7;">
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
        <div class="input-com-full" style="display: flex; align-items: center; margin-bottom: 10px; margin-top: 20px">
            <label style="margin-right: 30px;">Soal</label>
            <div style="margin-right: 20px;">
                <button
                    style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                    id="updSaveButton" onclick="addData()">Tambah Soal</button>
            </div>
        </div>
        <div style="margin: 0px 60px 30px 60px; border: 1px solid black; padding: 10px;">
            <table id="table" class="tab" style="width: 100%" data-id={{ $ujian->id }}>
                <thead>
                    <tr>
                        <th style="width: 3%;" class="sortable" data-column="nomor">No
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 89%;" class="sortable" data-column="soal">Soal
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 8%; text-align: center">Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujianDetail as $data)
                        <tr class="tugas-row" style="margin: 10px;" data-id="{{ $data->id }}"
                            onclick="openJawabanDetail({{ $data->id }})">
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false" name='materi'>{{ $data->soal }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false"
                                        name='formatted_submit_date'>{{ $data->nomor }}</label>
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
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            onclick="deleteData({{ $ujian->id }})">Hapus</button>
    </div>
    <div style="margin-right: 20px;">
        <button
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton" onclick="openData({{ $ujian->id }})">Ubah</button>
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
        var updSaveButton = document.getElementById('updSaveButton');
        var ujian = document.getElementById('ujian');
        var tipeUjian = document.getElementById('tipeUjian');
        var kodeRuangan = document.getElementById('kodeRuangan');
        var waktuPengerjaan = document.getElementById('waktuPengerjaan');
        var date = document.getElementById('date');
        var time = document.getElementById('time');
        var defaultColor = '#ffffff';
        var disabledColor = '#e7e7e7';

        // Use '==' for comparison, not '=' which is for assignment
        if (updSaveButton.innerHTML == "Ubah") {
            // Correct the typo: 'dupdSaveButton' to 'updSaveButton'
            updSaveButton.innerHTML = "Simpan";
            ujian.disabled = false;
            tipeUjian.disabled = false;
            kodeRuangan.disabled = false;
            waktuPengerjaan.disabled = false;
            date.disabled = false;
            time.disabled = false;
            ujian.style.backgroundColor = defaultColor;
            tipeUjian.style.backgroundColor = defaultColor;
            kodeRuangan.style.backgroundColor = defaultColor;
            waktuPengerjaan.style.backgroundColor = defaultColor;
            date.style.backgroundColor = defaultColor;
            time.style.backgroundColor = defaultColor;
        } else {
            this.updateData(ujianId);
            updSaveButton.innerHTML = "Ubah";
            ujian.disabled = true;
            tipeUjian.disabled = true;
            kodeRuangan.disabled = true;
            waktuPengerjaan.disabled = true;
            date.disabled = true;
            time.disabled = true;
            ujian.style.backgroundColor = disabledColor;
            tipeUjian.style.backgroundColor = disabledColor;
            kodeRuangan.style.backgroundColor = disabledColor;
            waktuPengerjaan.style.backgroundColor = disabledColor;
            date.style.backgroundColor = disabledColor;
            time.style.backgroundColor = disabledColor;
        }
    }

    function updateData(ujianId) {
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
