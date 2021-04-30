<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
    //
    use SoftDeletes;

    protected $table = "ruangan";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama', 'lokasi', 'keterangan', 
    ];
}
