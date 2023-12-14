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
            <label>Materi</label>
            <input type="text" id="materi" name="materi">
        </div>
        <div class="input-com-full">
            <label>Deskripsi</label>
            <textarea type="text" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <div style="display: flex; align-items: center;">
            <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                <label for="fileInput" id="customFileButton">Choose file</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()">
            </div>
            <div id="fileNameDisplay" style="margin-top: 13px">No file chosen</div>
        </div>
    </main>
    <footer
        style="position: absolute; bottom: 0; right: 0; left: 0; display: flex; justify-content: flex-end; align-items: center; min-height: 50px;">
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                onclick="addData()">Tambah</button>
        </div>
    </footer>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function addData() {
        var fileInput = document.getElementById('fileInput');
        var formData = new FormData();
        if (fileInput.files.length > 0) {
            formData.append('file_path', fileInput.files[0]);
        }

        var urlString = window.location.href;
        var parts = urlString.split('/');
        var id = parts[parts.indexOf('guru-pembelajaran') + 1];
        var fileNameDisplay = document.getElementById('fileNameDisplay').innerHTML;
        const nameWithoutExtension = fileNameDisplay.split(".")[0];

        formData.append('title', document.getElementById('materi').value);
        formData.append('description', document.getElementById('deskripsi').value);
        formData.append('guru_pembelajaran_id', id);
        formData.append('file_name_no_ext', nameWithoutExtension);
        formData.append('file_name', fileNameDisplay);
        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token for Laravel

        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/addMateri',
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
        if (document.getElementById("successOrFailedText").innerHTML != "") {
            var url = window.location.href;;
            var substring = url.substring(0, url.lastIndexOf('/materi'));
            window.location.href = substring
        }
    }

    window.onclick = function(event) {
        if (event.target == successOrFailedModal) {
            hideSuccessOrFailedModal();
        }
    }
</script>

<style>

</style>
