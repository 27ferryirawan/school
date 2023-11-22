<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use Illuminate\Support\Collection;

use App\Models\SiswaKelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;

class AdminSiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $siswaKelas = SiswaKelas::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'kelas.id AS kelas_id', 'tahun_ajaran.id AS tahun_ajaran_id', 'siswa_kelas.id AS siswa_kelas_id')          
                    ->join('siswa', 'siswa_kelas.siswa_id', '=', 'siswa.id')
                    ->join('kelas', 'siswa_kelas.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa_kelas.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->orderBy('siswa.nama_siswa', 'asc')
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        return view('admin_siswa', compact('siswaKelas','kelas','tahunAjaran'));
    }

    public function addIndex(){
        $siswaKelas = SiswaKelas::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'kelas.id AS kelas_id', 'tahun_ajaran.id AS tahun_ajaran_id', 'siswa_kelas.id AS siswa_kelas_id')          
                    ->join('siswa', 'siswa_kelas.siswa_id', '=', 'siswa.id')
                    ->join('kelas', 'siswa_kelas.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa_kelas.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->orderBy('siswa.nama_siswa', 'asc')
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        return view('admin_siswa_add', compact('siswaKelas','kelas','tahunAjaran'));
    }

    public function sort(Request $request)
    {
        $column = $request->input('column');
        $order = $request->input('order');

        // Logika pengurutan sesuai kolom dan urutan yang diterima
        $siswaKelas = SiswaKelas::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran')        
                    ->join('siswa', 'siswa_kelas.siswa_id', '=', 'siswa.id')
                    ->join('kelas', 'siswa_kelas.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa_kelas.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->orderBy($column, $order)
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        // Mengembalikan data dalam format yang dapat di-render pada tampilan
        return view('admin_siswa', compact('siswaKelas','kelas','tahunAjaran'));
    }

    // public function insertBulkData(Request $request)
    // {
    //     $data = $request->input('data');
    //     foreach ($data as $rowData) {
    //         $siswa = Siswa::create([
    //             'NISN' => $rowData['NISN'],
    //             'nama_siswa' => $rowData['nama_siswa'],
    //             'jenis_kelamin' => $rowData['jenis_kelamin'],
    //         ]);

    //         $siswaId = $siswa->id;

    //         SiswaKelas::create([
    //             'siswa_id' => $siswaId,
    //             'kelas_id' => $rowData['kelas_id'],
    //             'tahun_ajaran_id' => $rowData['tahun_ajaran_id'],
    //         ]);
    //     }
        
    //     return response()->json(['message' => 'Data Inserted'], 201);
    // }

    public function bulkUpdate(Request $request)
    {
        $data = $request->rowsData;

        DB::beginTransaction();

        try {
            foreach ($data as $rowData) {
                $siswaId = $rowData['id'];
                $siswaData = [
                    'NISN' => $rowData['NISN'],
                    'nama_siswa' => $rowData['nama_siswa'],
                    'jenis_kelamin' => $rowData['jenis_kelamin'],
                ];
                Siswa::where('id', $siswaId)->update($siswaData);

                // Update data siswa_kelas
                $siswaKelasId = $rowData['siswa_kelas_id'];
                $siswaKelasData = [
                    'siswa_id' => $rowData['id'],
                    'kelas_id' => $rowData['kelas_id'],
                    'tahun_ajaran_id' => $rowData['tahun_ajaran_id'],
                ];

                SiswaKelas::where('id', $siswaKelasId)->update($siswaKelasData);
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
            // return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function bulkDelete(Request $request)
    {
        $data = $request->rowsData;

        DB::beginTransaction();

        try {
            foreach ($data as $rowData) {
                $siswaId = $rowData['id'];
                Siswa::where('id', $siswaId)->delete();

                $siswaKelasId = $rowData['siswa_kelas_id'];
                SiswaKelas::where('id', $siswaKelasId)->delete();
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
