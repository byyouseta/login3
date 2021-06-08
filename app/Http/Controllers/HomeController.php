<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;
use app\Agenda;
use app\Pegawai;
use app\Ruangan;

class HomeController extends Controller
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
    public function index()
    { 
        session()->put('halaman','home');
        $count_agenda1 = DB::table('agenda')
                    ->where('agenda.status', '=','Dijadwalkan')
                    ->count();
        $count_pegawai = DB::table('pegawai')->count();
        $count_agenda2 = DB::table('agenda')
                    ->where('agenda.status', '=','Pengajuan')
                    ->count();
        
        return view('home', [
            'agenda_terjadwal' => $count_agenda1,
            'agenda_diajukan' => $count_agenda2,
            'pegawai' => $count_pegawai,
        ]);
    }

}
