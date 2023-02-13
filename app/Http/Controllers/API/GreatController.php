<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GreatSavings;
use App\Models\GenealogyLogs;
use App\Models\EncashmentLogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class GreatController extends Controller
{
    public function DirectReferrals()
    {

        $id = auth('sanctum')->user()->id;
        $countLevelTwo = GreatSavings::LevelTwoCheck($id);
        $userStatus = User::select('IsUpgraded')->where('id', $id)->get();
        foreach($userStatus as $users)
        {
            $isUpgraded = $users->IsUpgraded;
        }
        // dd($isUpgraded);
        if($isUpgraded === 0)
        {
            foreach($countLevelTwo as $count)
            {
                $validLevelTwo = $count->counter;
            }
            if($validLevelTwo >= 10)
            {
                GreatSavings::PromoteToGreatSavings($id);
                $sponsorID = GreatSavings::getSponsorID($id);
                $fName = auth('sanctum')->user()->firstName;
                $mName = auth('sanctum')->user()->middleName;
                $lName = auth('sanctum')->user()->lastName;
                $user = $fName." ".$mName." ".$lName;
                $directRef = GreatSavings::DirectReferrals($id);
                $totalRebate = GreatSavings::totalGreatSaveRebate($id);
                $totalStars = GreatSavings::totalGreatSaveStars($id);
                $encashments = GreatSavings::getEncashment($id);
                foreach($encashments as $cash)
                    {
                        $rawEncashment = $cash->encashment;
                    }
                $rebateBalance = $totalRebate - $rawEncashment;
                GreatSavings::updateGreatSave($id, $totalRebate, $totalStars, $rebateBalance);
                foreach($sponsorID as $sponsor)
                {
                    $userSponsor = $sponsor->sponsorID;
                }
                $newLog = array(
                    "id" => $id,
                    "sponsorID" => $userSponsor,
                    "title" => "Account Upgrade",
                    "description" => $user."'s"." "."account is now officially upgraded to Great Savings",
                    "totalRebate" => $totalRebate,
                    "totalStars" => $totalStars
                );
                // GenealogyLogs::create($newLog);
                $directRef = GreatSavings::DirectReferrals($id);
                return response()->json([
                    "referrals" => $directRef,
                    "logs" => $newLog,
                    "Current Balance" => $rebateBalance,
                    // "Level 2 Count" => $countLevelTwo
                ], 200);
            }
            else
            {
                return response()->json([
                    "message" => "Referrals under Level 2 hasn't reached 64 accounts yet. This Account is not yet valid for Great Savings",
                    "LevelTwoCount" => $validLevelTwo."/64"
                ], 201);
            }
        }
        else
        {
            $directRef = GreatSavings::DirectReferrals($id);
            $totalRebate = GreatSavings::totalGreatSaveRebate($id);
            $totalStars = GreatSavings::totalGreatSaveStars($id);
            $encashments = GreatSavings::getEncashment($id);
            foreach($encashments as $cash)
                {
                    $rawEncashment = $cash->encashment;
                }
            $rebateBalance = $totalRebate - $rawEncashment;
            GreatSavings::updateGreatSave($id, $totalRebate, $totalStars, $rawEncashment, $rebateBalance);
            return response()->json([
                "referrals" => $directRef,
                "Current Balance" => $rebateBalance,
                // "Level 2 Count" => $countLevelTwo
            ], 200);
        }
    }

    public function summaryReports()
    {
        $id = auth('sanctum')->user()->id;
        $totalRebate = GreatSavings::totalGreatSaveRebate($id);
        $totalStars = GreatSavings::totalGreatSaveStars($id);
        $encashment = GreatSavings::getEncashment($id);
        foreach($encashment as $cash)
            {
                $rawEncashment = $cash->encashment;
            }
        $rebateBalance = $totalRebate - $rawEncashment;
        GreatSavings::updateGreatSave($id, $totalRebate, $totalStars, $rawEncashment, $rebateBalance);
        $greatsaveRebate = GreatSavings::getRebateBalance($id);
        foreach($greatsaveRebate as $initRebate)
        {
            $rebate = $initRebate->rebateBalance;
        }
        $greatsavestars = GreatSavings::getStars($id);
        foreach($greatsavestars as $initStars)
        {
            $stars = $initStars->stars;
        }
        return response()->json([
            "GreatSavingsRebate" => $rebateBalance,
            "GreatSavingsStars" => $totalStars,
        ], 200);
    }

    public function encashment(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $currentRebate = GreatSavings::getRebateBalance($id);
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
            $user = DB::table('greatsavedata')->where('id', $id)->first();
            $userInfo = DB::table('users')->where('id', $id)->first();
            $userFullName = $userInfo->firstName." ".$userInfo->middleName." ".$userInfo->lastName;
            $lastRebate = $user->rebate;
            $currentStars = $user->stars;
            $newEncashment = $rawEncash + $user->encashment;
            GreatSavings::updateGreatSave($id, $lastRebate, $currentStars, $newEncashment, $newRebateBalance);
            $newLog = array(
                "userID" => $id,
                "title" => "Great Savings Wallet Encashment",
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
