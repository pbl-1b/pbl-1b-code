<?php

use App\Http\Controllers\AlamatRumahController;
use App\Http\Controllers\BahanBakarController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KaryawanPerusahaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerjalananKaryawanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ServiceController;
use App\Models\BahanBakar;
use App\Models\Informasi;
use App\Models\Service;

Route::get('/', function () {
    return view('source');
});

// Route::get('/dashboard/perjalanan', [PerjalananKaryawanController::class, 'index']);

// Perjalanan Karyawan Perusahaan
Route::get('dashboard/perusahaan/perjalanan', [PerjalananKaryawanController::class, 'index'])->name('perjalananKaryawanPerusahaan.index');
Route::get('dashboard/perusahaan/perjalanan/edit/{id}', [PerjalananKaryawanController::class, 'edit'])->name('perjalananKaryawanPerusahaan.edit');
Route::get('dashboard/perusahaan/perjalanan/add', [PerjalananKaryawanController::class, 'add'])->name('perjalananKaryawanPerusahaan.add');
Route::post('dashboard/perusahaan/perjalanan', [PerjalananKaryawanController::class, 'store'])->name('perjalananKaryawanPerusahaan.store');
Route::put('dashboard/perusahaan/perjalanan/edit/{id}', [PerjalananKaryawanController::class, 'update'])->name('perjalananKaryawanPerusahaan.update');
Route::delete('dashboard/perusahaan/perjalanan/{id}', [PerjalananKaryawanController::class, 'delete'])->name('perjalananKaryawanPerusahaan.delete');

// Alamat Rumah
Route::get('dashboard/perusahaan/alamat', [AlamatRumahController::class, 'index'])->name('alamatRumah.index');
Route::get('dashboard/perusahaan/alamat/edit/{id}', [AlamatRumahController::class, 'edit'])->name('alamatRumah.edit');
Route::get('dashboard/perusahaan/alamat/add', [AlamatRumahController::class, 'add'])->name('alamatRumah.add');
Route::post('dashboard/perusahaan/alamat', [AlamatRumahController::class, 'store'])->name('alamatRumah.store');
Route::put('dashboard/perusahaan/alamat/edit/{id}', [AlamatRumahController::class, 'update'])->name('alamatRumah.update');
Route::delete('dashboard/perusahaan/alamat/{id}', [AlamatRumahController::class, 'delete'])->name('alamatRumah.delete');
Route::get('dashboard/perusahaan/alamat/restore/{id}', [AlamatRumahController::class, 'restore'])->name('alamatRumah.restore');

// Perusahaan
Route::get('dashboard/staff/perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan.index');
Route::get('dashboard/staff/perusahaan/edit/{id}', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
Route::put('dashboard/staff/perusahaan/edit/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
Route::delete('dashboard/staff/perusahaan/{id}', [PerusahaanController::class, 'delete'])->name('perusahaan.delete');

// Service
Route::get('dashboard/staff/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('dashboard/staff/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
Route::get('dashboard/staff/service/add', [ServiceController::class, 'add'])->name('service.add');
Route::post('dashboard/staff/service', [ServiceController::class, 'store'])->name('service.store');
Route::put('dashboard/staff/service/edit/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('dashboard/staff/service/{id}', [ServiceController::class, 'delete'])->name('service.delete');
Route::get('dashboard/staff/service/restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');

// Bahan Bakar
Route::get('dashboard/staff/bahanBakar', [BahanBakarController::class, 'index'])->name('bahanBakar.index');
Route::get('dashboard/staff/bahanBakar/edit/{id}', [BahanBakarController::class, 'edit'])->name('bahanBakar.edit');
Route::get('dashboard/staff/bahanBakar/add', [BahanBakarController::class, 'add'])->name('bahanBakar.add');
Route::post('dashboard/staff/bahanBakar', [BahanBakarController::class, 'store'])->name('bahanBakar.store');
Route::put('dashboard/staff/bahanBakar/edit/{id}', [BahanBakarController::class, 'update'])->name('bahanBakar.update');
Route::delete('dashboard/staff/bahanBakar/{id}', [BahanBakarController::class, 'delete'])->name('bahanBakar.delete');
Route::get('dashboard/staff/bahanBakar/restore/{id}', [BahanBakarController::class, 'restore'])->name('bahanBakar.restore');

Route::get('dashboard/staff/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('dashboard/staff/informasi/edit/{id}', [InformasiController::class, 'edit'])->name('informasi.edit');
Route::get('dashboard/staff/informasi/add', [InformasiController::class, 'add'])->name('informasi.add');
Route::post('dashboard/staff/informasi', [InformasiController::class, 'store'])->name('informasi.store');
Route::put('dashboard/staff/informasi/edit/{id}', [InformasiController::class, 'update'])->name('informasi.update');
Route::delete('dashboard/staff/informasi/{id}', [InformasiController::class, 'delete'])->name('informasi.delete');
Route::get('dashboard/staff/informasi/restore/{id}', [InformasiController::class, 'restore'])->name('informasi.restore');

Route::get('dashboard/perusahaan/karyawan', [KaryawanPerusahaanController::class, 'index'])->name('karyawan.index');
Route::get('dashboard/perusahaan/karyawan/edit/{id}', [KaryawanPerusahaanController::class, 'edit'])->name('karyawan.edit');
Route::get('dashboard/perusahaan/karyawan/add', [KaryawanPerusahaanController::class, 'add'])->name('karyawan.add');
Route::post('dashboard/perusahaan/karyawan', [KaryawanPerusahaanController::class, 'store'])->name('karyawan.store');
Route::put('dashboard/perusahaan/karyawan/edit/{id}', [KaryawanPerusahaanController::class, 'update'])->name('karyawan.update');
Route::delete('dashboard/perusahaan/karyawan/{id}', [KaryawanPerusahaanController::class, 'delete'])->name('karyawan.delete');
Route::get('dashboard/perusahaan/karyawan/restore/{id}', [KaryawanPerusahaanController::class, 'restore'])->name('karyawan.restore');
