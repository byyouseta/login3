<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        session()->put('halaman','master');

        $unit = Unit::all();
		return view('unit',['unit'=>$unit]);
	}

    public function tambah(){
        //$unit = Unit::all();
		return view('tambahunit');
	}

    public function tambahunit(Request $request){
        
        $this->validate($request,[
            'nama_unit' => 'required'
        ]);

        $unit = new Unit;
        $unit->nama_unit = $request->nama_unit;
        $unit->keterangan = $request->keterangan;
        $unit->save();

		return redirect('/unit');
	}

    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('unit_edit', ['unit' => $unit]);
    }

    public function update($id, Request $request){
        
        $this->validate($request,[
            'nama_unit' => 'required'
        ]);

        $unit = Unit::find($id);
        $unit->nama_unit = $request->nama_unit;
        $unit->keterangan = $request->keterangan;
        $unit->save();

		return redirect('/unit');
	}

    public function delete($id)
    {
            $unit = Unit::find($id);
            $unit->delete();
    
            return redirect('/unit');
    }

}
