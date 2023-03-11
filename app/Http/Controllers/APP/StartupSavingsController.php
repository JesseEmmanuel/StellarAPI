<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GreatSavings;
use App\Models\StartupSavings;
use App\Models\GenealogyLogs;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class StartupSavingsController extends Controller
{
    public function index()
    {
        $gsList = GreatSavings::getAll();
        $saList = StartupSavings::getAll();
        $startups = StartupSavings::startups();
        return view('admin/startupsavings', compact('gsList','saList','startups'));
    }

    public function upgrade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startup' => 'required',
            'gsSponsor' => 'required',
        ]);

        $countLevelTwo = StartupSavings::levelCount($request->get('startup'), 2);
        if($countLevelTwo < 64)
        {
            return redirect('/startupsavings')->with('error', "Account is not valid for upgrade");
        }

        $sponsorInfo = DB::table('greatsavings')->where('userID', $request->get('gsSponsor'))->first();
        $accountInfo = DB::table('startupsavings')->where('userID', $request->get('startup'))->first();
        $accountFullname = $accountInfo->fullName;
        $upgradeAccount = array(
            "userID" => $request->get('startup'),
            "sponsorID" => $request->get('gsSponsor'),
            "fullName" => $accountFullname
        );
        GreatSavings::newGreatSaveUser($upgradeAccount);
        Notifications::greatLevelNotify($request->get('gsSponsor'));
        $updateAccount = User::find($request->get('startup'));
        $updateAccount->update(['IsUpgraded' => 1]);
        $greatsavingsTotalRebate = GreatSavings::totalGreatSaveRebate($request->get('gsSponsor'));
        $greatsavingsTotalStars = GreatSavings::totalGreatSaveStars($request->get('gsSponsor'));
        $greatsavingsGetEncashment = GreatSavings::getEncashment($request->get('gsSponsor'));
        $greatsavingsEncashment = $greatsavingsGetEncashment->encashment;
        $greatsavingsRebateBalance = $greatsavingsTotalRebate-$greatsavingsEncashment;
        GreatSavings::updateGreatSave($request->get('gsSponsor'), $greatsavingsTotalRebate, $greatsavingsTotalStars, $greatsavingsEncashment, $greatsavingsRebateBalance);
        $gsSponsorData = DB::table('greatsavedata')->where('id', $request->get('gsSponsor'))->first();
        $gsSponsorRebate = $gsSponsorData->rebate;
        $newGreatSaveLog = array(
            "id" => $request->get('startup'),
            "sponsorID" => $request->get('gsSponsor'),
            "title" => "An Account Unlocked Great Savings",
            "description" => "Admin Upgraded"." ".$accountFullname."'s"." "."with"." ".$sponsorInfo->fullName." "."as Sponsor.",
            "totalRebate" => $gsSponsorRebate,
        );
        GenealogyLogs::create($newGreatSaveLog);
        return redirect('/startupsavings')->with('success', "Account is successfully upgraded. Please check at Great Savings Account List");
    }

    public function newCycle(Request $request, $id)
    {
        $sponsor = Validator::make($request->all(), [
            'startup' => 'required',
        ]);
        $userInfo = DB::table('users')->where('id', $id)->first();
        dd($userInfo);
    }
}
