<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }
}
