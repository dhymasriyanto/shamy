<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use App\MataKuliah;
use App\User;
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
        $kurikulum = Kurikulum::with('getJurusan','getTahunAjaran')->get();
        return response($kurikulum);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kurikulum = [Kurikulum::with(['getJurusan', 'getTahunAjaran'])->get()->find($id)];
        return response($kurikulum);
    }

    public function allrincianmatkul($id)
    {
        $ids = [Kurikulum::with(['getJurusan', 'getTahunAjaran'])->get()->find($id)];
        $matkul = [null];
        $j = 0;
        foreach ($ids as $id) {
            for ($i = 0; $i < count($id->matakuliah); $i++) {
                $matkul[$j] = MataKuliah::where('id', $id->matakuliah[$i])->first();
                $j++;
            }
        }

        return response($matkul);
    }

    public function create(Request $request)
    {
        Kurikulum::create([
                'nama' => $request->nama,
                'aturan_lulus' => $request->aturan_lulus,
                'aturan_wajib' => $request->aturan_wajib,
                'aturan_pilihan' => $request->aturan_pilihan,
                'matakuliah' => [],
                'id_jurusan' => $request->id_jurusan,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'created_by' => Auth::id()
            ]
        );
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function edit($id)
    {
        $kurikulum = Kurikulum::where('id',$id)->get();
        $update = User::where('id',$kurikulum[0]['updated_by'])->value('name');
        $create = User::where('id',$kurikulum[0]['created_by'])->value('name');
        return response(['data'=>$kurikulum,'updatedby'=>$update,'createdby'=>$create]);
    }

    public function update(Request $request, $id)
    {
        $kurikulum = Kurikulum::find($id);
        $kurikulum->nama = $request->nama;
        $kurikulum->aturan_lulus = $request->aturan_lulus;
        $kurikulum->aturan_wajib = $request->aturan_wajib;
        $kurikulum->aturan_pilihan = $request->aturan_pilihan;
        $kurikulum->id_jurusan = $request->id_jurusan;
        $kurikulum->id_tahun_ajaran = $request->id_tahun_ajaran;
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
