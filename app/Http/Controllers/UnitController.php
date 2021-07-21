<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Crypt;
use DB;
use App\Unit;

class UnitController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth','cekstatus']);
    }
    
    public function index(){
        session()->put('halaman','master');

        $unit = Unit::paginate(10);
		return view('unit.unit',['unit'=>$unit]);
	}

    public function cari()
    {
        $cari = Input::get('cari');
    	// mengambil semua data pengguna
        if(!empty($cari)){
            $unit = DB::table('unit')
                    ->select('unit.*')
                    ->where('unit.nama_unit', 'like', '%'.$cari.'%')
                    ->orWhere('unit.keterangan', 'like', '%'.$cari.'%')
                    ->orderBy('unit.nama_unit', 'asc')
                    ->paginate(10);
            $unit->appends(['cari' => $cari]);

            // return data ke view
            return view('unit.unit', ['cari' => $unit]);
        }
        else{
            return redirect('/unit');
        }
    }

    public function tambah(){
        //$unit = Unit::all();
		return view('unit.tambahunit');
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
        $id = Crypt::decrypt($id);
        $unit = Unit::find($id);
        return view('unit.unit_edit', ['unit' => $unit]);
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
        $id = Crypt::decrypt($id);
        $unit = Unit::find($id);
        $unit->delete();

        return redirect('/unit');
    }

}
