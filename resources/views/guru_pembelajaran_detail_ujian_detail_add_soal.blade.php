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
                        @if ($key === 0) disabled @endif
                        @if ($key === 1) checked @endif style="display: inline">
                    {{ $soal->jenis_soal }}
                </label>
                <br>
            @endforeach
        </div>
        <div class="input-com-full">
            <label>Deskripsi Soal</label>
            <textarea type="text" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <div style="display: flex; align-items: center; margin-bottom: 30px">
            <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                <label for="fileInput" id="customFileButton">Pilih fail soal</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()">
            </div>
            <div id="fileNameDisplay" style="margin-top: 13px">Tidak ada fail</div>
        </div>
        <div id="additionalElements" style="display: block; margin-bottom: 30px">
            @php $alphabet = range('a', 'd'); @endphp
            @foreach ($alphabet as $letter)
                <div class="input-com-full" style="display: flex; align-items: center; margin-right: 10px;">
                    <label for="option{{ $letter }}" style="margin-right: 5px;">{{ strtoupper($letter) }}.</label>
                    <input type="radio" id="option{{ $letter }}" name="options"
                        value="{{ strtoupper($letter) }}" style="display: inline-block; margin-right: 5px;">
                    <input type="text" id="option{{ $letter }}Description"
                        name="option{{ $letter }}Description"
                        placeholder="Description for Option {{ strtoupper($letter) }}" style="margin-right: 50px">
                </div>
            @endforeach
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
            id="updSaveButton" onclick="addData({{ $ujian->id }})">Tambah</button>
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>

<script>
    function getSelectedRadioButtonValue() {
        var radioButtons = document.getElementsByName('jenis_soal');

        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                return radioButtons[i].value;
            }
        }

        return null; // Return null if no radio button is selected
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

    function addData(ujianId) {
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

        formData.append('optionsAndDescriptions', JSON.stringify(optionsAndDescriptions));

        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/addUjianSoal',
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
        var jenisSoalId = document.getElementById("jenis_soal").value

        // toggleAdditionalElements(jenisSoalId);
        toggleAdditionalElements(2);

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
