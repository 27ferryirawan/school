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
use App\Models\MataPelajaran;
use App\Models\GuruKelas;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\TahunAjaran;

class AdminGuruController extends Controller
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
        $guru = Guru::select('guru.id', 'guru.NIP', 'guru.nama_guru', DB::raw("CASE WHEN guru.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN guru.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'tahun_ajaran.id AS tahun_ajaran_id', 'guru.tanggal_lahir', 'guru.agama', 'guru.tempat_lahir', 'mata_pelajaran.mata_pelajaran', 'mata_pelajaran.id AS mata_pelajaran_id', 'guru.kelas_id')          
                    ->join('tahun_ajaran', 'guru.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->join('mata_pelajaran', 'guru.mata_pelajaran_id', '=', 'mata_pelajaran.id')
                    ->where('guru.mata_pelajaran_id', $mataPelajaranId) 
                    ->orderBy('guru.nama_guru', 'asc')
                    ->get();
        $kelas = Kelas::all();
        $mataPelajaran = MataPelajaran::all();

        return view('admin_guru', compact('guru','mataPelajaran', 'kelas'));
    }

    public function addIndex(){
        $guru = Guru::select('guru.id', 'guru.NIP', 'guru.nama_guru', DB::raw("CASE WHEN guru.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN guru.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'tahun_ajaran.id AS tahun_ajaran_id', 'guru.tanggal_lahir', 'guru.agama', 'guru.tempat_lahir', 'mata_pelajaran.mata_pelajaran', 'mata_pelajaran.id AS mata_pelajaran_id')          
                    ->join('tahun_ajaran', 'guru.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->join('mata_pelajaran', 'guru.mata_pelajaran_id', '=', 'mata_pelajaran.id')
                    ->orderBy('guru.nama_guru', 'asc')
                    ->get();

        $mataPelajaran = MataPelajaran::all();
        $kelas = Kelas::all();
        $tahunAjaran = TahunAjaran::select('id', 'tahun_ajaran')->get();

        return view('admin_guru_add', compact('guru','mataPelajaran', 'tahunAjaran', 'kelas'));
    }

    public function sort(Request $request)
    {
        $column = $request->input('column');
        $order = $request->input('order');
        $mataPelajaranId = $request->input('mataPelajaranId');

        // Logika pengurutan sesuai kolom dan urutan yang diterima
        $guru = Guru::select('guru.id', 'guru.NIP', 'guru.nama_guru', DB::raw("CASE WHEN guru.jenis_kelamin= 'L' THEN 'Laki-Laki' WHEN guru.jenis_kelamin= 'P' THEN 'Perempuan' ELSE '' END AS jenis_kelamin"), 'tahun_ajaran.tahun_ajaran', 'tahun_ajaran.id AS tahun_ajaran_id', 'guru.tanggal_lahir', 'guru.agama', 'guru.tempat_lahir', 'mata_pelajaran.mata_pelajaran', 'mata_pelajaran.id AS mata_pelajaran_id', 'guru.kelas_id')          
                    ->join('tahun_ajaran', 'guru.tahun_ajaran_id', '=', 'tahun_ajaran.id')
                    ->join('mata_pelajaran', 'guru.mata_pelajaran_id', '=', 'mata_pelajaran.id')
                    ->where('guru.mata_pelajaran_id', $mataPelajaranId) 
                    ->orderBy($column, $order)
                    ->get();
        $kelas = Kelas::all();

        $mataPelajaran = MataPelajaran::all();

        // Mengembalikan data dalam format yang dapat di-render pada tampilan
        return view('admin_guru', compact('guru','mataPelajaran', 'kelas'));
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->rowsData;

        DB::beginTransaction();

        try {
            foreach ($data as $rowData) {
                $guruId = $rowData['id'];
                $guruData = [
                    'NIP' => $rowData['NIP'],
                    'nama_guru' => $rowData['nama_guru'],
                    'jenis_kelamin' => $rowData['jenis_kelamin'],
                    'mata_pelajaran_id' => $rowData['mata_pelajaran_id'],
                    'kelas_id' => $rowData['kelas_id'],
                ];
                Guru::where('id', $guruId)->update($guruData);

                $user_id = Guru::where('id', $guruId)->value('user_id');

                if ($user_id) {
                    // Update the password in the User table
                    $user = User::where('id', $user_id)->first();

                    if ($user) {
                        $user->password = bcrypt($rowData['password']);
                        $user->save();
                    }
                }
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function bulkDelete(Request $request)
    {
        $data = $request->rowsData;

        DB::beginTransaction();

        try {
            foreach ($data as $rowData) {
                $guruUserId = Guru::select('guru.user_id')          
                    ->where('guru.id', $rowData['id'])
                    ->first();
                $guruId = $rowData['id'];
                Guru::where('id', $guruId)->delete();
                User::where('id', $guruUserId->user_id)->delete();
            }
            
            DB::commit();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();

            // return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addGuru(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'nip' => 'required',
                'nama_guru' => 'required',
                'jenis_kelamin' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'agama' => 'required',
                'mata_pelajaran_id' => 'required',
                'tahun_ajaran_id' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required',
            ]);

            $user = new User();
            $user->name = $request->nama_guru;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->role = 'GURU';
            $user->save();

            $guru = new Guru();
            $guru->NIP = $request->nip;
            $guru->nama_guru = $request->nama_guru;
            $guru->jenis_kelamin = $request->jenis_kelamin;
            $guru->tempat_lahir = $request->tempat_lahir;
            $guru->tanggal_lahir = $request->tanggal_lahir;
            $guru->agama = $request->agama;
            $guru->kelas_id = $request->kelas_id;
            $guru->mata_pelajaran_id = $request->mata_pelajaran_id;
            $guru->user_id = $user->id;
            $guru->tahun_ajaran_id = $request->tahun_ajaran_id;
            $guru->save();

            DB::commit();

            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Guru Berhasil!', 'data' => $guru]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }
}
