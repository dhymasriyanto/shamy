<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'dosen.index');
    }

    public function all()
    {
        $dosen = Dosen::with('getJurusan')->orderBy('nama', 'asc')->get();;
        return response($dosen);
    }

    public function create(Request $request)
    {
        if (Dosen::where('nomor_induk',$request->nomor_induk)->get() == '[]'){
            if ($request->agama == null){
                $request->agama = "Tidak diisi";
            }
            Dosen::create([
                    'nama' => $request->nama,
                    'nomor_induk' => $request->nomor_induk,
                    'id_jurusan' => $request->id_jurusan,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
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
        $dosen = Dosen::where('id',$id)->get();
        $update = User::where('id',$dosen[0]['updated_by'])->value('name');
        $create = User::where('id',$dosen[0]['created_by'])->value('name');
        return response(['data'=>$dosen,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        $dosen->nama = $request->nama;
        $dosen->nomor_induk = $request->nomor_induk;
        $dosen->jenis_kelamin = $request->jenis_kelamin;
        $dosen->tempat_lahir = $request->tempat_lahir;
        $dosen->tanggal_lahir = $request->tanggal_lahir;
        $dosen->agama = $request->agama;
        $dosen->id_jurusan = $request->id_jurusan;
        $dosen->updated_by = Auth::id();
        $dosen->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Dosen::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
