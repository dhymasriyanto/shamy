<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use Illuminate\Support\Facades\Redirect;

class KelasController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Kelas::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'kelas.index', $data);
    }

    public function hapus($id){
        $ayam = Kelas::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
