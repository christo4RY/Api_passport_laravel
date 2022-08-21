<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

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
Route::post('/login', [AuthContoller::class,'login']);
Route::post('/register', [AuthContoller::class,'create']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthContoller::class,'logout']);
    Route::get('/categories', [CategoryController::class,'index']);
    Route::get('/categories/{category}', [CategoryController::class,'show']);
    Route::post('/categories', [CategoryController::class,'store']);
    Route::patch('/categories/{category}', [CategoryController::class,'update']);
    Route::delete('/categories/{category}', [CategoryController::class,'destroy']);
});
