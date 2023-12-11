<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="display: flex; justify-content: space-between;">
            <button class="plus-button" onclick="goToAddPage()">+</button>
        </div>

        <div class="container">
            @foreach ($ujian as $dataUjian)
                <div class="item">
                    <div class="item-button" onclick="openNewPage()">
                        <div class="left-side">
                            <img src="{{ asset('images/exam.png') }}" style="width: 80px; height: 80px">
                        </div>
                        <div class="right-side">
                            {{ $dataUjian->deskripsi }} <br>
                            {{ $dataUjian->nama_kelas }} <br>
                            {{ $dataUjian->mata_pelajaran }}<br>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    const addModal = document.getElementById("addModal");

    function addPembelajaran(guruId, mataPelajaranId, tahunAjaranId) {
        kelasId = document.getElementById("kelas").value;
        $.ajax({
            type: 'POST',
            url: '/guru-pembelajaran/addPembelajaran', // Replace with the actual route of your controller function
            data: {
                '_token': '{{ csrf_token() }}', // Include CSRF token for Laravel
                'guru_id': guruId,
                'kelas_id': kelasId,
                'tahun_ajaran_id': tahunAjaranId,
                'mata_pelajaran_id': mataPelajaranId,
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

    function showAddModal() {
        addModal.style.display = "block";
        addModal.style.overflow = "hidden";
        document.body.style.overflow = "hidden";
    }

    function hideDownloadModal() {
        addModal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedText").innerHTML != "") {
            location.reload();
        }
    }

    function goToAddPage() {
        window.location.href = window.location.href + '/add'
    }

    window.onclick = function(event) {
        if (event.target == addModal) {
            hideDownloadModal();
        }
        if (event.target == successOrFailedModal) {
            hideSuccessOrFailedModal();
        }
    }
</script>

<style>
    .plus-button {
        background-color: #2EAEE1;
        color: black;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        cursor: pointer;
        font-size: 18px;
        margin-left: auto;
        /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        margin: 20px 0px 0px 66px;
    }

    .item .item-button {
        height: 120px;
        border: 3px solid black;
        box-shadow: 5px 5px 5px black;
        border-radius: 10px;
        font-size: 18px;
        width: 90%;
        display: flex;
        justify-content: space-between;
        background-color: #2EAEE1;
    }

    .item {
        width: 33.3%;
        padding: 10px;
        box-sizing: border-box;
        text-align: center;
    }

    .right-side {
        width: 68%;
        margin-top: 15px;
        margin-left: 25px;
        text-align: left;
    }

    .left-side {
        width: 28%;
        margin-top: 15px;
        margin-left: 25px;
    }
</style>
