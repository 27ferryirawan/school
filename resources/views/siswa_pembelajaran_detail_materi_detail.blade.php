<!DOCTYPE html>
<html>

<head>
    <title>Materi</title>
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
                <label for="fileInput" id="customFileButton" style="background-color: #e7e7e7;">Pilih
                    fail</label>
                <input type="file" id="fileInput" name="fileInput" accept=".txt, .pdf, .docx, .png, .jpg"
                    onchange="displayFileName()" disabled>
            </div>
            @if ($materi->file_path == null)
                <div id="fileNameDisplay" style="margin-top: 13px">Tidak ada fail</div>
            @else
                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank">
                    <div id="fileNameDisplay" style="margin-top: 13px; cursor: pointer;">
                        {{ $materi->file_name }}
                    </div>
                </a>
            @endif

        </div>
        <div class="input-com-full">
            <label>Komentar</label>
        </div>
        <div
            style="display: flex; align-items: center; margin: 0px 60px 0px 60px; border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black;">
            <div class="input-com-full"
                style="position: relative; margin-bottom: 10px; width: 100%; margin: 10px 25px 0px 25px;">
                <div id='commentsContainer'>
                    @foreach ($materiKomentar as $data)
                        @php
                            $siswaColors = $siswaColors ?? [];
                            $siswaColor = $siswaColors[$data->siswa_id] ?? '#' . str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

                            $siswaColors[$data->siswa_id] = $siswaColor;
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
            </div>
        </div>
        <div
            style="display: flex; justify-content: flex-start; align-items: center; margin: 0px 60px 30px 60px; border: 1px solid black; padding: 10px 10px 0px 10px;">
            <div style="position: relative; width: 100%">
                <textarea id="commentInput" placeholder="Type your comment..." oninput="autoExpand(this)"></textarea>
                <button id="clearButton" onclick="clearText()" style="position: absolute; top: 5px; right: 5px;">
                    <img src="{{ asset('images/x.png') }}" style="width: 20px; height: 20px">
                </button>
            </div>
            <button id="sendButton" onclick="sendKomentar({{ $materi->id }})">
                <img src="{{ asset('images/send.png') }}" style="width: 30px; height: 30px; margin-bottom: 12px">
            </button>
        </div>
    </main>
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

    commentInput.addEventListener('keydown', function(event) {
        if (event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();

            document.getElementById('sendButton').click();
        }
    });

    function addCommentToDOM(comment) {
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



    function sendKomentar(id) {
        var komentar = document.getElementById('commentInput').value;
        $.ajax({
            type: 'POST',
            url: '/siswa-pembelajaran/detail/addKomentar', // Replace with the actual route of your controller function
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
            var newUrl = currentUrl.substring(0, position + 2);
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
        background-color: transparent;
    }

    #sendButton {
        cursor: pointer;
        font-size: 25px;
        color: black;
        border: none;
        padding: 5px 10px;
        font-weight: bold;
        /* background-color: white; */
        background-color: transparent;
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
        margin-left: 2.5px;
        margin-right: 0;
        white-space: pre-wrap;
        text-align: left;
    }

    .leftNameLabel {
        margin-left: 2.5px;
        margin-right: 0;
    }

    .right-dynamic-div .rightDescriptionLabel {
        margin-right: 2.5px;
        margin-left: 0;
        white-space: pre-wrap;
        text-align: left;
    }

    .left-dynamic-div .leftCreatedAtLabel {
        margin-left: 2.5px;
        white-space: nowrap;
    }

    .right-dynamic-div .rightCreatedAtLabel {
        margin-right: 2.5px;
        white-space: nowrap;
    }
</style>
