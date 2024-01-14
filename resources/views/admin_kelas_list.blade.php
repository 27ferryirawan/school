<!DOCTYPE html>
<html>

<head>
    <title>Kelas</title>
    @include('layouts/admin_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">

        @foreach ($kelasPerTingkat as $tingkat => $kelas)
            <div class="kelas-group">
                <h2 style="margin: 20px 0px 0px 66px;">Kelas {{ $tingkat }}</h2>
                <div class="kelas-container">
                    @foreach ($kelas as $kelasItem)
                        <div class="kelas-item">
                            <button onclick="openNewPage({{ $kelasItem->id }})">
                                <h3>{{ $kelasItem->nama_kelas }}</h3>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </main>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function openNewPage(kelasId) {
        const siswaGuruNilai = window.location.pathname.split('/').pop();
        var urlSiswaGuruNilai = '';
        if (siswaGuruNilai == 1) {
            var url = '{{ url('') }}' + '/admin-siswa' + '/' + siswaGuruNilai + '/' + kelasId;
        } else if (siswaGuruNilai == 2) {
            var url = '{{ url('') }}' + '/admin-guru' + '/' + siswaGuruNilai + '/' + kelasId;
        } else {
            var url = '{{ url('/admin-mata-pelajaran/list') }}/' + siswaGuruNilai + '/' + kelasId;
        }
        // Navigate to the new page
        window.location.href = url;
    }
</script>

<style>
    .kelas-container {
        display: flex;
        flex-wrap: wrap;
    }

    .kelas-item {
        width: 16.666%;
        padding: 10px;
        box-sizing: border-box;
        text-align: center;
    }

    .kelas-item button {
        height: 35px;
        border: 3px solid black;
        box-shadow: 5px 5px 5px black;
        font-size: 18px;
        width: 100px;
    }

    .kelas-group {
        margin-bottom: 40px;
    }
</style>
