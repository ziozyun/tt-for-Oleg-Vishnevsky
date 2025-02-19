<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\City;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();

        Client::factory(50)->create()->each(function ($client) use ($cities) {
            $client->update(['city_id' => $cities->random()->id]);
        });
    }
}
