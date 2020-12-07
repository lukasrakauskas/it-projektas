<?php

namespace Database\Factories;

use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transportation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city' => $this->faker->randomElement(['Kaunas', 'Klaipėda', 'Vilnius', 'Šiauliai', 'Panevėžys']),
            'status' => $this->faker->randomElement(['ordered', 'transporting', 'done']),
            'user_id' => $this->faker->numberBetween(4, 8),
        ];
    }
}
