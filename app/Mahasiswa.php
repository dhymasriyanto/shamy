<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $guarded = ['id'];

    public function getJurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function getKelas()
    {
        return $this->belongsToMany('App\Kelas','kelas');
    }

    public function getNilai()
    {
        return $this->belongsTo('App\Nilai', 'id_nilai');
    }
}
