<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;

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
//        $this->reply['data'] = ['ayam' => $ayam];
//        $this->reply['status'] = true;
//        return response($this->reply, 200);
        return $this->renderPageData($request, 'data.datadosen', $ayam);
    }

    public function hapus($id){
        $ayam = Dosen::find($id);
        $ayam->delete();
        return Redirect::back();
    }
}
