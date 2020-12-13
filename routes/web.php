<?php

use App\Models\Pricing;
use Illuminate\Http\Request;
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

Route::get('/remove/users/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    $user->delete();
    return back();
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

Route::post('/save-pricing', function (Request $request) {
    $pricing = new Pricing();
    $pricing->min = $request->min;
    $pricing->max = $request->max;
    $pricing->price = $request->price;
    $pricing->save();
    return back();
})->middleware(['auth'])->name('saveprices');


Route::post('/save-appliance', function (Request $request) {
    $appliance = new \App\Models\Device();
    $appliance->name = $request->name;
    $file = $request->file('icon');
    $extension = $file->getClientOriginalExtension(); // you can also use file name
    $fileName = time() . '.' . $extension;
    $path = public_path() . '/icons';
    $upload = $file->move($path, $fileName);
    $appliance->icon = '/icons/' . time() . '.' . $extension;
    $appliance->description = $request->description;
    $appliance->wattage = $request->wattage;
    $appliance->save();
    return back();
});


require __DIR__ . '/auth.php';
