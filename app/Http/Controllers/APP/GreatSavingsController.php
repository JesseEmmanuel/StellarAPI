<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GreatSavings;
use App\Models\StartupSavings;
use App\Models\ActivationCode;
use App\Models\Notifications;
use App\Models\GenealogyLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Jobs\SendMailJob;
use DB;

class GreatSavingsController extends Controller
{
    public function index()
    {
        $gsList = GreatSavings::getAll();
        $saList = StartupSavings::getAll();
        return view('admin/greatsavings', compact('gsList','saList'));
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activationCode' => 'required',
            'firstName' => 'required',
            'middleName' => '',
            'lastName' => 'required',
            'saSponsor' => 'required',
            'gsSponsor' => 'required',
            'date_of_birth' => 'required',
            'contactInfo' => 'required',
            'email' => 'required',
        ]);
        $saCheckSlot = StartupSavings::checkSlot($request->get('saSponsor'));
        foreach($saCheckSlot as $sacount)
        {
            $saCountSlot = $sacount->slots;
        }
        $gsCheckSlot = GreatSavings::checkSlot($request->get('gsSponsor'));
        foreach($gsCheckSlot as $gscount)
        {
            $gsCountSlot = $gscount->slots;
        }
        if($saCountSlot === 8)
        {
            return redirect('/greatsavings')->with('error', "Selected Start-up Savings' Sponsor is full");
        }
        if($gsCountSlot === 8)
        {
            return redirect('/greatsavings')->with('error', "Selected Great Savings' Sponsor is full");
        }
        $checkCode = ActivationCode::where('activationCode', $request->get('activationCode'))->first();
        if($checkCode === null)
        {
            return redirect('/greatsavings')->with('error', 'Code does not exist');
        }
        $isCodeUsed = User::where('activationCode', $request->get('activationCode'))->first();
        if($isCodeUsed === null)
        {
            $userName = $request->get('firstName').$request->get('lastName')."_"."C1";
            $password = Str::random(10);
            $newUser = array(
                "userName" => $userName,
                "activationCode" => $request->get('activationCode'),
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
            ActivationCode::codeStatus($request->get('activationCode'));
            $newUserAccount = DB::table('users')->where('activationCode', $request->get('activationCode'))->first();
            $newUserID = $newUserAccount->id;
            $newUserName = $request->get('firstName')." ".$request->get('lastName');
            $newData = array(
                "id" => $newUserID,
                "rebate" => 0,
                "stars" => 0,
                "encashment" => 0,
                "rebateBalance" => 0
            );
            StartupSavings::newStartupData($newData);
            $saSponsorInfo = DB::table('startupsavings')->where('userID', $request->get('saSponsor'))->first();
            $saSponsorName = $saSponsorInfo->fullName;
            GreatSavings::newGreatSaveData($newData);
            $gsSponsorInfo = DB::table('greatsavings')->where('userID', $request->get('gsSponsor'))->first();
            $gsSponsorName = $gsSponsorInfo->fullName;
            $newStartup = array(
                "userID" => $newUserID,
                "sponsorID" => $request->get('saSponsor'),
                "fullName" => $newUserName,
                "cycle" => 1
            );
            StartupSavings::newStartupUser($newStartup);
            Notifications::startupLevelNotify($request->get('saSponsor'));
            $startupTotalRebate = StartupSavings::totalStartupRebate($request->get('saSponsor'));
            $startupTotalStars = StartupSavings::totalStartupStars($request->get('saSponsor'));
            $startupGetEncashment = StartupSavings::getEncashment($request->get('saSponsor'));
            $startupEncashment = $startupGetEncashment->encashment;
            $startupRebateBalance = $startupTotalRebate-$startupEncashment;
            StartupSavings::updateStartup($request->get('saSponsor'), $startupTotalRebate, $startupTotalStars, $startupEncashment, $startupRebateBalance);
            $saSponsorData = DB::table('startupdata')->where('id', $request->get('saSponsor'))->first();
            $saSponsorRebate = $saSponsorData->rebate;
            $newStartupLog = array(
                "id" => $newUserID,
                "sponsorID" => $request->get('saSponsor'),
                "title" => "New Start-up Account Added",
                "description" => "Admin added"." ".$newUserName." "."with"." ".$saSponsorName." "."as Sponsor.",
                "totalRebate" => $saSponsorRebate,
            );
            GenealogyLogs::create($newStartupLog);
            $newGreatSave = array(
                "userID" => $newUserID,
                "sponsorID" => $request->get('gsSponsor'),
                "fullName" => $newUserName,
                "cycle" => 1
            );
            GreatSavings::newGreatSaveUser($newGreatSave);
            Notifications::greatLevelNotify($request->get('gsSponsor'));
            $greatsavingsTotalRebate = GreatSavings::totalGreatSaveRebate($request->get('gsSponsor'));
            $greatsavingsTotalStars = GreatSavings::totalGreatSaveStars($request->get('gsSponsor'));
            $greatsavingsGetEncashment = GreatSavings::getEncashment($request->get('gsSponsor'));
            $greatsavingsEncashment = $greatsavingsGetEncashment->encashment;
            $greatsavingsRebateBalance = $greatsavingsTotalRebate-$greatsavingsEncashment;
            GreatSavings::updateGreatSave($request->get('gsSponsor'), $greatsavingsTotalRebate, $greatsavingsTotalStars, $greatsavingsEncashment, $greatsavingsRebateBalance);
            $gsSponsorData = DB::table('greatsavedata')->where('id', $request->get('gsSponsor'))->first();
            $gsSponsorRebate = $gsSponsorData->rebate;
            $newGreatSaveLog = array(
                "id" => $newUserID,
                "sponsorID" => $request->get('gsSponsor'),
                "title" => "New Great Savings Account Added",
                "description" => "Admin added"." ".$newUserName." "."with"." ".$gsSponsorName." "."as Sponsor.",
                "totalRebate" => $gsSponsorRebate,
            );
            GenealogyLogs::create($newGreatSaveLog);
            Mail::to($request->get('email'))->send(new WelcomeMail($request->get('firstName'), $password, "Admin", $userName));
            return redirect('/greatsavings')->with('message', 'New Account Added Successfully');
        }
        else
        {
            return redirect('/greatsavings')->with('error', 'Code is already used');
        }
    }
}
