<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mengajar;
use Illuminate\Support\Facades\Redirect;

class MengajarController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Mengajar::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'mengajar.index', $data);
    }

    public function hapus($id){
        $ayam = Mengajar::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
