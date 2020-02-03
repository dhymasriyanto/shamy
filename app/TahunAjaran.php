<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    //
    protected $table = 'tahun_ajaran';

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }
}
