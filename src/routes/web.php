<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;


Route::get('/products',[ProductsController::class,'index']);
Route::get('/products/register',[ProductsController::class,'register']);
Route::get('/products/search',[ProductsController::class,'search']);