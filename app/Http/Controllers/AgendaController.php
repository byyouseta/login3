<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormValidationRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use DateTime;
use App\Agenda;
use App\User;
use App\Ruangan;
use App\Pegawai;

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
    	       
        $query = DB::table('agenda')
            ->join('agenda_user', 'agenda.id', '=', 'agenda_user.agenda_id')
            ->join('ruangan', 'agenda.ruangan_id', '=', 'ruangan.id')
            ->select('agenda.*', 'ruangan.nama as nama_ruangan', DB::raw('COUNT(agenda_user.user_id) as peserta'))
            ->groupBy('agenda.id', 'agenda.nama_agenda', 'agenda.tanggal', 'agenda.waktu_mulai', 
                'agenda.waktu_selesai', 'agenda.ruangan_id', 'agenda.status', 'agenda.keterangan',
                'agenda.pic', 'agenda.notulen', 'agenda.updated_at', 'agenda.created_at', 'ruangan.nama')
            ->orderBy('tanggal', 'asc')
            //->where('agenda.status', '=','Scheduled')
            ->get();
    	// return data ke view
    	return view('agenda', ['agenda' => $query]);
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

    public function deleteundangan($id, $ids)
    {
        $agenda = Agenda::find($id)->user()->detach($ids);
        
        return redirect("/agenda/undangan/$id");
    }

    public function upload($id, Request $request){
        $this->validate($request, [
			'file' => 'required|mimes:pdf|max:2048',
			
		]);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
        $random = Str::random(12);
        $nama_file = time()."_".$random.'.pdf';
 
		//$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'notulen_rapat';
		$file->move($tujuan_upload,$nama_file);

        $agenda = Agenda::find($id);
        $agenda->notulen = $nama_file;
        $agenda->status = 'Done';
        $agenda->save();

        return redirect("/agenda/undangan/$id");
    }

    public function view($file) {
        // Force download of the file
        $this->file_to_download   = 'notulen_rapat/' . $file;
        //return response()->streamDownload(function () {
        //    echo file_get_contents($this->file_to_download);
        //}, $file.'.pdf');
        return response()->file($this->file_to_download);
    }
}
