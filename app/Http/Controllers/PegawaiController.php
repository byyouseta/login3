<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class PegawaiController extends Controller
{
    //
    public function index()
    {
    	// mengambil semua data pengguna
    	$pegawai = User::all();
    	// return data ke view
    	return view('pegawai', ['pegawai' => $pegawai]);
    }
}
