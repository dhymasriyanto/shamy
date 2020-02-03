<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //
    protected $table = 'fakultas';

    public function getJurusan(){
        return $this->hasMany('App\Jurusan', 'id_fakultas');
    }
}
