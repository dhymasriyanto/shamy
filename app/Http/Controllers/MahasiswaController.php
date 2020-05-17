<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return $this->renderPage($request, 'mahasiswa.index');
    }

    public function all()
    {
        $mahasiswa = Mahasiswa::with('getJurusan')->orderBy('nama', 'asc')->get();;
        return response($mahasiswa);
    }

    public function create(Request $request)
    {
        if (Mahasiswa::where('nomor_induk',$request->nomor_induk)->get() == '[]'){
            Mahasiswa::create([
                    'nama' => $request->nama,
                    'nomor_induk' => $request->nomor_induk,
                    'id_jurusan' => $request->id_jurusan,
                    'jenis_pendaftaran' => $request->jenis_pendaftaran,
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
        $mahasiswa = Mahasiswa::where('id',$id)->get();
        $update = User::where('id',$mahasiswa[0]['updated_by'])->value('name');
        $create = User::where('id',$mahasiswa[0]['created_by'])->value('name');
        return response(['data'=>$mahasiswa,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->nama;
        $mahasiswa->nomor_induk = $request->nomor_induk;
        $mahasiswa->jenis_pendaftaran = $request->jenis_pendaftaran;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->agama = $request->agama;
        $mahasiswa->id_jurusan = $request->id_jurusan;
        $mahasiswa->updated_by = Auth::id();
        $mahasiswa->save();
        return response(['pesan'=>"Data berhasil diubah"]);
    }

    public function destroy($id, Request $request)
    {
        Mahasiswa::destroy($id);
        return response(['pesan'=>"Data berhasil dihapus"]);
    }
}
