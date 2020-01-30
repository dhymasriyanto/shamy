<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use Illuminate\Support\Facades\Redirect;

class DosenController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $ayam = Dosen::all();
        $data = [
            'terserah'=>$ayam
        ];
        return $this->renderPage($request, 'dosen.index', $data);
    }

    public function hapus($id){
        $ayam = Dosen::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
