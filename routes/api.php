<?php

use App\Http\Controllers\Api\LokasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::apiResource('products', ProductController::class);
Route::apiResource('lokasi', LokasiController::class);
