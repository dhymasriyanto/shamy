<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mengajar;
use Illuminate\Http\Request;

class MengajarController extends Controller
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
        return $this->renderPage($request, 'mengajar.index');
    }

    public function all()
    {
        $mengajar = Mengajar::with(['getJurusan', 'getKelas', 'getDosen', 'getMataKuliah', 'getTahunAjaran'])->latest()->get();

        return response($mengajar);
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
//        $kelas = [Kelas::with(['getJurusan',  'getKurikulum', 'getMataKuliah' ,'getTahunAjaran'])->get()->find($request->id_kelas)];

        $mengajar = new Mengajar();
        $mengajar->id_jurusan = $request->id_jurusan;
        $mengajar->id_kelas = $request->id_kelas;
        $mengajar->id_dosen = $request->id_dosen;
        $mengajar->save();

        return response(['type' => 'success', 'message' => 'Data berhasil di simpan']);
//        return response($request);
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
    public function destroy($id, Request $request)
    {
        Mengajar::destroy($id);
        $data = [];

        return response('sukses');
    }
}
