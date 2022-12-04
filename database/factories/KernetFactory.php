<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kernet>
 */
class KernetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->firstName('male').' '.$this->faker->lastName('male'),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->e164PhoneNumber()
        ];
    }
}
