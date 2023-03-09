<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rewards;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use App\Models\EncashmentLogs;
use App\Models\GenealogyLogs;
use App\Models\ActivationCode;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    public function checkRewards()
    {
        $id = auth('sanctum')->user()->id;
        $userStatus = auth('sanctum')->user()->IsUpgraded;
        Rewards::checkStartupRewards($id);
        if($userStatus === 1)
        {
            Rewards::checkGreatSavingsRewards($id);
        }
    }

    public function getRewards()
    {
        $id = auth('sanctum')->user()->id;
        $rewards = Rewards::getRewards($id);
        return response()->json([
            'rewards' => $rewards
        ], 200);
    }
}
