<?php

use App\Http\Controllers\Topic\OOPTopicController;
use App\Http\Controllers\Topic\TopicController;
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
Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
//Route::get('/topics/oop', [OOPTopicController::class, 'index'])->name('topics.oop');
Route::get('/topics/{id}/solid', [OOPTopicController::class, 'solid'])->name('topics.solid');
Route::get('/topics/{id}/aggregation', [OOPTopicController::class, 'aggregation'])->name('topics.aggregation');
Route::get('/topics/{id}/demetra', [OOPTopicController::class, 'demetra'])->name('topics.demetra');
Route::get('/topics/{id}/polymorphism', [OOPTopicController::class, 'polymorphism'])->name('topics.polymorphism');
//Route::get('/topics/oop/srp', [OOPTopicController::class, 'srp'])->name('topics.srp');
Route::get('/topics/{id}', [TopicController::class, 'show'])->name('topics.show');
