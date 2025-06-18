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
use App\Models\Code;
use App\Models\Pesan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Mailer\Transport;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Code::create([
            'id' => '1',
            'code' => '1234567890',
            'code_type' => 'staff_mitra',
            'status' => 'aktif',
        ]);

        Code::create([
            'id' => '2',
            'code' => '12dakndoaiq',
            'code_type' => 'staff_perusahaan',
            'status' => 'aktif',
        ]);

        StaffMitra::create([
            'id' => '1',
            'nama_staff' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@example.com',
            'id_code' => '1',
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
            'email_perusahaan' => 'perusahaan@example.com',
            'kode_perusahaan' => '1234567890',
            'tanggal_aktif_service' => '2023-01-01',
            'latitude' => '0',
            'longitude' => '0',
        ]);

        staffPerusahaan::create([
            'id' => '1',
            'nama_staff' => 'Staff Perusahaan 1',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff'),
            'id_perusahaan' => '1',
            'id_code' => '2',
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
            'email' => 'karyawan@example.com',
            'password' => Hash::make('karyawan'),
            'jabatan' => 'Karyawan Perusahaan 1',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2023-01-01',
        ]);

        KaryawanPerusahaan::create([
            'id' => '2',
            'id_perusahaan' => '1',
            'nama_karyawan' => 'Karyawan Perusahaan 2',
            'email' => 'karyawans@example.com',
            'password' => Hash::make('karyawan'),
            'jabatan' => 'Karyawan Perusahaan 2',
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

        Informasi::create([
            'id' => '1',
            'judul_informasi' => 'Informasi 1',
            'id_staff_mitra' => '1',
            'isi_informasi' => 'Informasi 1',
            'tag' => 'Ekonomi, Kesehatan',
            'gambar_informasi' => 'gambar_informasi.jpg',
        ]);

        HasilAnalisisEmisi::create([
            'id' => '1',
            'nama_analisis' => 'Hasil Analisis Emisi 1',
            'id_perusahaan' => '1',
            'tanggal_analisis' => '2023-01-01',
            'file_pdf' => 'text.pdf'
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
            'nama_konsultasi' => 'Nama Konsultasi',
            'tanggal_konsultasi' => '2023-01-01',
            'isi_konsultasi' => 'Hasil Konsultasi 1',
            'status_konsultasi' => 'OPEN',
            'id_hasil_analisis' => '1',
        ]);

        Pesan::Create([
            'id' => '1',
            'id_staff' => '1',
            'id_konsultasi' => '1',
            'judul_pesan' => 'Pesan 1',
            'isi_pesan' => 'Pesan 1',
            'file_pdf' => 'file.pdf',
        ]);
    }
}
