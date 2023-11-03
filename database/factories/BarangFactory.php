<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_barang' => $this->faker->randomNumber(6, true),
            'id_kategori' => rand(1, 8),
            'deskripsi_barang' => Arr::random(['Switch', 'MIC', 'HDMI', 'Laptop']),
            'serial_number' => $this->faker->randomNumber(8, true),
            'lokasi_user' => 'TIK',
            'tahun_pengadaan' => 2020,
            'keterangan' => '',
            'kondisi_barang' => 'Baik',
            'status' => 0
        ];
    }
}
