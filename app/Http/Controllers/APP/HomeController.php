<?php

namespace App\Http\Controllers\APP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }
}
