<?php

namespace Database\Seeders;

use App\Models\AlamatRumah;
use App\Models\BahanBakar;
use App\Models\HasilAnalisisEmisi;
use App\Models\HasilKonsultasi;
use App\Models\Informasi;
use App\Models\KaryawanPerusahaan;
use App\Models\Perjalanan;
use App\Models\PerjalananKaryawanPerusahaan;
use App\Models\Perusahaan;
use App\Models\Service;
use App\Models\StaffMitra;
use App\Models\staffPerusahaan;
use App\Models\Transportasi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Mailer\Transport;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StaffMitra::create([
            'id' => '1',
            'nama_staff' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',
        ]);

        Service::create([
            'id' => '1',
            'id_staff_mitra' => '1',
            'nama_service' => 'Service 1',
            'durasi_service' => '30',
            'harga_service' => '100000',
            'deskripsi_service' => 'Service 1 deskripsi'
        ]);

        Perusahaan::create([
            'id' => '1',
            'id_service' => '1',
            'nama_perusahaan' => 'Perusahaan 1',
            'kode_perusahaan' => '1234567890',
            'tanggal_aktif_service' => '2023-01-01',
            'alamat' => 'Jl. Perusahaan 1',
        ]);

        staffPerusahaan::create([
            'id' => '1',
            'nama_staff' => 'Staff Perusahaan 1',
            'email' => 'staff@example',
            'password' => bcrypt('staff'),
            'id_perusahaan' => '1',
        ]);

        BahanBakar::create([
            'id' => '1',
            'nama_bahan_bakar' => 'Bahan Bakar 1',
            'harga_bahan_bakar_per_liter' => '10000',
            'jenis_bahan_bakar' => 'Bahan Bakar 1',
            'emisi_karbon_permenit' => '100',
        ]);

        KaryawanPerusahaan::create([
            'id' => '1',
            'id_perusahaan' => '1',
            'nama_karyawan' => 'Karyawan Perusahaan 1',
            'email' => 'karyawan@example',
            'password' => bcrypt('karyawan'),
            'jabatan' => 'Karyawan Perusahaan 1',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2023-01-01',
        ]);

        Transportasi::create([
            'id' => '1',
            'nama_transportasi' => 'Transportasi 1',
            'jenis_transportasi' => 'Transportasi 1',
        ]);

        AlamatRumah::create([
            'id' => '1',
            'id_karyawan' => '1',
            'alamat_rumah' => 'Jl. Rumah 1',
        ]);

        Informasi::created([
            'id' => '1',
            'judul_informasi' => 'Informasi 1',
            'id_staff_mitra' => '1',
            'isi_informasi' => 'Informasi 1',
            'tanggal_rilis' => '2023-01-01',
            'tag' => 'Ekonomi, Kesehatan',
            'gambar_informasi' => 'gambar_informasi.jpg',
        ]);

        HasilAnalisisEmisi::create([
            'id' => '1',
            'id_perusahaan' => '1',
            'tanggal_analisis' => '2023-01-01',
            'pesan_analisis' => 'Hasil Analisis Emisi 1',
            'tanggal_awal' => '2023-01-01',
            'tanggal_akhir' => '2023-01-01',
        ]);

        PerjalananKaryawanPerusahaan::create([
            'id' => '1',
            'id_karyawan' => '1',
            'id_transportasi' => '1',
            'id_bahan_bakar' => '1',
            'id_perusahaan' => '1',
            'id_alamat' => '1',
            'tanggal_perjalanan' => '2023-01-01',
            'durasi_perjalanan' => '30',
            'total_emisi_karbon' => '100',
        ]);

        Perjalanan::create([
            'id_hasil_analisis' => '1',
            'id_perjalanan' => '1',
        ]);

        HasilKonsultasi::create([
            'id' => '1',
            'id_perusahaan' => '1',
            'id_staff_mitra' => '1',
            'tanggal_konsultasi' => '2023-01-01',
            'isi_konsultasi' => 'Hasil Konsultasi 1',
            'pesan_konsultasi' => 'Pesan Hasil Konsultasi 1',
            'id_hasil_analisis' => '1',
        ]);
    }
}
