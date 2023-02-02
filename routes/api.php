<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StartupController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::post('/addUser', [AuthController::class, 'addStartupUser']);
Route::get('/view', [StartupController::class, 'DirectReferrals']);
Route::get('/startupLogs', [StartupController::class, 'startupLogs']);
Route::get('/totalRebate', [StartupController::class, 'rebate']);
Route::get('view-direct-referrals/{id}', [StartupController::class, 'viewLevelOne']);