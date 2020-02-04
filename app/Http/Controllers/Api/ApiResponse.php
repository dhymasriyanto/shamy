<?php
/**
 * Created by Pizaini <pizaini@uin-suska.ac.id>
 * Date: 26/01/2020
 * Time: 9:22
 */

namespace App\Http\Controllers\Api;


trait ApiResponse
{
    protected $reply = [
        'status' => false,
        'message' => '',
        'data' => [],
    ];
}
