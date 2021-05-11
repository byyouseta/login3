<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = "agenda";

    protected $fillable = [
        'nama_agenda', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'ruangan_id', 'status', 'user_id', 'keterangan', 
    ];

    public function user()
    {
    	return $this->belongsToMany('App\User')->withPivot('presensi','presensi_at')->withTimestamps();
    }

    public function ruangan()
    {
    	return $this->belongsTo('App\Ruangan');
    }
}
