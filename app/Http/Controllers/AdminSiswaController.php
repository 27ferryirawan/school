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

class AdminSiswaController extends Controller
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
    public function index($siswaGuruNilai, $kelasId){
        $siswa = Siswa::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'kelas.id AS kelas_id', 'tahun_ajaran.id AS tahun_ajaran_id',  'siswa.tanggal_lahir', 'siswa.agama', 'siswa.tempat_lahir')          
                    ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->where('siswa.kelas_id', $kelasId)
                    ->orderBy('siswa.nama_siswa', 'asc')
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        return view('admin_siswa', compact('siswa','kelas','tahunAjaran'));
    }

    public function addIndex(){
        $siswa = Siswa::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'kelas.id AS kelas_id', 'tahun_ajaran.id AS tahun_ajaran_id',  'siswa.tanggal_lahir', 'siswa.agama', 'siswa.tempat_lahir')          
                    ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->orderBy('siswa.nama_siswa', 'asc')
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        return view('admin_siswa_add', compact('siswa','kelas','tahunAjaran'));
    }

    public function sort(Request $request)
    {
        $column = $request->input('column');
        $order = $request->input('order');

        // Logika pengurutan sesuai kolom dan urutan yang diterima
        $siswa = Siswa::select('siswa.id', 'siswa.NISN', 'siswa.nama_siswa', 'kelas.nama_kelas', DB::raw("CASE WHEN siswa.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN siswa.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'kelas.id AS kelas_id', 'tahun_ajaran.id AS tahun_ajaran_id',  'siswa.tanggal_lahir', 'siswa.agama', 'siswa.tempat_lahir')          
                    ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                    ->join('tahun_ajaran', 'siswa.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->orderBy($column, $order)
                    ->get();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        // Mengembalikan data dalam format yang dapat di-render pada tampilan
        return view('admin_siswa', compact('siswa','kelas','tahunAjaran'));
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
                    'kelas_id' => $rowData['kelas_id'],
                    'tahun_ajaran_id' => $rowData['tahun_ajaran_id'],
                ];
                Siswa::where('id', $siswaId)->update($siswaData);
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
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addSiswa(Request $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi data yang diterima dari permintaan AJAX
            $request->validate([
                'nisn' => 'required',
                'nama_siswa' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'kelas_id' => 'required',
                'tahun_ajaran_id' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
            ]);

            // Simpan data user ke dalam tabel users
            $user = new User();
            $user->name = $request->nama_siswa;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            // Simpan data siswa ke dalam tabel siswa
            $siswa = new Siswa();
            $siswa->kelas_id = $request->kelas_id;
            $siswa->tahun_ajaran_id = $request->tahun_ajaran_id;
            $siswa->NISN = $request->nisn;
            $siswa->nama_siswa = $request->nama_siswa;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->tempat_lahir = $request->tempat_lahir;
            $siswa->tanggal_lahir = $request->tanggal_lahir;
            $siswa->agama = $request->agama;
            $siswa->user_id = $user->id;
            $siswa->save();

            // Commit transaksi database jika berhasil
            DB::commit();

            // Respon JSON untuk memberi tahu bahwa data telah ditambahkan
            return response()->json(['message' => 'Data siswa berhasil ditambahkan.']);
        } catch (\Exception $e) {
            // Rollback transaksi database jika terjadi kesalahan
            DB::rollBack();

            // Respon JSON dengan pesan kesalahan
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
