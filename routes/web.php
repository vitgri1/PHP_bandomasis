<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as C;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('country')->name('country-')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index')->middleware('role:admin');
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('role:admin');
    Route::post('/create', [C::class, 'store'])->name('store')->middleware('role:admin');
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('role:admin');
    Route::put('/edit/{country}', [C::class, 'update'])->name('update')->middleware('role:admin');
    Route::delete('/delete/{country}', [C::class, 'destroy'])->name('delete')->middleware('role:admin');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
