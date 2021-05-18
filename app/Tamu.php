<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    //
    protected $table = "tamu";

    protected $fillable = [
        'agenda_id', 'nama', 'nip', 'unit', 'no_hp', 'email', 'ttd', 
    ];

    public function agenda()
    {
    	return $this->belongsTo('App\Agenda');
    }
}
