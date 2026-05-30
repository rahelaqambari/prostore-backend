<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Reviwcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("products",ProductController::class);
Route::apiResource("reviews",Reviwcontroller::class)->middleware('auth:sanctum');
