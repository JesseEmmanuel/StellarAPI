<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use App\Models\ActivationCode;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Missing Credentials',
                'error' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            $user = User::where('email', $request->get('email'))->first();
            return response()->json([
                'message' => 'Signed in successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStartupUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activationCode' => 'required',
            'firstName' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'date_of_birth' => 'required',
            'contactInfo' => 'required',
            'email' => 'required',
        ]);

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
        else
        {
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
                    "IsUpgraded" => 0,
                    "role" => "user"
                );
                User::create($newUser);
                $userID = User::select('id')->where('activationCode', $activationCode)->get();
                foreach($userID as $userid){
                    $newUserID = $userid->id;
                }
                $totalRebate = StartupSavings::totalStartupRebate($sponsorID);
                $totalStars = StartupSavings::totalStartupStars($sponsorID);
                $encashment = StartupSavings::getEncashment($sponsorID);
                foreach($encashment as $cash)
                {
                    $rawEncashment = $cash->encashment;
                }
                $rebateBalance = $totalRebate - $rawEncashment;
                StartupSavings::updateStartup($sponsorID, $totalRebate, $totalStars, $rebateBalance);
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
                    "title" => "New Start-up Account Added",
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

    }

}
