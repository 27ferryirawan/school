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
        <nav class="tabbar" style="margin-top: 10px;">
            <ul class="tabbar-nav">
                <li><a onclick="showTab('materi')" class="tabbar-isAct active" id="materiTabMaster">Materi </a></li>
                <li><a onclick="showTab('tugas')" class="tabbar-isAct" id="tugasTabMaster">Tugas </a></li>
                <li><a onclick="showTab('diskusi')" class="tabbar-isAct" id="diskusiTabMaster">Diskusi </a></li>
            </ul>
        </nav>
        <div style="margin: 10px 20px;" class="tab-content active" id="materiTab">
            <table id="table" class="tab" style="width: 100%">
                <thead>
                    <tr>
                        <th style="width: 80%;" class="sortable" data-column="materi">Materi
                            <img class="sort-icon" src="{{ asset('images/asc.png') }}" alt="Ascending" data-order="asc">
                        </th>
                        <th style="width: 12%;" class="sortable" data-column="tanggal">Tanggal
                        </th>
                        <th style="width: 8%; text-align: center" class="sortable" data-column="tanggal">Detail
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
                                    src="{{ asset('images/double-left-arrow.png') }}" alt="Ascending" data-order="asc">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <footer
                style="position: absolute; bottom: 0; right: 0; left: 0; display: flex; justify-content: flex-end; align-items: center; min-height: 50px;">
                <div style="margin-right: 20px;">
                    <button
                        style="width: 125px; height: 35px; background-color: #d9251c; border: 3px solid black; color: white; box-shadow: 5px 5px 5px black; font-size: 18px;"
                        onclick="addData()">Tambah</button>
                </div>
            </footer>
        </div>
        <div style="margin: 10px 20px;" class="tab-content" id="tugasTab">

        </div>
        <div style="margin: 10px 20px;" class="tab-content" id="diskusiTab">

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function showTab(tabName) {
        // Hide all tab contents
        var tabs = document.getElementsByClassName('tab-content');
        var tabbar = document.getElementsByClassName('tabbar-isAct');
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove('active');
        }
        for (var i = 0; i < tabbar.length; i++) {
            tabbar[i].classList.remove('active');
        }

        // Show the selected tab content
        document.getElementById(tabName + 'Tab').classList.add('active');
        document.getElementById(tabName + 'TabMaster').classList.add('active');
    }

    function addData() {
        window.location.href = window.location.href + '/materi'
    }

    function openMateriDetail(id) {
        window.location.href = window.location.href + '/materi-detail/' + id
    }
</script>

<style>
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

    .tab-content.active {
        display: block;
    }
</style>
