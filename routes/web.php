<?php

use App\Http\Controllers\AlamatRumahController;
use App\Http\Controllers\AnalisisEmisiKarbonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakarController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KaryawanPerusahaanController;
use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerjalananKaryawanController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\HalamanKaryawananController;
use App\Models\BahanBakar;
use App\Models\Informasi;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'viewRegister'])->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::redirect('/dashboard/staff', '/dashboard/staff/perusahaan')->name('dashboard.staff');
Route::redirect('/dashboard/perusahaan', '/dashboard/perusahaan/karyawan')->name('dashboard.perusahaan');
// Route::get('/dashboard/perjalanan', [PerjalananKaryawanController::class, 'index']);

Route::post('/generate-code', [CodeController::class, 'generateCode'])->name('code.generate');


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

Route::get('dashboard/perusahaan/analisis', [AnalisisEmisiKarbonController::class, 'index'])->name('analisis.index');
Route::get('dashboard/perusahaan/analisis/edit/{id}', [AnalisisEmisiKarbonController::class, 'edit'])->name('analisis.edit');
Route::get('dashboard/perusahaan/analisis/add', [AnalisisEmisiKarbonController::class, 'add'])->name('analisis.add');
Route::post('dashboard/perusahaan/analisis', [AnalisisEmisiKarbonController::class, 'store'])->name('analisis.store');
Route::put('dashboard/perusahaan/analisis/edit/{id}', [AnalisisEmisiKarbonController::class, 'update'])->name('analisis.update');
Route::delete('dashboard/perusahaan/analisis/{id}', [AnalisisEmisiKarbonController::class, 'delete'])->name('analisis.delete');
Route::get('dashboard/perusahaan/analisis/restore/{id}', [AnalisisEmisiKarbonController::class, 'restore'])->name('analisis.restore');

Route::get('dashboard/perusahaan/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::get('dashboard/perusahaan/konsultasi/edit/{id}', [KonsultasiController::class, 'edit'])->name('konsultasi.edit');
Route::get('dashboard/perusahaan/konsultasi/add', [KonsultasiController::class, 'add'])->name('konsultasi.add');
Route::post('dashboard/perusahaan/konsultasi', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Route::put('dashboard/perusahaan/konsultasi/edit/{id}', [KonsultasiController::class, 'update'])->name('konsultasi.update');
Route::delete('dashboard/perusahaan/konsultasi/{id}', [KonsultasiController::class, 'delete'])->name('konsultasi.delete');
Route::get('dashboard/perusahaan/konsultasi/restore/{id}', [KonsultasiController::class, 'restore'])->name('konsultasi.restore');

Route::get('dashboard/karyawan/konsultasi', [HalamanKaryawananController::class, 'index'])->name('halamanKaryawan.index');
Route::get('dashboard/karyawan/halamanKaryawan/edit/{id}', [HalamanKaryawananController::class, 'edit'])->name('halamanKaryawan.edit');
Route::get('dashboard/karyawan/halamanKaryawa/add', [HalamanKaryawananController::class, 'add'])->name('halamanKaryawa.add');
Route::post('dashboard/karyawan/halamanKaryawa', [HalamanKaryawananController::class, 'store'])->name('halamanKaryawa.store');
Route::put('dashboard/karyawan/halamanKaryawa/edit/{id}', [HalamanKaryawananController::class, 'update'])->name('halamanKaryawa.update');
Route::delete('dashboard/karyawan/halamanKaryawa/{id}', [HalamanKaryawananController::class, 'delete'])->name('halamanKaryawa.delete');
Route::get('dashboard/karyawan/halamanKaryawa/restore/{id}', [HalamanKaryawananController::class, 'restore'])->name('halamanKaryawa.restore');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/session', function () {
    return session()->all();
});
