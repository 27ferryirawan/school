<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use Illuminate\Support\Collection;

use App\Models\User;
use App\Models\SiswaKelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\SiswaNilai;
use App\Models\MataPelajaran;

class AdminSiswaNilaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($siswaGuruNilai, $kelasId, $mataPelajaranId){
        $siswaNilai = Siswa::select(
            'siswa.id',
            'siswa.NISN',
            'siswa.nama_siswa',
            'kelas.nama_kelas',
            DB::raw("CASE WHEN siswa.jenis_kelamin = 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin = 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"),
            'tahun_ajaran.tahun_ajaran',
            'siswa.tanggal_lahir',
            'siswa.agama',
            'siswa.tempat_lahir',
            'siswa_nilai.nilai',
            'siswa_nilai.id',
            DB::raw('IFNULL(siswa_nilai.siswa_id, siswa.id) AS siswa_id'),
            DB::raw('IFNULL(siswa_nilai.kelas_id, kelas.id) AS kelas_id'),
            DB::raw('IFNULL(siswa_nilai.tahun_ajaran_id, tahun_ajaran.id) AS tahun_ajaran_id'),
            DB::raw('IFNULL(siswa_nilai.mata_pelajaran_id, ' . $mataPelajaranId . ') AS mata_pelajaran_id')
        )
        ->leftJoin('siswa_nilai', function ($join) use ($mataPelajaranId) {
            $join->on('siswa.id', '=', 'siswa_nilai.siswa_id')
                ->where('siswa_nilai.mata_pelajaran_id', '=', $mataPelajaranId);
        })
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('tahun_ajaran', 'siswa.tahun_ajaran_id', '=', 'tahun_ajaran.id')
        ->where('siswa.kelas_id', $kelasId)
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();


        return view('admin_siswa_nilai', compact('siswaNilai'));
    }

    public function sort(Request $request)
    {
        $column = $request->input('column');
        $order = $request->input('order');
        $kelasId = $request->input('kelasId');
        $mataPelajaranId = $request->input('mataPelajaranId');

        $siswaNilai = Siswa::select(
            'siswa.id',
            'siswa.NISN',
            'siswa.nama_siswa',
            'kelas.nama_kelas',
            DB::raw("CASE WHEN siswa.jenis_kelamin = 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin = 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"),
            'tahun_ajaran.tahun_ajaran',
            'siswa.tanggal_lahir',
            'siswa.agama',
            'siswa.tempat_lahir',
            'siswa_nilai.nilai',
            'siswa_nilai.id',
            DB::raw('IFNULL(siswa_nilai.siswa_id, siswa.id) AS siswa_id'),
            DB::raw('IFNULL(siswa_nilai.kelas_id, kelas.id) AS kelas_id'),
            DB::raw('IFNULL(siswa_nilai.tahun_ajaran_id, tahun_ajaran.id) AS tahun_ajaran_id'),
            DB::raw('IFNULL(siswa_nilai.mata_pelajaran_id, ' . $mataPelajaranId . ') AS mata_pelajaran_id')
        )
        ->leftJoin('siswa_nilai', function ($join) use ($mataPelajaranId) {
            $join->on('siswa.id', '=', 'siswa_nilai.siswa_id')
                ->where('siswa_nilai.mata_pelajaran_id', '=', $mataPelajaranId);
        })
        ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->leftJoin('tahun_ajaran', 'siswa.tahun_ajaran_id', '=', 'tahun_ajaran.id')
        ->where('siswa.kelas_id', $kelasId)
        ->orderBy($column, $order)
        ->get();
        
        // Mengembalikan data dalam format yang dapat di-render pada tampilan
        return view('admin_siswa_nilai', compact('siswaNilai'));
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->rowsData;

        DB::beginTransaction();

        try {
            foreach ($data as $rowData) {
                $nilaiId = $rowData['id'];
                $nilaiData = [
                    'siswa_id' => $rowData['siswa_id'],
                    'kelas_id' => $rowData['kelas_id'],
                    'tahun_ajaran_id' => $rowData['tahun_ajaran_id'],
                    'mata_pelajaran_id' => $rowData['mata_pelajaran_id'],
                    'nilai' => $rowData['nilai'],
                ];
                SiswaNilai::updateOrInsert(
                    ['id' => $rowData['id']], // Condition for update
                    $nilaiData // Data to update or insert
                );
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
