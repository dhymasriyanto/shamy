<?php

namespace App\Http\Controllers;

use App\MataKuliah;
use App\Nilai;
use Illuminate\Http\Request;
use JavaScript;

class NilaiController extends Controller
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
        return $this->renderPage($request, 'nilai.index');
    }

    public function all()
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->latest()->get();
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;
        }
        return response($nn);
    }

    public function nilaikelas($id)
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id_mengajar', $id);
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j]['nilai'] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;
        }
        return response($nn);
    }

    public function nilaimahasiswa($id, Request $request)
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id_mahasiswa', $id)->where('id_mengajar', $request->id_mengajar);
        $mahasiswa = [null];
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j]['nilai'] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;

        }
        return response($nn);
    }


    public function nilaipribadi($id){
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id_mahasiswa', $id);
        $j = 0;
        foreach ($nilai as $n) {
            $nn[$j]['nilai'] = json_decode($n->nilai);
            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
            $nn[$j]['id_mengajar'] = $n->id_mengajar;
            $j++;
        }
        return response($nn);
    }

    public function lihatdaftarnilai($id, Request $request)
    {
        $nilai = Nilai::with(['getMahasiswa', 'getMengajar'])->get()->where('id_mahasiswa', $id);
        $mahasiswa = [null];
        $j = 0;
//        foreach ($nilai as $n) {
//            $nn[$j]['nilai'] = json_decode($n->nilai);
//            $nn[$j]['id_mahasiswa'] = $n->id_mahasiswa;
//            $j++;
//
//        }
//        return response($nilai);
//        $data = [
//            'nilai' => $nilai
//        ];

        JavaScript::put([
            'idmahasiswa'=>$id
        ]);

        return $this->renderPage($request, 'nilai.index');


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
//        $nilai = new Nilai();

        $arr = array(
            'nilai_angka' => $request->nilai_angka,
            'nilai_indeks' => $request->nilai_indeks,
            'nilai_huruf' => $request->nilai_huruf
        );

        $arr_tojson = json_encode($arr);

        $nilaiMhs = $arr_tojson;

        Nilai::where('id_mengajar', $request->id_mengajar)->where('id_mahasiswa', $request->id_mahasiswa)->update([
            'nilai' => $nilaiMhs
        ]);
        return response(['type' => 'success', 'message' => 'Berhasil menyimpan nilai']);

//        dump($nilaiMhs,$request->id_mahasiswa,$request->id_mengajar);
//        $nilai->save();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
