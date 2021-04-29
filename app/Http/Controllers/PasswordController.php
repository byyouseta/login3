<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class PasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
		return view('auth.password', compact('user'));
	}

    public function change(Request $request){

        $this->validate($request,[
            'password' => 'required|min:6',
            'password_new' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password_new|min:6'
        ]);

        $hashedPassword = Auth::user()->password;
        $password_lama = $request->password;
        $id = Auth::user()->id;
        if (Hash::check($password_lama, $hashedPassword))
        {
            // The passwords match...
            $password = Hash::make($request->password_new);
            $pesan = 'password berhasil diubah';
            $user = User::find($id);
            $user->password = $password;
            $user->save();
        }
        else{
            $pesan = 'password lama salah atau gagal diubah';
        }
		return view('auth.password', compact('pesan'));
	}
}
