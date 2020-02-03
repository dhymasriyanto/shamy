<?php

namespace App\Http\Controllers;

use App\Fakultas;
use App\Jurusan;
use App\Kelas;
use App\Kurikulum;
use App\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JurusanController extends Controller
{
    //
    public function index(Request $request)
    {
        $kelas = Kelas::find(2);
        echo $kelas->getJurusan->nama;

        $jurusan = Jurusan::find(1);
        echo $jurusan->getFakultas->nama;

        $fakultas = Fakultas::find(1);
        $jurusanPadaFakultas = $fakultas->getJurusan->find(2);
        echo $jurusanPadaFakultas->nama;

        $kurikulum = Kurikulum::find(1);
        echo $kurikulum->getJurusan->nama;

        $mataKuliah = MataKuliah::find(2);
        echo $mataKuliah->getJurusan->nama;

        dd();
    }

    public function hapus($id){
        $ayam = Jurusan::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
