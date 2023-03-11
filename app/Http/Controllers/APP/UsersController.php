<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $userList = DB::table('users')->where('role', 'user')->get();
        return view('admin.users', compact('userList'));
    }
}
