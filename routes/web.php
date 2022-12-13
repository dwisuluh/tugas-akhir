<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryaIlmiahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ObservasiController;
use App\Http\Controllers\PendahuluanController;
use App\Http\Controllers\PenelitianController;


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
    return redirect('dashboard');
});
Route::controller(HomeController::class)->group(function (){
    Route::get('/','index')->name('dashboard');
    // Route::get('surat-observasi','observasi')->name('pendahuluan');
    // Route::get('surat-penelitian','penelitian')->name('penelitian');
});
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
Route::get('reset', [LoginController::class, 'reset']);
Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store']);
Route::post('register-reset', [RegisterController::class, 'reset']);
Route::resource('karya-ilmiah',KaryaIlmiahController::class)->except('destroy');

// Route::name('dashboard')->group(function()
// {
//     Route::get('dashboard', [HomeController::class, 'index'])->name('home');

// });

// Route::resource('surat', SuratController::class)->middleware('auth');
Route::resource('surat-penelitian', PenelitianController::class)->except('destroy');
Route::resource('surat-observasi',ObservasiController::class)->except('destroy');
Route::get('surat-observasi/{id}',[ObservasiController::class,'print'])->name('print-observasi');
// Route::resource('pendahuluan', PendahuluanController::class)->middleware('auth')->except(['index','create']);
Route::get('/pendahuluan/print/{id}', [PendahuluanController::class, 'print']);
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::get('import',[MahasiswaController::class,'import'])->name('mahasiswa-import');
Route::resource('files', FileController::class)->middleware('auth');

Route::fallback(function () {
    return view('layouts.404');
});
Route::post('import-mahasiswa',[MahasiswaController::class,'importData'])->name('import-data');
