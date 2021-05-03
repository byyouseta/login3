<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Agenda;
use App\Ruangan;
use App\Pegawai;

class AgendaController extends Controller
{
    //
    public function index()
    {
    	// mengambil semua data pengguna
    	$agenda = Agenda::orderBy('tanggal', 'ASC')->get();
    	// return data ke view
    	return view('agenda', ['agenda' => $agenda]);
    }

    public function tambah()
    {
        # code...
        $ruangan = Ruangan::all();
        $pegawai = Auth::user();
        return view('tambahagenda', ['ruangan' => $ruangan, 'pic' => $pegawai]);
    }

    public function tambahagenda(Request $request){
        
        $this->validate($request,[
            'nama_agenda' => 'required|min:6',
            'ruangan' => 'required',
            'tanggal' => 'required|min:10',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'keterangan' => 'required',
        ]);
        
        //Konversi waktu mulai
        $waktu_mulai = $request->get('waktu_mulai');
        $waktu_mulai = DateTime::createFromFormat( 'H:i A', $waktu_mulai);
        $waktu_mulai = $waktu_mulai->format( 'H:i:s');
        //Konversi waktu selesai
        $waktu_selesai = $request->get('waktu_selesai');
        $waktu_selesai = DateTime::createFromFormat( 'H:i A', $waktu_selesai);
        $waktu_selesai = $waktu_selesai->format( 'H:i:s');

        $pic = Auth::user()->id;
        $agenda = new Agenda;
        $agenda->nama_agenda = $request->nama_agenda;
        $agenda->ruangan_id = $request->ruangan;
        $agenda->tanggal = $request->tanggal;
        $agenda->waktu_mulai = $waktu_mulai;
        $agenda->waktu_selesai = $waktu_selesai;
        $agenda->keterangan = $request->keterangan;
        $agenda->status = 'Scheduled';
        $agenda->user_id = $pic;
        $agenda->save();

        return redirect('/agenda');
    }
}
