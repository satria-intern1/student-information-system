<?php

use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// reminder i already make this kind of middleware
// ->middleware('role:allowedrole1,alllowedrole2');

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('kelas')->group(function () {
        Route::get('/list', [KelasController::class, 'index'])->name('kelas.list');
        Route::get('/edit', [KelasController::class, 'formtable'])->name('kelas.edit')->middleware('role:kaprodi');
        Route::get('/fill/{id}', [KelasController::class, 'displayFillKelas'])->name('kelas.fill')->middleware('role:kaprodi');
        Route::post('/add', [KelasController::class, 'store'])->name('kelas.add')->middleware('role:kaprodi');
        Route::delete('/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.delete')->middleware('role:kaprodi');
        Route::put('/update/{id}', [KelasController::class, 'update'])->name('kelas.update')->middleware('role:kaprodi');
    });

    Route::prefix('dosen')->group(function () {
        Route::get('/list', [DosenController::class, 'index'])->name('dosen.list');
        Route::get('/edit', [DosenController::class, 'formtable'])->name('dosen.edit')->middleware('role:kaprodi');
        Route::post('/add', [DosenController::class, 'store'])->name('dosen.add')->middleware('role:kaprodi');
        Route::delete('/delete/{id}', [DosenController::class, 'destroy'])->name('dosen.delete')->middleware('role:kaprodi');
        Route::put('/update/{id}', [DosenController::class, 'update'])->name('dosen.update')->middleware('role:kaprodi');
        Route::put('/update-class/{id}', [DosenController::class, 'updateClass'])->name('dosen.update.class')->middleware('role:kaprodi');

    });

    Route::prefix('mahasiswa')->group(function () {
        Route::get('/list', [MahasiswaController::class, 'index'])->name('mahasiswa.list')->middleware('role:kaprodi,dosen');
        Route::get('/kelas/{id}', [MahasiswaController::class, 'formtable'])->name('mahasiswa.editkelas');
        Route::post('/add', [MahasiswaController::class, 'store'])->name('mahasiswa.add');
        Route::delete('/delete/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');
        Route::put('/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::put('/update-class/{id}', [MahasiswaController::class, 'updateClass'])->name('mahasiswa.update.class')->middleware('role:kaprodi');
        
    });

});
