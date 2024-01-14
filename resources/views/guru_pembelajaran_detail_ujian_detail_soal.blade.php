<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main>
        <div class="input-com-full">
            <label>Tipe Soal</label>
            @foreach ($jenisSoal as $key => $soal)
                <label style="display: inline">
                    <input type="radio" name="jenis_soal" id="jenis_soal" value="{{ $soal->id }}"
                        @if ($ujianDetail->jenis_soal_id == $soal->id) checked @endif style="display: inline"
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
                <div id="fileNameDisplay" style="margin-top: 13px">No file chosen</div>
            @else
                <a href="{{ asset('storage/' . $ujianDetail->file_path) }}" target="_blank">
                    <div id="fileNameDisplay" style="margin-top: 13px; cursor: pointer;">
                        {{ $ujianDetail->file_name }}
                    </div>
                </a>
            @endif

        </div>
        <div id="additionalElements"
            style="display: @if ($ujianDetail->jenis_soal_id == 1) none @else block @endif; margin-bottom: 30px; margin-top: 30px">
            @if ($ujianDetailPilgan->isEmpty())
                @php $alphabet = range('a', 'd'); @endphp
                @foreach ($alphabet as $letter)
                    <div class="input-com-full" style="display: flex; align-items: center; margin-right: 10px;">
                        <label for="option{{ $letter }}"
                            style="margin-right: 5px;">{{ strtoupper($letter) }}.</label>
                        <input type="radio" id="option{{ $letter }}" name="options"
                            value="{{ strtoupper($letter) }}" style="display: inline-block; margin-right: 5px;">
                        <input type="text" id="option{{ $letter }}Description"
                            name="option{{ $letter }}Description"
                            placeholder="Description for Option {{ strtoupper($letter) }}" style="margin-right: 50px">
                    </div>
                @endforeach
            @else
                @php $alphabet = range('a', 'd'); @endphp
                @foreach ($ujianDetailPilgan as $detail)
                    @php
                        $letter = $alphabet[$detail->no_jawaban - 1];
                    @endphp
                    <div class="input-com-full" style="display: flex; align-items: center; margin-right: 10px;">
                        <label for="option{{ $letter }}"
                            style="margin-right: 5px;">{{ strtoupper($letter) }}.</label>
                        <input type="radio" id="option{{ $letter }}" name="options"
                            value="{{ strtoupper($letter) }}"
                            style="display: inline-block; margin-right: 5px;background-color: #e7e7e7;" disabled
                            @if ($detail->is_jawaban == 1) checked @endif;>
                        <input type="text" id="option{{ $letter }}Description"
                            name="option{{ $letter }}Description"
                            placeholder="Description for Option {{ strtoupper($letter) }}"
                            style="margin-right: 50px;background-color: #e7e7e7;" disabled
                            value="{{ $detail->jawaban }}">
                    </div>
                @endforeach
            @endif
            <input type="hidden" id="selectedOptions" name="selectedOptions" value="">
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
            onclick="deleteData({{ $ujianDetail->id }})">Hapus</button>
    </div>
    <div style="margin-right: 20px;">
        <button
            style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
            id="updSaveButton" onclick="openData({{ $ujianDetail->id }}, {{ $ujianDetail->ujian_id }})">Ubah</button>
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>

<script>
    function openData(ujianDetailId, ujianId) {
        var updSaveButton = document.getElementById('updSaveButton');
        var jenis_soal = document.querySelectorAll('#jenis_soal');
        var deskripsi = document.getElementById('deskripsi');
        var defaultColor = '#ffffff';
        var disabledColor = '#e7e7e7';
        var customFileButton = document.getElementById('customFileButton');
        var fileInput = document.getElementById('fileInput');

        if (updSaveButton.innerHTML == "Ubah") {
            updSaveButton.innerHTML = "Simpan";
            deskripsi.disabled = false;
            fileInput.disabled = false;
            deskripsi.style.backgroundColor = defaultColor;
            customFileButton.style.backgroundColor = defaultColor;

            @php $alphabet = range('a', 'd'); @endphp
            @foreach ($ujianDetailPilgan as $detail)
                @php
                    $letter = $alphabet[$detail->no_jawaban - 1];
                @endphp
                var radio = document.getElementById('option{{ $letter }}');
                var description = document.getElementById('option{{ $letter }}Description');

                radio.style.backgroundColor = defaultColor;
                description.style.backgroundColor = defaultColor;
                radio.disabled = false;
                description.disabled = false;
            @endforeach

            jenis_soal.forEach(function(element) {
                element.disabled = false;
                element.style.backgroundColor = defaultColor;
            });
        } else {
            this.updateData(ujianDetailId, ujianId);
            updSaveButton.innerHTML = "Ubah";
            deskripsi.disabled = true;
            fileInput.disabled = true;
            deskripsi.style.backgroundColor = disabledColor;
            customFileButton.backgroundColor = disabledColor;

            @php $alphabet = range('a', 'd'); @endphp
            @foreach ($ujianDetailPilgan as $detail)
                @php
                    $letter = $alphabet[$detail->no_jawaban - 1];
                @endphp
                var radio = document.getElementById('option{{ $letter }}');
                var description = document.getElementById('option{{ $letter }}Description');

                radio.style.backgroundColor = disabledColor;
                description.style.backgroundColor = disabledColor;
                radio.disabled = true;
                description.disabled = true;
            @endforeach

            jenis_soal.forEach(function(element) {
                element.disabled = true;
                element.style.backgroundColor = disabledColor;
            });
        }
    }

    function pushArray() {
        var alphabet = ['a', 'b', 'c', 'd'];
        var optionsAndDescriptions = [];

        for (var i = 0; i < alphabet.length; i++) {
            var radioId = 'option' + alphabet[i];
            var descriptionId = 'option' + alphabet[i] + 'Description';

            var optionValue = document.getElementById(radioId).checked ? 1 : 0;
            var descriptionValue = document.getElementById(descriptionId).value;

            optionsAndDescriptions.push({
                option: optionValue,
                description: descriptionValue
            });
        }

        return optionsAndDescriptions;
    }

    function getSelectedRadioButtonValue() {
        var radioButtons = document.getElementsByName('jenis_soal');

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                return radioButtons[i].value;
            }
        }

        return null; // Return null if no radio button is selected
    }


    function updateData(ujianDetailId, ujianId) {
        var formData = new FormData();
        var fileInput = document.getElementById('fileInput');
        var optionsAndDescriptions = pushArray();
        if (fileInput.files.length > 0) {
            formData.append('file_path', fileInput.files[0]);
        }

        var fileNameDisplay = document.getElementById('fileNameDisplay').innerHTML;
        const nameWithoutExtension = fileNameDisplay.split(".")[0];

        formData.append('ujian_id', ujianId);
        formData.append('jenis_soal_id', getSelectedRadioButtonValue());
        formData.append('deskripsi', document.getElementById('deskripsi').value);
        formData.append('file_name_no_ext', nameWithoutExtension);
        formData.append('file_name', fileNameDisplay);
        formData.append('ujian_detail_id', ujianDetailId);
        if (getSelectedRadioButtonValue())
            formData.append('optionsAndDescriptions', JSON.stringify(optionsAndDescriptions));

        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/updateUjianSoal',
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
        if (selectedValue == 2) {
            additionalElements.style.display = 'block';
        } else {
            additionalElements.style.display = 'none';
        }
    }

    function deleteData(ujianDetailId) {
        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/deleteUjianSoal',
            data: {
                id: ujianDetailId,
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
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/soal/');
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
</style>
