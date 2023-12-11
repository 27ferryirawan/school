<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="display: flex;">
            <div>
                <div class="input-com">
                    <label>Pilih Ujian</label>
                    <select class="dropdown" name="jenisUjian-dropdown" id="jenisUjian">
                        <option value="" selected disabled hidden>

                        </option>
                        @foreach ($jenisUjian as $dataJenisUjian)
                            <option value="{{ $dataJenisUjian['id'] }}">
                                {{ $dataJenisUjian['jenis_ujian'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-com">
                    <label>Kelas</label>
                    <select class="dropdown" name="kelas-dropdown" id="kelas">
                        <option value="" selected disabled hidden>

                        </option>
                        @foreach ($kelas as $dataKelas)
                            <option value="{{ $dataKelas['id'] }}">
                                {{ $dataKelas['nama_kelas'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-com">
                    <label>Kode Ruangan</label>
                    <input type="text" id="kodeRuangan" name="kodeRuangan">
                </div>
                <div class="input-com">
                    <label>Nama Guru</label>
                    <input type="text" id="namaGuru" name="namaGuru" value='{{ $guru->nama_guru }}' disabled
                        style="background-color: #e7e7e7;">
                </div>
                <div class="input-com">
                    <label>Mata Pelajaran</label>
                    <input type="text" id="mataPelajaran" name="mataPelajaran" value='{{ $guru->mata_pelajaran }}'
                        disabled style="background-color: #e7e7e7;">
                </div>
                <div class="input-com">
                    <label>Waktu Pengerjaan</label>
                    <div style="display: flex; align-items: center; width: 200%;">
                        <input type="text" id="waktuPengerjaan" name="waktuPengerjaan" style="width: 89%;">
                        <label for="waktuPengerjaan" style="margin-left: 10px; width: 5%;">menit</label>
                    </div>
                </div>
            </div>
            <div class="reserve-div">

            </div>
        </div>
    </main>
    <footer style="display: flex; justify-content: flex-end; align-items: center; min-height: 50px; margin-top: auto">
        <div style="display: flex; justify-content: center; align-items: center; margin-left: 20px;">
            <button
                style="width: 125px; height: 35px; background-color: white; border: 3px solid black;  color: #03549b; box-shadow: 5px 5px 5px black; font-size: 18px;"
                onclick="addData()">Tambah</button>
        </div>
    </footer>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    flatpickr("#tanggalLahir", {
        dateFormat: "Y-m-d",
        maxDate: "today",
    });

    function addData() {
        // Mengumpulkan data dari formulir
        // var nisn = $('#nisn').val();
        // var namaSiswa = $('#namaSiswa').val();
        // var jenisKelamin = $('#jenisKelamin').val();
        // var tempatLahir = $('#tempatLahir').val();
        // var tanggalLahir = $('#tanggalLahir').val();
        // var agama = $('#agama').val();
        // var kelas = $('#kelas').val();
        // var tahunAjaran = $('#tahunAjaran').val();
        // var username = $('#username').val();
        // var password = $('#password').val();

        // // Menyusun data untuk dikirimkan ke server
        // var requestData = {
        //     nisn: nisn,
        //     nama_siswa: namaSiswa,
        //     jenis_kelamin: jenisKelamin,
        //     tempat_lahir: tempatLahir,
        //     tanggal_lahir: tanggalLahir,
        //     agama: agama,
        //     kelas_id: kelas,
        //     tahun_ajaran_id: tahunAjaran,
        //     username: username,
        //     password: password,
        //     _token: '{{ csrf_token() }}'
        // };

        // $.ajax({
        //     url: '{{ route('admin-siswa.addSiswa') }}',
        //     method: 'POST',
        //     data: requestData,
        //     dataType: 'json',
        //     beforeSend: function() {
        //         $('.loading').show();
        //     },
        //     success: function(response) {
        //         document.getElementById("successOrFailedText").innerHTML = response.message;
        //         document.getElementById("successOrFailedDescriptionText").innerHTML = response
        //             .message_description;
        //     },
        //     error: function(xhr, status, error) {
        //         document.getElementById("successOrFailedText").innerHTML = response.message;
        //         document.getElementById("successOrFailedDescriptionText").innerHTML = response
        //             .message_description;
        //     },
        //     complete: function() {
        //         $('.loading').hide();
        //         successOrFailedModal.style.display = "block";
        //         document.body.style.overflow = "hidden";
        //     }
        // });
    }

    function hideSuccessOrFailedModal() {
        // if (document.getElementById("successOrFailedText").innerHTML != "") {
        //     window.location.href = window.location.href.replace('/add', '');
        // }
    }

    window.onclick = function(event) {
        // if (event.target == successOrFailedModal) {
        //     hideSuccessOrFailedModal();
        // }
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
