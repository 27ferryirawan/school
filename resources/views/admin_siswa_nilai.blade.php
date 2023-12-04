<!DOCTYPE html>
<html>

<head>
    <title>Nilai</title>
    @include('layouts/admin_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <table id="siswa-table" class="siswa-tab" style="width: 100%;">
            <thead>
                <tr>
                    <th style="width: 21%;" class="sortable" data-column="nisn">NISN
                        <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                    </th>
                    <th style="width: 14%;" class="sortable" data-column="nama_siswa">Nama Siswa
                        <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                    </th>
                    <th style="width: 17%;" class="sortable" data-column="nama_kelas">Kelas
                        <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                    </th>
                    <th style="width: 17%;" class="sortable" data-column="nilai">Nilai
                        <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                    </th>
                    <th style="width: 17%;" class="sortable" data-column="tahun_ajaran">Tahun Ajaran
                        <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                    </th>
                    <th style="width: 14%;; text-align: center">Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaNilai as $data)
                    <tr class="siswa-row" style="margin: 10px;" data-resid="{{ $data->id }}"
                        data-siswaid="{{ $data->siswa_id }}" data-kelasid="{{ $data->kelas_id }}"
                        data-tahunajaranid="{{ $data->tahun_ajaran_id }}"
                        data-matapelajaranid="{{ $data->mata_pelajaran_id }}">
                        <td style="position: relative; text-align: left;">
                            <div style="margin-right:10px">
                                <label name='nisn'>{{ $data->NISN }}</label>
                            </div>
                        </td>
                        <td style="position: relative; text-align: left;">
                            <div style="margin-right:10px">
                                <label name='nama-siswa'>{{ $data->nama_siswa }}</label>
                            </div>
                        </td>
                        <td style="position: relative; text-align: left;">
                            <div style="margin-right:10px">
                                <label name='kelas'>{{ $data->nama_kelas }}</label>
                            </div>
                        </td>
                        <td style="position: relative; text-align: left;">
                            <div class="editable-com" style="margin-right:10px">
                                <label contenteditable="false" name='nilai'
                                    onblur="validateLabel(this)">{{ $data->nilai }}</label>
                                <img class="editable-icon" src="{{ asset('images/draw.png') }}">
                            </div>
                        </td>
                        <td style="position: relative; text-align: left;">
                            <div style="margin-right:10px">
                                <label name='tahun-ajaran'>{{ $data->tahun_ajaran }}</label>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="checkbox"
                                    style="width: 20px; height: 20px; border-radius: 5px; background-color: #392A23; border: none; color: white"
                                    data-resid="{{ $data->id }}" data-tabid="{{ $data->table_id }}"
                                    onclick="checkBox(this)">
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <footer style="display: flex; justify-content: flex-end; align-items: center; min-height: 50px; margin-top: auto">
        <div style="display: flex; justify-content: center; align-items: center; margin-right: auto;">
            <button
                style="width: 125px; height: 35px; background-color: #888888; border: 3px solid black;  color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                onclick="cancelEditDelete(this)" disabled>Batal</button>
        </div>
        <div style="display: flex; justify-content: center; align-items: center;">
            <button
                style="width: 125px; height: 35px; background-color: #888888; border: 3px solid black;  color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                onclick="editData(this)" data-editing="false" disabled>Ubah</button>
        </div>
    </footer>
    <div id="saveModal" class="modal">
        <div class="modal-content">
            <h2>Perbaharui Data</h2>
            <p>Apakah anda yakin ingin memperbaharui data?</p>
            <button class="confirm-button" onclick="updateData()">Konfirmasi</button>
            <button class="cancel-button" onclick="hideModal()">Batal</button>
        </div>
    </div>
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Menghapus Data</h2>
            <p>Apakah anda yakin ingin menghapus data?</p>
            <button class="confirm-button" onclick="confirmDeleteData()">Konfirmasi</button>
            <button class="cancel-button" onclick="hideDeleteModal()">Batal</button>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function validateLabel(label) {
        // Get the label content (assuming it contains a numeric value)
        var labelContent = parseFloat(label.textContent);

        // Check if the label content is a valid number
        if (isNaN(labelContent) || !isFinite(labelContent)) {
            alert("Please enter a valid number.");
            // You may choose to revert the label content to its original value
            // or take appropriate action based on your requirements.
            return;
        }

        // Check if the label content is between 0 and 100
        if (labelContent < 0 || labelContent > 100) {
            alert("Please enter a number between 0 and 100.");
            // You may choose to revert the label content to its original value
            // or take appropriate action based on your requirements.
        }
    }
    const modal = document.getElementById("saveModal");
    const deleteModal = document.getElementById("deleteModal");
    $(document).ready(function() {
        $('.siswa-tab th.sortable').on('click', function() {
            var column = $(this).data('column');
            var order = $(this).data('order') == null ? 'asc' : $(this).data('order');
            var icon = $(this).find('img.sort-icon');

            $('.siswa-tab th.sortable img.sort-icon').removeAttr('style');
            icon.css('display', 'inline');

            if (order === 'asc') {
                icon.attr('src', '{{ asset('images/desc.png') }}');
                $(this).data('order', 'desc');
            } else {
                icon.attr('src', '{{ asset('images/asc.png') }}');
                $(this).data('order', 'asc');
            }

            const [kelasId, mataPelajaranId] = window.location.pathname.split('/').slice(-2);

            $.ajax({
                url: '{{ route('admin-nilai.sort') }}',
                method: 'GET',
                data: {
                    kelasId: kelasId,
                    mataPelajaranId: mataPelajaranId,
                    column: column,
                    order: order
                },
                success: function(data) {
                    $('#siswa-table tbody').replaceWith($(data).find('tbody'));
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });

    var selectedIds = [];

    function checkCheckBoxUpdateButton() {
        var isChecked = $('input[type="checkbox"]:checked').length > 0;
        $('button[onclick="editData(this)"]').prop('disabled', !isChecked);
        $('button[onclick="editData(this)"]').css('background-color', isChecked ? '#d9251c' : '#888888');
        $('button[onclick="deleteData(this)"]').prop('disabled', !isChecked);
        $('button[onclick="deleteData(this)"]').css('background-color', isChecked ? '#d9251c' : '#888888');
    }

    function checkBox(checkbox) {
        var resid = $(checkbox).data('resid');
        var tabid = $(checkbox).data('tabid');

        if (checkbox.checked) {
            selectedIds.push(resid);
        } else {
            var index = selectedIds.indexOf(resid);
            if (index !== -1) {
                selectedIds.splice(index, 1);
            }
        }
        checkCheckBoxUpdateButton()
    }
    var selectedRowsData = [];

    function saveEditData() {
        $('input[type="checkbox"]:checked').each(function() {
            var row = $(this).closest('tr');

            var rowData = {
                'nilai': row.find('label[name="nilai"]').text(),
                'id': row.data('resid'),
                'siswa_id': row.data('siswaid'),
                'kelas_id': row.data('kelasid'),
                'tahun_ajaran_id': row.data('tahunajaranid'),
                'mata_pelajaran_id': row.data('matapelajaranid'),
            };

            selectedRowsData.push(rowData);
        });

        $.ajax({
            url: '{{ route('admin-nilai.bulkUpdate') }}',
            method: 'POST',
            data: {
                rowsData: selectedRowsData,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function cancelEditDelete(button) {
        $('label[contenteditable][name="nilai"]').attr('contenteditable', false);
        $('input[type="checkbox"]').prop('checked', false);
        button.innerText = 'Batal';
        selectedIds.length = 0;
        $('button[onclick="deleteData(this)"]').prop('disabled', false);
        $('button[onclick="deleteData(this)"]').css('background-color', '#d9251c')
        $('div.editable-com').css('border-bottom', '');
        $('option').prop('disabled', true);
        $('select').css('pointer-events', 'none');
        $('button[onclick="editData(this)"]').text('Ubah');

        $('button[onclick="cancelEditDelete(this)"]').prop('disabled', true);
        $('button[onclick="cancelEditDelete(this)"]').css('background-color', '#888888')

        $('img.editable-icon').css('display', 'none');
        $('input[type="checkbox"]').prop('disabled', false);
        checkCheckBoxUpdateButton()
    }

    function editData(button) {
        var isEditMode = $(this).data('editing')

        if (!isEditMode) {
            selectedIds.forEach(function(resid) {
                var row = $('tr[data-resid="' + resid + '"]');
                row.find('label[contenteditable][name="nilai"]').attr('contenteditable', true);
                row.find('.editable-com').css('border-bottom', '1px solid black');
                row.find('option').prop('disabled', false);
                row.find('select').css('pointer-events', 'auto');

                $('tr[data-resid="' + resid + '"] img.editable-icon').css('display', 'inline-block');
            });

            button.innerText = 'Simpan';
            $('button[onclick="deleteData(this)"]').prop('disabled', true);
            $('button[onclick="deleteData(this)"]').css('background-color', '#888888')

            $('button[onclick="cancelEditDelete(this)"]').prop('disabled', false);
            $('button[onclick="cancelEditDelete(this)"]').css('background-color', '#d9251c')

            $('input[type="checkbox"]').prop('disabled', true);
        } else {
            modal.style.display = "block";
            document.body.style.overflow = "hidden";
        }

        $(this).data('editing', !isEditMode);
    }

    function hideModal() {
        modal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    function hideDeleteModal() {
        deleteModal.style.display = "none";
        document.body.style.overflow = "auto";
    }

    function updateData() {
        saveEditData()
        $('label[contenteditable][name="nilai"]').attr('contenteditable', false);
        $('input[type="checkbox"]').prop('checked', false);
        $('button[onclick="editData(this)"]').text('Ubah');
        selectedIds.length = 0;
        $('button[onclick="deleteData(this)"]').prop('disabled', false);
        $('button[onclick="deleteData(this)"]').css('background-color', '#d9251c')
        $('div.editable-com').css('border-bottom', '');
        $('option').prop('disabled', true);
        $('select').css('pointer-events', 'none');

        $('button[onclick="cancelEditDelete(this)"]').prop('disabled', true);
        $('button[onclick="cancelEditDelete(this)"]').css('background-color', '#888888')

        $('img.editable-icon').css('display', 'none');
        $('input[type="checkbox"]').prop('disabled', false);
        checkCheckBoxUpdateButton()
        hideModal()
    }

    function confirmDeleteData() {
        selectedIds.forEach(function(resid) {
            var row = $('tr[data-resid="' + resid + '"]');
            row.find('.editable-com').css('border-bottom', '1px solid red');
        });
        saveDeleteData()
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            hideModal();
        }
        if (event.target == deleteModal) {
            hideDeleteModal();
        }
    }
</script>

<style>
    .siswa-tab th {
        border-bottom: 1px black solid;
    }

    .siswa-tab td {
        border-bottom: 1px black solid;
    }

    .siswa-tab tr>td {
        padding: 10px 0px;
    }

    .sort-icon {
        display: none;
        width: 12px;
        height: 12px;
        margin-left: 5px;
    }

    .editable-icon {
        display: none;
        width: 12px;
        height: 12px;
        margin-right: 15px;
        position: absolute;
        right: 0;
        top: 38%;
    }

    .editable-com label {
        width: 90%;
    }

    .editable-com .dropdown {
        border: none;
        outline: none;
        width: 90%;
        background-color: #f8fafc;
        pointer-events: none;
    }
</style>
