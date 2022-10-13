<?php

use App\Http\Controllers\CakeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cakes')->group(function() {
	Route::post('/', [CakeController::class, 'store'])->name('api.cake.store');
	Route::put('/{id}', [CakeController::class, 'update'])->whereNumber('id')->name('api.cake.update');
	Route::delete('/{id}', [CakeController::class, 'destroy'])->whereNumber('id')->name('api.cake.destroy');
	Route::get('/{id}', [CakeController::class, 'show'])->whereNumber('id')->name('api.cake.show');
	Route::get('/', [CakeController::class, 'index'])->name('api.cake.index');;
});
