<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

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
    redirect('mahasiswa');
});

Route::get('mahasiswa/nilai/{idMhs}', [MahasiswaController::class, 'nilai'])->name('mahasiswa.nilai');

Route::get('mahasiswa/nilai/{idMhs}/cetak', [MahasiswaController::class, 'cetakKhs'])->name('mahasiswa.cetakKhs');

Route::get('mahasiswa/search', [MahasiswaController::class, 'search'])->name('mahasiswa.search');

Route::resource('mahasiswa', MahasiswaController::class);


