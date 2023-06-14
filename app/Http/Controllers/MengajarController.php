<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mahasiswa;
use App\Mengajar;
use App\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
//        $mengajar = Mengajar::all();
//        $data = [
//            'data' => $mengajar
//        ];
        return $this->renderPage($request, 'mengajar.index');
    }

    public function all()
    {
        $mengajar = Mengajar::with(['getJurusan', 'getKelas', 'getDosen'])->latest()->get();

        return response($mengajar);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $kelas = [Kelas::with(['getJurusan',  'getKurikulum', 'getMataKuliah' ,'getTahunAjaran'])->get()->find($request->id_kelas)];
        if (Mengajar::where('id_kelas', $request->id_kelas)->get() == '[]') {
            $mengajar = new Mengajar();
            $mengajar->id_jurusan = $request->id_jurusan;
            $mengajar->id_kelas = $request->id_kelas;
            $mengajar->id_dosen = $request->id_dosen;
            $mengajar->save();


            $ids = [Kelas::with(['getJurusan', 'getKurikulum', 'getTahunAjaran', 'getMataKuliah'])->get()->find($mengajar->id_kelas)];
            $mahasiswa = [null];
            $j = 0;
            foreach ($ids as $id) {
                for ($i = 0; $i < count($id->mahasiswa); $i++) {
//                    $mahasiswa[$j] = Mahasiswa::where('id', $id->mahasiswa[$i])->with('getJurusan')->first();
                        $nilai = new Nilai();
//
//                    if (Nilai::where('id_mahasiswa', $id->mahasiswa[$i])->get() == '[]') {

                        $arr = array(
//                            'id_mata_kuliah' => $id->id_mata_kuliah,
                                'nilai_angka' => 0,
                                'nilai_indeks' => 0,
                                'nilai_huruf' => 'E'
                        );
                        $arr_tojson = json_encode($arr);
                        $nilai->nilai = $arr_tojson;
                        $nilai->id_mengajar = $mengajar->id;
                        $nilai->id_mahasiswa = $id->mahasiswa[$i];


                        $nilai->save();
//                    } else {
//                        $nilai2 = new Nilai();
//                        $nilai2->where('id_mahasiswa', $id->mahasiswa[$i])->first();
//                        $nilai2= DB::table('nilai')->where('id_mahasiswa','=',$id->mahasiswa[$i])->first();
//                        $arr = array(
//                            'id_mata_kuliah' => $id->id_mata_kuliah,
//                            'nilai_angka' => 0,
//                            'nilai_indeks' => 0,
//                            'nilai_huruf' => 'E'
//                        );

//                        $arr_tojson = json_encode($arr);
//                         $ar=json_decode($nilai2->nilai);
//                        $nilaiupdate=array($ar);
//                        array_push($nilaiupdate, $arr);
//
//                        Nilai::where('id_mahasiswa', '=', $id->mahasiswa[$i])
//                            ->update([
//                                'nilai'=>$nilaiupdate
//                            ]);
//                        $nilai2->where('id_mahasiswa', '=', $id->mahasiswa[$i])->update([
//                            [
//                                'nilai'=>$nilaiupdate
//                            ]
//                        ]);

//                        $nilai2->save();
//                        dump($id->mahasiswa[$i], $ar, $nilai2,$nilaiupdate);
//                    }

                    $j++;

                }
            }

            return response(['type' => 'success', 'message' => 'Data berhasil di simpan']);

        } else {
            return response(['type' => 'warning', 'message' => 'Data sudah ada']);

        }

//        return response($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $mengajar = [Mengajar::with(['getJurusan', 'getKelas', 'getDosen'])->get()->find($id)];
        return response($mengajar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Mengajar::where('id_kelas', $request->id_kelas)->get() == '[]') {

            Mengajar::where('id', $id)->update([
                'id_jurusan' => $request->id_jurusan,
                'id_kelas' => $request->id_kelas,
                'id_dosen' => $request->id_dosen,
            ]);
            return response(['type' => 'success', 'message' => 'Berhasil mengubah data']);

        } else {
            return response(['type' => 'warning', 'message' => 'Data sudah ada']);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Mengajar::destroy($id);
        $data = [];

        return response(['type' => 'success', 'message' => 'Data berhasil di hapus']);
    }
}
