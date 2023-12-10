<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    @include('layouts/admin_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="display: flex;">
            <div>
                <div class="input-com">
                    <label>NIP</label>
                    <input type="text" id="nip" name="nip">
                </div>
                <div class="input-com">
                    <label>Nama Guru</label>
                    <input type="text" id="namaGuru" name="namaGuru">
                </div>
                <div class="input-com">
                    <label>Jenis Kelamin</label>
                    <select class="dropdown" name="jenis-kelamin-dropdown" id="jenisKelamin">
                        <option value="" selected disabled hidden>

                        </option>
                        <option value="L">
                            Laki-Laki
                        </option>
                        <option value="P">
                            Perempuan
                        </option>
                    </select>
                </div>
                <div class="input-com">
                    <label>Tempat Lahir</label>
                    <input type="text" id="tempatLahir" name="tempatLahir">
                </div>
                <div class="date-input">
                    <label>Tanggal Lahir</label>
                    <input type="text" id="tanggalLahir" name="tanggalLahir">
                </div>
            </div>
            <div class="reserve-div">
                <div class="input-com">
                    <label>Agama</label>
                    <select class="dropdown" name="agama-dropdown" id="agama">
                        <option value="" selected disabled hidden>

                        </option>
                        <option value="Buddha">
                            Buddha
                        </option>
                        <option value="Hindu">
                            Hindu
                        </option>
                        <option value="Islam">
                            Islam
                        </option>
                        <option value="Katolik">
                            Katolik
                        </option>
                        <option value="Khonghucu">
                            Khonghucu
                        </option>
                        <option value="Kristen">
                            Kristen
                        </option>
                    </select>
                </div>
                <div class="input-com">
                    <label>Mata Pelajaran</label>
                    <select class="dropdown" name="matapelajaran-dropdown" id="mataPelajaran">
                        <option value="" selected disabled hidden>
                        </option>
                        @foreach ($mataPelajaran as $dataMataPelajaran)
                            <option value="{{ $dataMataPelajaran['id'] }}">
                                {{ $dataMataPelajaran['mata_pelajaran'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-com">
                    <label>Tahun Ajaran</label>
                    <select class="dropdown" name="tahun-ajaran-dropdown" id="tahunAjaran">
                        <option value="" selected disabled hidden>

                        </option>
                        @foreach ($tahunAjaran as $dataTahunAjaran)
                            <option value="{{ $dataTahunAjaran['id'] }}">
                                {{ $dataTahunAjaran['tahun_ajaran'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-com">
                    <label>Username</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="input-com">
                    <label>Password</label>
                    <input type="password" id="password" name="password">
                </div>
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
        var nip = $('#nip').val();
        var namaGuru = $('#namaGuru').val();
        var jenisKelamin = $('#jenisKelamin').val();
        var tempatLahir = $('#tempatLahir').val();
        var tanggalLahir = $('#tanggalLahir').val();
        var agama = $('#agama').val();
        var mataPelajaran = $('#mataPelajaran').val();
        var tahunAjaran = $('#tahunAjaran').val();
        var username = $('#username').val();
        var password = $('#password').val();

        // Menyusun data untuk dikirimkan ke server
        var requestData = {
            nip: nip,
            nama_guru: namaGuru,
            jenis_kelamin: jenisKelamin,
            tempat_lahir: tempatLahir,
            tanggal_lahir: tanggalLahir,
            agama: agama,
            mata_pelajaran_id: mataPelajaran,
            tahun_ajaran_id: tahunAjaran,
            username: username,
            password: password,
            _token: '{{ csrf_token() }}'
        };

        // Melakukan permintaan AJAX
        $.ajax({
            url: '{{ route('admin-guru.addGuru') }}',
            method: 'POST',
            data: requestData,
            dataType: 'json',
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
            window.location.href = window.location.href.replace('/add', '');
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
