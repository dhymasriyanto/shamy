<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded = ['id'];

    public function getMahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    public function getMengajar()
    {
        return $this->belongsTo('App\Mengajar', 'id_mengajar');
    }
}
