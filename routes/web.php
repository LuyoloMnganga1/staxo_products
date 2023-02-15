<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
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

Route::view('/', 'welcome');


Route::group(['middleware' => ['auth']], function () {
    //*****PRODUCT ROUTES**********//
    Route::get('get_products',[ProductsController::class,'index'])->name('get_products');
    Route::get('view_product/{id}',[ProductsController::class,'show'])->name('view_product');
    Route::get('add_product',[ProductsController::class,'create'])->name('add_product');
    Route::get('edit_product/{id}',[ProductsController::class,'edit'])->name('edit_product');
    Route::get('delete_product/{id}',[ProductsController::class,'destroy'])->name('delete_product');
    //*****END OF PRODUCT ROUTES**********//
});