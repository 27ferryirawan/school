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
            $guruId = $request->input('guru_id');
            $kelasId = $request->input('kelas_id');
            $tahunAjaranId = $request->input('tahun_ajaran_id');
            $mataPelajaranId = $request->input('mata_pelajaran_id');

            $existingRecord = GuruPembelajaran::where([
                'guru_id' => $guruId,
                'kelas_id' => $kelasId,
                'tahun_ajaran_id' => $tahunAjaranId,
                'mata_pelajaran_id' => $mataPelajaranId,
            ])->first();

            if ($existingRecord) {
                return response()->json(['message' => 'Data pembelajaran sudah tersedia', 'data' => $existingRecord]);
            }

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

    public function detailIndex($guruPembelajaranId){
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

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        return view('guru_pembelajaran_detail', compact('guruPembelajaran', 'materi', 'tugas'));
    }

    public function detailSortIndex($guruPembelajaranId, Request $request){
        $authUserId = Auth::id();
        $column = $request->input('column');
        $order = $request->input('order');
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

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
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
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('tugas.created_at', 'asc')
        ->get();

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        return view('guru_pembelajaran_detail', compact('guruPembelajaran', 'materi', 'tugas'));
    }

    public function detailSortIndexTugas($guruPembelajaranId, Request $request){
        $authUserId = Auth::id();
        $column = $request->input('column');
        $order = $request->input('order');
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

        $tugas = Tugas::select(
            'tugas.*'
        )
        ->join('guru_pembelajaran', 'tugas.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy($column, $order)
        ->get();

        $materi = Materi::select(
            'materi.*'
        )
        ->join('guru_pembelajaran', 'materi.guru_pembelajaran_id', '=', 'guru_pembelajaran.id')
        ->where('guru_pembelajaran.id', $guruPembelajaranId)
        ->orderBy('materi.created_at', 'asc')
        ->get();

        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        foreach ($tugas as $tugasItem) {
            $tugasItem->formatted_created_at = Carbon::parse($tugasItem->created_at)->format('d M Y H:i');
            $tugasItem->formatted_due_date = $tugasItem->due_date == "" ? '' : Carbon::parse($tugasItem->due_date)->format('d M Y H:i');
            $tugasItem->formatted_updated_at = Carbon::parse($tugasItem->updated_at)->format('d M Y H:i');
        }

        return view('guru_pembelajaran_detail', compact('guruPembelajaran', 'tugas', 'materi'));
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

        return view('guru_pembelajaran_detail_add_materi', compact('guruPembelajaran'));
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

        return view('guru_pembelajaran_detail_add_tugas', compact('guruPembelajaran'));
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
                $siswa = Guru::select(
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

    public function updateTugas(Request $request)
    {
        try {
            $guru_pembelajaran_id = $request->input('guru_pembelajaran_id');
            $title = $request->input('title');
            $description = $request->input('description');
            $file_name = $request->input('file_name');
            $file_name_no_ext = $request->input('file_name_no_ext');
            $tugasId = $request->input('id');
            if($request->input('due_date') != ""){
                $due_date = Carbon::createFromFormat('d M Y H:i', $request->input('due_date'))->format('Y-m-d H:i:s');
            } else {
                $due_date = null;
            }
            $existingRecord = Tugas::find($tugasId);
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
                    'file_name' => $file_name,
                    'due_date' => $due_date
                ]);

                return response()->json(['message' => 'Berhasil','message_description' => 'Mengubah Tugas Berhasil!', 'data' => $existingRecord]);
            } else {
                return response()->json(['message' => 'Gagal','message_description' => 'Tugas tidak ditemukan.']);
            }
        } catch (QueryException $e) {
            return response()->json(['message' => 'Gagal','message_description' =>  $e->getMessage()], 500);
        }
    }

    public function materiDetailIndex($guruPembelajaranId, $materiId){
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

        $materi = Materi::find($materiId);

        $materiKomentar = MateriKomentar::select(
            DB::raw("CASE WHEN materi_komentar.role= 'GURU' THEN guru.nama_guru WHEN materi_komentar.role= 'SISWA' THEN siswa.nama_siswa ELSE '' END AS nama"),
            DB::raw("CASE WHEN materi_komentar.role= 'GURU' THEN 1 WHEN 0 THEN siswa.nama_siswa ELSE 2 END AS is_guru"),
            DB::raw("CASE WHEN materi_komentar.role= 'SISWA' THEN siswa.id WHEN 0 THEN siswa.nama_siswa ELSE -1 END AS siswa_id"),
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

        return view('guru_pembelajaran_detail_materi_detail', compact('guruPembelajaran', 'materi', 'materiKomentar'));
    }

    public function tugasDetailIndex($guruPembelajaranId, $tugasId){
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

        $tugasJawaban = Siswa::select(
            'siswa.nama_siswa',
            'tugas_jawaban.*'
        )
        ->leftJoin('tugas_jawaban', function ($join) use ($tugasId) {
            $join->on('siswa.id', '=', 'tugas_jawaban.siswa_id')
                ->where('tugas_jawaban.tugas_id', '=', $tugasId);
        })
        ->orderBy('siswa.nama_siswa', 'asc')
        ->get();
        foreach ($tugasJawaban as $tugasJawabanItem) {
            $tugasJawabanItem->formatted_created_at = $tugasJawabanItem->created_at == '' ? '' :  Carbon::parse($tugasJawabanItem->created_at)->format('d M Y H:i');
            $tugasJawabanItem->formatted_updated_at = $tugasJawabanItem->updated_at == '' ? $tugasJawabanItem->formatted_created_at : Carbon::parse($tugasJawabanItem->updated_at)->format('d M Y H:i');
        }

        return view('guru_pembelajaran_detail_tugas_detail', compact('guruPembelajaran', 'tugas', 'tugasJawaban'));
    }
    
    public function tugasDetailIndexJawaban($guruPembelajaranId, $tugasId, $tugasJawabanId){
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
        )
        ->join('siswa', 'tugas_jawaban.siswa_id', '=', 'siswa.id')
        ->where('tugas_jawaban.id', $tugasJawabanId)
        ->first();
    
        $tugasJawaban->formatted_created_at = $tugasJawaban->created_at == '' ? '' :  Carbon::parse($tugasJawaban->created_at)->format('d M Y H:i');
        $tugasJawaban->formatted_updated_at = $tugasJawaban->updated_at == '' ? $tugasJawaban->formatted_created_at : Carbon::parse($tugasJawabanItem->updated_at)->format('d M Y H:i');

        return view('guru_pembelajaran_detail_tugas_detail_jawaban', compact('guruPembelajaran', 'tugas', 'tugasJawaban'));
    }
}
