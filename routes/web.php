<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PendahuluanController;

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

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('reset',[LoginController::class, 'reset']);
Route::get('register',[RegisterController::class,'index'])->middleware('guest');
Route::post('register',[RegisterController::class,'store']);
Route::post('register-reset',[RegisterController::class,'reset']);

Route::get('dashboard',[HomeController::class,'index'])->middleware('auth');
Route::resource('pendahuluan', PendahuluanController::class)->middleware('auth');
Route::get('/pendahuluan/print/{id}',[PendahuluanController::class,'print']);
Route::resource('user',UserController::class)->middleware('auth');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
