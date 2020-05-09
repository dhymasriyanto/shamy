<?php

namespace App\Http\Controllers;

use App\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'fakultas.index');
    }

    public function all()
    {
        $fakultas = Fakultas::all();
        return response($fakultas);
    }

    public function create(Request $request)
    {
        Fakultas::create([
                'nama' => $request->nama,
                'singkatan' => $request->singkatan,
                'created_by' => Auth::id()
            ]
        );
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $fakultas = Fakultas::where('id',$id)->get();
        return response($fakultas);
    }

    public function update(Request $request, $id)
    {
        $fakultas = Fakultas::find($id);
        $fakultas->nama = $request->nama;
        $fakultas->singkatan = $request->singkatan;
        $fakultas->updated_by = Auth::id();
        $fakultas->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Fakultas::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
