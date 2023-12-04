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

class AdminKelasController extends Controller
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
    public function indexList(){
        // $tingkat_kelas = Kelas::all();

        $tingkat_kelas = Kelas::select('tingkat_kelas')->distinct()->get();

        // Mengelompokkan kelas berdasarkan tingkat kelas
        $kelasPerTingkat = [];

        foreach ($tingkat_kelas as $tingkat) {
            $kelasPerTingkat[$tingkat->tingkat_kelas] = Kelas::where('tingkat_kelas', $tingkat->tingkat_kelas)->get();
        }

        return view('admin_kelas_list', compact('kelasPerTingkat'));
    }
}
