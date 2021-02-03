<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class,'landing'])->name('landing');
Route::get('/tentang', [HomeController::class,'tentang'])->name('tentang');
Auth::routes();
//produsen
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:pelanggan');
    Route::get('/kalkulator', [HomeController::class, 'kalkulator'])->name('kalkulator')->middleware('role:pelanggan');
    Route::post('/kalkulator', [HomeController::class,'hitung'])->name('hitung')->middleware('role:pelanggan');
    Route::get('/profil', 'ProfilController@index')->name('profil'); // unimplemented
    Route::post('/profil', 'ProfilController@update')->name('profilstore')->middleware('role:pelanggan');
});