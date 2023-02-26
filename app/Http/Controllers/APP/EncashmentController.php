<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EncashmentLogs;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use DB;

class EncashmentController extends Controller
{
    public function index()
    {
        $encashLogs = DB::table('encashment_logs')->get();
        return view('admin.encashments', compact('encashLogs'));
    }

    public function verify(Request $request, $id)
    {
        $logInfo = DB::table('encashment_logs')->where('logID', $id)->first();
        $userID = $logInfo->userID;
        $userInfo = DB::table('users')->where('id', $userID)->first();
        $userCode = $userInfo->activationCode;
        $userEmail = $userInfo->email;
        $userPassword = $userInfo->password;
        $validated = $request->validate([
            "activationCode" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        if($request->get('activationCode') != $userCode)
        {
            return redirect('/encashment')->with('error', 'Wrong Activation Code');
        }

        if($request->get('email') != $userEmail)
        {
            return redirect('/encashment')->with('error', 'Wrong Email');
        }

        if(!Hash::check($request->get('password'), $userPassword))
        {
            return redirect('/encashment')->with('error', 'Wrong Password');
        }
        $updateLog = EncashmentLogs::find($logInfo->logID);
        $updateLog->update(['claim' => 1]);
        $updateLog->save();
        // DB::table('encashment_logs')->where('logID', $logID)->limit(1)->update(array('claim' => 1));
        return redirect('/encashment')->with('success', 'User Verified');
    }
}
