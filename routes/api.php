<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StartupController;
use App\Http\Controllers\API\GreatController;
use App\Http\Controllers\API\NotificationsController;
use App\Http\Controllers\API\EncashmentController;
use App\Http\Controllers\API\RewardsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('/getUserInfo', [AuthController::class, 'userInfo']);
Route::put('/updateInfo', [AuthController::class, 'updateInfo']);
Route::put('/changePassword', [AuthController::class, 'changePassword']);
Route::put('/forgotPassword', [AuthController::class, 'forgotPassword']);
Route::post('/addStartupAccount', [StartupController::class, 'addUser']);
Route::post('/addGreatSaveAccount', [GreatController::class, 'addUser']);
Route::get('/viewStartup', [StartupController::class, 'DirectReferrals']);
Route::get('/viewGreatSave', [GreatController::class, 'DirectReferrals']);
Route::get('/userLogs', [StartupController::class, 'startupLogs']);
Route::get('/startupSummary', [StartupController::class, 'summaryReports']);
Route::get('/greatsaveSummary', [GreatController::class, 'summaryReports']);
Route::get('view-startup-referrals/{id}', [StartupController::class, 'viewLevelOne']);
Route::get('view-greatsave-referrals/{id}', [GreatController::class, 'viewLevelOne']);
Route::post('/startupEncashment', [StartupController::class, 'encashment']);
Route::post('/greatsaveEncashment', [GreatController::class, 'encashment']);
Route::get('/encashmentLogs', [EncashmentController::class, 'encashmentLogs']);
Route::get('/notifications', [NotificationsController::class, 'notify']);
Route::get('/checkRewards', [RewardsController::class, 'checkRewards']);
Route::get('/getRewards', [RewardsController::class, 'getRewards']);
