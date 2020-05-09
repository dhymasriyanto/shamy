<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
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
        $mahasiswa = Mahasiswa::with('getJurusan')->get();;
        return response($mahasiswa);
    }

    public function create(Request $request)
    {
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

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('id',$id)->get();
        return response($mahasiswa);
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
