<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $city = $this->faker->randomElement(['Vilnius', 'Kaunas', 'Klaipėda']);

        $locations = [
            'Kaunas' => [
                'latitude' => 54.898521,
                'longitude' => 23.903597,
            ],
            'Vilnius' => [
                'latitude' => 54.687157,
                'longitude' => 25.279652,
            ],
            'Klaipėda' => [
                'latitude' => 55.703297,
                'longitude' => 21.144279,
            ],
        ];

        $change = $this->faker->randomFloat(null, -0.5, 0.5);

        return [
            'city' => $city,
            'latitude' => $locations[$city]['latitude'] + $change,
            'longitude' => $locations[$city]['longitude'] + $change,
            'available' => true
        ];
    }
}
