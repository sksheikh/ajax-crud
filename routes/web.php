<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



//_Product Route_//
Route::get('/', [ProductController::class,'index']);
Route::get('/products/create', [ProductController::class,'create']);
Route::post('/products/store', [ProductController::class,'store']);
Route::get('/products/edit/{id}', [ProductController::class,'edit']);
Route::post('/products/update/{id}', [ProductController::class,'update']);
Route::get('/products/delete/{id}', [ProductController::class,'delete']);
// Route::post('/store-data', [ProductController::class,'storeData']);
