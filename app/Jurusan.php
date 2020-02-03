<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    //
    protected $table = 'jurusan';


    public function getFakultas(){
        return $this->belongsTo('App\Fakultas', 'id_fakultas');
    }

    public function getKelas()
    {
        return $this->hasOne('App\Kelas');
    }
}
