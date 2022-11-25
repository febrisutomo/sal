<?php

namespace Database\Factories;

use App\Models\Sopir;
use App\Models\Kernet;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Truk>
 */
class TrukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode' => 'SAL-0'.collect([1, 2, 3, 4])->random(),
            'merk' => collect(['Hino Dutro', 'Mitsubishi Colt Diesel', 'Izuzu Elf'])->random(),
            'plat_nomor' => "R ".$this->faker->numberBetween(1000, 9999)." ".Str::upper($this->faker->lexify('??')),
            'kapasitas' => 560,
            'sopir_id' => Sopir::factory(), 
            'kernet_id' => Kernet::factory(), 
        ];
    }
}
