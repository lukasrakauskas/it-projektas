<?php

namespace Database\Seeders;

use App\Models\Transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transportation::factory(5)->create();

        Transportation::factory()->create([
            'user_id' => 1,
            'status' => 'transporting'
        ]);

        Transportation::factory()->create([
            'user_id' => 1,
            'status' => 'ordered'
        ]);

        Transportation::factory()->create([
            'user_id' => 1,
            'status' => 'done'
        ]);
    }
}
