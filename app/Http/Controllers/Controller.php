<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

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
    protected function renderPageData(Request $request, $view = null, $balik , $data = []){
        $layout = $request->ajax() ? 'ajax': 'app';
        return view($view, $data, ['appLayout' => 'layouts.'.$layout, 'datanya'=>$balik]);
    }
}
