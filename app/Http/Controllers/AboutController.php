<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manual;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
//use Symfony\Component\HttpFoundation\File\File;
use File;

class AboutController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        session()->put('halaman','about');
        $manual = Manual::all();
        return view('about.manual',['manual'=>$manual]);
    }

    public function upload(Request $request){
        $this->validate($request, [
            'namafile' => 'required|unique:manuals|max:50',
			'fileupload' => 'required|mimes:pdf|max:2048',
			
		]);
        // dd($request);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('fileupload');
        // $random = Str::random(12);
        // $extension = $file->getClientOriginalExtension();
        // $nama_file = time()."_".$random.'.'.$extension;
        $nama_file = $request->get('namafile');
		//$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'manual';
		$file->move($tujuan_upload,$nama_file);

        $about = new Manual;
        $about->namafile = $nama_file;
        $about->nama = $request->get('namafile');
        $about->keterangan = $request->get('keterangan');
        $about->save();
        
        return redirect("/about");
    }

    public function view($file) {
        $file = Crypt::decrypt($file); 
    	// mengambil semua data pengguna
    	// $manual = Manual::find($id);
        // $file = $manual->namafile;

        // dd($file);
        // Force download of the file
        $this->file_to_download   = 'manual/' . $file;
        
        return response()->file($this->file_to_download);
    }

    public function delete($id){
        $id = Crypt::decrypt($id); 
        // hapus file
        $manual = Manual::where('id',$id)->first();
        File::delete('manual/'.$manual->namafile);
    
        // hapus data
        Manual::where('id',$id)->delete();
    
        return redirect()->back();
    }
}
