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
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Ujian;
use App\Models\UjianDetail;
use App\Models\UjianDetailPilgan;
use App\Models\JenisUjian;
use App\Models\JenisSoal;

class GuruUjianController extends Controller
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
        $ujian = Ujian::select(
            'ujian.id',
            'ujian.deskripsi',
            'jenis_ujian.jenis_ujian',
            'kelas.nama_kelas',
            'mata_pelajaran.mata_pelajaran'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('kelas', 'ujian.kelas_id', '=', 'kelas.id')
        ->join('mata_pelajaran', 'ujian.mata_pelajaran_id', '=', 'mata_pelajaran.id')
        ->join('guru', 'ujian.guru_id', '=', 'guru.id')
        ->where('guru.user_id', $authUserId)
        ->orderBy('ujian.deskripsi', 'asc')
        ->get();

        

        return view('guru_ujian', compact('ujian'));
    }

    public function addIndex(){
        $jenisUjian = JenisUjian::all();
        $kelas = Kelas::all();
        $mataPelajaran = MataPelajaran::all();
        $authUserId = Auth::id();
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

        return view('guru_ujian_add', compact('jenisUjian','kelas','mataPelajaran', 'guru'));
    }

    public function addUjian(Request $request)
    {
        // try {
        //     // Validate your request data as needed

        //     $guruId = $request->input('guru_id');
        //     $kelasId = $request->input('kelas_id');
        //     $tahunAjaranId = $request->input('tahun_ajaran_id');
        //     $mataPelajaranId = $request->input('mata_pelajaran_id');

        //     // Check if the record already exists
        //     $existingRecord = GuruPembelajaran::where([
        //         'guru_id' => $guruId,
        //         'kelas_id' => $kelasId,
        //         'tahun_ajaran_id' => $tahunAjaranId,
        //         'mata_pelajaran_id' => $mataPelajaranId,
        //     ])->first();

        //     // If it exists, return the existing record
        //     if ($existingRecord) {
        //         return response()->json(['message' => 'Data pembelajaran sudah tersedia', 'data' => $existingRecord]);
        //     }

        //     // If it doesn't exist, create a new record
        //     $newRecord = GuruPembelajaran::create([
        //         'guru_id' => $guruId,
        //         'kelas_id' => $kelasId,
        //         'tahun_ajaran_id' => $tahunAjaranId,
        //         'mata_pelajaran_id' => $mataPelajaranId,
        //     ]);
        //     return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Pembelajaran Berhasil!', 'data' => $newRecord]);
        // } catch (QueryException $e) {
        //     return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        // }
    }
}
