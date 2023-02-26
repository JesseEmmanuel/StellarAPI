<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StartupSavings;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function notify()
    {
        $id = auth('sanctum')->user()->id;
        $userStatus = auth('sanctum')->user()->IsUpgraded;
        Notifications::startupLevelNotify($id);
        if($userStatus === 1)
        {
            Notifications::greatLevelNotify($id);
        }

    }
}
