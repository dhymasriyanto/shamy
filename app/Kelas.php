<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $guarded = ['id'];
    protected $casts = [
        'mahasiswa' => 'json'
    ];

    public function getJurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function getTahunAjaran()
    {
        return $this->belongsTo('App\TahunAjaran', 'id_tahun_ajaran');
    }

    public function getMengajar()
    {
        return $this->hasMany('App\Mengajar');
    }

    public function getMahasiswa()
    {
        return $this->belongsToMany('App\Mahasiswa', 'mahasiswa');
    }
}
