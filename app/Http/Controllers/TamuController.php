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

            return redirect("/tamu")->with('message', 'Presensi berkasil disimpan!');
        }
        else{
            return redirect("/tamu")->withErrors(['Pesan Error', 'Peserta sudah pernah presensi!']);
        } 
	}
}
