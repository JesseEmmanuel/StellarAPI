<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupSavings;
use App\Models\EncashmentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

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
        $directRef = StartupSavings::DirectReferrals($id);
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
        $totalRebate = StartupSavings::totalStartupRebate($id);
        $totalStars = StartupSavings::totalStartupStars($id);
        $encashment = StartupSavings::getEncashment($id);
        $rawEncashment = $encashment->encashment;
        $rebateBalance = $totalRebate - $rawEncashment;
        StartupSavings::updateStartup($id, $totalRebate, $totalStars, $rawEncashment, $rebateBalance);
        $startupRebate = StartupSavings::getRebateBalance($id);
        return response()->json([
            "StartupRebate" => $rebateBalance,
            "StartupStars" => $totalStars,
        ], 200);
    }

    public function encashment(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $currentRebate = StartupSavings::getRebateBalance($id);
        foreach($currentRebate as $rebate)
        {
            $rebateBalance = $rebate->rebateBalance;
        }
        $rawRebate = (int)$rebateBalance;
        $validator = Validator::make($request->all(), [
            'encash' => 'required|numeric',
        ]);
        $encash = $request->get('encash');
        $rawEncash = (int)$encash;
        if($rawEncash > $rawRebate)
        {
            return response()->json([
                "message" => "Not enough balance"
            ], 401);
        }
        else
        {
            $newRebateBalance = $rawRebate-$rawEncash;
            $user = DB::table('startupdata')->where('id', $id)->first();
            $userInfo = DB::table('users')->where('id', $id)->first();
            $userFullName = $userInfo->firstName." ".$userInfo->middleName." ".$userInfo->lastName;
            $lastRebate = $user->rebate;
            $currentStars = $user->stars;
            $newEncashment = $rawEncash + $user->encashment;
            StartupSavings::updateStartup($id, $lastRebate, $currentStars, $newEncashment, $newRebateBalance);
            $newLog = array(
                "userID" => $id,
                "title" => "Startup Wallet Encashment",
                "description" => "₱".$rawEncash." "."was successfully encashed from ".$userFullName."'s"." "."Startup Account Wallet",
                "encashment" => $rawEncash,
                "rebateBalance" => $newRebateBalance
            );
            EncashmentLogs::create($newLog);
            return response()->json([
                "newRebate" => $newRebateBalance,
                "newEncash" => $newEncashment,
                "newLog" => $newLog
            ], 200);
        }
    }
}
