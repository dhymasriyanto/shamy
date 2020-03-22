<?php

namespace App\Http\Controllers;

use App\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
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
        $tahunajaran = TahunAjaran::all();
        $data = [
            'data' => $tahunajaran
        ];

        return $this->renderPage($request, 'tahun-ajaran.index', $data);
    }

    public function all()
    {
        $tahunajaran = TahunAjaran::all();

        return response($tahunajaran);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        TahunAjaran::create([
                'tahun_ajaran' => $request->tahun_ajaran
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
        $tahun_ajaran = TahunAjaran::where('id',$id)->get();

        return response($tahun_ajaran);
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
        $tahun_ajaran = TahunAjaran::find($id);
        $tahun_ajaran->tahun_ajaran = $request->tahun_ajaran;
        $tahun_ajaran->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        TahunAjaran::destroy($id);
        $data = [];

        return response('sukses');
    }
}
