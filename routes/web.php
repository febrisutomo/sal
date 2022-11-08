<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaController;
use App\Http\Controllers\KitirController;
use App\Http\Controllers\SuratJalanController;

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('surat-jalan', [SuratJalanController::class, 'index'])->name('surat-jalan.index');
    Route::get('surat-jalan/create', [SuratJalanController::class, 'create'])->name('surat-jalan.create');
    Route::post('surat-jalan', [SuratJalanController::class, 'store'])->name('surat-jalan.store');
    Route::get('surat-jalan/{pengambilan}', [SuratJalanController::class, 'show'])->name('surat-jalan.show');
    Route::get('surat-jalan/{pengambilan}/pdf', [SuratJalanController::class, 'pdf'])->name('surat-jalan.pdf');
    Route::get('surat-jalan/create/{tanggal}', [SuratJalanController::class, 'getSA'])->name('surat-jalan.get-sa');
    Route::post('kitir/get-sa', [KitirController::class, 'getSA'])->name('kitir.get-sa');
    Route::resource('kitir', KitirController::class);
    Route::resource('sa', SaController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
