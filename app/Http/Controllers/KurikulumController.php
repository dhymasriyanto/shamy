<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurikulumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'kurikulum.index');
    }

    public function all()
    {
        $kurikulum = Kurikulum::all();
        return response($kurikulum);
    }

    public function create(Request $request)
    {
        Kurikulum::create([
                'nama' => $request->nama,
                'created_by' => Auth::id()
            ]
        );
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $kurikulum = Kurikulum::where('id',$id)->get();
        return response($kurikulum);
    }

    public function update(Request $request, $id)
    {
        $kurikulum = Kurikulum::find($id);
        $kurikulum->nama = $request->nama;
        $kurikulum->updated_by = Auth::id();
        $kurikulum->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Kurikulum::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
