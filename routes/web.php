<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', function () {
    return response()->json(\App\Models\User::all());
});

Route::get('/dashboard', function () {
    $users = \App\Models\User::all();
    return view('dashboard')->with('users', $users);
})->middleware(['auth'])->name('dashboard');

Route::get('/pricing', function () {
    return view('pricing');
})->middleware(['auth'])->name('pricing');

Route::get('/devices', function () {
    return view('devices');
})->middleware(['auth'])->name('devices');

require __DIR__ . '/auth.php';
