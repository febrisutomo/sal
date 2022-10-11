<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    Route::resource('surat-jalan', SuratJalanController::class);
    Route::get('surat-jalan/create/{tanggal}', [SuratJalanController::class, 'getSA'])->name('surat-jalan.get-sa');
    Route::post('kitir/get-sa', [KitirController::class, 'getSA'])->name('kitir.get-sa');
    Route::resource('kitir', KitirController::class);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
