<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\Rewards;
use DB;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function index()
    {
        $rewards = Rewards::getAllRewards();
        return view('admin/rewards', compact('rewards'));
    }

    public function redeemReward($rewardID)
    {
        $rewardInfo = DB::table('user_rewards')->where('id', $rewardID)->first();
        $updateReward = Rewards::find($rewardInfo->id);
        $updateReward->update(["redeemStatus" => 1]);
        $updateReward->save();
        return redirect('/rewards')->with('success', 'Reward claimed successfully');
    }
}
