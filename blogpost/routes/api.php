<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'post'], function(){
   Route::get('/',[\App\Http\Controllers\PostController::class,'index']);
});

Route::group(['prefix'=>'task'], function(){
    Route::get('/',[\App\Http\Controllers\TaskController::class,'index']);
});
