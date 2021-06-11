<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Crypt;
use DateTime;
use App\Agenda;
use App\Pegawai;
use App\User;

class PresensiController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $id = Crypt::decrypt($id);
    	// mengambil semua data pengguna
    	$agenda = Agenda::find($id);
        $pegawai = Auth::user();
    	// return data ke view
    	return view('presensi', ['agenda' => $agenda, 'pegawai' => $pegawai]);
    }

    public function presensi($id, Request $request){
        $user_id = $request->user_id;
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        //$presensi = "Sudah";

        //$agenda  = Agenda::where('id', $id)->get();
        //foreach($messages as $message)
        //$agenda->user()->updateExistingPivot($user_id, array('presensi' => 'sudah', 'presensi_at' => $now), false);
        Agenda::find($id)->user()->updateExistingPivot($user_id, array('presensi' => 'sudah', 'presensi_at' => $now), false);

        $id = Crypt::encrypt($id);
        return redirect("presensi/undangan/$id");
    }
}
