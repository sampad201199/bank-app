<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonalAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes(['verify' => true]);

// main routes
Route::get('/', function () {
return view('welcome');
})->name('home');
Route::get('/about', function () {
return view('about');
})->name('about');
Route::get('/form', function () {
return view('form');
})->name('form');
route::get('/services', function () {
return view('services');
})->middleware(['auth', 'verified'])->name('services');
//route::get('/profile', function () {
//return view('user-profile');
//})->name('user-profile');
// services routes


// Form Routes
Route::get('/open-account', [PersonalAccountController::class, 'index'])->name('p-account');
Route::post('/open-account', [PersonalAccountController::class, 'storeAccountInfo'])->name('p-account-store');

Route::get('/dashboard', [PersonalAccountController::class, 'showAccountInfo'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Transaction Routes
Route::post('/withdraw', [PersonalAccountController::class, 'withdraw'])->name('withdraw');

require __DIR__.'/auth.php';
