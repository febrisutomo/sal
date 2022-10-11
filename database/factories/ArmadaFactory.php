<?php

namespace Database\Factories;

use App\Models\Sopir;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Armada>
 */
class ArmadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plat_nomor' => "R ".$this->faker->numberBetween(1000, 9999)." ".Str::upper($this->faker->lexify('??')),
            'sopir_id' => Sopir::factory(),
        ];
    }
}
