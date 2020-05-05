<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Render page. If Ajax request, ajak layout will be loaded. Otherwise, normal layout
     *
     * @param Request $request
     * @param array $data
     * @param null $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    protected function renderPage(Request $request, $view = null, $data = []){
        $layout = $request->ajax() ? 'ajax': 'app';
        return view($view, $data, ['appLayout' => 'layouts.'.$layout]);
    }

    public function log($updatedid,$createdid){
        $update = User::where('id',$updatedid)->value('name');
        $create = User::where('id',$createdid)->value('name');
        return response(['updatedby'=>$update,'createdby'=>$create]);
    }
}
