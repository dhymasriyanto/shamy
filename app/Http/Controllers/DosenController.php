<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Fakultas;
use App\Jurusan;
use App\Kelas;
use App\Kurikulum;
use App\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //Tata cara penulisan untuk pengambilan data pada suatu tabel

//        $kelas = Kelas::find(2);
//        echo $kelas->getJurusan->nama;
//
//        $jurusan = Jurusan::find(1);
//        echo $jurusan->getFakultas->nama;
//
//        $fakultas = Fakultas::find(1);
//        $jurusanPadaFakultas = $fakultas->getJurusan->find(2);
//        echo $jurusanPadaFakultas->nama;
//
//        $kurikulum = Kurikulum::find(1);
//        echo $kurikulum->getJurusan->nama;
//
//        $mataKuliah = MataKuliah::find(2);
//        echo $mataKuliah->getJurusan->nama;
//
//        dd();

        $dosen = Dosen::all();
        $data = [
            'data' => $dosen
        ];

        return $this->renderPage($request, 'dosen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dosen::destroy($id);

        return Redirect::back();
    }
}
