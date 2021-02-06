<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\PupukController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PesananController;
/*
,--------------------------------------------------------------------------
, Web Routes
,--------------------------------------------------------------------------
,
, Here is where you can register web routes for your application. These
, routes are loaded by the RouteServiceProvider within a group which
, contains the "web" middleware group. Now create something great!
,
*/
Route::get('/', [FrontController::class,'landing'])->name('landing');
Route::get('/tentang', [FrontController::class,'tentang'])->name('tentang');

// AUTH
Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::get('/register', [AuthController::class,'registerForm'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');
//produsen
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('role:pelanggan,produsen');
    Route::get('/kalkulator', [HomeController::class, 'kalkulator'])->name('kalkulator')->middleware('role:pelanggan');
    Route::post('/kalkulator', [HomeController::class,'hitung'])->name('hitung')->middleware('role:pelanggan');
    Route::get('/profil', [ProfilController::class,'index'])->name('profil');
    Route::post('/profil', [ProfilController::class,'update'])->name('profilstore');
//     Route::group(['as' => 'lahan.' , 'prefix' => 'lahan'], function () {                // unimplemented
//         Route::get('/', [LahanController::class,'index'])->name('lahan')->middleware('role:pelanggan');
//         Route::get('/tambah', [LahanController::class,'create'])->name('create')->middleware('role:pelanggan');
//         Route::post('/tambah', [LahanController::class, 'store'])->name('store')->middleware('role:pelanggan');
//         Route::get('/{id}/edit', [LahanController::class,'edit'])->name('edit')->middleware('role:pelanggan');
//         Route::patch('/{id}/edit', [LahanController::class, 'update'])->name('update')->middleware('role:pelanggan');
//         Route::delete('/{id}/hapus', [LahanController::class, 'destroy'])->name('delete')->middleware('role:pelanggan');
//     });
    Route::group(['as' => 'penjualan.' , 'prefix' => 'penjualan'], function () {
        Route::get('/', [PenjualanController::class,'index'])->name('index')->middleware('role:produsen');
        Route::get('/tambah', [PenjualanController::class, 'create'])->name('create')->middleware('role:produsen');
        Route::post('/tambah', [PenjualanController::class, 'store'])->name('store')->middleware('role:pelanggan,produsen');
        Route::get('/{id}/edit', [PenjualanController::class,'edit'])->name('edit')->middleware('role:produsen');
        Route::get('/{id}/set/{status}', [PenjualanController::class,'setstatus'])->name('edit')->middleware('role:pelanggan,produsen');
        Route::patch('/{id}/edit', [PenjualanController::class,'update'])->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', [PenjualanController::class,'destroy'])->name('delete')->middleware('role:pelanggan,produsen');
    });
    Route::group(['as' => 'pesanan.' , 'prefix' => 'pesanan'], function () {
        Route::get('/', [PesananController::class,'index'])->name('index')->middleware('role:produsen,pelanggan');
        Route::get('/riwayatpesan', [PesananController::class,'riwayatPesan'])->name('riwayatPesan')->middleware('role:pelanggan');
        Route::get('/tambah', [PesananController::class,'create'])->name('create')->middleware('role:pelanggan,produsen');
        Route::post('/tambah', [PesananController::class,'store'])->name('store')->middleware('role:pelanggan,produsen');
        Route::get('/{id}/edit', [PesananController::class,'edit'])->name('edit')->middleware('role:pelanggan,produsen');
        Route::patch('/{id}/edit', [PesananController::class,'update'])->name('update')->middleware('role:pelanggan,produsen');
        Route::delete('/{id}/hapus', [PesananController::class,'destroy'])->name('delete')->middleware('role:pelanggan,produsen');
    });
    Route::group(['as' => 'bahan.' , 'prefix' => 'bahan'], function () {
        Route::get('/', [BahanController::class,'index'])->name('index')->middleware('role:produsen');
        Route::get('/tambah', [BahanController::class,'create'])->name('create')->middleware('role:produsen');
        Route::post('/tambah', [BahanController::class,'store'])->name('store')->middleware('role:produsen');
        Route::get('/{id}/edit', [BahanController::class,'edit'])->name('edit')->middleware('role:produsen');
        Route::post('/{id}/edit', [BahanController::class,'update'])->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', [BahanController::class,'destroy'])->name('delete')->middleware('role:produsen');
    });
    Route::group(['as' => 'pupuk.' , 'prefix' => 'pupuk'], function () {
        Route::get('/', [PupukController::class,'index'])->name('index')->middleware('role:produsen,pelanggan');
        Route::get('/arsip', [PupukController::class,'arsip'])->name('arsip')->middleware('role:produsen');
        Route::get('/tambah', [PupukController::class,'create'])->name('create')->middleware('role:produsen');
        Route::post('/tambah', [PupukController::class,'store'])->name('store')->middleware('role:produsen');
        Route::get('/{id}/edit', [PupukController::class,'edit'])->name('edit')->middleware('role:produsen');
        Route::post('/{id}/edit', [PupukController::class,'update'])->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', [PupukController::class,'destroy'])->name('delete')->middleware('role:produsen');
        Route::get('/{id}/revert', [PupukController::class,'revert'])->name('revert')->middleware('role:produsen');
        Route::get('/{id}', [PupukController::class,'show'])->name('show')->middleware('role:produsen,pelanggan');
    });
    Route::group(['as' => 'pengaturan.' , 'prefix' => 'pengaturan'], function () { 
        Route::get('/website', [SettingController::class,'website'])->name('website')->middleware('role:produsen');
        Route::get('/jumbotron', [SettingController::class,'jumbotron'])->name('jumbotron')->middleware('role:produsen');
        Route::get('/kontak', [SettingController::class,'kontak'])->name('kontak')->middleware('role:produsen');
        Route::get('/maps', [SettingController::class,'maps'])->name('maps')->middleware('role:produsen');
        Route::post('/perbarui', [SettingController::class,'update'])->name('store')->middleware('role:produsen');
    });
});