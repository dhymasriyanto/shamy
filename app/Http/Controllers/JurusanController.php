<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JurusanController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Jurusan::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'jurusan.index', $data);
    }

    public function hapus($id){
        $ayam = Jurusan::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
