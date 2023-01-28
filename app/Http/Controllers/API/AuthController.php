<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivationCode;
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
    public function store(Request $request)
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
        $activationCode = '';
        $activeCode = ActivationCode::where('activationCode', $request->get('activationCode'))->first();
        if($activeCode === null)
        {
            return response()->json([
                "message" => "Code doesn't exist"
            ], 400);
        }
        else
        {
            $isCodeUsed = User::where('activationCode', $request->get('activationCode'))->first();
            if($isCodeUsed === null)
            {
                $activationCode = $request->get('activationCode');
                $sponsorID = auth('sanctum')->user()->id;
                $password = "test123";
                $newUser = array(
                    "sponsorID" => $sponsorID,
                    "activationCode" => $activationCode,
                    "firstName" => $request->get('firstName'),
                    "middleName" => $request->get('middleName'),
                    "lastName" => $request->get('lastName'),
                    "date_of_birth" => $request->get('date_of_birth'),
                    "contactInfo" => $request->get('contactInfo'),
                    "email" => $request->get('email'),
                    "password" => Hash::make($password)
                );
                User::create($newUser);
                return response()->json([
                    "message" => "Added Successfully",
                    "New User" => $newUser,
                ]);
            }
            else
            {
                return response()->json([
                    "message" => "Code is already used"
                ], 400);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
