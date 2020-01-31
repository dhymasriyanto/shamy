<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MataKuliah;
use Illuminate\Support\Facades\Redirect;

class MataKuliahController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = MataKuliah::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'matakuliah.index', $data);
    }

    public function hapus($id){
        $ayam = MataKuliah::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
