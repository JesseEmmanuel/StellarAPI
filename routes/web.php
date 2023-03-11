<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Middleware;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\APP\UsersController;
use App\Http\Controllers\APP\GreatSavingsController;
use App\Http\Controllers\APP\StartupSavingsController;
use App\Http\Controllers\API\StartupController;
use App\Http\Controllers\APP\HomeController;
use App\Http\Controllers\APP\NotificationsController;
use App\Http\Controllers\APP\EncashmentController;
use App\Http\Controllers\APP\RewardsController;
use App\Http\Controllers\APP\ActivationCodeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/users', [UsersController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth');
Route::post('/login/auth', [AuthController::class, 'auth']);
Route::get('/activation-codes', [CodeController::class, 'index']);
Route::get('/greatsavings', [GreatSavingsController::class, 'index']);
Route::get('/startupsavings', [StartupSavingsController::class, 'index']);
Route::post('/startupsavings/upgrade', [StartupSavingsController::class, 'upgrade']);
Route::post('/startupsavings/newCycle/{id}', [StartupSavingsController::class, 'newCycle'])->name("new-cycle");
Route::post('/greatsavings/add', [GreatSavingsController::class, 'addUser']);
Route::get('/logout', [AuthController::class, 'destroy']);
Route::get('/notifications', [NotificationsController::class, 'index']);
Route::get('/notifications/read/{id}', [NotificationsController::class, 'read']);
Route::get('/notifications/unread/{id}', [NotificationsController::class, 'unread']);
Route::get('/notifications/readAll', [NotificationsController::class, 'bulkread']);
Route::get('/notifications/unreadAll', [NotificationsController::class, 'bulkunread']);
Route::get('/encashment', [EncashmentController::class, 'index']);
Route::get('/encashment/verify/{id}', [EncashmentController::class, 'verify']);
Route::get('/rewards', [RewardsController::class, 'index']);
Route::get('/rewards/redeem/{id}', [RewardsController::class, 'redeemReward']);
Route::get('/activationCodes', [ActivationCodeController::class, 'index']);
Route::get('/activationCodes/newCode', [ActivationCodeController::class, 'generateCode']);

/**Route For Email */
Route::get('/email', [StartupController::class, 'addUser']);
