<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded = ['id'];

    public function getMahasiswa()
    {
        return $this->hasMany('App\Mahasiswa', 'id_nilai');
    }

}
