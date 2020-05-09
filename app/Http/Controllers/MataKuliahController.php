<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
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

    public function create(Request $request)
    {
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
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $matakuliah = MataKuliah::where('id',$id)->get();
        return response($matakuliah);
    }

    public function update(Request $request, $id)
    {
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
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        MataKuliah::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
