<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;
use Illuminate\Support\Facades\Redirect;

class TahunAjaranController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = TahunAjaran::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'tahunajaran.index', $data);
    }

    public function hapus($id){
        $ayam = TahunAjaran::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
