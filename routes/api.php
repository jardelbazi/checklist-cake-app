<?php

use App\Http\Controllers\CakeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cakes')->group(function() {
	Route::post('/', [CakeController::class, 'store']);
	Route::put('/{id}', [CakeController::class, 'update'])->whereNumber('id');
	Route::delete('/{id}', [CakeController::class, 'destroy'])->whereNumber('id');
	Route::get('/{id}', [CakeController::class, 'show'])->whereNumber('id');
	Route::get('/', [CakeController::class, 'index']);
});
