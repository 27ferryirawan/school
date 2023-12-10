<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use Illuminate\Support\Collection;

use App\Models\GuruPembelajaran;
use App\Models\SiswaKelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MataPelajaran;
use App\Models\Guru;

class GuruPembelajaranContoller extends Controller
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
    public function index(){
        $authUserId = Auth::id();
        $guruPembelajaran = guruPembelajaran::select(
            'guru_pembelajaran.id',
            'mata_pelajaran.mata_pelajaran',
            'kelas.nama_kelas',
            'guru_pembelajaran.guru_id',
            'guru.nama_guru',
            'guru_pembelajaran.mata_pelajaran_id',
            'mata_pelajaran.mata_pelajaran',
            'guru_pembelajaran.kelas_id',
        )
        ->join('guru', 'guru_pembelajaran.guru_id', '=', 'guru.id')
        ->join('kelas', 'guru_pembelajaran.kelas_id', '=', 'kelas.id')
        ->join('tahun_ajaran', 'guru_pembelajaran.tahun_ajaran_id', '=', 'tahun_ajaran.id')
        ->join('mata_pelajaran', 'guru_pembelajaran.mata_pelajaran_id', '=', 'mata_pelajaran.id')
        ->where('guru.user_id', $authUserId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->get();

        $guru = Guru::select(
            'mata_pelajaran.mata_pelajaran',
            'guru.id AS guru_id',
            'guru.nama_guru',
            'guru.mata_pelajaran_id',
            'guru.tahun_ajaran_id',
        )
        ->join('mata_pelajaran', 'guru.mata_pelajaran_id', '=', 'mata_pelajaran.id')
        ->where('guru.user_id', $authUserId)
        ->first();

        $kelas = Kelas::select('id', 'nama_kelas')->get();
        $mataPelajaran = MataPelajaran::all();

        return view('guru_pembelajaran', compact('guruPembelajaran', 'kelas', 'mataPelajaran', 'guru'));
    }

    public function addGuruPembelajaran(Request $request)
{
    try {
        // Validate your request data as needed

        $guruId = $request->input('guru_id');
        $kelasId = $request->input('kelas_id');
        $tahunAjaranId = $request->input('tahun_ajaran_id');
        $mataPelajaranId = $request->input('mata_pelajaran_id');

        // Check if the record already exists
        $existingRecord = GuruPembelajaran::where([
            'guru_id' => $guruId,
            'kelas_id' => $kelasId,
            'tahun_ajaran_id' => $tahunAjaranId,
            'mata_pelajaran_id' => $mataPelajaranId,
        ])->first();

        // If it exists, return the existing record
        if ($existingRecord) {
            return response()->json(['message' => 'Data pembelajaran sudah tersedia', 'data' => $existingRecord]);
        }

        // If it doesn't exist, create a new record
        $newRecord = GuruPembelajaran::create([
            'guru_id' => $guruId,
            'kelas_id' => $kelasId,
            'tahun_ajaran_id' => $tahunAjaranId,
            'mata_pelajaran_id' => $mataPelajaranId,
        ]);
        return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Pembelajaran Berhasil!', 'data' => $newRecord]);
    } catch (QueryException $e) {
        return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
    }
}
}
