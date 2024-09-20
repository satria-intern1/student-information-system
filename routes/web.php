<?php

use App\Models\Kelas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);

Route::get('/dashboard', [DashboardController::class, 'index' ])->name('dashboard')->middleware('auth');

//get log out, only redirecting the routes
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');


//kelas route
Route::get('/kelas/list',  [KelasController::class, 'index'])->name('kelas.list')->middleware('auth');
Route::get('/kelas/edit',  [KelasController::class, 'formtable'])->name('kelas.edit')->middleware('auth');
Route::get('/kelas/fill/{id}',  [KelasController::class, 'displayFillKelas'])->name('kelas.fill')->middleware('auth');
Route::post('/kelas/add',  [KelasController::class, 'store'])->name('kelas.add')->middleware('auth');
Route::delete('/kelas/delete/{id}',  [KelasController::class, 'destroy'])->name('kelas.delete')->middleware('auth');
Route::put('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas.update')->middleware('auth');


//dosen route
Route::get('/dosen/list')->name('dosen.list');
Route::get('/dosen/edit',  [DosenController::class, 'formtable'])->name('dosen.edit')->middleware('auth');
Route::post('/dosen/add',  [DosenController::class, 'store'])->name('dosen.add')->middleware('auth');
Route::delete('/dosen/delete/{id}',  [DosenController::class, 'destroy'])->name('dosen.delete')->middleware('auth');
Route::put('/dosen/update/{id}', [DosenController::class, 'update'])->name('dosen.update')->middleware('auth');

Route::get('/mahasiswa/list')->name('mahasiswa.list');
Route::get('/mahasiswa/edit')->name('mahasiswa.edit');
Route::post('/mahasiswa/edit')->name('mahasiswa.update');
