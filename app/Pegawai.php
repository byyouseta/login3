<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $table = "pegawai";

    public function user() { 
        return $this->belongsTo('App\User'); 
    }

    

    protected $fillable = [
        'user_id', 'unit_id','alamat', 'no_hp', 
    ];
}
