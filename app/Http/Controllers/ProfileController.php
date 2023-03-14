<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => 'required|string|regex:/\w*$/|max:255|unique:users,username',
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required','regex:/^[0-9]{10}$/']
        ]);
    }

    public function index(){
        // get id of current user 
        $user = User::find(Auth::user()->id);
        return view('profile', compact('user'));
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
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'profile_picture' => $profilePicture,
            ]);
        }else {
            User::where('id', Auth::user()->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'profile_picture' => $profilePicture,
            ]);
        }

        // $user = User::find(Auth::user()->id);
        // return view('profile', compact('user'));
        return redirect('profile');
    }
}
