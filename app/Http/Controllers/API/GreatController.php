<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GreatSavings;
use App\Models\StartupSavings;
use App\Models\GenealogyLogs;
use App\Models\EncashmentLogs;
use App\Models\ActivationCode;
use Illuminate\Support\Facades\Hash;
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
            return response()->json([
                    "message" => "Referrals under Level 2 hasn't reached 64 accounts yet. This Account is not yet valid for Great Savings",
            ], 201);

        }
        else
        {
            $directRef = GreatSavings::DirectReferrals($id);
            $totalRebate = GreatSavings::totalGreatSaveRebate($id);
            $totalStars = GreatSavings::totalGreatSaveStars($id);
            $encashments = GreatSavings::getEncashment($id);
            $rawEncashment = $encashments->encashment;
            $rebateBalance = $totalRebate - $rawEncashment;
            GreatSavings::updateGreatSave($id, $totalRebate, $totalStars, $rawEncashment, $rebateBalance);
            return response()->json([
                "referrals" => $directRef,
                "Current Balance" => $rebateBalance,
                // "Level 2 Count" => $countLevelTwo
            ], 200);
        }
    }

    public function viewLevelOne($id)
    {
        $directRef = GreatSavings::DirectReferrals($id);
        $userInfo = User::where('id', $id)->first();
        return response()->json([
            "referrals" => $directRef,
            "userInfo" => $userInfo
        ], 200);
    }

    public function addUser(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $validator = Validator::make($request->all(), [
            'activationCode' => 'required',
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'date_of_birth' => 'required',
            'contactInfo' => 'required',
            'email' => 'required',
        ]);
        $user = DB::table('users')->where('id', $id)->first();
        $userAccountType = $user->IsUpgraded;
        if($userAccountType === 0)
        {
            return response()->json([
                'message' => 'Failed to add user. Account is not qualified',
            ], 402);
        }
        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Required',
                'errors' => $validator->errors()
            ], 400);
        }

        $activationCode = '';
        $activeCode = ActivationCode::where('activationCode', $request->get('activationCode'))->first();
        if($activeCode === null)
        {
            return response()->json([
                "message" => "Code doesn't exist"
            ], 401);
        }
        $isCodeUsed = User::where('activationCode', $request->get('activationCode'))->first();
        if($isCodeUsed === null)
        {
            $activationCode = $request->get('activationCode');
            $sponsorID = auth('sanctum')->user()->id;
            $sponsorFname = auth('sanctum')->user()->firstName;
            $sponsorMname = auth('sanctum')->user()->middleName;
            $sponsorLname = auth('sanctum')->user()->lastName;
            $sponsor = $sponsorFname." ".$sponsorMname." ".$sponsorLname;
            $password = "test123";
            $role = "user";
            $addedUserName = $request->get('firstName')." ".$request->get('middleName')." ".$request->get('lastName');
            $newUser = array(
                "sponsorID" => $sponsorID,
                "activationCode" => $activationCode,
                "firstName" => $request->get('firstName'),
                "middleName" => $request->get('middleName'),
                "lastName" => $request->get('lastName'),
                "date_of_birth" => $request->get('date_of_birth'),
                "contactInfo" => $request->get('contactInfo'),
                "email" => $request->get('email'),
                "password" => Hash::make($password),
                "IsUpgraded" => 1,
                "role" => "user"
            );
            User::create($newUser);
            $userID = User::select('id')->where('activationCode', $activationCode)->get();
            foreach($userID as $userid){
                $newUserID = $userid->id;
            }
            $totalRebate = GreatSavings::totalGreatSaveRebate($sponsorID);
            $totalStars = GreatSavings::totalGreatSaveStars($sponsorID);
            $encashment = GreatSavings::getEncashment($sponsorID);
            foreach($encashment as $cash)
            {
                $rawEncashment = $cash->encashment;
            }
            $rebateBalance = $totalRebate - $rawEncashment;
            GreatSavings::updateGreatSave($sponsorID, $totalRebate, $totalStars, $rawEncashment, $rebateBalance);
            $data = array(
                "id" => $newUserID,
                "rebate" => 0,
                "stars" => 0,
                "encashment" => 0,
                "rebateBalance" => 0
            );
            StartupSavings::newStartupData($data);
            GreatSavings::newGreatSaveData($data);
            $codeStatus = ActivationCode::codeStatus($activationCode);
            $newLog = array(
                "id" => $newUserID,
                "sponsorID" => $sponsorID,
                "title" => "New Great Savings Account Added",
                "description" => $sponsor." "."added"." ".$addedUserName." ",
                "totalRebate" => $totalRebate,
                "totalStars" => $totalStars
            );
            StartupSavings::create($newLog);
            return response()->json([
                "message" => "Added Successfully",
                "New User" => $newUser,
                "New Log" => $newLog
            ]);
        }
        else
        {
            return response()->json([
                "message" => "Code is already used"
            ], 402);
        }
    }

    public function summaryReports()
    {
        $id = auth('sanctum')->user()->id;
        $hasGreatSavings = DB::table('greatsavings')->where('userID', $id)->first();
        if($hasGreatSavings === null)
        {
            return response()->json([
                "GreatSavingsRebate" => "N/A",
                "GreatSavingsStars" => "N/A",
            ], 200);
        }
        $totalRebate = GreatSavings::totalGreatSaveRebate($id);
        $totalStars = GreatSavings::totalGreatSaveStars($id);
        $encashment = GreatSavings::getEncashment($id);
        $rawEncashment = $encashment->encashment;
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
            "GreatSavingsRebate" => "₱".$rebateBalance.".00",
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
        if($rawEncash < 500)
        {
            return response()->json([
                "message" => "Minimum Encashment is atleast ₱500.00"
            ], 402);
        }
        $vatEncash = $rawEncash + 100;
        if($vatEncash > $rawRebate)
        {
            return response()->json([
                "message" => "Not enough balance"
            ], 401);
        }
        else
        {
            $newRebateBalance = $rawRebate-$vatEncash;
            $user = DB::table('greatsavedata')->where('id', $id)->first();
            $userInfo = DB::table('users')->where('id', $id)->first();
            $userFullName = $userInfo->firstName." ".$userInfo->middleName." ".$userInfo->lastName;
            $lastRebate = $user->rebate;
            $currentStars = $user->stars;
            $newEncashment = $vatEncash + $user->encashment;
            GreatSavings::updateGreatSave($id, $lastRebate, $currentStars, $newEncashment, $newRebateBalance);
            $newLog = array(
                "userID" => $id,
                "title" => "Great Savings Wallet Encashment",
                "description" => "₱".$rawEncash." "."was successfully encashed from ".$userFullName."'s"." "."Great Savings Account Wallet",
                "encashment" => $rawEncash,
                "rebateBalance" => $newRebateBalance,
                "claim" => 0
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
