<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerjalananKaryawanController;

Route::get('/', function () {
    return view('source');
});

// Route::get('/dashboard/perjalanan', [PerjalananKaryawanController::class, 'index']);

Route::get('dashboard/perusahaan/perjalanan', [PerjalananKaryawanController::class, 'index'])->name('perjalananKaryawanPerusahaan.index');

Route::get('dashboard/perusahaan/perjalanan/edit/{id}', [PerjalananKaryawanController::class, 'edit'])->name('perjalananKaryawanPerusahaan.edit');
Route::get('dashboard/perusahaan/perjalanan/add', [PerjalananKaryawanController::class, 'add'])->name('perjalananKaryawanPerusahaan.add');
Route::post('dashboard/perusahaan/perjalanan', [PerjalananKaryawanController::class, 'store'])->name('perjalananKaryawanPerusahaan.store');
Route::put('dashboard/perusahaan/perjalanan', [PerjalananKaryawanController::class, 'store'])->name('perjalananKaryawanPerusahaan.update');
