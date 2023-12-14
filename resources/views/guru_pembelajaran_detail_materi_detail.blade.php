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
            <input type="text" id="materi" name="materi" value="{{ $materi->title }}" disabled
                style="background-color: #e7e7e7;">
        </div>
        <div class="input-com-full">
            <label>Deskripsi</label>
            <textarea type="text" id="deskripsi" name="deskripsi" disabled style="background-color: #e7e7e7;">{{ $materi->description }}</textarea>
        </div>
        <div style="display: flex; align-items: center;">
            <div class="input-com-full" enctype="multipart/form-data" style="margin: 10px 20px 0px 60px;">
                <label for="fileInput" id="customFileButton" style="background-color: #e7e7e7;">Choose
                    file</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()" disabled>
            </div>
            @if ($materi->file_path == null)
                <div id="fileNameDisplay" style="margin-top: 13px">No file chosen</div>
            @else
                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">
                    <div id="fileNameDisplay" style="margin-top: 13px; cursor: pointer;">
                        {{ $materi->file_name }}
                    </div>
                </a>
            @endif
        </div>
        <div style="display: flex; align-items: center; width: 100%;">
            <div class="input-com-full"
                style="position: relative; margin-bottom: 10px; width: 88.5%; margin-right: 5px;">
                <label>Komentar</label>
                <div id='commentsContainer'>
                    @foreach ($materiKomentar as $data)
                        @php
                            $siswaColors = $siswaColors ?? [];

                            // Iterate through the siswa data
                            // foreach ($siswaData as $data) {
                            // Get the color for the current siswa ID, or use a default color if not found
                            $siswaColor = $siswaColors[$data->siswa_id] ?? '#' . str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

                            // Assign the color to the siswa ID
                            $siswaColors[$data->siswa_id] = $siswaColor;
                            // }
                        @endphp
                        @if ($data->is_guru == 1)
                            <div style="display: flex; justify-content: flex-end; align-items: center;">
                                <div class="right-dynamic-div">
                                    <div class="quote quote-right"></div>
                                    <label class="rightDescriptionLabel">{{ $data->description }}</label>
                                    <label style="font-size: 12px"
                                        class="rightCreatedAtLabel">{{ $data->formatted_created_at }}</label>
                                </div>
                            </div>
                        @else
                            <div style="display: flex; justify-content: flex-start; align-items: center;">
                                <div class="left-dynamic-div">
                                    <div class="quote quote-left"></div>
                                    <label class="leftNameLabel" data-id="{{ $data->siswa_id }}"
                                        style="color: {{ $siswaColor }};">{{ $data->nama }}</label>
                                    <label class="leftDescriptionLabel">{{ $data->description }} </label>
                                    <label style="font-size: 12px"
                                        class="leftCreatedAtLabel">{{ $data->formatted_created_at }}</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div style="display: flex; justify-content: flex-start; align-items: center; margin-top: 30px">
                    <textarea id="commentInput" placeholder="Type your comment..." oninput="autoExpand(this)"></textarea>
                    <button id="clearButton" onclick="clearText()">
                        <img src="{{ asset('images/x.png') }}" style="width: 20px; height: 20px">
                    </button>
                    <button id="sendButton" onclick="sendKomentar({{ $materi->id }})">
                        <img src="{{ asset('images/send.png') }}"
                            style="width: 30px; height: 30px; margin-bottom: 10px">
                    </button>
                </div>

            </div>

        </div>
    </main>
    <footer style="display:flex; justify-content: flex-end; align-items:center; min-height:50px; margin-top: auto">
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                onclick="deleteData({{ $materi->id }})">Hapus</button>
        </div>
        <div style="margin-right: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                id="updSaveButton" onclick="openData({{ $materi->id }})">Ubah</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        adjustMinWidth();
    });

    window.addEventListener('resize', function() {
        adjustMinWidth();
    });

    function adjustMinWidth() {
        var rightDescriptionLabels = document.querySelectorAll('.right-dynamic-div .rightDescriptionLabel');
        rightDescriptionLabels.forEach(function(label) {
            var createdAtLabel = label.parentElement.querySelector('.rightCreatedAtLabel');
            var width = createdAtLabel.clientWidth;
            label.style.minWidth = width + 'px';
        });
    }
    var commentInput = document.getElementById('commentInput');

    // Add an event listener for the 'keydown' event
    commentInput.addEventListener('keydown', function(event) {
        // Check if the pressed key is Enter (keyCode 13) and Shift key is not pressed
        if (event.keyCode === 13 && !event.shiftKey) {
            // Prevent the default behavior of the Enter key
            event.preventDefault();

            // Trigger the click event for the Send button
            document.getElementById('sendButton').click();
        }
    });

    function addCommentToDOM(comment) {
        // Create HTML elements for the new comment
        var commentContainer = document.createElement('div');
        commentContainer.style.display = 'flex';
        commentContainer.style.justifyContent = 'flex-end';
        commentContainer.style.alignItems = 'center';

        var dynamicDiv = document.createElement('div');
        dynamicDiv.className = 'right-dynamic-div';

        var quoteDiv = document.createElement('div');
        quoteDiv.className = 'quote quote-right';

        var descriptionLabel = document.createElement('label');
        descriptionLabel.className = 'rightDescriptionLabel description';
        descriptionLabel.textContent = comment.description;

        var createdAtLabel = document.createElement('label');
        createdAtLabel.style.fontSize = '12px';
        createdAtLabel.className = 'rightCreatedAtLabel';
        createdAtLabel.textContent = comment.formatted_created_at;

        // Append elements to the DOM
        dynamicDiv.appendChild(quoteDiv);
        dynamicDiv.appendChild(descriptionLabel);
        dynamicDiv.appendChild(createdAtLabel);
        commentContainer.appendChild(dynamicDiv);

        // Get the existing comments container
        var commentsContainer = document.querySelector('#commentsContainer');

        // Append the new comment container to the existing comments container
        commentsContainer.appendChild(commentContainer);

        // Clear the comment input
        clearText();
        adjustMinWidth();
    }

    function autoExpand(textarea) {
        textarea.style.height = "auto";
        textarea.style.height = (textarea.scrollHeight) + "px";
    }

    function clearText() {
        var commentInput = document.getElementById('commentInput');
        commentInput.value = '';
        commentInput.style.height = "45px"; // Reset to initial height
    }

    function openData(materiId) {
        var updSaveButton = document.getElementById('updSaveButton');
        var materi = document.getElementById('materi');
        var deskripsi = document.getElementById('deskripsi');
        var defaultColor = '#ffffff';
        var disabledColor = '#e7e7e7';
        var customFileButton = document.getElementById('customFileButton');
        var fileInput = document.getElementById('fileInput');

        // Use '==' for comparison, not '=' which is for assignment
        if (updSaveButton.innerHTML == "Ubah") {
            // Correct the typo: 'dupdSaveButton' to 'updSaveButton'
            updSaveButton.innerHTML = "Simpan";
            materi.disabled = false;
            deskripsi.disabled = false;
            fileInput.disabled = false;
            materi.style.backgroundColor = defaultColor;
            deskripsi.style.backgroundColor = defaultColor;
            customFileButton.style.backgroundColor = defaultColor;
        } else {
            this.updateData(materiId);
            updSaveButton.innerHTML = "Ubah";
            materi.disabled = true;
            deskripsi.disabled = true;
            fileInput.disabled = true;
            materi.style.backgroundColor = disabledColor;
            deskripsi.style.backgroundColor = disabledColor;
            customFileButton.backgroundColor = disabledColor;
        }
    }

    function updateData(materiId) {
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

        formData.append('id', materiId);
        formData.append('title', document.getElementById('materi').value);
        formData.append('description', document.getElementById('deskripsi').value);
        formData.append('guru_pembelajaran_id', id);
        formData.append('file_name_no_ext', nameWithoutExtension);
        formData.append('file_name', fileNameDisplay);
        formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token for Laravel

        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/updateMateri',
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
            url: '/guru-pembelajaran/detail/deleteMateri',
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

    function sendKomentar(id) {
        var komentar = document.getElementById('commentInput').value;
        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/detail/addKomentar', // Replace with the actual route of your controller function
            data: {
                '_token': '{{ csrf_token() }}', // Include CSRF token for Laravel
                'materi_id': id,
                'description': komentar,
            },
            beforeSend: function() {
                $('.loading').show();
            },
            success: function(response) {
                addCommentToDOM(response.data);
            },
            error: function(xhr, status, error) {
                document.getElementById("successOrFailedText").innerHTML = response.message;
                document.getElementById("successOrFailedDescriptionText").innerHTML = response
                    .message_description;
            },
            complete: function() {
                $('.loading').hide();
                // successOrFailedModal.style.display = "block";
                // document.body.style.overflow = "hidden";
            }
        });
    }


    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedDescriptionText").innerHTML == "Mengubah Materi Berhasil!") {
            location.reload();
        } else {
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/materi-detail');
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
    #commentInput {
        resize: none;
        overflow: hidden;
        transition: height 0.3s;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin-bottom: 10px;
        height: 45px;
    }

    #clearButton {
        position: absolute;
        bottom: 19px;
        right: 55px;
        cursor: pointer;
        font-size: 25px;
        color: black;
        border: none;
        padding: 5px 10px;
        display: none;
        font-weight: bold;
        background-color: white;
    }

    #sendButton {
        cursor: pointer;
        font-size: 25px;
        color: black;
        border: none;
        padding: 5px 10px;
        font-weight: bold;
        background-color: white;
    }

    #commentInput:not(:placeholder-shown)+#clearButton {
        display: block;
    }

    .quote {
        width: 0;
        height: 0;
        border-style: solid;
        position: absolute;
        pointer-events: none;
    }

    .quote-left {
        border-width: 10px 15px 10px 0;
        border-color: transparent #202d33 transparent transparent;
        left: -15px;
    }

    .quote-right {
        border-width: 10px 0 10px 15px;
        border-color: transparent transparent transparent #85a9a0;
        right: -15px;
    }

    /* Update the style for left-dynamic-div and right-dynamic-div */
    .left-dynamic-div,
    .right-dynamic-div {
        display: flex;
        flex-direction: column;
        position: relative;
        background-color: #E2E2E2;
        /* Add background color as needed */
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .right-dynamic-div {
        align-items: flex-end;
        background-color: #85a9a0;
        color: white;

    }

    .left-dynamic-div {
        align-items: flex-start;
        background-color: #202d33;
        color: white;
    }

    /* Update the style for label elements */
    .left-dynamic-div .leftDescriptionLabel {
        margin-left: 10px;
        margin-right: 0;
        white-space: pre-wrap;
        text-align: left;
    }

    .leftNameLabel {
        margin-left: 10px;
        margin-right: 0;
    }

    .right-dynamic-div .rightDescriptionLabel {
        margin-right: 10px;
        margin-left: 0;
        white-space: pre-wrap;
        text-align: left;
    }

    .left-dynamic-div .leftCreatedAtLabel {
        margin-left: 10px;
        white-space: nowrap;
    }

    .right-dynamic-div .rightCreatedAtLabel {
        margin-right: 10px;
        white-space: nowrap;
    }
</style>
