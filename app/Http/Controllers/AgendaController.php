<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
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
            //->select('agenda.*', 'ruangan.nama as nama_ruangan', 'agenda_user.user_id')
            ->groupBy( 'agenda.id', 'agenda.nama_agenda', 'agenda.tanggal', 'agenda.waktu_mulai', 
                'agenda.waktu_selesai', 'agenda.ruangan_id', 'agenda.status', 'agenda.keterangan',
                'agenda.pic', 'agenda.notulen', 'agenda.updated_at', 'agenda.created_at', 'ruangan.nama')
            ->orderBy('agenda.status', 'desc')
            ->orderBy('tanggal', 'asc')
            
            ->get();
        $query2 = DB::table('agenda')
            //->join('agenda_user', 'agenda.id', '=', 'agenda_user.agenda_id')
            ->join('ruangan', 'agenda.ruangan_id', '=', 'ruangan.id')
            ->select('agenda.*', 'ruangan.nama as nama_ruangan')
            //->where('agenda.id', '=', 'agenda_user.agenda_id')
            //->select('agenda.*', 'ruangan.nama as nama_ruangan', 'agenda_user.user_id')
            //->groupBy( 'agenda_user.user_id','agenda.id', 'agenda.nama_agenda', 'agenda.tanggal', 'agenda.waktu_mulai', 
             //   'agenda.waktu_selesai', 'agenda.ruangan_id', 'agenda.status', 'agenda.keterangan',
            //    'agenda.pic', 'agenda.notulen', 'agenda.updated_at', 'agenda.created_at', 'ruangan.nama')
            ->orderBy('agenda.status', 'desc')
            ->orderBy('tanggal', 'asc')
            ->paginate(2);

        $agenda = Agenda::
            paginate(10);
            //->sortBy('tanggal')
            //->sortByDesc('status')
            
    	// return data ke view
    	return view('agenda', ['agenda' => $query2]);
    }

    public function cari()
    {
        $cari = Input::get('cari');
        // mengambil semua data pengguna
        if(!empty($cari)){
            $query2 = DB::table('agenda')
                ->join('ruangan', 'agenda.ruangan_id', '=', 'ruangan.id')
                ->select('agenda.*', 'ruangan.nama as nama_ruangan')
                ->where('agenda.nama_agenda', 'like', '%'.$cari.'%')
                ->orWhere('agenda.tanggal', 'like', '%'.$cari.'%')
                ->orWhere('ruangan.nama', 'like', '%'.$cari.'%')
                ->orWhere('agenda.status', 'like', '%'.$cari.'%')
                ->orWhere('agenda.pic', 'like', '%'.$cari.'%')
                ->orderBy('tanggal', 'asc')
                ->paginate(2);
            $query2->appends(['cari' => $cari]);

            // return data ke view
            return view('agenda', ['agenda' => $query2]);
        }
        else{
            return redirect('/agenda');
        }
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

        $id = Crypt::decrypt($id);
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
        $id = Crypt::decrypt($id);
        $agenda = Agenda::find($id);
        $agenda->delete();

        return redirect('/agenda');
    }

    public function undangan($id)
    {
        $id = Crypt::decrypt($id); 
    	// mengambil semua data pengguna
    	$agenda = Agenda::find($id);
        // lempar juga data pegawai
        $pegawai = User::all();
        $peserta = DB::table('agenda_user')
            ->where('presensi', 'sudah')
            ->where('agenda_id', $id)
            ->count();
    	// return data ke view
    	return view('undangan', ['id'=>$id, 'agenda' => $agenda, 'pegawai' => $pegawai, 'presensi' => $peserta]);
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
            
            $id = Crypt::encrypt($id);
            return redirect("/agenda/undangan/$id");
        }
        else{
            $id = Crypt::encrypt($id);
            return redirect("/agenda/undangan/$id")->withErrors(['Peserta sudah pernah ditambahkan', 'The Message']);
        } 
    }

    public function deleteundangan($id, $ids)
    {
        $ids = Crypt::decrypt($ids);
        $agenda = Agenda::find($id)->user()->detach($ids);

        $id = Crypt::encrypt($id);
        return redirect("/agenda/undangan/$id");
    }

    public function cariundangan()
    {
        $cari = Input::get('cari');
        $id = Input::get('id');
        // mengambil semua data pengguna
        if(!empty($cari)){
            $query2 = DB::table('users')
                ->join('unit', 'unit.id', '=', 'users.unit_id')
                ->join('agenda_user', 'agenda_user.user_id', '=', 'users.id')
                ->select('users.*', 'unit.nama_unit', 'agenda_user.presensi', 'agenda_user.presensi_at')
                ->Where('agenda_user.agenda_id', '=', $id)
                ->Where('users.name', 'like', '%'.$cari.'%')
                ->orWhere('agenda_user.presensi', 'like', '%'.$cari.'%')
                ->orderBy('agenda_user.presensi_at', 'asc')
                ->get();

            $agenda = Agenda::find($id);
            // lempar juga data pegawai
            $pegawai = User::all();
            $peserta = DB::table('agenda_user')
                ->where('presensi', 'sudah')
                ->where('agenda_id', $id)
                ->count();
            //$query2->appends(['cari' => $cari]);
            //return view('undangan', ['agenda' => $query2]);
            return view('undangan', ['id'=>$id, 'agenda' => $agenda, 'pegawai' => $pegawai, 'presensi' => $peserta,
            'cari' => $query2]);
        }
        else{
            // return data ke view
            $id = Crypt::encrypt($id);
            return redirect("/agenda/undangan/$id");
        }
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
