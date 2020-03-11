<?php

namespace App\Http\Controllers;

use App\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dosen = Dosen::all();
        $data = [
            'data' => $dosen
        ];

        return $this->renderPage($request, 'dosen.index', $data);
    }

    public function all()
    {
        $dosen = Dosen::all();
        return response($dosen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        Dosen::create([
                'nama' => $request->nama,
                'nomor_induk' => $request->nomor_induk,
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
        $dosen = Dosen::where('id',$id)->get();

        return response($dosen);
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
        $dosen = Dosen::find($id);
        $dosen->nama = $request->nama;
        $dosen->nomor_induk = $request->nomor_induk;
        $dosen->updated_by = Auth::id();
        $dosen->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Dosen::destroy($id);
        $data = [];

        return response('sukses');
    }
}
