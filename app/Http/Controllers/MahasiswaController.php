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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = [Mahasiswa::with(['getJurusan'])->get()->find($id)];
        return response($mahasiswa);
    }

    public function allRincian($id)
    {
        $ids = [Mahasiswa::with(['getJurusan'])->get()->find($id)];
        $mahasiswa = [null];
        $j = 0;
        foreach ($ids as $id) {
            for ($i = 0; $i < count($id->status_aktif); $i++) {
                if ($id->status_aktif[$i] == 0){
                    $mahasiswa[$i]['semester'] = $i+1;
                    $mahasiswa[$i]['status'] = "AKTIF";
                }
                else if ($id->status_aktif[$i] == 1){
                    $mahasiswa[$i]['semester'] = $i+1;
                    $mahasiswa[$i]['status'] = "Mengundurkan diri";
                }
                else if ($id->status_aktif[$i] == 2){
                    $mahasiswa[$i]['semester'] = $i+1;
                    $mahasiswa[$i]['status'] = "Hilang";
                }
                else if ($id->status_aktif[$i] == 3){
                    $mahasiswa[$i]['semester'] = $i+1;
                    $mahasiswa[$i]['status'] = "Putus Sekolah";
                }
                else if ($id->status_aktif[$i] == 4){
                    $mahasiswa[$i]['semester'] = $i+1;
                    $mahasiswa[$i]['status'] = "Wafat";
                }
                $j++;
            }
        }

        return response($mahasiswa);
    }

    public function create(Request $request)
    {
        if (Mahasiswa::where('nomor_induk',$request->nomor_induk)->get() == '[]'){
            Mahasiswa::create([
                    'nama' => $request->nama,
                    'nomor_induk' => $request->nomor_induk,
                    'nomor_induk_kependudukan' => $request->nomor_induk_kependudukan,
                    'status_aktif' => [],
                    'id_jurusan' => $request->id_jurusan,
                    'jenis_pendaftaran' => $request->jenis_pendaftaran,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'agama' => $request->agama,
                    'alamat' => $request->alamat,
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
        $mahasiswa->nomor_induk_kependudukan = $request->nomor_induk_kependudukan;
        $mahasiswa->jenis_pendaftaran = $request->jenis_pendaftaran;
        $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->agama = $request->agama;
        $mahasiswa->alamat = $request->alamat;
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
