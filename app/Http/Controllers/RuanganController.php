<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan;

class RuanganController extends Controller
{
    //
    public function index(){
        $ruangan = Ruangan::all();
		return view('ruangan',['ruangan'=>$ruangan]);
	}

    public function tambah(){
        
		return view('tambahruangan');
	}

    public function tambahruangan(Request $request){
        
        $this->validate($request,[
            'nama' => 'required',
            'lokasi' => 'required'
        ]);

        $ruangan = new Ruangan;
        $ruangan->nama = $request->nama;
        $ruangan->lokasi = $request->lokasi;
        $ruangan->keterangan = $request->keterangan;
        $ruangan->save();

		return redirect('/ruangan');
	}

    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('ruangan_edit', ['ruangan' => $ruangan]);
    }

    public function update($id, Request $request){
        
        $this->validate($request,[
            'nama' => 'required',
            'lokasi' => 'required'
        ]);

        $ruangan = Ruangan::find($id);
        $ruangan->nama = $request->nama;
        $ruangan->lokasi = $request->lokasi;
        $ruangan->keterangan = $request->keterangan;
        $ruangan->save();

		return redirect('/ruangan');
	}

    public function delete($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();

        return redirect('/ruangan');
    }
}
