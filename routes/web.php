<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login/github', [LoginController::class, 'github']);
Route::get('/login/github/redirect', [LoginController::class, 'githubRedirect']);
Route::get('/login/google', [LoginController::class, 'google']);
Route::get('/login/google/redirect', [LoginController::class, 'googleRedirect']);
