<?php

use App\Models\Sppbe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KitirController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\SppbeController;
use App\Http\Controllers\KernetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PangkalanController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\KuotaHarianController;
use App\Models\Pangkalan;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('surat-jalan', SuratJalanController::class)->parameters(['surat-jalan' => 'pengambilan']);
    Route::get('surat-jalan/{pengambilan}/print', [SuratJalanController::class, 'print'])->name('surat-jalan.print');
    Route::post('surat-jalan/get-no-sa', [SuratJalanController::class, 'getNoSA'])->name('surat-jalan.get-no-sa');

    Route::post('kitir/get-sa', [KuotaHarianController::class, 'getSA'])->name('kitir.get-sa');
    Route::resource('kuota-harian', KuotaHarianController::class);
    Route::resource('kitir', KitirController::class);
    Route::get('kitir/{kitir}/print', [KitirController::class, 'print'])->name('kitir.print');

    Route::resource('sa', SaController::class);

    Route::resource('pangkalan', PangkalanController::class)->except('show');
    Route::get('pangkalan/maps', [PangkalanController::class, 'maps'])->name('pangkalan.maps');


    Route::resource('sppbe', SppbeController::class)->except('show');
    Route::get('spppbe/maps', [SppbeController::class, 'maps'])->name('sppbe.maps');


    Route::name('armada.')->group(function () {
        Route::resource('truk', TrukController::class)->except('show');
        Route::resource('sopir', SopirController::class)->except('show');
        Route::resource('kernet', KernetController::class)->except('show');
    });


    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except('show');
        Route::put('user/{user}/update-password', [UserController::class, 'password'])->name('user.update-password');
    });


    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'password'])->name('profile.update-password');


    Route::get('setting', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('setting', [SettingController::class, 'update'])->name('setting.update');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
