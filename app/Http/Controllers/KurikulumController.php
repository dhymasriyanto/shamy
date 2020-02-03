<?php

namespace App\Http\Controllers;
use App\Kurikulum;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KurikulumController extends Controller
{
    //
    public function index(Request $request)
    {
        $ayam = Kurikulum::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'kurikulum.index', $data);
    }

    public function hapus($id){
        $ayam = Kurikulum::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
