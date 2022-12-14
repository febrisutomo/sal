<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pangkalan>
 */
class PangkalanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'no_reg' => $this->faker->numberBetween(100000, 900000),
            'nama' => $this->faker->firstName($gender) . (collect([true, false])->random() ? ' ' . fake()->lastName($gender) : ''),
            'no_hp' => $this->faker->e164PhoneNumber(),
            'alamat' => $this->faker->streetName() . ' RT 00' . $this->faker->numberBetween(1, 9) . ' / 00' . $this->faker->numberBetween(1, 9) . ' ' . $this->faker->city(),
            'kuota' => $this->faker->randomElement([30, 60, 90, 120]),
            'lat_lng' => $this->faker->latitude(-7.511223017989502 - 0.06, -7.511223017989502 + 0.06) . ', ' . $this->faker->longitude(109.29252259228235 - 0.06,     109.29252259228235 + 0.06),
        ];
    }
}