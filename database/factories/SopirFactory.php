<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sopir>
 */
class SopirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->firstName('male'),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->e164PhoneNumber(),
            'ttd' => 'ttd.jpg'
        ];
    }
}
