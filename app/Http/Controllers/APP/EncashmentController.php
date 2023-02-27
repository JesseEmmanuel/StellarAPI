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
        // $encashLogs = DB::table('encashment_logs')->get();
        $encashLogs = DB::table('encashment_logs')->orderBy('created_at', 'desc')->get();
        return view('admin.encashments', compact('encashLogs'));
    }

    public function verify(Request $request, $id)
    {
        $logInfo = DB::table('encashment_logs')->where('logID', $id)->first();
        $updateLog = EncashmentLogs::find($logInfo->logID);
        $updateLog->update(['claim' => 1]);
        $updateLog->save();
        // DB::table('encashment_logs')->where('logID', $logID)->limit(1)->update(array('claim' => 1));
        return redirect('/encashment')->with('success', 'Cash Claimed Successfully');
    }
}
