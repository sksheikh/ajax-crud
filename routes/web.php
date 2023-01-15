<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



//_Product Route_//
Route::resource('/', ProductController::class);
