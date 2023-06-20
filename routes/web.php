<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;

Route::get('/', [AuthController::class, 'showFormLogin'])->name("front");
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Route::get('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('report')->group(function () {
        Route::prefix('mitra')->group(function () {
            Route::get('pendaftaran-mitra', [ReportController::class, 'pendaftaran_mitra']);
            Route::get('transaksi', [ReportController::class, 'transaksi_mitra']);
        });

        
        Route::get('vote-ml', [ReportController::class, 'vote_ml']);
        Route::get('pendaftaran', [ReportController::class, 'pendaftaran']);
    });

    Route::prefix('pengaturan')->group(function () {
        Route::get('website', [SettingController::class, 'website']);
        Route::get('program-mitra', [SettingController::class, 'program_mitra']);

        Route::prefix('akes-user')->group(function () {
            Route::get('tipe-user', [SettingController::class, 'website']);
            Route::get('hak-akses', [SettingController::class, 'website']);
            Route::get('data-user', [SettingController::class, 'website']);

        });

        Route::prefix('mitra')->group(function () {
            Route::get('produk-mitra', [SettingController::class, 'produk_mitra']);
            Route::get('produk-mitra/tambah', [SettingController::class, 'produk_mitra_add']);
            Route::post('produk-mitra/tambah', [SettingController::class, 'produk_mitra_add_p']);
            Route::get('produk-mitra/edit', [SettingController::class, 'produk_mitra_edit']);
            Route::post('produk-mitra/edit', [SettingController::class, 'produk_mitra_edit_p']);
            Route::get('transaksi', [ReportController::class, 'transaksi_mitra']);
        });

        
        Route::get('tim-ml', [SettingController::class, 'tim_ml']);
        Route::get('tim-ml/tambah', [SettingController::class, 'tim_ml_add']);
        Route::post('tim-ml/tambah', [SettingController::class, 'tim_ml_add_p']);
        Route::get('tim-ml/edit', [SettingController::class, 'tim_ml_edit']);
        Route::post('tim-ml/edit', [SettingController::class, 'tim_ml_edit_p']);
    });
    
});



