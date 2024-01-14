<!DOCTYPE html>
<html>

<head>
    <title>Ujian</title>
    @include('layouts/guru_navbar')
</head>

<body>
    <main>
        <div class="input-com-full" style="display: flex; align-items: center; margin-bottom: 10px;">
            <label style="margin-right: 30px;">Jawaban <b id="namaSiswa">{{ $siswa->nama_siswa }}</b></label>
            <div class="input-com-full" style="margin: 0px; text-align: center">
                <label><b>Nilai</b></label>
                <input type="number" id="nilai" name="nilai" style="width: 65px;" min="0" max="100"
                    oninput="validateInput()" value="{{ $ujianJawaban->nilai ?? '' }}">
            </div>
        </div>
        <div style="margin: 10px 60px 30px 60px; border: 1px solid black; padding: 10px;">
            <table id="table" class="tab" style="width: 100%" data-id={{ $ujian->id }}>
                <thead>
                    <tr>
                        <th style="width: 3%;" class="sortable" data-column="nomor">No
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 74%;" class="sortable" data-column="soal">Soal
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 10%;" class="sortable" data-column="jenis_soal">Jenis Soal
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 5%;" class="sortable" data-column="benar_salah">Benar/Salah
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 8%; text-align: center">Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujianDetail as $data)
                        <tr class="tugas-row" style="margin: 10px;" data-id="{{ $data->id }}"
                            onclick="openSoalDetail({{ $data->id }})">
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false"
                                        name='formatted_submit_date'>{{ $data->row_num }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false" name='materi'>{{ $data->soal }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: left;">
                                <div class="editable-com" style="margin-right:10px">
                                    <label contenteditable="false"
                                        name='materi'>{{ $data->deskripsi_jenis_soal }}</label>
                                </div>
                            </td>
                            <td style="position: relative; text-align: center;">
                                @if ($data->ujian_detail_jenis_soal_id == 2)
                                    @if ($data->is_benar !== null)
                                        @if ($data->is_benar)
                                            <img src="{{ asset('images/check.png') }}"
                                                style="width: 30px; height: 30px">
                                        @else
                                            <img src="{{ asset('images/cross.png') }}"
                                                style="width: 30px; height: 30px">
                                        @endif
                                    @else
                                        <img src="{{ asset('images/cross.png') }}" style="width: 30px; height: 30px">
                                    @endif
                                @endif
                            </td>
                            <td style="position: relative; text-align: center;">
                                <img style=" width: 20px; height: 20px;"
                                    src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending" data-order="asc">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
            id="updSaveButton"
            onclick="saveData('{{ $ujianJawaban->id ?? 0 }}','{{ $ujian->id ?? 0 }}','{{ $siswa->id ?? 0 }}')">Simpan
            Nilai</button>
    </div>
</footer>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function openSoalDetail(soalId) {
        window.location.href = window.location.href + '/soal/' + soalId
    }

    function validateInput() {
        var inputElement = document.getElementById('nilai');
        var value = parseFloat(inputElement.value);

        if (isNaN(value) || value < 0) {
            inputElement.value = 0;
        } else if (value > 100) {
            inputElement.value = 100;
        } else {

        }
    }

    function saveData(ujianJawabanId, ujianId, siswaId) {
        var nilai = parseFloat(document.getElementById('nilai').value).toFixed(2);

        var inputElement = document.getElementById('nilai');
        $.ajax({
            url: '/guru-pembelajaran/detail/updateNilaiUjian',
            method: 'POST',
            data: {
                nilai: nilai,
                ujian_id: ujianId,
                siswa_id: siswaId,
                id: ujianJawabanId,
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
        if (document.getElementById("successOrFailedDescriptionText").innerHTML == "Mengubah Ujian Berhasil!") {
            location.reload();
        } else {
            var currentUrl = window.location.href;
            var position = currentUrl.lastIndexOf('/ujian-detail');
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

    .tab th {
        border-bottom: 1px black solid;
    }

    .tab td {
        border-bottom: 1px black solid;
    }

    .tab tr>td {
        padding: 10px 0px;
    }

    .sort-icon {
        display: none;
        width: 12px;
        height: 12px;
        margin-left: 5px;
    }
</style>
