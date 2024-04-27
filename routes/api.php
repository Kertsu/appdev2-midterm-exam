<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\ProductAccessMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([ProductAccessMiddleware::class])->group(function () {
    Route::apiResource('products', ProductController::class);

    Route::prefix('products/upload')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::post('local', 'uploadImageLocal')->name('upload.local');
            Route::post('public', 'uploadImagePublic')->name('upload.public');
        });
    });
});

