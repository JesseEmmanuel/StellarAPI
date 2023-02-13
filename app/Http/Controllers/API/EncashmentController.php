<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EncashmentLogs;
use Illuminate\Support\Facades\Auth;
use DB;

class EncashmentController extends Controller
{
    public function encashmentLogs()
    {
        $id = auth('sanctum')->user()->id;
        $encashLogs = DB::table('encashment_logs')->where('userID', $id)->get();
        return response()->json([
            "encashmentLogs" => $encashLogs
        ], 200);
    }
}
