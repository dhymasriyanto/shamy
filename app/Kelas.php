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

    public function getMataKuliah()
    {
        return $this->belongsTo('App\MataKuliah', 'id_mata_kuliah');
    }

    public function getKurikulum()
    {
        return $this->belongsTo('App\Kurikulum', 'id_kurikulum');
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
