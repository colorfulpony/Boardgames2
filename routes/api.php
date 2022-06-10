<?php

use App\Http\Controllers\API\ProductCategory\ProductCategoryController;
use App\Http\Controllers\Auth\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'product_categories', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ProductCategoryController::class, 'index']);
    Route::post('/add', [ProductCategoryController::class, 'add']);
    Route::get('/edit/{id}', [ProductCategoryController::class, 'edit']);
    Route::post('/update/{id}', [ProductCategoryController::class, 'update']);
    Route::delete('/delete/{id}', [ProductCategoryController::class, 'delete']);
});
