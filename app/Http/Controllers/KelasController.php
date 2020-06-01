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
        $kelas = Kelas::with(['getJurusan', 'getKurikulum', 'getTahunAjaran', 'getMataKuliah'])->latest()->get();
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

        $ids = [Kelas::with(['getJurusan', 'getKurikulum',  'getTahunAjaran','getMataKuliah'])->get()->find($id)];
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
                'id_mata_kuliah'=> $request->id_mata_kuliah,
                'id_kurikulum'=>$request->id_kurikulum,
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
        $kelas = [Kelas::with(['getJurusan',  'getKurikulum', 'getTahunAjaran','getMataKuliah'])->get()->find($id)];
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
            'id_kurikulum'=>$request->id_kurikulum,
            'id_mata_kuliah' => $request->id_mata_kuliah,
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

    public function mahasiswa($id, Request $request)
    {
        $sudah = Kelas::where('id',$id)->value('mahasiswa');
//        $mahasiswa = Mahasiswa::with('getJurusan')->whereNotIn('id', $sudah)->orderBy('id', 'asc')->get();
        $mahasiswa = Mahasiswa::with('getJurusan')->where('id_jurusan',$request->id_jurusan)->whereNotIn('id', $sudah)->orderBy('id', 'asc')->get();
        return response($mahasiswa);
    }

    public function tambahmahasiswa(Request $request)
    {
        $kelas = Kelas::find($request->kelasid);

        $mahasiswa = $kelas->mahasiswa;
        array_push($mahasiswa, $request->mahasiswaid);
        $kelas->update(['mahasiswa'=>$mahasiswa]);
        $kelas->save();
        return response(['type' => 'success', 'message' => 'Berhasil memasukkan mahasiswa ke kelas']);
    }

    public function hapusmahasiswa(Request $request)
    {
        $kelas = [Kelas::with(['getJurusan',  'getKurikulum', 'getMataKuliah' ,'getTahunAjaran'])->get()->find($request->id)];

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
