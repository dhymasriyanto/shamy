<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $guarded = ['id'];

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }
}
