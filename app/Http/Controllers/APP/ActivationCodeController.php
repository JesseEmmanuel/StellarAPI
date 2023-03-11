<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\ActivationCodes;
use Illuminate\Support\Str;
use DB;
use Illuminate\Http\Request;

class ActivationCodeController extends Controller
{
    public function index()
    {
        $unusedCodes = DB::table('activation_codes')->where('status', 0)->orderBy('created_at', 'desc')->get();
        $usedCodes = ActivationCodes::getUsedCodes();
        return view('admin.activationCodes', compact('unusedCodes', 'usedCodes'));
    }

    public function generateCode()
    {
        $newCode = mt_rand(1000000, 9999999);
        $newData = array(
            "activationCode" => $newCode,
            "status" => 0
        );
        $checkNewCode = DB::table('activation_codes')->where('activationCode', $newCode)->first();
        if($checkNewCode === null)
        {
            ActivationCodes::create($newData);
        }

        return redirect('/activationCodes')->with('success', 'Generated an Activation Code Successfully');
    }
}
