<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormValidationRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Validator;
use App\Agenda;
use App\Ruangan;
use App\Pegawai;
use App\User;

class AgendaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        session()->put('halaman','agenda');
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

        $pic = Auth::user()->name;
        $agenda = new Agenda;
        $agenda->nama_agenda = $request->nama_agenda;
        $agenda->ruangan_id = $request->ruangan;
        $agenda->tanggal = $request->tanggal;
        $agenda->waktu_mulai = $waktu_mulai;
        $agenda->waktu_selesai = $waktu_selesai;
        $agenda->keterangan = $request->keterangan;
        $agenda->status = 'Scheduled';
        $agenda->pic = $pic;
        $agenda->save();

        return redirect('/agenda');
    }

    public function edit($id){
        
        $agenda = Agenda::find($id);
        $ruangan = Ruangan::all();
        return view('agenda_edit', ['ruangan' => $ruangan,'agenda' => $agenda]);
    }

    public function update($id, Request $request){
        
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

        $agenda = Agenda::find($id);
        $agenda->nama_agenda = $request->nama_agenda;
        $agenda->ruangan_id = $request->ruangan;
        $agenda->tanggal = $request->tanggal;
        $agenda->waktu_mulai = $waktu_mulai;
        $agenda->waktu_selesai = $waktu_selesai;
        $agenda->keterangan = $request->keterangan;
        
        $agenda->save();
		
        return redirect('/agenda');
	}

    public function delete($id)
    {
        $agenda = Agenda::find($id);
        $agenda->delete();

        return redirect('/agenda');
    }

    public function undangan($id)
    {
        
    	// mengambil semua data pengguna
    	$agenda = Agenda::find($id);
        // lempar juga data pegawai
        $pegawai = User::all();
    	// return data ke view
    	return view('undangan', ['id'=>$id, 'agenda' => $agenda, 'pegawai' => $pegawai]);
    }

    public function tambahpeserta($id,Request $request){
        //$this->validate($request,[
        //    'peserta' => 'required|unique:agenda_user,user_id,agenda_id' . $id,
        //]);
        
        $cari = Agenda::whereHas('user', function ($query) use($request) {
            $query->where('user_id', '=', $request->peserta)
                ->where('agenda_id','=', $request->id);
        })->count();   

        //$cari = Agenda::find($id)
        //    ->where('user_id', '=', $request->peserta)
        //    ->get();

        if(empty($cari)) {

            $user = $request->peserta;
            $user = User::find($user);
            $agenda = Agenda::find($id);
            $user->agenda()->attach($agenda, ['presensi' => 'belum']);
            
            return redirect("/agenda/undangan/$id");
        }
        else{
            return redirect("/agenda/undangan/$id")->withErrors(['Peserta sudah pernah ditambahkan', 'The Message']);
        }

        
    }
}
