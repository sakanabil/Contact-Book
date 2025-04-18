<?php

use App\Http\Controllers\KontakController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'kontak'], function () {
    Route::get('/', [KontakController::class, 'index']);
    Route::post('/list', [KontakController::class, 'list']);
    Route::get('/create', [KontakController::class, 'create']);
    Route::post('/', [KontakController::class, 'store']);
    Route::get('/{id}', [KontakController::class, 'show']);
    Route::get('/{id}/edit', [KontakController::class, 'edit']);
    Route::put('/{id}', [KontakController::class, 'update']);
    Route::delete('/{id}', [KontakController::class, 'destroy']);
});

