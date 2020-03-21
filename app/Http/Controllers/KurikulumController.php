<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kurikulum = Kurikulum::all();
        $data = [
            'data' => $kurikulum
        ];

        return $this->renderPage($request, 'kurikulum.index', $data);
    }

    public function all()
    {
        $kurikulum = Kurikulum::all();

        return response($kurikulum);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Kurikulum::create([
                'nama' => $request->nama,
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
        $kurikulum = Kurikulum::where('id',$id)->get();

        return response($kurikulum);
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
        $kurikulum = Kurikulum::find($id);
        $kurikulum->nama = $request->nama;
        $kurikulum->updated_by = Auth::id();
        $kurikulum->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Kurikulum::destroy($id);
        $data = [];

        return response('sukses');
    }
}
