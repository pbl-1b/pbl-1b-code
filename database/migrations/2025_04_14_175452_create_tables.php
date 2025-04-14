<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informasis', function (Blueprint $table) {
            $table->id('idInformasi')->unique()->primary();
            $table->string('judulInformasi');
            $table->integer('idStaffMitra');
            $table->string('isiInformasi');
            $table->string('tanggalRilis');
            $table->string('tag');
            $table->string('gambarInformasi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('staffPerusahaans', function (Blueprint $table) {
            $table->id('idStaffPerusahaan')->unique()->primary();
            $table->string('namaStaff');
            $table->string('email');
            $table->integer('idPerusahaan');
        });

        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id('idPerusahaan')->unique()->primary();
            $table->string('namaPerusahaan');
            $table->string('kodePerusahaan');
            $table->integer('idService');
            $table->date('tanggalAktifService');
            $table->string('alamat');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('karyawanPerusahaans', function (Blueprint $table) {
            $table->id('idKaryawan')->unique()->primary();
            $table->integer('idPerusahaan');
            $table->string('namaKaryawan');
            $table->string('jabatan');
            $table->string('email');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->date('tanggalLahir');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bahanBakars', function (Blueprint $table) {
            $table->id('idBahanBakar')->unique()->primary();
            $table->string('namaBahanBakar');
            $table->string('jenisBahanBakar');
            $table->integer('emisiKarbonPermenit');
            $table->integer('hargaBahanBakarPerLiter');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('staffMitras', function (Blueprint $table) {
            $table->id('idStaffMitra')->unique()->primary();
            $table->string('namaStaff');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hasilAnalisisEmisis', function (Blueprint $table) {
            $table->id('idHasilAnalisis')->unique()->primary();
            $table->integer('idPerusahaan');
            $table->date('tanggalAnalisis');
            $table->string('pesanAnalisis');
            $table->date('tanggalAwal');
            $table->date('tanggalAkhir');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('alamatRumahs', function (Blueprint $table) {
            $table->id('idAlamat')->unique()->primary();
            $table->integer('idKaryawan');
            $table->string('alamatRumah');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transportasis', function (Blueprint $table) {
            $table->id('idTransportasi')->unique()->primary();
            $table->string('namaTransportasi');
            $table->string('jenisTransportasi');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id('idService')->unique()->primary();
            $table->string('namaService');
            $table->integer('durasiService');
            $table->integer('hargaService');
            $table->string('deskripsiService');
            $table->integer('idStaffMitra');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('perjalanans', function (Blueprint $table) {
            $table->integer('idHasilAnalisis');
            $table->integer('idPerjalanan');
        });

        Schema::create('perjalananKaryawans', function (Blueprint $table) {
            $table->id('idPerjalanan')->unique()->primary();
            $table->integer('idKaryawan');
            $table->integer('idTransportasi');
            $table->integer('idBahanBakar');
            $table->integer('idPerusahaan');
            $table->integer('idAlamat');
            $table->date('tanggalPerjalanan');
            $table->integer('durasiPerjalanan');
            $table->integer('totalEmisiKarbon');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hasilKonsultasis', function (Blueprint $table) {
            $table->id('idHasilKonsultasi')->unique()->primary();
            $table->integer('idPerusahaan');
            $table->integer('idStaffMitra');
            $table->date('tanggalKonsultasi');
            $table->string('isiKonsultasi');
            $table->string('pesanKonsultasi');
            $table->integer('idHasilAnalisis');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasis');
        Schema::dropIfExists('staffPerusahaans');
        Schema::dropIfExists('perusahaans');
        Schema::dropIfExists('karyawanPerusahaans');
        Schema::dropIfExists('bahanBakars');
        Schema::dropIfExists('staffMitras');
        Schema::dropIfExists('hasilAnalisisEmisis');
        Schema::dropIfExists('alamatRumahs');
        Schema::dropIfExists('transportasis');
        Schema::dropIfExists('services');
        Schema::dropIfExists('perjalanans');
        Schema::dropIfExists('perjalananKaryawans');
        Schema::dropIfExists('hasilKonsultasis');
    }
};
