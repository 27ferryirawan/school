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
use Illuminate\Support\Facades\Storage;

use App\Models\GuruPembelajaran;
use App\Models\SiswaKelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Materi;
use App\Models\MateriKomentar;
use App\Models\Tugas;
use App\Models\TugasJawaban;
use App\Models\Diskusi;
use App\Models\Ujian;
use App\Models\UjianDetail;
use App\Models\UjianDetailPilgan;
use App\Models\JenisUjian;
use App\Models\JenisSoal;
use App\Models\UjianJawaban;
use App\Models\UjianJawabanDetail;
use App\Models\SiswaNilaipr;

class SiswaPembelajaranContoller extends Controller
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
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->get();
    
        return view('siswa_pembelajaran', compact('guruPembelajaran'));
    }

    public function detailIndex($mataPelajaranId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('materi.created_at', 'asc')
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        $diskusi = Diskusi::select(
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN guru.nama_guru WHEN diskusi.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' AND siswa.id = ".$siswa->id." THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' AND siswa.id != ".$siswa->id." THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'diskusi.description',
            'diskusi.created_at'
        )
        ->leftJoin('guru', 'diskusi.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'diskusi.guru_siswa_id', '=', 'siswa.id')
        ->join('guru_pembelajaran', 'diskusi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('diskusi.created_at', 'asc')
        ->get();

        foreach ($diskusi as $diskusiItem) {
            $diskusiItem->formatted_created_at = Carbon::parse($diskusiItem->created_at)->format('d M Y H:i');
            $diskusiItem->formatted_updated_at = Carbon::parse($diskusiItem->updated_at)->format('d M Y H:i');
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('guru_pembelajaran', 'ujian.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('ujian.tanggal_ujian', 'desc')
        ->get();

        foreach ($ujian as $ujianItem) {
            $ujianItem->formatted_created_at = Carbon::parse($ujianItem->created_at)->format('d M Y H:i');
            $ujianItem->formatted_updated_at = Carbon::parse($ujianItem->updated_at)->format('d M Y H:i');
            $ujianItem->formatted_tanggal_ujian = Carbon::parse($ujianItem->tanggal_ujian)->format('d M Y H:i');
        }

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
        ->where('siswa.kelas_id', $siswa->kelas_id)
        ->where('siswa.id', $siswa->id)
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();

        return view('siswa_pembelajaran_detail', compact('guruPembelajaran', 'materi', 'tugas', 'diskusi', 'ujian', 'siswaNilai', 'siswa'));
    }

    public function detailSortIndex($mataPelajaranId, Request $request){
        $column = $request->input('column');
        $order = $request->input('order');
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy($column, $order)
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        $diskusi = Diskusi::select(
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN guru.nama_guru WHEN diskusi.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'diskusi.description',
            'diskusi.created_at'
        )
        ->leftJoin('guru', 'diskusi.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'diskusi.guru_siswa_id', '=', 'siswa.id')
        ->join('guru_pembelajaran', 'diskusi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('diskusi.created_at', 'asc')
        ->get();

        foreach ($diskusi as $diskusiItem) {
            $diskusiItem->formatted_created_at = Carbon::parse($diskusiItem->created_at)->format('d M Y H:i');
            $diskusiItem->formatted_updated_at = Carbon::parse($diskusiItem->updated_at)->format('d M Y H:i');
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('guru_pembelajaran', 'ujian.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('ujian.tanggal_ujian', 'desc')
        ->get();

        foreach ($ujian as $ujianItem) {
            $ujianItem->formatted_created_at = Carbon::parse($ujianItem->created_at)->format('d M Y H:i');
            $ujianItem->formatted_updated_at = Carbon::parse($ujianItem->updated_at)->format('d M Y H:i');
            $ujianItem->formatted_tanggal_ujian = Carbon::parse($ujianItem->tanggal_ujian)->format('d M Y H:i');
        }

        $mataPelajaranId = $guruPembelajaran->mata_pelajaran_id;
        $kelasId = $guruPembelajaran->kelas_id;

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

        return view('siswa_pembelajaran_detail', compact('guruPembelajaran', 'materi', 'tugas', 'diskusi', 'ujian','siswaNilai', 'siswa'));
    }

    public function detailSortIndexTugas($mataPelajaranId, Request $request){
        $column = $request->input('column');
        $order = $request->input('order');
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('materi.created_at', 'asc')
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy($column, $order)
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        $diskusi = Diskusi::select(
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN guru.nama_guru WHEN diskusi.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'diskusi.description',
            'diskusi.created_at'
        )
        ->leftJoin('guru', 'diskusi.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'diskusi.guru_siswa_id', '=', 'siswa.id')
        ->join('guru_pembelajaran', 'diskusi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('diskusi.created_at', 'asc')
        ->get();

        foreach ($diskusi as $diskusiItem) {
            $diskusiItem->formatted_created_at = Carbon::parse($diskusiItem->created_at)->format('d M Y H:i');
            $diskusiItem->formatted_updated_at = Carbon::parse($diskusiItem->updated_at)->format('d M Y H:i');
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('guru_pembelajaran', 'ujian.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('ujian.tanggal_ujian', 'desc')
        ->get();

        foreach ($ujian as $ujianItem) {
            $ujianItem->formatted_created_at = Carbon::parse($ujianItem->created_at)->format('d M Y H:i');
            $ujianItem->formatted_updated_at = Carbon::parse($ujianItem->updated_at)->format('d M Y H:i');
            $ujianItem->formatted_tanggal_ujian = Carbon::parse($ujianItem->tanggal_ujian)->format('d M Y H:i');
        }

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
        ->where('siswa.kelas_id', $siswa->kelas_id)
        ->where('siswa.id', $siswa->id)
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();

        return view('siswa_pembelajaran_detail', compact('guruPembelajaran', 'tugas', 'materi', 'diskusi', 'ujian', 'siswaNilai', 'siswa'));
    }

    public function detailSortIndexUjian($mataPelajaranId, Request $request){
        $column = $request->input('column');
        $order = $request->input('order');
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('materi.created_at', 'asc')
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        $diskusi = Diskusi::select(
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN guru.nama_guru WHEN diskusi.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'diskusi.description',
            'diskusi.created_at'
        )
        ->leftJoin('guru', 'diskusi.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'diskusi.guru_siswa_id', '=', 'siswa.id')
        ->join('guru_pembelajaran', 'diskusi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('diskusi.created_at', 'asc')
        ->get();

        foreach ($diskusi as $diskusiItem) {
            $diskusiItem->formatted_created_at = Carbon::parse($diskusiItem->created_at)->format('d M Y H:i');
            $diskusiItem->formatted_updated_at = Carbon::parse($diskusiItem->updated_at)->format('d M Y H:i');
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('guru_pembelajaran', 'ujian.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy($column, $order)
        ->get();

        foreach ($ujian as $ujianItem) {
            $ujianItem->formatted_created_at = Carbon::parse($ujianItem->created_at)->format('d M Y H:i');
            $ujianItem->formatted_updated_at = Carbon::parse($ujianItem->updated_at)->format('d M Y H:i');
            $ujianItem->formatted_tanggal_ujian = Carbon::parse($ujianItem->tanggal_ujian)->format('d M Y H:i');
        }

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
        ->where('siswa.kelas_id', $siswa->kelas_id)
        ->where('siswa.id', $siswa->id)
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();
        
        return view('siswa_pembelajaran_detail', compact('guruPembelajaran', 'tugas', 'materi', 'diskusi', 'ujian', 'siswaNilai', 'siswa'));
    }

    public function detailSortIndexNilai($mataPelajaranId, Request $request){
        $column = $request->input('column');
        $order = $request->input('order');
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();
        
        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('materi.created_at', 'asc')
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        $diskusi = Diskusi::select(
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN guru.nama_guru WHEN diskusi.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN diskusi.role= 'GURU' THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN diskusi.role= 'SISWA' THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'diskusi.description',
            'diskusi.created_at'
        )
        ->leftJoin('guru', 'diskusi.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'diskusi.guru_siswa_id', '=', 'siswa.id')
        ->join('guru_pembelajaran', 'diskusi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('diskusi.created_at', 'asc')
        ->get();

        foreach ($diskusi as $diskusiItem) {
            $diskusiItem->formatted_created_at = Carbon::parse($diskusiItem->created_at)->format('d M Y H:i');
            $diskusiItem->formatted_updated_at = Carbon::parse($diskusiItem->updated_at)->format('d M Y H:i');
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian'
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->join('guru_pembelajaran', 'ujian.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('ujian.tanggal_ujian', 'desc')
        ->get();

        foreach ($ujian as $ujianItem) {
            $ujianItem->formatted_created_at = Carbon::parse($ujianItem->created_at)->format('d M Y H:i');
            $ujianItem->formatted_updated_at = Carbon::parse($ujianItem->updated_at)->format('d M Y H:i');
            $ujianItem->formatted_tanggal_ujian = Carbon::parse($ujianItem->tanggal_ujian)->format('d M Y H:i');
        }

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
        ->where('siswa.kelas_id', $siswa->kelas_id)
        ->where('siswa.id', $siswa->id)
        ->orderBy($column, $order)
        ->get();

        return view('siswa_pembelajaran_detail', compact('guruPembelajaran', 'tugas', 'materi', 'diskusi', 'ujian', 'siswaNilai', 'siswa'));
    }

    public function materiAddIndex($guruPembelajaranId){
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        return view('siswa_pembelajaran_detail_add_materi', compact('guruPembelajaran'));
    }

    public function tugasAddIndex($guruPembelajaranId){
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        return view('siswa_pembelajaran_detail_add_tugas', compact('guruPembelajaran'));
    }

    public function ujianAddIndex($guruPembelajaranId){
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $jenisUjian = JenisUjian::all();

        return view('siswa_pembelajaran_detail_add_ujian', compact('guruPembelajaran', 'jenisUjian'));
    }

    public function ujianAddIndexSoal($guruPembelajaranId, $ujianId){
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $ujian = Ujian::find($ujianId);

        $jenisSoal = JenisSoal::all();

        return view('siswa_pembelajaran_detail_ujian_detail_add_soal', compact('guruPembelajaran', 'jenisSoal', 'ujian'));
    }

    public function addMateri(Request $request)
    {
        try {
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            
            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = null;
                $file_name = null;
            }
            
            $newRecord = Materi::create([
                'guru_pembelajaran_id' => $guru_pembelajaran_id,
                'title' => $title,
                'description' => $description,
                'file_path' => $file_path,
                'file_name' => $file_name
            ]);
            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Materi Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function addTugas(Request $request)
    {
        try {
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            if($request->input('due_date') != ""){
                $due_date = Carbon::createFromFormat('d M Y H:i', $request->input('due_date'))->format('Y-m-d H:i:s');
            }else{
                $due_date = null;
            }
            
            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = null;
                $file_name = null;
            }
            
            $newRecord = Tugas::create([
                'guru_pembelajaran_id' => $guru_pembelajaran_id,
                'title' => $title,
                'description' => $description,
                'file_path' => $file_path,
                'file_name' => $file_name,
                'due_date' => $due_date
            ]);
            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Tugas Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function addKomentar(Request $request)
    {
        try {
            $authUserId = Auth::id();
            $authUserRole = Auth::user()->role;
            
            $materi_id = $request->input('materi_id');
            $guru_siswa_id = $request->input('guru_siswa_id');
            $description = $request->input('description');

            if($authUserRole == 'GURU'){
                $guru = Guru::select(
                    'guru.id',
                )
                ->where('guru.user_id', $authUserId)
                ->first();
                $guru_siswa_id = $guru->id;
            } else {
                $siswa = Siswa::select(
                    'siswa.id',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
                $guru_siswa_id = $siswa->id;
            }

            $newRecord = MateriKomentar::create([
                'materi_id' => $materi_id,
                'guru_siswa_id' => $guru_siswa_id,
                'role' => $authUserRole,
                'description' => $description,
            ]);
            $newRecord->formatted_created_at = Carbon::parse($newRecord->created_at)->format('d M Y H:i');
            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Komentar Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function deleteMateri(Request $request)
    {
        try {
            $id = $request->input('id');
            $materi = Materi::find($id);

            if ($materi) {
                Storage::disk('public')->delete($materi->file_path);

                $materi->delete();

                return response()->json(['message' => 'Berhasil', 'message_description' => 'Menghapus Materi Berhasil!']);
            } else {
                return response()->json(['message' => 'Gagal', 'message_description' => 'Materi tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal', 'message_description' => $e->getMessage()], 500);
        }
    }

    public function deleteTugas(Request $request)
    {
        try {
            $id = $request->input('id');
            $tugas = Tugas::find($id);

            if ($tugas) {
                Storage::disk('public')->delete($tugas->file_path);

                $tugas->delete();

                return response()->json(['message' => 'Berhasil', 'message_description' => 'Menghapus Tugas Berhasil!']);
            } else {
                return response()->json(['message' => 'Gagal', 'message_description' => 'Tugas tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal', 'message_description' => $e->getMessage()], 500);
        }
    }

    public function updateMateri(Request $request)
    {
        try {
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            $materiId = $request->input('id');
            $existingRecord = Materi::find($materiId);
            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = $existingRecord->file_path ?? null;
            }
            
            if ($existingRecord) {
                $existingRecord->update([
                    'guru_pembelajaran_id' => $guru_pembelajaran_id,
                    'title' => $title,
                    'description' => $description,
                    'file_path' => $file_path,
                    'file_name' => $file_name
                ]);

                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Materi Berhasil!', 'data' => $existingRecord]);
            } else {
                return response()->json(['message' => 'Gagal','message_description' => 'Materi tidak ditemukan.']);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function updateInsertTugasJawaban(Request $request)
    {
        try {
            $authUserId = Auth::id();
            $siswa = Siswa::select(
                'siswa.*',
            )
            ->where('siswa.user_id', $authUserId)
            ->first();

            $title = $request->input('title');
            $description = $request->input('description');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            $tugasId = $request->input('id');
            $submit_date = now();

            $existingRecord = TugasJawaban::select(
                'tugas_jawaban.*',
            )
            ->where('tugas_id', $tugasId)
            ->where('siswa_id', $siswa->id)
            ->first(); 

            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = $existingRecord->file_path ?? null;
            }   

            $data = [
                'description' => $description,
                'file_path' => $file_path,
                'file_name' => $file_name,
                'submit_date' => $submit_date
            ];
            
            TugasJawaban::updateOrInsert(
                ['tugas_id' => $tugasId, 'siswa_id' => $siswa->id],
                $data 
            );

            return response()->json(['message' => 'Berhasil','message_description' => 'Mengisi Jawaban Tugas Berhasil!', 'data' => $existingRecord]);
            
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function updateUjian(Request $request)
    {
        try {
            $id = $request->input('id');
            $deskripsi = $request->input('deskripsi');
            $jenis_ujian_id = $request->input('jenis_ujian_id');
            $kode_ruangan = $request->input('kode_ruangan');
            $waktu_pengerjaan = $request->input('waktu_pengerjaan');

            $existingRecord = Ujian::find($id);

            if($request->input('tanggal_ujian') != ""){
                $tanggal_ujian = Carbon::createFromFormat('d M Y H:i', $request->input('tanggal_ujian'))->format('Y-m-d H:i:s');
            } else {
                $tanggal_ujian = null;
            }
            
            if ($existingRecord) {
                $existingRecord->update([
                    'deskripsi' => $deskripsi,
                    'jenis_ujian_id' => $jenis_ujian_id,
                    'kode_ruangan' => $kode_ruangan,
                    'waktu_pengerjaan' => $waktu_pengerjaan,
                    'tanggal_ujian' => $tanggal_ujian,
                ]);

                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Ujian Berhasil!', 'data' => $existingRecord]);
            } else {
                return response()->json(['message' => 'Gagal','message_description' => 'Tugas tidak ditemukan.']);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function materiDetailIndex($mataPelajaranId, $materiId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $materi = Materi::find($materiId);

        $materiKomentar = MateriKomentar::select(
            DB::raw("CASE WHEN materi_komentar.role= 'GURU' THEN guru.nama_guru WHEN materi_komentar.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN materi_komentar.role= 'SISWA' AND siswa.id = ".$siswa->id." THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN materi_komentar.role= 'SISWA' AND siswa.id != ".$siswa->id." THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
            'materi_komentar.description',
            'materi_komentar.created_at'
        )
        ->leftJoin('guru', 'materi_komentar.guru_siswa_id', '=', 'guru.id')
        ->leftJoin('siswa', 'materi_komentar.guru_siswa_id', '=', 'siswa.id')
        ->where('materi_komentar.materi_id', $materiId)
        ->orderBy('materi_komentar.created_at', 'asc')
        ->get();

        foreach ($materiKomentar as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }


        return view('siswa_pembelajaran_detail_materi_detail', compact('guruPembelajaran', 'materi', 'materiKomentar'));
    }

    public function tugasDetailIndex($mataPelajaranId, $tugasId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $tugas = Tugas::find($tugasId);

        $tugas->formatted_due_date = $tugas->due_date == '' ? '' : Carbon::parse($tugas->due_date)->format('d M Y');
        $tugas->formatted_due_time = $tugas->due_date == '' ? '' : Carbon::parse($tugas->due_date)->format('H:i');

        $tugasJawaban = TugasJawaban::select(
            'tugas_jawaban.*',
        )
        ->join('tugas', 'tugas.id', '=', 'tugas_jawaban.tugas_id')
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->where('tugas_jawaban.tugas_id', $tugasId)
        ->where('tugas_jawaban.siswa_id', $siswa->id)
        ->first();
        
        if ($tugasJawaban) {
            $tugasJawaban->formatted_submit_date = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('d M Y');
            $tugasJawaban->formatted_submit_time = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('H:i');
            $tugasJawaban->formatted_created_at = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('d M Y H:i');
            $tugasJawaban->formatted_updated_at = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawaban->updated_at)->format('d M Y H:i');
        } else {
            // Handle the case when $tugasJawaban is null
            // You can set default values or perform any other necessary actions
        }

        return view('siswa_pembelajaran_detail_tugas_detail', compact('guruPembelajaran', 'tugas', 'tugasJawaban'));
    }
    
    public function tugasDetailIndexJawaban($guruPembelajaranId, $tugasId, $siswaId){
        $authUserId = Auth::id();
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $tugas = Tugas::find($tugasId);

        $tugas->formatted_due_date = $tugas->due_date == '' ? '' : Carbon::parse($tugas->due_date)->format('d M Y');
        $tugas->formatted_due_time = $tugas->due_date == '' ? '' : Carbon::parse($tugas->due_date)->format('H:i');

        $tugasJawaban = TugasJawaban::select(
            'tugas_jawaban.*',
            'siswa.nama_siswa',
            DB::raw('DATE_FORMAT(tugas.submit_date, "%H:%i") as formatted_submit_date_time')

        )
        ->join('siswa', 'tugas_jawaban.siswa_id', '=', 'siswa.id')
        ->where('tugas_jawaban.siswa_id', $siswaId)
        ->where('tugas_jawaban.tugas_id', $tugasId)
        ->first();
        $currentSiswa = Siswa::where('id', $siswaId)->first();

        if (!$tugasJawaban) {
            $tugasJawaban = new TugasJawaban;
            $tugasJawaban->nilai = null;
            $tugasJawaban->description = null;
            $tugasJawaban->file_path = null;
            $tugasJawaban->file_name = null;
            $tugasJawaban->created_at = null;
            $tugasJawaban->updated_at = null;
            $tugasJawaban->siswa_id = $currentSiswa->id;
            $tugasJawaban->nama_siswa = $currentSiswa->nama_siswa;
        }
        
        $tugasJawaban->formatted_submit_date_date = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('d M Y');
        $tugasJawaban->formatted_submit_date_time = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('H:i');
        $tugasJawaban->formatted_created_at_date = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('d M Y');
        $tugasJawaban->formatted_created_at_time = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('H:i');
        $tugasJawaban->formatted_updated_at_date = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawaban->updated_at)->format('d M Y');
        $tugasJawaban->formatted_updated_at_time = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawaban->updated_at)->format('H:i');

        return view('siswa_pembelajaran_detail_tugas_detail_jawaban', compact('guruPembelajaran', 'tugas', 'tugasJawaban'));
    }
    

    public function ujianDetailIndex($mataPelajaranId, $ujianId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $existingRecord = UjianJawaban::select(
            'ujian_jawaban.*',
        )
        ->where('ujian_jawaban.ujian_id', $ujianId)
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->first();

        if(!$existingRecord){
            $newRecord = UjianJawaban::create([
                'ujian_id' => $ujianId,
                'siswa_id' => $siswa->id,
            ]);
        }

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian',
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->where('ujian.id', $ujianId)
        ->first();

        $ujian->formatted_tanggal_ujian_date = $ujian->tanggal_ujian == '' ? '' : Carbon::parse($ujian->tanggal_ujian)->format('d M Y');
        $ujian->formatted_tanggal_ujian_time = $ujian->tanggal_ujian == '' ? '' : Carbon::parse($ujian->tanggal_ujian)->format('H:i');

        $jenisUjian = JenisUjian::all();

        $ujianDetail = UjianDetail::select(
            'ujian_detail.*'
        )
        ->where('ujian_detail.ujian_id', $ujianId)
        ->orderBy('ujian_detail.id', 'asc')
        ->first();

        $ujianJawaban = UjianJawaban::select(
            'ujian_jawaban.*',
        )
        ->where('ujian_jawaban.ujian_id', $ujianId)
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->first();

        return view('siswa_pembelajaran_detail_ujian_detail', compact('guruPembelajaran', 'ujian', 'jenisUjian', 'ujianDetail', 'ujianJawaban'));
    }

    public function updateTugasNilai(Request $request)
    {
        try {
            $nilai = $request->input('nilai');
            $tugasJawabanId = $request->input('id');
            $tugasId = $request->input('tugas_id');
            $siswaId = $request->input('siswa_id');

            $existingRecord = TugasJawaban::find($tugasJawabanId);
            
            if ($existingRecord) {
                $existingRecord->update([
                    'nilai' => $nilai,
                ]);
                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Nilai Tugas Berhasil!', 'data' => $existingRecord]);
            } else {
                $newRecord = TugasJawaban::create([
                    'tugas_id' => $tugasId,
                    'siswa_id' => $siswaId,
                    'description' => null,
                    'file_path' => null,
                    'file_name' => null,
                    'nilai' => $nilai
                ]);
                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Nilai Tugas Berhasil!', 'data' => $newRecord]);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function getNextPrevTugasJawaban(Request $request)
    {
        $direction = $request->direction;
        $siswaId = $request->siswa_id;
        $tugasId = $request->tugas_id;

        if ($direction == 'prev') {
            $operator = '<';
            $orderBy = 'desc';
        } else {
            $operator = '>';
            $orderBy = 'asc';
        }

        $currentSiswa = Siswa::where('id', $siswaId)->first();
        $nextSiswa = Siswa::where('nama_siswa', $operator, $currentSiswa->nama_siswa)
            ->orderBy('nama_siswa', $orderBy)
            ->first();

        if (!$nextSiswa && $orderBy == 'asc') {
            $nextSiswa = Siswa::orderBy('nama_siswa', 'asc')->first();
        } else if (!$nextSiswa && $orderBy == 'desc') {
            $nextSiswa = Siswa::orderBy('nama_siswa', 'desc')->first();
        }

        $nextSiswaId = $nextSiswa->id ?? null;

        $tugasJawaban = null;

        if ($nextSiswaId) {
            $tugasJawaban = TugasJawaban::select('tugas_jawaban.*', 'siswa.nama_siswa')
                ->leftJoin('siswa', 'tugas_jawaban.siswa_id', '=', 'siswa.id')
                ->where('tugas_jawaban.tugas_id', $tugasId)
                ->where('tugas_jawaban.siswa_id', $nextSiswaId)
                ->first();
            
            if (!$tugasJawaban) {
                $tugasJawaban = new TugasJawaban;
                $tugasJawaban->nilai = null;
                $tugasJawaban->description = null;
                $tugasJawaban->file_path = null;
                $tugasJawaban->file_name = null;
                $tugasJawaban->created_at = null;
                $tugasJawaban->updated_at = null;

            }
            $tugasJawaban->siswa_id = $nextSiswa->id;
            $tugasJawaban->nama_siswa = $nextSiswa->nama_siswa;
        }

        $tugasJawaban->formatted_submit_date_date = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('d M Y');
        $tugasJawaban->formatted_submit_date_time = $tugasJawaban->submit_date == '' ? '' :  Carbon::parse($tugasJawaban->submit_date)->format('H:i');
        $tugasJawaban->formatted_created_at_date = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('d M Y');
        $tugasJawaban->formatted_created_at_time = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('H:i');
        $tugasJawaban->formatted_updated_at_date = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawaban->updated_at)->format('d M Y');
        $tugasJawaban->formatted_updated_at_time = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawaban->updated_at)->format('H:i');

        return response()->json([
            'success' => true,
            'data' => $tugasJawaban,
        ]);
    }

    public function addDiskusi(Request $request)
    {
        try {
            $authUserId = Auth::id();
            $authUserRole = Auth::user()->role;
            
            $guru_siswa_id = $request->input('guru_siswa_id');
            $description = $request->input('description');
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');

            if($authUserRole == 'GURU'){
                $guru = Guru::select(
                    'guru.id',
                )
                ->where('guru.user_id', $authUserId)
                ->first();
                $guru_siswa_id = $guru->id;
            } else {
                $siswa = Siswa::select(
                    'siswa.id',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
                $guru_siswa_id = $siswa->id;
            }

            $newRecord = Diskusi::create([
                'guru_pembelajaran_id' => $guru_pembelajaran_id,
                'guru_siswa_id' => $guru_siswa_id,
                'role' => $authUserRole,
                'description' => $description,
            ]);
            $newRecord->formatted_created_at = Carbon::parse($newRecord->created_at)->format('d M Y H:i');
            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Komentar Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function addUjian(Request $request)
    {
        try {
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');
            $jenis_ujian_id = $request->input('jenis_ujian_id');
            $deskripsi = $request->input('deskripsi');
            $kode_ruangan = $request->input('kode_ruangan');
            $waktu_pengerjaan = $request->input('waktu_pengerjaan');

            if($request->input('tanggal_ujian') != ""){
                $tanggal_ujian = Carbon::createFromFormat('d M Y H:i', $request->input('tanggal_ujian'))->format('Y-m-d H:i:s');
            }else{
                $tanggal_ujian = null;
            }
            
            $newRecord = Ujian::create([
                'guru_pembelajaran_id' => $guru_pembelajaran_id,
                'jenis_ujian_id' => $jenis_ujian_id,
                'deskripsi' => $deskripsi,
                'kode_ruangan' => $kode_ruangan,
                'waktu_pengerjaan' => $waktu_pengerjaan,
                'tanggal_ujian' => $tanggal_ujian
            ]);

            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Ujian Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function addUjianSoal(Request $request)
    {
        try {
            $ujian_id = $request->input('ujian_id');
            $jenis_soal_id = $request->input('jenis_soal_id');
            $deskripsi = $request->input('deskripsi');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            $optionsAndDescriptions = json_decode($request->input('optionsAndDescriptions'), true);
            
            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = null;
                $file_name = null;
            }
            
            $newRecord = UjianDetail::create([
                'ujian_id' => $ujian_id,
                'jenis_soal_id' => $jenis_soal_id,
                'soal' => $deskripsi,
                'file_path' => $file_path,
                'file_name' => $file_name,
            ]);
            $counter = 1;

            foreach ($optionsAndDescriptions as $data) {
                UjianDetailPilgan::create([
                    'ujian_detail_id' => $newRecord->id,
                    'is_jawaban' => $data['option'],
                    'jawaban' => $data['description'],
                    'no_jawaban' => $counter++
                ]);
            }
            return response()->json(['message' => 'Berhasil','message_description' => 'Menambahkan Soal Berhasil!', 'data' => $newRecord]);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function ujianDetailIndexSoal($mataPelajaranId, $ujianId, $soalId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $ujianDetailPilgan = UjianDetail::select(
            'ujian_detail_pilgan.*',
            DB::raw("CASE WHEN ujian_jawaban_detail.ujian_detail_pilgan_id = ujian_detail_pilgan.id THEN 1 ELSE 0 END AS is_jawaban_siswa"),
        )
        ->leftJoin('ujian_jawaban', 'ujian_jawaban.ujian_id', '=', 'ujian_detail.ujian_id')
        ->leftJoin('ujian_jawaban_detail', function ($join) use ($soalId) {
            $join->on('ujian_jawaban.id', '=', 'ujian_jawaban_detail.ujian_jawaban_id')
                ->where('ujian_jawaban_detail.ujian_detail_id', '=', $soalId);
        })
        ->leftJoin('ujian_detail_pilgan', function ($join) {
            $join->on('ujian_detail_pilgan.ujian_detail_id', '=', 'ujian_detail.id');
        })
        ->join('jenis_soal', 'jenis_soal.id', '=', 'ujian_detail.jenis_soal_id')
        ->where('ujian_detail.ujian_id', $ujianId)
        ->where('ujian_detail.id', $soalId)
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->orderBy('ujian_detail.jenis_soal_id', 'desc')
        ->orderBy('ujian_detail.created_at', 'asc')
        ->get();

        $ujianDetail = UjianDetail::select(
            'ujian_detail.*',
            'ujian_detail.id as ud_ujian_detail_id',
            'ujian_detail.jenis_soal_id as ujian_detail_jenis_soal_id',
            'ujian_jawaban_detail.*',
            'ujian_jawaban.id as ujian_jawaban_id'
        )
        ->leftJoin('ujian_jawaban', 'ujian_jawaban.ujian_id', '=', 'ujian_detail.ujian_id')
        ->leftJoin('ujian_jawaban_detail', function ($join) use ($soalId) {
            $join->on('ujian_jawaban.id', '=', 'ujian_jawaban_detail.ujian_jawaban_id')
                ->where('ujian_jawaban_detail.ujian_detail_id', '=', $soalId)
                ->where('ujian_jawaban_detail.jenis_soal_id', '=', 1);
        })
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->where('ujian_detail.id', $soalId)
        ->first();

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian',
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->where('ujian.id', $ujianId)
        ->first();

        $jenisSoal = JenisSoal::all();

        $ujianJawaban = UjianJawaban::select(
            'ujian_jawaban.*',
            'ujian_jawaban_detail.ujian_detail_pilgan_id as ujian_detail_pilgan_id',
        )
        ->leftJoin('ujian_jawaban_detail', function ($join) use ($soalId) {
            $join->on('ujian_jawaban.id', '=', 'ujian_jawaban_detail.ujian_jawaban_id')
            ->where('ujian_jawaban_detail.ujian_detail_id', '=', $soalId);;
        })
        ->where('ujian_jawaban.ujian_id', $ujianId)
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->first();
        
        return view('siswa_pembelajaran_detail_ujian_detail_soal', compact('guruPembelajaran', 'ujianDetail', 'ujianDetailPilgan', 'jenisSoal', 'ujian', 'ujianJawaban'));
    }   

    public function ujianDetailIndexList($mataPelajaranId, $ujianId){
        $authUserId = Auth::id();
        $siswa = Siswa::select(
                    'siswa.*',
                )
                ->where('siswa.user_id', $authUserId)
                ->first();
        
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.kelas_id', $siswa->kelas_id)
        ->where('guru_pembelajaran.mata_pelajaran_id', $mataPelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $ujianDetail = UjianDetail::select(
            DB::raw('ROW_NUMBER() OVER (ORDER BY ujian_detail.created_at ASC) as row_num'),
            'ujian_detail.*'
        )
        ->where('ujian_detail.ujian_id', $ujianId)
        ->orderBy('ujian_detail.created_at', 'asc')
        ->get();

        $ujian = Ujian::select(
            'ujian.*',
            'jenis_ujian.jenis_ujian',
        )
        ->join('jenis_ujian', 'ujian.jenis_ujian_id', '=', 'jenis_ujian.id')
        ->where('ujian.id', $ujianId)
        ->first();

        $ujianJawaban = UjianJawaban::select(
            'ujian_jawaban.*',
        )
        ->where('ujian_jawaban.ujian_id', $ujianId)
        ->where('ujian_jawaban.siswa_id', $siswa->id)
        ->first();

        return view('siswa_pembelajaran_detail_ujian_detail_list', compact('guruPembelajaran', 'ujianDetail', 'ujian', 'ujianJawaban'));
    }

    public function updateUjianSoal(Request $request)
    {
        try {
            $ujian_id = $request->input('ujian_id');
            $jenis_soal_id = $request->input('jenis_soal_id');
            $deskripsi = $request->input('deskripsi');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            $ujian_detail_id = $request->input('ujian_detail_id');
            $optionsAndDescriptions = json_decode($request->input('optionsAndDescriptions'), true);

            if ($request->hasFile('file_path')) {
                $file_path = $request->file('file_path')->storeAs(
                    'file',
                    $file_name_no_ext . '-' . Carbon::now()->timestamp . '.' . $request->file('file_path')->getClientOriginalExtension(),
                    'public'
                );
            } else {
                $file_path = null;
                $file_name = null;
            }

            $existingRecord = UjianDetail::find($ujian_detail_id);
            if ($existingRecord){
                $existingRecord->update([
                    'jenis_soal_id' => $jenis_soal_id,
                    'soal' => $deskripsi,
                    'file_path' => $file_path,
                    'file_name' => $file_name,
                ]);
                $counter = 1;
                if ($jenis_soal_id == 2){    
                    foreach ($optionsAndDescriptions as $data) {
                        $ujianDetailPilgan = UjianDetailPilgan::where('ujian_detail_id', $ujian_detail_id)->where('no_jawaban', $counter)->first();
                        if ($ujianDetailPilgan ){
                            $ujianDetailPilgan->update([
                                'is_jawaban' => $data['option'],
                                'jawaban' => $data['description'],
                            ]);
                        } else {
                            UjianDetailPilgan::create([
                                'ujian_detail_id' => $ujian_detail_id,
                                'is_jawaban' => $data['option'],
                                'jawaban' => $data['description'],
                                'no_jawaban' => $counter++
                            ]);
                        }
                    }
                } else {
                    $ujianDetailPilgan = UjianDetailPilgan::where('ujian_detail_id', $ujian_detail_id)->delete();
                }
                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Soal Berhasil!', 'data' => $existingRecord]);
            } else {
                return response()->json(['message' => 'Gagal','message_description' => 'Soal tidak ditemukan.']);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }    
    
    public function deleteUjian(Request $request)
    {
        try {
            $id = $request->input('id');
            $ujian = Ujian::find($id);

            if ($ujian) {
                $ujian->delete();

                return response()->json(['message' => 'Berhasil', 'message_description' => 'Menghapus Ujian Berhasil!']);
            } else {
                return response()->json(['message' => 'Gagal', 'message_description' => 'Ujian tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal', 'message_description' => $e->getMessage()], 500);
        }
    }    

    public function deleteUjianSoal(Request $request)
    {
        try {
            $id = $request->input('id');
            $ujianDetail = UjianDetail::find($id);

            if ($ujianDetail) {
                $ujianDetail->delete();

                return response()->json(['message' => 'Berhasil', 'message_description' => 'Menghapus Soal Berhasil!']);
            } else {
                return response()->json(['message' => 'Gagal', 'message_description' => 'Soal tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal', 'message_description' => $e->getMessage()], 500);
        }
    }    

    public function ujianDetailIndexJawaban($guruPembelajaranId, $ujianId, $siswaId){
        $authUserId = Auth::id();
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $ujian = Ujian::select(
            'ujian.*'
        )
        ->where('ujian.id', $ujianId)
        ->first();

        $ujianDetail = UjianDetail::select(
            DB::raw('ROW_NUMBER() OVER (ORDER BY ujian_detail.jenis_soal_id DESC, ujian_detail.created_at ASC) as row_num'),
            'ujian_detail.*',
            'ujian_detail.jenis_soal_id as ujian_detail_jenis_soal_id',
            DB::raw("CASE WHEN ujian_jawaban_detail.ujian_detail_pilgan_id = ujian_detail_pilgan.id THEN 1 ELSE 0 END AS is_benar"),
            'jenis_soal.jenis_soal as deskripsi_jenis_soal',
        )
        ->leftJoin('ujian_detail_pilgan', function ($join) use ($siswaId) {
            $join->on('ujian_detail.id', '=', 'ujian_detail_pilgan.ujian_detail_id')
            ->where('ujian_detail_pilgan.is_jawaban', '=', 1);;
        })
        ->leftJoin('ujian_jawaban_detail', 'ujian_jawaban_detail.ujian_detail_id', '=', 'ujian_detail_pilgan.ujian_detail_id')
        ->leftJoin('ujian_jawaban', function ($join) use ($siswaId) {
            $join->on('ujian_jawaban.id', '=', 'ujian_jawaban_detail.ujian_jawaban_id')
            ->where('ujian_jawaban.siswa_id', '=', $siswaId);;
        })
        ->join('jenis_soal', 'jenis_soal.id', '=', 'ujian_detail.jenis_soal_id')
        ->where('ujian_detail.ujian_id', $ujianId)
        ->orderBy('ujian_detail.jenis_soal_id', 'desc')
        ->orderBy('ujian_detail.created_at', 'asc')
        ->get();

        $siswa = Siswa::select(
            'siswa.*'
        )
        ->where('siswa.id', $siswaId)
        ->first();

        $ujianJawaban = UjianJawaban::select(
            'ujian_jawaban.*'
        )
        ->where('ujian_jawaban.siswa_id', $siswaId)
        ->where('ujian_jawaban.ujian_id', $ujianId)
        ->first();
        
        return view('siswa_pembelajaran_detail_ujian_detail_jawaban', compact('guruPembelajaran', 'siswa', 'ujian', 'ujianDetail', 'ujianJawaban'));
    }

    public function ujianDetailIndexJawabanSiswa($guruPembelajaranId, $ujianId, $siswaId, $soalId){
        $authUserId = Auth::id();
        $guruPembelajaran = GuruPembelajaran::select(
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('kelas.nama_kelas', 'asc')
        ->first();

        $ujian = Ujian::select(
            'ujian.*'
        )
        ->where('ujian.id', $ujianId)
        ->first();

        $ujianDetailPilgan = UjianDetailPilgan::select(
            'ujian_detail_pilgan.*',
            DB::raw("CASE WHEN ujian_jawaban_detail.ujian_detail_pilgan_id = ujian_detail_pilgan.id THEN 1 ELSE 0 END AS is_jawaban_siswa"),
        )
        ->leftJoin('ujian_jawaban_detail', function ($join) use ($soalId) {
            $join->on('ujian_detail_pilgan.id', '=', 'ujian_jawaban_detail.ujian_detail_pilgan_id');
        })
        ->leftJoin('ujian_jawaban', function ($join) use ($siswaId) {
            $join->on('ujian_jawaban_detail.ujian_jawaban_id', '=', 'ujian_jawaban.id')
                ->where('ujian_jawaban.siswa_id', '=', $siswaId);
        })
        ->where('ujian_detail_pilgan.ujian_detail_id', $soalId)
        ->orderBy('no_jawaban', 'asc')
        ->get();

        $ujianDetail = UjianDetail::select(
            'ujian_detail.*',
            'ujian_detail.id as ud_ujian_detail_id',
            'ujian_detail.jenis_soal_id as ujian_detail_jenis_soal_id',
            'ujian_jawaban_detail.*',
            'ujian_jawaban.id as ujian_jawaban_id'
        )
         ->leftJoin('ujian_jawaban_detail', function ($join) use ($soalId) {
            $join->on('ujian_detail.id', '=', 'ujian_jawaban_detail.ujian_detail_id')
                ->where('ujian_jawaban_detail.jenis_soal_id', '=', 1);
        })
        ->leftJoin('ujian_jawaban', function ($join) use ($siswaId) {
            $join->on('ujian_jawaban_detail.ujian_jawaban_id', '=', 'ujian_jawaban.id')
                ->where('ujian_jawaban.siswa_id', '=', $siswaId);
        })
        ->where('ujian_detail.id', $soalId)
        ->first();

        $siswa = Siswa::select(
            'siswa.*'
        )
        ->where('siswa.id', $siswaId)
        ->first();

        $jenisSoal = JenisSoal::all();

        $benarSalah = UjianDetailPilgan::select(
            DB::raw("CASE WHEN ujian_jawaban_detail.ujian_detail_pilgan_id = ujian_detail_pilgan.id THEN 1 ELSE 0 END AS is_benar"),
        )
        ->join('ujian_jawaban_detail', 'ujian_jawaban_detail.ujian_detail_id', '=', 'ujian_detail_pilgan.ujian_detail_id')
        ->join('ujian_jawaban', 'ujian_jawaban.id', '=', 'ujian_jawaban_detail.ujian_jawaban_id')
        ->where('ujian_detail_pilgan.ujian_detail_id', $soalId)
        ->where('ujian_jawaban.siswa_id', $siswaId)
        ->where('ujian_detail_pilgan.is_jawaban', 1)
        ->orderBy('no_jawaban', 'asc')
        ->first();

        return view('siswa_pembelajaran_detail_ujian_detail_jawaban_siswa', compact('guruPembelajaran', 'siswa', 'ujian', 'ujianDetail', 'jenisSoal', 'ujianDetailPilgan', 'benarSalah'));
    }

    public function updateUjianNilai(Request $request)
    {
        try {
            $nilai = $request->input('nilai');
            $id = $request->input('id');
            $ujian_id = $request->input('ujianId');

            $existingRecord = UjianJawaban::find($id);
            
            if ($existingRecord) {
                $existingRecord->update([
                    'nilai' => $nilai,
                ]);
                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Nilai Ujian Berhasil!', 'data' => $existingRecord]);
            } else {
                $newRecord = TugasJawaban::create([
                    'ujian_id' => $ujian_id,
                    'siswa_id' => $siswaId,
                    'finish_date' => null,
                    'nilai' => $nilai
                ]);
                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Nilai Ujian Berhasil!', 'data' => $newRecord]);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function nilaiBulkUpdate(Request $request)
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

    public function updateUjianJawaban(Request $request)
    {
        
        try {
            $authUserId = Auth::id();
            $siswa = Siswa::select(
                'siswa.*',
            )
            ->where('siswa.user_id', $authUserId)
            ->first();

            $ujian_jawaban_id = $request->input('ujian_jawaban_id');
            $ujian_detail_id = $request->input('ujian_detail_id');
            $jawaban_ujian_detail_pilgan_id = $request->input('jawaban_ujian_detail_pilgan_id');
            $jawaban_deskripsi = $request->input('jawaban_deskripsi');
            $jenis_soal_id = $request->input('jenis_soal_id');
            
            $data = [
                
                'ujian_detail_pilgan_id' => $jawaban_ujian_detail_pilgan_id,
                'jawaban_deskripsi' => $jawaban_deskripsi,
                'jenis_soal_id' => $jenis_soal_id,
            ];
            
            UjianJawabanDetail::updateOrInsert(
                ['ujian_jawaban_id' => $ujian_jawaban_id, 'ujian_detail_id' => $ujian_detail_id],
                $data 
            );

            $existingRecord = UjianJawabanDetail::select(
                'ujian_jawaban_detail.*',
            )
            ->where('ujian_jawaban_id', $ujian_jawaban_id)
            ->where('ujian_detail_id', $ujian_detail_id)
            ->first(); 

            return response()->json(['message' => 'Berhasil','message_description' => 'Mengisi Jawaban Ujian Berhasil!', 'data' => $existingRecord]);
            
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }    

    public function updateFinishUjianJawaban(Request $request)
    {
        
        try {
            $authUserId = Auth::id();
            $siswa = Siswa::select(
                'siswa.*',
            )
            ->where('siswa.user_id', $authUserId)
            ->first();

            $ujian_jawaban_id = $request->input('ujian_jawaban_id');
            $finish_date = now();

            $data = [
                'finish_date' => $finish_date,
            ];
            
            UjianJawaban::updateOrInsert(
                ['id' => $ujian_jawaban_id],
                $data 
            );

            $existingRecord = UjianJawaban::select(
                'ujian_jawaban.*',
            )
            ->where('id', $ujian_jawaban_id)
            ->first(); 

            return response()->json(['message' => 'Berhasil','message_description' => 'Menyelesaikan  Ujian Berhasil!', 'data' => $existingRecord]);
            
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }    
}
