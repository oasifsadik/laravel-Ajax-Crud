<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('home',[ProductController::class,'index']);
Route::post('add-product',[ProductController::class,'add']);
Route::post('update-product',[ProductController::class,'update']);
Route::get('delete-product',[ProductController::class,'delete']);
Route::get('/pagination/paginate-data',[ProductController::class,'pagination']);
Route::get('search-product',[ProductController::class,'search']);
