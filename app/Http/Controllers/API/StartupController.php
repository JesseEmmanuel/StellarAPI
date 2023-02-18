<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use App\Models\EncashmentLogs;
use App\Models\GenealogyLogs;
use App\Models\ActivationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activationCode' => 'required',
            'firstName' => 'required',
            'middleName' => '',
            'lastName' => 'required',
            'date_of_birth' => 'required',
            'contactInfo' => 'required',
            'email' => 'required',
        ]);

        $id = auth('sanctum')->user()->id;
        $slots = StartupSavings::checkSlot($id);
        foreach($slots as $checkSlots)
        {
            $usedSlots = $checkSlots->slots;
        }
        if($usedSlots > 8)
        {
            return response()->json([
                "message" => "No Slots Available"
            ], 403);
        }

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All Fields are Required',
                'errors' => $validator->errors()
            ], 400);
        }

        $checkCode = ActivationCode::where('activationCode', $request->get('activationCode'))->first();
        if($checkCode === null)
        {
            return response()->json([
                "message" => "Code doesn't exist"
            ], 401);
        }

        $isCodeUsed = User::where('activationCode', $request->get('activationCode'))->first();
        if($isCodeUsed === null)
        {
            $sponsorInfo = DB::table('users')->where('id', $id)->first();
            $sponsorName = $sponsorInfo->firstName." ".$sponsorInfo->lastName;
            $password = "test123";
            $role = "user";
            $addedUserName = $request->get('firstName')." ".$request->get('lastName');
            $newUser = array(
                "activationCode" =>$request->get('activationCode'),
                "firstName" => $request->get('firstName'),
                "middleName" => $request->get('middleName'),
                "lastName" => $request->get('lastName'),
                "date_of_birth" => $request->get('date_of_birth'),
                "contactInfo" => $request->get('contactInfo'),
                "email" => $request->get('email'),
                "password" => Hash::make($password),
                "IsUpgraded" => 0,
                "role" => "user"
            );
            User::create($newUser);
            ActivationCode::codeStatus($request->get('activationCode'));
            $newUserID = DB::table('users')->where('activationCode', $request->get('activationCode'))->first();
            $userID = $newUserID->id;
            $newUserName = $request->get('firstName')." ".$request->get('middleName')." ".$request->get('lastName');
            $newStartupUser = array(
                "userID" => $userID,
                "sponsorID" => $id,
                "fullName" => $newUserName
            );
            StartupSavings::newStartupUser($newStartupUser);
            $totalRebate = StartupSavings::totalStartupRebate($id);
            $totalStars = StartupSavings::totalStartupStars($id);
            $getEncashment = StartupSavings::getEncashment($id);
            $encashment = $getEncashment->encashment;
            $rebateBalance = $totalRebate-$encashment;
            StartupSavings::updateStartup($id, $totalRebate, $totalStars, $encashment, $rebateBalance);
            $newData = array(
                "id" => $userID,
                "rebate" => 0,
                "stars" => 0,
                "encashment" => 0,
                "rebateBalance" => 0
            );
            StartupSavings::newStartupData($newData);
            GreatSavings::newGreatSaveData($newData);
            $newLog = array(
                "id" => $userID,
                "sponsorID" => $id,
                "title" => "New Start-up Account Added",
                "description" => $sponsorName." "."added"." ".$addedUserName,
                "totalRebate" => $totalRebate,
            );
            GenealogyLogs::create($newLog);
            return response()->json([
                "message" => "Added Successfully",
                "New User" => $newUser,
                "New Log" => $newLog
            ], 200);
        }
        else
        {
            return response()->json([
                "message" => "Code is already used"
            ], 402);
        }

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
            "StartupRebate" => "₱".$rebateBalance.".00",
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
