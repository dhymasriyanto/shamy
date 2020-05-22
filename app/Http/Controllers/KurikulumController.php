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
        $jumlahsks = Kurikulum::all()->pluck('matakuliah');
        $i = 0;
        foreach ($jumlahsks as $x){
            $jumlah = 0;
            foreach ($x as $y){
                $bobot =  MataKuliah::where('id',$y)->where('jenis','Wajib Program Studi')->value('bobot');
                $jumlah = $jumlah + $bobot;

            }
            $kurikulum[$i]['skswajib'] = $jumlah;
            $i = $i + 1;
        }
        $j = 0;
        foreach ($jumlahsks as $x){
            $jumlah = 0;
            foreach ($x as $y){
                $bobot =  MataKuliah::where('id',$y)->where('jenis','Pilihan')->value('bobot');
                $jumlah = $jumlah + $bobot;

            }
            $kurikulum[$j]['skspilihan'] = $jumlah;
            $j = $j + 1;
        }
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

    public function allRincianMatkul($id)
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

    public function tambahRincianMatkul(Request $request)
    {
        $matakuliah = Kurikulum::find($request->kurikulumid);
        $matakuliah2 = $matakuliah->matakuliah;
        array_push($matakuliah2, $request->matkulid);
        $matakuliah->update(['matakuliah'=>$matakuliah2]);
        $matakuliah->save();
        return response(['pesan'=>"Data berhasil ditambahkan"]);
    }

    public function hapusRincianMatkul(Request $request)
    {
        $matakuliah = Kurikulum::find($request->kurikulumid);
        $matakuliah2 = $matakuliah->matakuliah;
        if (count($matakuliah2) == 1){
            $matakuliah->matakuliah = [];
            $matakuliah->save();
        }
        else{
            $data = [];
            foreach ($matakuliah2 as $k) {
                if ($k != $request->matkulid) {
                    array_push($data,$k);
                }
            }
            $matakuliah->update(['matakuliah'=>$data]);
            $matakuliah->save();
        }
        return response(['pesan'=>"Data berhasil dihapus"]);
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

    public function mataKuliah($id)
    {
        $sudah = Kurikulum::where('id',$id)->value('matakuliah');
        $matakuliah = MataKuliah::whereNotIn('id',$sudah)->orderBy('id', 'asc')->get();
        return response($matakuliah);
    }
}
