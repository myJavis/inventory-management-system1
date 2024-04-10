<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [LoginController::class, 'login']);
Route::post('/add-category', [CategoryController::class, 'store']);
Route::get('/dashboard', [DashboardController::class, 'dashboardData']);
Route::post('/add-product', [ProductController::class, 'store']);
Route::post('/get-categories', [CategoryController::class, 'getCategories']);
Route::get('/get-products', [ProductController::class, 'getProducts']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
Route::put('/products/{id}', [ProductController::class, 'update']);





Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
