<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $guarded = ['id'];
    protected $casts = [
        'matakuliah' => 'json'
    ];

    public function getJurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function getKelas()
    {
        return $this->hasOne('App\Kelas');
    }

    public function getTahunAjaran()
    {
        return $this->belongsTo('App\TahunAjaran', 'id_tahun_ajaran');
    }
}
