<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    //
    use SoftDeletes;
    protected $table = "pegawai";
    

    public function user() { 
        return $this->belongsTo('App\User'); 
    }

    

    protected $fillable = [
        'user_id', 'unit_id','alamat', 'no_hp', 
    ];
}
