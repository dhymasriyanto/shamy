<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Mahasiswa::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'mahasiswa.index', $data);
    }

    public function hapus($id){
        $ayam = Mahasiswa::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
