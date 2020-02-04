<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 26/01/2020
 * Time: 9:21
 */

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Api\ApiApp;
use App\Http\Controllers\Api\ApiResponse;
use Illuminate\Http\Request;

class ApiUser extends ApiApp
{
    use ApiResponse;

    /**
     * ApiUser constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get(Request $request){
        $this->reply['status'] = true;
        $this->reply['data'] = $request->user();
        return response($this->reply);
    }
}
