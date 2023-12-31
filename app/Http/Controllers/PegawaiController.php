<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PegawaiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'pegawai.index');
    }

    public function all()
    {
        $pegawai = Pegawai::all();
        return response($pegawai);
    }

    public function create(Request $request)
    {
        Pegawai::create([
            'nama' => $request->nama,
            'created_by' => Auth::id()
            ]
        );
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $pegawai = Pegawai::where('id',$id)->get();
        $update = User::where('id',$pegawai[0]['updated_by'])->value('name');
        $create = User::where('id',$pegawai[0]['created_by'])->value('name');
        return response(['data'=>$pegawai,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        //
        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->nama;
        $pegawai->updated_by = Auth::id();
        $pegawai->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Pegawai::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
