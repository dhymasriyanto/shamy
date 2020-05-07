<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
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
        return $this->renderPage($request, 'mata-kuliah.index');
    }

    public function all()
    {
        $matakuliah = MataKuliah::with('getJurusan','getKurikulum')->get();

        return response($matakuliah);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        MataKuliah::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'singkatan' => $request->singkatan,
                'bobot' => $request->bobot,
                'jenis' => $request->jenis,
                'id_jurusan' => $request->id_jurusan,
                'id_kurikulum' => $request->id_kurikulum,
                'created_by' => Auth::id()
            ]
        );
        echo $request->nama;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $matakuliah = MataKuliah::where('id',$id)->get();

        return response($matakuliah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $matakuliah = MataKuliah::find($id);
        $matakuliah->nama = $request->nama;
        $matakuliah->kode = $request->kode;
        $matakuliah->singkatan = $request->singkatan;
        $matakuliah->id_jurusan = $request->id_jurusan;
        $matakuliah->id_kurikulum = $request->id_kurikulum;
        $matakuliah->bobot = $request->bobot;
        $matakuliah->jenis = $request->jenis;
        $matakuliah->updated_by = Auth::id();
        $matakuliah->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        MataKuliah::destroy($id);
        $data = [];

        return response('sukses');
    }
}
