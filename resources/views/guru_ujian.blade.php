<!DOCTYPE html>
<html>

<head>
    <title>Siswa</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="display: flex; justify-content: space-between;">
            <button class="plus-button" onclick="showAddModal()">+</button>
        </div>

        <div class="container">
            @foreach ($guruPembelajaran as $dataGuru_pembelajaran)
                <div class="item">
                    <div class="item-button" onclick="openNewPage()">
                        <div class="left-side">
                            <img src="{{ asset('images/class.png') }}" style="width: 80px; height: 80px">
                        </div>
                        <div class="right-side">
                            {{ $dataGuru_pembelajaran->nama_guru }} <br>
                            {{ $dataGuru_pembelajaran->mata_pelajaran }} <br>
                            {{ $dataGuru_pembelajaran->nama_kelas }}<br>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Tambah Pembelajaran</h2>
        <div class="modal-input">
            <div style="margin-right:10px">
                <label style="font-size: 17px; margin: 15px 0px 0px 3px">Nama Guru</label>
                <input type="text" name="namaGuru" id="namaGuru"
                    style="height: 35px; border: 1px black solid; margin: 0px 3px 0px 3px; background-color: #e7e7e7;"
                    value='{{ $guru->nama_guru }}' disabled>
            </div>
            <div style="margin-right:10px">
                <label style="font-size: 17px; margin: 15px 0px 0px 3px">Mata Pelajaran</label>
                <input type="text" name="mataPelajaran" id="mataPelajaran"
                    style="height: 35px; border: 1px black solid; margin: 0px 3px 0px 3px; background-color: #e7e7e7;"
                    value='{{ $guru->mata_pelajaran }}' disabled>
            </div>
            <div style="margin-right:10px">
                <label style="font-size: 17px; margin: 15px 0px 0px 3px">Kelas</label>
                <select id="kelas" name="kelas"
                    style="width: 100%; height: 35px; border: 1px black solid; margin: 0px 3px 45px 3px;">
                    @foreach ($kelas as $dataKelas)
                        <option value="" selected disabled hidden>

                        </option>
                        <option value="{{ $dataKelas['id'] }}">
                            {{ $dataKelas['nama_kelas'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="confirm-button"
            onclick="addPembelajaran('{{ $guru->guru_id }}', '{{ $guru->mata_pelajaran_id }}' , '{{ $guru->tahun_ajaran_id }}')">Tambah</button>
    </div>
</div>
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

    .left-side {
        width: 48%;
        margin-top: 15px;
        margin-left: 35px;
    }
</style>
