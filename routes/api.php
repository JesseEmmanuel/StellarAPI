<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StartupController;
use App\Http\Controllers\API\GreatController;
use App\Http\Controllers\API\EncashmentController;

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
Route::get('/viewStartup', [StartupController::class, 'DirectReferrals']);
Route::get('/viewGreatSave', [GreatController::class, 'DirectReferrals']);
Route::get('/userLogs', [StartupController::class, 'startupLogs']);
Route::get('/startupSummary', [StartupController::class, 'summaryReports']);
Route::get('/greatsaveSummary', [GreatController::class, 'summaryReports']);
Route::get('view-startup-referrals/{id}', [StartupController::class, 'viewLevelOne']);
Route::post('/startupEncashment', [StartupController::class, 'encashment']);
Route::post('/greatsaveEncashment', [GreatController::class, 'encashment']);
Route::get('/encashmentLogs', [EncashmentController::class, 'encashmentLogs']);
