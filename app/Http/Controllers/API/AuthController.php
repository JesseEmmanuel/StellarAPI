<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StartupLog;
use App\Models\ActivationCode;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        if(Auth::attempt($credentials)){
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
                'message' => 'Invalid email and password'
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

        if($validator->fails()){
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
                $sponsor = auth('sanctum')->user()->firstName;
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
                    "role" => "user"
                );
                User::create($newUser);
                $levelOneCount = User::LevelOne(auth('sanctum')->user()->id);
                foreach($levelOneCount as $count1){
                    $levelOneMultiplier = $count1->multiplier;
                }
                $levelTwoCount = User::LevelTwo(auth('sanctum')->user()->id);
                foreach($levelTwoCount as $count2){
                    $levelTwoMultiplier = $count2->multiplier;
                }
                $levelThreeCount = User::LevelThree(auth('sanctum')->user()->id);
                foreach($levelThreeCount as $count3){
                    $levelThreeMultiplier = $count3->multiplier;
                }
                $levelFourCount = User::LevelFour(auth('sanctum')->user()->id);
                foreach($levelFourCount as $count4){
                    $levelFourMultiplier = $count4->multiplier;
                }
                $levelOneSubTotalRebate = $levelOneMultiplier*50;
                $levelTwoSubTotalRebate = $levelTwoMultiplier*8;
                $levelThreeSubTotalRebate = $levelThreeMultiplier*16;
                $levelFourSubTotalRebate = $levelFourMultiplier*16;
                $totalRebate = $levelOneSubTotalRebate + $levelTwoSubTotalRebate + $levelThreeSubTotalRebate + $levelFourSubTotalRebate;
                $totalStars = $levelOneMultiplier + $levelTwoMultiplier + $levelThreeMultiplier + ($levelFourMultiplier*2);
                $codeStatus = ActivationCode::codeStatus($activationCode);
                $userID = User::select('id')->where('activationCode', $activationCode)->get();
                foreach($userID as $userid){
                    $newUserID = $userid->id;
                }
                $newLog = array(
                    "id" => $newUserID,
                    "sponsorID" => $sponsorID,
                    "addedUser" => $addedUserName,
                    "addedBy" => $sponsor,
                    "totalRebate" => $totalRebate,
                    "totalStars" => $totalStars
                );
                StartupLog::create($newLog);
                return response()->json([
                    "message" => "Added Successfully",
                    "New User" => $newUser,
                    "New Log" => $newLog
                ]);
                // return response()->json([
                //         "message" => $newUserID,
                //     ]);
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
