<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', [Api::class, 'getToken'])->name('api.token');
Route::post('/registration', [Api::class, 'registration'])->name('api.registration');
Route::get('/profile/{id}', [Api::class, 'profile'])->name('api.profile');
