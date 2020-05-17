<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use App\User;
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
        $matakuliah = MataKuliah::all();
        return response($matakuliah);
    }

    public function create(Request $request)
    {
        if (MataKuliah::where('kode',$request->kode)->get() == '[]'){
            MataKuliah::create([
                    'nama' => $request->nama,
                    'kode' => $request->kode,
                    'singkatan' => $request->singkatan,
                    'bobot' => $request->bobot,
                    'jenis' => $request->jenis,
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
        $matakuliah = MataKuliah::where('id',$id)->get();
        $update = User::where('id',$matakuliah[0]['updated_by'])->value('name');
        $create = User::where('id',$matakuliah[0]['created_by'])->value('name');
        return response(['data'=>$matakuliah,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        $matakuliah = MataKuliah::find($id);
        $matakuliah->nama = $request->nama;
        $matakuliah->kode = $request->kode;
        $matakuliah->singkatan = $request->singkatan;
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
