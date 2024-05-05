<!DOCTYPE html>
<html>

<head>
    <title>Pembelajaran</title>
    @include('layouts/siswa_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div class="container">
            @foreach ($guruPembelajaran as $dataGuru_pembelajaran)
                <div class="item">
                    <a href="/siswa-pembelajaran/{{ $dataGuru_pembelajaran->mata_pelajaran_id }}/detail"
                        class="item-button" style="text-decoration: none; color: black;">
                        <div class="left-side">
                            <img src="{{ asset('images/class.png') }}" style="width: 80%; height: 80px">
                        </div>
                        <div class="right-side">
                            <label>{{ substr(explode(' ', $dataGuru_pembelajaran->nama_guru)[0], 0, 10) }}</label> <br>
                            <label>{{ substr(explode(' ', $dataGuru_pembelajaran->mata_pelajaran)[0], 0, 10) }}</label>
                            <br>
                            <label>{{ substr($dataGuru_pembelajaran->nama_kelas, 0, 10) }}</label> <br>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
</body>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function hideSuccessOrFailedModal() {
        if (document.getElementById("successOrFailedText").innerHTML != "") {
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
        width: 70%;
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
        width: 48%;
        margin-top: 15px;
        margin-left: 45px;
        text-align: left;
    }

    .right-side label {
        width: 100%;
    }

    .left-side {
        width: 48%;
        margin-top: 15px;
        margin-left: 35px;
    }

    @media screen and (max-width: 1010px) {
        .left-side {
            width: 0%;
        }

        .right-side {
            width: 100%;
            font-size: 15px;
            margin-left: -48%;
            text-align: center;
            word-wrap: break-word;
        }

        .right-side label {
            width: 100%;
        }

    }
</style>
