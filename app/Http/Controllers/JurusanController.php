<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurusanController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'jurusan.index');
    }

    public function all()
    {
        $jurusan = Jurusan::with('getFakultas')->get();

        return response($jurusan);
    }

    public function create(Request $request)
    {
        if (Jurusan::where('kode',$request->kode)->get() == '[]'){
            Jurusan::create([
                    'nama' => $request->nama,
                    'kode' => $request->kode,
                    'singkatan' => $request->singkatan,
                    'id_fakultas' => $request->id_fakultas,
                    'created_by' => Auth::id()
                ]
            );
            return response(['pesan'=>"Data berhasil ditambahkan"]);
        }
        else{
            return response(['pesan'=>"Data sudah ada"]);
        }
    }

    public function edit($id)
    {
        $jurusan = Jurusan::where('id',$id)->get();
        $update = User::where('id',$jurusan[0]['updated_by'])->value('name');
        $create = User::where('id',$jurusan[0]['created_by'])->value('name');
        return response(['data'=>$jurusan,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->nama = $request->nama;
        $jurusan->kode = $request->kode;
        $jurusan->singkatan = $request->singkatan;
        $jurusan->id_fakultas = $request->id_fakultas;
        $jurusan->updated_by = Auth::id();
        $jurusan->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Jurusan::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
