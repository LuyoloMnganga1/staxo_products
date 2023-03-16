<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', [ProductsController::class,'index']);

//*****AUTHENTICATION ROUTES**********//
Route::get('login', [LoginController::class,'index'])->name('login'); 
Route::post('authenticate', [LoginController::class,'authenticate'])->name('authenticate'); 
Route::get('new/user', [RegisterController::class,'indeex'])->name('register');
Route::get('logout', [LoginController::class,'logout'])->name('logout'); 
//***** ND OF AUTHENTICATION ROUTES**********//


//*****PRODUCT ROUTES**********//
Route::get('get_products',[ProductsController::class,'getproducts'])->name('get_products');
Route::get('view_product/{id}',[ProductsController::class,'show'])->name('view_product');
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [ProductsController::class,'index'])->name('dashboard');
    Route::post('add_product',[ProductsController::class,'create'])->name('add_product');
    Route::post('edit_product',[ProductsController::class,'edit'])->name('edit_product');
    Route::get('delete_product/{id}',[ProductsController::class,'destroy'])->name('delete_product'); 
});
 //*****END OF PRODUCT ROUTES**********//