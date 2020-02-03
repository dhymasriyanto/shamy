<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    public function getFakultas()
    {
        return $this->belongsTo('App\Fakultas', 'id_fakultas');
    }

    public function getKelas()
    {
        return $this->hasMany('App\Kelas');
    }

    public function getKurikulum()
    {
        return $this->hasMany('App\Kurikulum');
    }

    public function getMataKuliah()
    {
        return $this->hasMany('App\MataKuliah');
    }

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }
}
