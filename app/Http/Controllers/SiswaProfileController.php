<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaProfileController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/";

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'NISN' => ['required', 'string', 'max:255'],
            'gender' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'agama' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function index(){
        // $user = User::find(Auth::user()->id);
        $user = User::select(
            'users.*',
            'siswa.*',
            'kelas.nama_kelas'
        )
        ->join('siswa', 'users.id', '=', 'siswa.user_id')
        ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
        ->where('users.id', Auth::user()->id)
        ->first();

        return view('siswa_profile', compact('user'));
    }

    public function editProfile(Request $request){
        if($request->hasfile('profile_picture')){
            $profilePicture = $request->file('profile_picture')->storeAs(
               'images',
               'ProfilePicture' . '-' . $request->name . '.' . $request->file('profile_picture')->getClientOriginalExtension(),
               'public'
            );
        }else{
            $checkImg = User::find(Auth::user()->id);
            $profilePicture = $checkImg->profile_picture;
        }
        // update by current user logged id 
        if($request->password != null){
            User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_picture' => $profilePicture,
            ]);

            Siswa::where('user_id', Auth::user()->id)
            ->update([
                'NISN' => $request->NISN,
                'agama' => $request->agama,
            ]);
        }else {
            User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_picture' => $profilePicture,
            ]);

            Siswa::where('user_id', Auth::user()->id)
            ->update([
                'NISN' => $request->NISN,
                'agama' => $request->agama,
            ]);
        }

        // $user = User::find(Auth::user()->id);
        // return view('profile', compact('user'));
        return redirect('siswa_profile');
    }
}
