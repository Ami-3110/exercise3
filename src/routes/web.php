<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WeightController;

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

Route::get('/register/step1', [AuthController::class, 'showRegisterStep1']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/register/step2', [AuthController::class, 'showRegisterStep2']);
Route::post('/register/step1',[AuthController::class,'registerStep1']);
Route::post('/register/step2',[AuthController::class,'registerStep2']);
Route::post('/logout',[AuthController::class,'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/weight_logs',[WeightController::class,'index']);
    Route::post('/weight_logs/create',[WeightController::class,'store']);
    Route::post('/weight_logs/search',[WeightController::class,'search']);

    Route::get('weight_logs/{weightLogId}',[WeightController::class,'show']);
    Route::post('/weight_logs/{weightLogId}/update',[WeightController::class,'update']);
    Route::post('/weight_logs/{weightLogId}/delete',[WeightController::class,'delete']);

    Route::post('/weight_logs/goal_setting',[WeightController::class,'settings']);

});