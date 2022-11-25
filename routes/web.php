<?php

use App\Models\Sppbe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrukController;
use App\Http\Controllers\KitirController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\SppbeController;
use App\Http\Controllers\KernetController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\PangkalanController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\KuotaHarianController;

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
    Route::get('surat-jalan/{pengambilan}/edit', [SuratJalanController::class, 'edit'])->name('surat-jalan.edit');
    Route::put('surat-jalan/{pengambilan}', [SuratJalanController::class, 'update'])->name('surat-jalan.update');
    Route::get('surat-jalan/{pengambilan}/print', [SuratJalanController::class, 'print'])->name('surat-jalan.print');
    Route::post('surat-jalan/get-no-sa', [SuratJalanController::class, 'getNoSA'])->name('surat-jalan.get-no-sa');

    Route::post('kitir/get-sa', [KuotaHarianController::class, 'getSA'])->name('kitir.get-sa');
    Route::resource('kuota-harian', KuotaHarianController::class);
    Route::resource('kitir', KitirController::class);
    Route::get('kitir/{kitir}/print', [KitirController::class, 'print'])->name('kitir.print');

    Route::resource('sa', SaController::class);


    Route::resource('pangkalan', PangkalanController::class);
    Route::resource('sppbe', SppbeController::class);

    Route::name('armada.')->group(function () {
        Route::resource('truk', TrukController::class);
        Route::resource('sopir', SopirController::class);
        Route::resource('kernet', KernetController::class);
    });

    Route::resource('dropzone', DropzoneController::class);

});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
