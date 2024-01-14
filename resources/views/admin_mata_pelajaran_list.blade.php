<!DOCTYPE html>
<html>

<head>
    <title>Mata Pelajaran</title>
    @include('layouts/admin_navbar')
</head>

<body>
    <main style="margin: 10px 20px;">
        <div style="margin: 20px 0px 0px 66px;">
            @foreach ($mata_pelajaran as $dataMata_pelajaran)
                <div class="kelas-item">
                    <button onclick="openNewPage({{ $dataMata_pelajaran->id }})">
                        <h3>{{ $dataMata_pelajaran->mata_pelajaran }}</h3>
                    </button>
                </div>
            @endforeach
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</html>


<script>
    function openNewPage(mataPelajaranId) {
        const [siswaGuruNilai, kelasId] = window.location.pathname.split('/').slice(-2);
        var urlSiswaGuruNilai = '';
        if (siswaGuruNilai == 1) {
            // urlSiswaGuruNilai = '/admin-siswa'
        } else if (siswaGuruNilai == 2) {
            urlSiswaGuruNilai = '/admin-guru'
        } else {
            urlSiswaGuruNilai = '/admin-nilai'
        }
        var url = '{{ url('') }}' + urlSiswaGuruNilai + '/' + siswaGuruNilai + '/' + kelasId + '/' +
            mataPelajaranId;


        // Navigate to the new page
        window.location.href = url;
    }
</script>

<style>
    .kelas-item button {
        height: 35px;
        border: 3px solid black;
        box-shadow: 5px 5px 5px black;
        font-size: 18px;
        width: 230px;
    }

    .kelas-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .kelas-item {
        margin-bottom: 20px;
    }
</style>
