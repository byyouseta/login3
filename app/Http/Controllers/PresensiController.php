<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //session()->put('halaman','agenda');
    	// mengambil semua data pengguna
    	$agenda = Agenda::find($id);
        $pegawai = Auth::user();
    	// return data ke view
    	return view('presensi', ['agenda' => $agenda, 'pegawai' => $pegawai]);
    }
}
