<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    //
    protected $table = 'kurikulum';

    public function getJurusan(){
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }
}
