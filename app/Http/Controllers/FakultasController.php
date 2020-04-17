<?php

namespace App\Http\Controllers;

use App\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $fakultas = Fakultas::all();
        $data = [
            'data' => $fakultas
        ];

        return $this->renderPage($request, 'fakultas.index', $data);
    }

    public function all()
    {
        $fakultas = Fakultas::all();

        return response($fakultas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        Fakultas::create([
                'nama' => $request->nama,
                'singkatan' => $request->singkatan,
                'created_by' => Auth::id()
            ]
        );
        echo $request->nama;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $fakultas = Fakultas::where('id',$id)->get();

        return response($fakultas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $fakultas = Fakultas::find($id);
        $fakultas->nama = $request->nama;
        $fakultas->singkatan = $request->singkatan;
        $fakultas->updated_by = Auth::id();
        $fakultas->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Fakultas::destroy($id);
        $data = [];

        return response('sukses');
    }
}
