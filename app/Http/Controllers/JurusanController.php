<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        $data = [
            'data' => $jurusan
        ];

        return $this->renderPage($request, 'jurusan.index', $data);
    }

    public function all()
    {
        $jurusan = Jurusan::with('getFakultas')->get();

        return response($jurusan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        Jurusan::create([
                'nama' => $request->nama,
                'kode' => $request->kode,
                'singkatan' => $request->singkatan,
                'id_fakultas' => $request->id_fakultas
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
        $jurusan = Jurusan::where('id',$id)->get();

        return response($jurusan);
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
        $jurusan = Jurusan::find($id);
        $jurusan->nama = $request->nama;
        $jurusan->kode = $request->kode;
        $jurusan->singkatan = $request->singkatan;
        $jurusan->id_fakultas = $request->id_fakultas;
        $jurusan->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Jurusan::destroy($id);
        $data = [];

        return response('sukses');
    }
}
