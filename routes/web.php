<?php

use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileKaryaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryaIlmiahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ObservasiController;
// use App\Http\Controllers\PendahuluanController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\SearchController;

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
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'authenticate');
    Route::post('logout', 'logout');
    Route::get('reset', 'reset');
});
Route::controller(RegisterController::class)->group(function () {
    Route::get('register','index')->middleware('guest');
    Route::post('register','store');
    Route::post('register-reset','reset');
});
Route::controller(MahasiswaController::class)->group(function(){
    Route::get('mahasiswa-import', 'import')->name('import-mahasiswa');
    Route::post('import-data-mahasiswa','importData')->name('data-mahasiswa');
})->middleware('admin');
Route::resource('mahasiswa', MahasiswaController::class)->middleware('auth');
Route::resource('data-dosen', DosenController::class);
Route::controller(DosenController::class)->group(function(){
    Route::get('import','import')->name('dosen-import');
    Route::post('import-dosen','importData')->name('import-dosen');
});
Route::controller(SearchController::class)->group(function () {
    Route::get('search','index');
    Route::get('detail-surat-ijin/{id}','show')->name('detail-surat-ijin');
});
// Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('login', [LoginController::class, 'authenticate']);
// Route::post('logout', [LoginController::class, 'logout']);
// Route::get('reset', [LoginController::class, 'reset']);
// Route::get('register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('register', [RegisterController::class, 'store']);
// Route::post('register-reset', [RegisterController::class, 'reset']);
Route::resource('karya-ilmiah', KaryaIlmiahController::class);
Route::resource('surat-penelitian', PenelitianController::class)->except('destroy');
Route::resource('surat-observasi', ObservasiController::class)->except('destroy');
Route::get('surat-observasi-print/{surat}', [ObservasiController::class, 'print'])->name('print-observasi');
Route::get('surat-penelitian-print/{surat}', [PenelitianController::class, 'print'])->name('print-penelitian');
Route::resource('user', UserController::class)->middleware('auth');
Route::get('replacePass/{id}',[UserController::class,'replacePass'])->name('replace-pass')->middleware('auth');
// Route::get('import', [MahasiswaController::class, 'import'])->name('mahasiswa-import');
Route::resource('files', FileController::class)->middleware('auth');
Route::resource('file-karya', FileKaryaController::class)->middleware('auth');
Route::get('karya-ilmiah-print/{karyaIlmiah}', [KaryaIlmiahController::class, 'print'])->name('print-karya');
// Route::get('karya-ilmiah-download-surat{karyaIlmiah}', [KaryaIlmiahController::class, 'download'])->name('download-surat');
// Route::post('import-data-mahasiswa', [MahasiswaController::class, 'importData'])->name('import-data');
// Route::get('import', [DosenController::class, 'import'])->name('dosen-import');
// Route::post('import-dosen', [DosenController::class, 'importData'])->name('import-dosen');
Route::fallback(function () {
    return view('layouts.404');
});
