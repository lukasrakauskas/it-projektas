<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehicle::factory()->create([
            'available' => false,
            'user_id' => 1
        ]);

        Vehicle::factory(3)->create();

        Vehicle::factory()->create([
           'available' => false,
           'user_id' => 4
        ]);

        Vehicle::factory()->create([
            'available' => false,
            'user_id' => 5
        ]);

        Vehicle::factory(3)->create();

        Vehicle::factory()->create([
            'available' => false,
            'user_id' => 6
        ]);

        Vehicle::factory()->create([
            'available' => false,
            'user_id' => 7
        ]);

        Vehicle::factory(3)->create();
    }
}
