<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $guarded = ['id'];

    public function getJurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function getKelas()
    {
        return $this->hasOne('App\Kelas');
    }

    public function getKurikulum()
    {
        return $this->belongsTo('App\Kurikulum', 'id_kurikulum');
    }

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }
}
