<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use DateTime;
use App\Tamu;
use App\Agenda;

class TamuController extends Controller
{
    //
    public function index(){
        $now = new DateTime();
        $now = $now->format('Y-m-d'); 
        $agenda = Agenda::all()
                ->where('tanggal', '=', $now);
        return view('tamu.tamu', ['agenda' => $agenda]);
	}

    public function presensi(Request $request){
		$this->validate($request, [
            'agenda' => 'required',
			'nama' => 'required',
			'nip' => 'required|min:18|numeric',
            'unit' => 'required',
            'no_hp' => 'required|min:10|numeric',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha',
            //'output' => 'required',
		]);
 
		// menyimpan data file yang diupload ke variabel $file
		//$img = $request->get('output');

        //$img1 = str_replace('data:image/png;base64,', '', $img);
        //$img = str_replace(' ', '+', $img1);
        //$data = base64_decode($img1);
        //$file = UPLOAD_DIR . uniqid() . '.jpeg';
        //$success = file_put_contents($file, $data);

        //echo 'data base64: '.$img;
        //$random = Str::random(12);
        //$nama_file = time()."_".$random.'.png';
        //$file = file_put_contents($nama_file, $data);
      	// isi dengan nama folder tempat kemana file diupload
		//$tujuan_upload = 'ttd_tamu';
        //Storage::disk('public')->put($nama_file, $data);
        
        //$image = Image::make($request->get('output'));
        //$image->save('public/bar.jpg');

        // upload file
		//$file->move($tujuan_upload,$file);
        $cari = Tamu::whereHas('agenda', function ($query) use($request) {
            $query->where('nip', '=', $request->nip)
                ->where('agenda_id','=', $request->agenda);
        })->count(); 
        if(empty($cari)) {
            $tamu = new Tamu;
            $tamu->agenda_id = $request->agenda;
            $tamu->nama = $request->nama;
            $tamu->nip = $request->nip;
            $tamu->unit = $request->unit;
            $tamu->no_hp = $request->no_hp;
            $tamu->email = $request->email;
            
            $tamu->save();

            return redirect("/tamu");
        }
        else{
            return redirect("/tamu")->withErrors(['Pesan Error', 'Peserta sudah pernah ditambahkan']);
        } 

        //return redirect("/tamu");
	}
}
