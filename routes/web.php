<?php

use App\Helpers\FcmNotification;
use App\Http\Controllers\PeriksaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JamPraktekController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\HariPraktekController;
use App\Http\Controllers\PendaftaranController;


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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/debug', function () {
    event(new \App\Events\NomorAntrianEvent());
});
Route::prefix('home')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('user', PetugasController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('jampraktek', JamPraktekController::class);
    Route::resource('haripraktek', HariPraktekController::class);
    Route::resource('notifikasi', NotifikasiController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('periksa', PeriksaController::class);
    // Route::resource('pendaftaranpemriksaan', PendaftaranController::class);

    // Route::get('/jumlah-pasien', [App\Http\Controllers\PendaftaranController::class, 'jumlahPasien']);

    // Route::get('/notifikasi', [App\Http\Controllers\NotifikasiController::class, 'index'])->name('notifikasi');
});
