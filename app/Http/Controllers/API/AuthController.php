<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rewards;
use App\Models\Notifications;
use App\Models\StartupSavings;
use App\Models\GreatSavings;
use App\Models\ActivationCode;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
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
            'userName' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'Missing Credentials',
                'error' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('userName', 'password');
        if(Auth::attempt($credentials))
        {
        /** CHECK FOR REWARDS */
        $id = auth('sanctum')->user()->id;
        $userStatus = auth('sanctum')->user()->IsUpgraded;
        Rewards::checkStartupRewards($id);
        if($userStatus === 1)
        {
            Rewards::checkGreatSavingsRewards($id);
        }

        /** CHECK FOR COMPLETED LEVEL */
        $userStatus = auth('sanctum')->user()->IsUpgraded;
        Notifications::startupLevelNotify($id);
        if($userStatus === 1)
        {
            Notifications::greatLevelNotify($id);
        }

            $user = User::where('userName', $request->get('userName'))->first();
            return response()->json([
                'message' => 'Signed in successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => $user,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401);
        }
    }

    public function userInfo()
    {
        $id = auth('sanctum')->user()->id;
        $usernInfo = DB::table('users')->where('id', $id)->first();
        return response()->json([
            'userInfo' => $usernInfo
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $newInfo = Validator::make($request->all(), [
            'userName' => 'required',
            'firstName' => 'required',
            'middleName' => '',
            'lastName' => 'required',
            'date_of_birth' => 'required',
            'contactInfo' => 'required',
            'email' => '',
        ]);
        if($newInfo->fails())
        {
            return response()->json([
                'message' => 'Invalid Input, Please check the errors',
                'error' => $newInfo->errors(),
            ], 400);
        }
        $userInfo = User::find($id);
        $userInfo->update([
            'userName' => $request->get('userName'),
            'firstName' => $request->get('firstName'),
            'middleName' => $request->get('middleName'),
            'lastName' => $request->get('lastName'),
            'date_of_birth' => $request->get('date_of_birth'),
            'contactInfo' => $request->get('contactInfo'),
            'email' => $request->get('email')
        ]);
        $updatedUser = DB::table('users')->where('id', $id)->first();

        return response()->json([
            'message' => 'Updated Successfully',
            'updateInfo' => $updatedUser
        ], 200);

    }

    public function changePassword(Request $request)
    {
        $id = auth('sanctum')->user()->id;
        $newPassword = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        if($newPassword->fails()) {
            return response()->json([
                'message' => 'An error occured. Please check',
                'errors' => $newPassword->errors(),
            ], 400);
        }

        $userInfo = DB::table('users')->where('id', $id)->first();
        $currentPassword = $userInfo->password;
        $oldPassword = $request->get('oldPassword');

        if(!Hash::check($oldPassword, $currentPassword))
        {
            return response()->json([
                'message' => 'Old Password not found'
            ], 401);
        }

        if($request->get('newPassword') !== $request->get('confirmPassword'))
        {
            return response()->json([
                'message' => 'Failed Password Confirmation'
            ], 402);
        }
        $updateInfo = User::find($id);
        $updateInfo->update(["password" => Hash::make($request->get('newPassword'))]);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activationCode' => 'required',
            'email' => 'required',
        ]);
        $checkAccount = DB::table('users')->where('activationCode', $request->get('activationCode'))
                                          ->where('email', $request->get('email'))->first();
        if($checkAccount === null)
        {
            return response()->json([
                'message' => 'This Account does not exist'
            ], 400);
        }

        $newPassword = Str::random(10);
        $firstName = $checkAccount->firstName;
        $userID = $checkAccount->id;
        $updatePassword = User::find($userID);
        $updatePassword->update(["password" => Hash::make($newPassword)]);
        Mail::to($request->get('email'))->send(new ForgotPassword($firstName, $newPassword));

        return response()->json([
            'message' => 'New Password requested Successfully. Please check your email'
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

}
