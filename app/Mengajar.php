<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mengajar extends Model
{
    //
    protected $table = 'mengajar';

    public function getJurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }

    public function getKelas(){
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function getDosen()
    {
        return $this->belongsTo('App\Dosen', 'id_dosen');
    }

    public function getMataKuliah()
    {
        return $this->belongsTo('App\MataKuliah', 'id_mata_kuliah');
    }

    public function getTahunAjaran()
    {
        return $this->belongsTo('App\TahunAjaran', 'id_tahun_ajaran');
    }


}
