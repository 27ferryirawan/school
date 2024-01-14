<!DOCTYPE html>
<html>

<head>
    <title>Pembelajaran</title>
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
        <nav class="tabbar" style="margin-top: 10px;">
            <ul class="tabbar-nav">
                <li><a onclick="showTab('materi')" class="tabbar-isAct active" id="materiTabMaster">Materi </a></li>
                <li><a onclick="showTab('tugas')" class="tabbar-isAct" id="tugasTabMaster">Tugas</a></li>
                <li><a onclick="showTab('diskusi')" class="tabbar-isAct" id="diskusiTabMaster">Diskusi</a></li>
                <li><a onclick="showTab('ujian')" class="tabbar-isAct" id="ujianTabMaster">Ujian</a></li>
                <li><a onclick="showTab('nilai')" class="tabbar-isAct" id="nilaiTabMaster">Nilai</a></li>
            </ul>
        </nav>
        <div class="tab-content active" id="materiTab">
            <div style="margin: 10px 20px;">
                <table id="table" class="tab" style="width: 100%" data-id={{ $guruPembelajaran->id }}>
                    <thead>
                        <tr>
                            <th style="width: 80%;" class="sortable" data-column="title">Materi
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 12%;" class="sortable" data-column="created_at">Tanggal Dibuat
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 8%; text-align: center">Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materi as $data)
                            <tr class="siswa-row" style="margin: 10px;" data-id="{{ $data->id }}"
                                onclick="openMateriDetail({{ $data->id }})">
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false" name='materi'>{{ $data->title }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_created_at'>{{ $data->formatted_created_at }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: center;">
                                    <img style=" width: 20px; height: 20px;"
                                        src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending"
                                        data-order="asc">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-content" id="tugasTab">
            <div style="margin: 10px 20px;">
                <table id="table" class="tab" style="width: 100%" data-id={{ $guruPembelajaran->id }}>
                    <thead>
                        <tr>
                            <th style="width: 70%;" class="sortable" data-column="title">Tugas
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 12%;" class="sortable" data-column="created_at">Tanggal Dibuat
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 12%;" class="sortable" data-column="due_date">Tanggal Tenggat
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 8%;" class="sortable" data-column="nilai">Nilai
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 8%; text-align: center">Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $data)
                            <tr class="siswa-row" style="margin: 10px;" data-id="{{ $data->id }}"
                                onclick="openTugasDetail({{ $data->id }})">
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false" name='materi'>{{ $data->title }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_created_at'>{{ $data->formatted_created_at }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_due_date'>{{ $data->formatted_due_date }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_due_date'>{{ $data->nilai }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: center;">
                                    <img style=" width: 20px; height: 20px;"
                                        src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending"
                                        data-order="asc">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-content" id="diskusiTab">
            <div
                style="display: flex; align-items: center; margin: 0px 60px 0px 60px; border-top: 1px solid black;border-left: 1px solid black; border-right: 1px solid black; margin-top: 10px">
                <div class="input-com-full"
                    style="position: relative; margin-bottom: 10px; width: 100%; margin: 10px 25px 0px 25px;">
                    <div id='commentsContainer'>
                        @foreach ($diskusi as $data)
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
                style="display: flex; justify-content: flex-start; align-items: center; margin: 0px 60px 20px 60px; border: 1px solid black; padding: 10px 10px 0px 10px;">
                <div style="position: relative; width: 100%">
                    <textarea id="commentInput" placeholder="Type your comment..." oninput="autoExpand(this)"></textarea>
                    <button id="clearButton" onclick="clearText()" style="position: absolute; top: 5px; right: 5px;">
                        <img src="{{ asset('images/x.png') }}" style="width: 20px; height: 20px">
                    </button>
                </div>
                <button id="sendButton" onclick="sendKomentar()">
                    <img src="{{ asset('images/send.png') }}" style="width: 30px; height: 30px; margin-bottom: 12px">
                </button>
            </div>
        </div>
        <div class="tab-content" id="ujianTab">
            <div style="margin: 10px 20px;">
                <table id="table" class="tab" style="width: 100%" data-id={{ $guruPembelajaran->id }}>
                    <thead>
                        <tr>
                            <th style="width: 70%;" class="sortable" data-column="deskripsi">Ujian
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 12%;" class="sortable" data-column="jenis_ujian">Jenis Ujian
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 12%;" class="sortable" data-column="tanggal_ujian">Tanggal
                                Ujian
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 8%;" class="sortable" data-column="nilai">Nilai
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 8%; text-align: center">Detail
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ujian as $data)
                            <tr class="siswa-row" style="margin: 10px;" data-id="{{ $data->id }}"
                                onclick="openUjianDetail({{ $data->id }})">
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false" name='materi'>{{ $data->deskripsi }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_created_at'>{{ $data->jenis_ujian }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_due_date'>{{ $data->formatted_tanggal_ujian }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: left;">
                                    <div class="editable-com" style="margin-right:10px">
                                        <label contenteditable="false"
                                            name='formatted_due_date'>{{ $data->nilai }}</label>
                                    </div>
                                </td>
                                <td style="position: relative; text-align: center;">
                                    <img style=" width: 20px; height: 20px;"
                                        src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending"
                                        data-order="asc">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-content" id="nilaiTab">
            <div style="margin: 10px 20px;">
                <table id="table" class="tab" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 21%;" class="sortable" data-column="nisn">NISN
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 18%;" class="sortable" data-column="nama_siswa">Nama Siswa
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 21%;" class="sortable" data-column="nama_kelas">Kelas
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 20%;" class="sortable" data-column="nilai">Nilai
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
                            </th>
                            <th style="width: 20%;" class="sortable" data-column="tahun_ajaran">Tahun Ajaran
                                <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending"
                                    data-order="asc">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
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

    function validateLabel(label) {
        var labelContent = parseFloat(label.textContent);

        if (isNaN(labelContent) || !isFinite(labelContent)) {
            alert("Please enter a valid number.");
            return;
        }

        if (labelContent < 0 || labelContent > 100) {
            alert("Please enter a number between 0 and 100.");
        }
    }
    const modal = document.getElementById("saveModal");
    const deleteModal = document.getElementById("deleteModal");
    // $(document).ready(function() {
    //     $('.siswa-tab th.sortable').on('click', function() {
    //         var column = $(this).data('column');
    //         var order = $(this).data('order') == null ? 'asc' : $(this).data('order');
    //         var icon = $(this).find('img.sort-icon');

    //         $('.siswa-tab th.sortable img.sort-icon').removeAttr('style');
    //         icon.css('display', 'inline');

    //         if (order === 'asc') {
    //             icon.attr('src', '{{ asset('images/desc.png') }}');
    //             $(this).data('order', 'desc');
    //         } else {
    //             icon.attr('src', '{{ asset('images/asc.png') }}');
    //             $(this).data('order', 'asc');
    //         }

    //         const [kelasId, mataPelajaranId] = window.location.pathname.split('/').slice(-2);
    //         var table = document.getElementById('table');

    //         var dataId = table.getAttribute('data-id');
    //         $.ajax({
    //             url: '/siswa-pembelajaran/' + dataId + '/detailSortNilai',
    //             method: 'GET',
    //             data: {
    //                 kelasId: kelasId,
    //                 mataPelajaranId: mataPelajaranId,
    //                 column: column,
    //                 order: order
    //             },
    //             success: function(data) {
    //                 $('#siswa-table tbody').replaceWith($(data).find('tbody'));
    //             },
    //             error: function(error) {
    //                 console.log(error);
    //             }
    //         });
    //     });

    // });

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
            url: '/siswa-pembelajaran/nilai-bulk-update',
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

    function sendKomentar() {
        var komentar = document.getElementById('commentInput').value;
        var guruPembelajaran = {{ $guruPembelajaran->id }}
        $.ajax({
            type: 'POST',
            url: '/siswa-pembelajaran/detail/addDiskusi',
            data: {
                '_token': '{{ csrf_token() }}',
                'description': komentar,
                'guru_pembelajaran_id': guruPembelajaran
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
            }
        });
    }
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

    function autoExpand(textarea) {
        textarea.style.height = "auto";
        textarea.style.height = (textarea.scrollHeight) + "px";
    }

    function clearText() {
        var commentInput = document.getElementById('commentInput');
        commentInput.value = '';
        commentInput.style.height = "45px";
    }

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

        dynamicDiv.appendChild(quoteDiv);
        dynamicDiv.appendChild(descriptionLabel);
        dynamicDiv.appendChild(createdAtLabel);
        commentContainer.appendChild(dynamicDiv);

        var commentsContainer = document.querySelector('#commentsContainer');

        commentsContainer.appendChild(commentContainer);

        clearText();
        adjustMinWidth();
    }


    $(document).ready(function() {
        var table = document.getElementById('table');

        var dataId = table.getAttribute('data-id');
        $('.tab th.sortable').on('click', function() {
            var column = $(this).data('column');
            var order = $(this).data('order') == null ? 'asc' : $(this).data('order');
            var icon = $(this).find('img.sort-icon');

            $('.tab th.sortable img.sort-icon').removeAttr('style');
            icon.css('display', 'inline');

            if (order === 'asc') {
                icon.attr('src', '{{ asset('images/desc.png') }}');
                $(this).data('order', 'desc');
            } else {
                icon.attr('src', '{{ asset('images/asc.png') }}');
                $(this).data('order', 'asc');
            }

            var activeTabId = document.querySelector('.tab-content.active').id;
            var activeUrl = '';
            if (activeTabId == 'materiTab') {
                activeUrl = '/siswa-pembelajaran/' + dataId + '/detailSort';
            } else if (activeTabId == 'tugasTab') {
                activeUrl = '/siswa-pembelajaran/' + dataId + '/detailSortTugas';
            } else if (activeTabId == 'ujianTab') {
                activeUrl = '/siswa-pembelajaran/' + dataId + '/detailSortUjian';
            } else if (activeTabId == 'ujianTab') {
                activeUrl = '/siswa-pembelajaran/' + dataId + '/detailSortNilai';
            }

            $.ajax({
                url: activeUrl,
                method: 'GET',
                data: {
                    column: column,
                    order: order
                },
                success: function(data) {
                    $('#' + activeTabId + ' #table tbody').replaceWith($(data).find(
                        '#' + activeTabId + ' #table tbody'));
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });

    function showTab(tabName) {
        var tabs = document.getElementsByClassName('tab-content');
        var tabbar = document.getElementsByClassName('tabbar-isAct');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active');
        }
        for (var i = 0; i < tabbar.length; i++) {
            tabbar[i].classList.remove('active');
        }

        document.getElementById(tabName + 'Tab').classList.add('active');
        document.getElementById(tabName + 'TabMaster').classList.add('active');

    }

    function addData() {
        window.location.href = window.location.href + '/materi'
    }

    function addTugasData() {
        window.location.href = window.location.href + '/tugas'
    }

    function addUjianData() {
        window.location.href = window.location.href + '/ujian'
    }

    function openMateriDetail(id) {
        window.location.href = window.location.href + '/materi-detail/' + id
    }

    function openTugasDetail(id) {
        window.location.href = window.location.href + '/tugas-detail/' + id
    }

    function openUjianDetail(id) {
        window.location.href = window.location.href + '/ujian-detail/' + id
    }
</script>

<style>
    #commentsContainer {
        min-height: calc(100vh - 390px);
        overflow-y: auto;
        overflow-x: hidden;
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

    .plus-button {
        background-color: white;
        color: black;
        border: none;
        width: 150px;
        height: 50px;
        cursor: pointer;
        font-size: 18px;
        margin-left: auto;
        margin-right: 25px;
        border: 3px solid black;
        color: black;
        box-shadow: 5px 5px 5px black;
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

    .tab-content {
        display: none;
    }

    .footer-content {
        display: none;
        justify-content: flex-end;
        align-items: center;
        min-height: 50px;
        margin-top: auto;
        width: 100%;
    }

    .footer-content.active {
        display: flex;
    }

    .tab-content.active {
        display: block;
    }

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

    .left-dynamic-div,
    .right-dynamic-div {
        display: flex;
        flex-direction: column;
        position: relative;
        background-color: #E2E2E2;
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
