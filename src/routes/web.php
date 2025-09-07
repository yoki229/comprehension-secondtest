<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;


Route::get('/products',[ProductsController::class,'index']);
Route::get('/products/search',[ProductsController::class,'search']);
Route::get('/products/register',[ProductsController::class,'register']);
Route::put('/products/{productId}/update',[ProductsController::class,'update']);
Route::delete('/products/{productId}/delete',[ProductsController::class,'delete']);
Route::get('/products/{productId}',[ProductsController::class,'detail']);