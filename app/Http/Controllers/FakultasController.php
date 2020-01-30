<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fakultas;
use Illuminate\Support\Facades\Redirect;

class FakultasController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Fakultas::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'fakultas.index', $data);
    }

    public function hapus($id){
        $ayam = Fakultas::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
