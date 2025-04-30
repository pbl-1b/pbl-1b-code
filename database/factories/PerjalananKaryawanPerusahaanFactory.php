<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PerjalananKaryawanPerusahaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idKaryawan' => fake()->numberBetween(1, 100),
            'idTransportasi' => fake()->numberBetween(1, 5),
            'idBahanBakar' => fake()->numberBetween(1, 3),
            'idPerusahaan' => fake()->numberBetween(1, 10),
            'idAlamat' => fake()->numberBetween(1, 50),
            'tanggalPerjalanan' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'durasiPerjalanan' => fake()->numberBetween(10, 480), // dalam menit
            'totalEmisiKarbon' => fake()->randomFloat(2, 0.1, 50), // dalam kg CO2
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
