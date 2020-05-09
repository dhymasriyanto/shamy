<?php

namespace App\Http\Controllers;

use App\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'tahun-ajaran.index');
    }

    public function all()
    {
        $tahunajaran = TahunAjaran::all();
        return response($tahunajaran);
    }

    public function create(Request $request)
    {
        TahunAjaran::create([
                'tahun_ajaran' => $request->tahun_ajaran
            ]
        );
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $tahun_ajaran = TahunAjaran::where('id',$id)->get();
        return response($tahun_ajaran);
    }

    public function update(Request $request, $id)
    {
        $tahun_ajaran = TahunAjaran::find($id);
        $tahun_ajaran->tahun_ajaran = $request->tahun_ajaran;
        $tahun_ajaran->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        TahunAjaran::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
