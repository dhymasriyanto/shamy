<?php

namespace App\Http\Controllers;

use App\Fakultas;
use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JurusanController extends Controller
{
    //
    public function index(Request $request)
    {

//        $fakultas = Jurusan::find(1);
////        $jurusan = Fakultas::find(1);
////
////        $jurusan2= $jurusan->getJurusan->find(2);
////
////        echo $jurusan2->nama;
////
////        echo $fakultas->nama;
////
////        dd($fakultas);
//        $ayam = Jurusan::where('id_fakultas','fakultas.id');
//        $data = [
//            'terserah'=>$ayam
//        ];
//        return $this->renderPage($request, 'jurusan.index', $data);
    }

    public function hapus($id){
        $ayam = Jurusan::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
