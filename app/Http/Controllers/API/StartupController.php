<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupSavings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StartupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function DirectReferrals()
    {
        $id = auth('sanctum')->user()->id;
        $directRef = User::DirectReferral($id);
        return response()->json([
            "referrals" => $directRef
        ], 200);
    }

    public function startupLogs()
    {
        $id = auth('sanctum')->user()->id;
        $startupLogs = StartupSavings::logs($id);
        return response()->json(["logs" => $startupLogs
    ], 200);
    }

    public function viewLevelOne($id)
    {
        $directRef = User::DirectReferral($id);
        $userInfo = User::where('id', $id)->first();
        return response()->json([
            "referrals" => $directRef,
            "userInfo" => $userInfo
        ], 200);
    }

    public function summaryReports()
    {
        $id = auth('sanctum')->user()->id;
        $startupRebate = StartupSavings::totalStartupRebate($id);
        $startupstars = StartupSavings::totalStartupStars($id);
        return response()->json([
            "StartupRebate" => $startupRebate,
            "StartupStars" => $startupstars,
        ], 200);
    }
}
