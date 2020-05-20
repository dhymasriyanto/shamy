<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mahasiswa;
use Illuminate\Http\Request;

class KelasController extends Controller
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
        $kelas = Kelas::all();
        $data = [
            'data' => $kelas
        ];

        return $this->renderPage($request, 'kelas.index', $data);
    }

    public function all()
    {
        $kelas = Kelas::with(['getJurusan', 'getTahunAjaran'])->get();
        return response($kelas);
    }

//    public function allmahasiswa()
//    {
//        $ids = Kelas::all('mahasiswa');
//
//        $j = 0;
//        foreach ($ids as $id) {
//            for ($i = 0; $i < count($id->mahasiswa); $i++) {
//                $mahasiswa[$j] = Mahasiswa::where('id', $id->mahasiswa[$i])->first();
//                $j++;
//            }
//        }
//
//        return response($mahasiswa);
//    }

    public function allrinciankelas($id)
    {

        $ids = [Kelas::with(['getJurusan', 'getTahunAjaran'])->get()->find($id)];
        $mahasiswa = [null];
        $j = 0;
        foreach ($ids as $id) {
            for ($i = 0; $i < count($id->mahasiswa); $i++) {
                $mahasiswa[$j] = Mahasiswa::where('id', $id->mahasiswa[$i])->with('getJurusan')->first();
                $j++;
            }
        }

        return response($mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Kelas::create(
            [
                'nama' => $request->nama,
                'semester' => $request->semester,
                'id_jurusan' => $request->id_jurusan,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'mahasiswa' => $request->mahasiswa
            ]
        );

        return response(['type' => 'success', 'message' => 'Berhasil menyimpan data']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

//        $kelas = Kelas::with(['getJurusan','getTahunAjaran'])->find($id);
        $kelas = [Kelas::with(['getJurusan', 'getTahunAjaran'])->get()->find($id)];
        return response($kelas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        Kelas::where('id', $id)->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'id_jurusan' => $request->id_jurusan,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'mahasiswa' => $request->mahasiswa
        ]);
        return response(['type' => 'success', 'message' => 'Berhasil menyimpan data']);

//        return response($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Kelas::destroy($id);

        return response(['type' => 'success', 'message' => 'Berhasil menghapus data']);
    }

    public function hapusmahasiswa(Request $request)
    {
        $kelas = [Kelas::with(['getJurusan', 'getTahunAjaran'])->get()->find($request->id)];

//        $mahasiswa = Kelas::where
        $mahasiswa = [null];
        $kk = [];
        $j = 0;
        foreach ($kelas as $id) {
            for ($i = 0; $i < count($id->mahasiswa); $i++) {
                $mahasiswa[$j] = Mahasiswa::where('id', $id->mahasiswa[$i])->with('getJurusan')->first();
                $j++;
            }
        }
        foreach ($mahasiswa as $k) {
            if ($k['id'] != $request->mahasiswaid) {
                $kk [] = $k['id'];
            }
        }

//        $data = json_encode($kk);

        Kelas::where('id', $request->id)->update([
            'mahasiswa' => $kk
        ]);
        return response(['type' => 'success', 'message' => 'Berhasil mengeluarkan mahasiswa dari kelas']);

    }
}
