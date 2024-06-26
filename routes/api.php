<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\PaymeController; 
use App\Http\Controllers\Api\ApiController; 
use App\Http\Controllers\TkunController; 
use App\Http\Controllers\Api\AuthController; 
use App\Http\Controllers\Api\UserController; 

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payme', [PaymeController::class, 'index']);

Route::get('/tkun', [TkunController::class, 'index']);

Route::get('/setting', [ApiController::class, 'setting']);
Route::post('/setting/update', [ApiController::class, 'update']);
Route::get('/sms', [ApiController::class, 'smsCount']);
Route::post('/sms/plus', [ApiController::class, 'smsCountPlus']);
Route::post('/active', [ApiController::class, 'active']);

Route::get('/cours', [ApiController::class, 'cours']);


/* Student API */
Route::post('/student/login', [AuthController::class, 'login']);

Route::group([
    'middleware' => ["auth:sanctum"]
],function(){
    Route::get('/student/profel', [AuthController::class, 'profel']);
    Route::put('/student/logout', [AuthController::class, 'logout']);

    Route::get('/student/guruh', [UserController::class, 'guruh']);
    Route::get('/student/guruhshow', [UserController::class, 'guruhshow']);
    Route::get('/student/tulovlar', [UserController::class, 'tulovlar']);
});
