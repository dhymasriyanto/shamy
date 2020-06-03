<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use App\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'nilai.index');
    }

    public function all()
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->latest()->get();
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;
        }
        return response($nn);
    }

    public function nilaikelas($id)
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id_mengajar', $id);
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j]['nilai'] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;
        }
        return response($nn);
    }

    public function nilaimahasiswa($id)
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id', $id);
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j]['nilai']  = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;

        }
        return response($nn);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
