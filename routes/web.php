<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SettingController;
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
// Route::get('/', 'welcome')->name('landing');
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
    Route::get('/profil', [ProfilController::class,'index'])->name('profil'); // unimplemented
    Route::post('/profil', [ProfilController::class,'update'])->name('profilstore')->middleware('role:pelanggan');
//     Route::group(['as' => 'lahan.' , 'prefix' => 'lahan'], function () {                // unimplemented
//         Route::get('/', [LahanController::class,'index'])->name('lahan')->middleware('role:pelanggan');
//         Route::get('/tambah', [LahanController::class,'create'])->name('create')->middleware('role:pelanggan');
//         Route::post('/tambah', [LahanController::class, 'store'])->name('store')->middleware('role:pelanggan');
//         Route::get('/{id}/edit', [LahanController::class,'edit'])->name('edit')->middleware('role:pelanggan');
//         Route::patch('/{id}/edit', [LahanController::class, 'update'])->name('update')->middleware('role:pelanggan');
//         Route::delete('/{id}/hapus', [LahanController::class, 'destroy'])->name('delete')->middleware('role:pelanggan');
//     });
    Route::group(['as' => 'penjualan.' , 'prefix' => 'penjualan'], function () {                // unimplemented
        Route::get('/', [PenjualanController::class,'index'])->name('index')->middleware('role:produsen');
        Route::get('/tambah', [PenjualanController::class, 'create'])->name('create')->middleware('role:produsen');
        Route::post('/tambah', [PenjualanController::class, 'store'])->name('store')->middleware('role:pelanggan|produsen');
        Route::get('/{id}/edit', [PenjualanController::class,'edit'])->name('edit')->middleware('role:produsen');
        Route::get('/{id}/set/{status}', [PenjualanController::class,'setstatus'])->name('edit')->middleware('role:pelanggan|produsen');
        Route::patch('/{id}/edit', 'PenjualanController@update')->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', 'PenjualanController@destroy')->name('delete')->middleware('role:pelanggan|produsen');
    });
    Route::group(['as' => 'pesanan.' , 'prefix' => 'pesanan'], function () {                // unimplemented
        Route::get('/', 'PesananController@index')->name('index')->middleware('role:produsen|pelanggan');
        Route::get('/riwayatpesan', 'PesananController@riwayatPesan')->name('riwayatpesan')->middleware('role:pelanggan');
        Route::get('/tambah', 'PesananController@create')->name('create')->middleware('role:pelanggan|produsen');
        Route::post('/tambah', 'PesananController@store')->name('store')->middleware('role:pelanggan|produsen');
        Route::get('/{id}/edit', 'PesananController@edit')->name('edit')->middleware('role:pelanggan|produsen');
        Route::patch('/{id}/edit', 'PesananController@update')->name('update')->middleware('role:pelanggan|produsen');
        Route::delete('/{id}/hapus', 'PesananController@destroy')->name('delete')->middleware('role:pelanggan|produsen');
    });
    Route::group(['as' => 'bahan.' , 'prefix' => 'bahan'], function () {                // unimplemented
        Route::get('/', 'BahanController@index')->name('index')->middleware('role:produsen');
        Route::get('/tambah', 'BahanController@create')->name('create')->middleware('role:produsen');
        Route::post('/tambah', 'BahanController@store')->name('store')->middleware('role:produsen');
        Route::get('/{id}/edit', 'BahanController@edit')->name('edit')->middleware('role:produsen');
        Route::post('/{id}/edit', 'BahanController@update')->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', 'BahanController@destroy')->name('delete')->middleware('role:produsen');
    });
    Route::group(['as' => 'pupuk.' , 'prefix' => 'pupuk'], function () {                // unimplemented
        Route::get('/', 'PupukController@index')->name('index')->middleware('role:produsen|pelanggan');
        Route::get('/arsip', 'PupukController@arsip')->name('arsip')->middleware('role:produsen');
        Route::get('/tambah', 'PupukController@create')->name('create')->middleware('role:produsen');
        Route::post('/tambah', 'PupukController@store')->name('store')->middleware('role:produsen');
        Route::get('/{id}/edit', 'PupukController@edit')->name('edit')->middleware('role:produsen');
        Route::post('/{id}/edit', 'PupukController@update')->name('update')->middleware('role:produsen');
        Route::get('/{id}/hapus', 'PupukController@destroy')->name('delete')->middleware('role:produsen');
        Route::get('/{id}/revert', 'PupukController@revert')->name('revert')->middleware('role:produsen');
        Route::get('/{id}', 'PupukController@show')->name('show')->middleware('role:produsen|pelanggan');
    });
    Route::group(['as' => 'pengaturan.' , 'prefix' => 'pengaturan'], function () {                // unimplemented
        Route::get('/website', [SettingController::class,'website'])->name('website')->middleware('role:produsen');
        Route::get('/jumbotron', [SettingController::class,'jumbotron'])->name('jumbotron')->middleware('role:produsen');
        Route::get('/kontak', [SettingController::class,'kontak'])->name('kontak')->middleware('role:produsen');
        Route::get('/maps', [SettingController::class,'maps'])->name('maps')->middleware('role:produsen');
        Route::post('/perbarui', [SettingController::class,'store'])->name('store')->middleware('role:produsen');
    });
});