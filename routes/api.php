<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Reviwcontroller;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('dashboard')->group(function() {
 Route::get("/allreviews",[Reviwcontroller::class,'allReviwes']);
 Route::get("lastmonthreviews",[Reviwcontroller::class,'lastMonthReviewes']);
 Route::get("/alluser",[UserController::class,'alluser']);
 Route::get("/lastMonthUser",[UserController::class,'lastMonthUser']);
 Route::apiResource('all-user',UserController::class);
});
Route::apiResource("products",ProductController::class);
Route::apiResource("reviews",Reviwcontroller::class)->middleware('auth:sanctum');
Route::apiResource("auth",AuthController::class)->only('store');
Route::apiResource("signup",SignUpController::class);
Route::apiResource("check-token",AuthController::class);
