<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
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
        $ayam = Pegawai::all();
//        $this->reply['data'] = ['ayam' => $ayam];
//        $this->reply['status'] = true;
//        return response($this->reply, 200);
        return $this->renderPageData($request, 'data.datapegawai', $ayam);
    }

    public function hapus($id){
        $ayam = Pegawai::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
