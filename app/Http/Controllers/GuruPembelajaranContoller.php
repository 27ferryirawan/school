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

        $materi = Materi::all();

        // Format timestamps in Materi records
        foreach ($materi as $materiItem) {
            $materiItem->formatted_created_at = Carbon::parse($materiItem->created_at)->format('d M Y H:i');
            $materiItem->formatted_updated_at = Carbon::parse($materiItem->updated_at)->format('d M Y H:i');
        }

        return view('guru_pembelajaran_detail', compact('guruPembelajaran', 'materi'));
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

    public function addMateri(Request $request)
    {
        try {
            // Validate your request data as needed 

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
            
            // If it doesn't exist, create a new record
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

    public function deleteMateri(Request $request)
    {
        try {
            // Find the Materi record by ID
            $id = $request->input('id');
            $materi = Materi::find($id);

            // Check if the Materi record exists
            if ($materi) {
                // Delete the file associated with the Materi record
                Storage::disk('public')->delete($materi->file_path);

                // Delete the Materi record from the database
                $materi->delete();

                return response()->json(['message' => 'Berhasil', 'message_description' => 'Menghapus Materi Berhasil!']);
            } else {
                // Materi record not found
                return response()->json(['message' => 'Gagal', 'message_description' => 'Materi tidak ditemukan.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal', 'message_description' => $e->getMessage()], 500);
        }
    }

    public function updateMateri(Request $request)
    {
        try {
            // Validate your request data as needed 

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
            

            // If the record exists, update it; otherwise, create a new one
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

        return view('guru_pembelajaran_detail_materi_detail', compact('guruPembelajaran', 'materi'));
    }
    
}
