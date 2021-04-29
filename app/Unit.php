<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = "unit";

    public function user() { 
        return $this->hasMany('App\User'); 
    }

    protected $fillable = [
        'nama_unit', 'keterangan', 
    ];
}
