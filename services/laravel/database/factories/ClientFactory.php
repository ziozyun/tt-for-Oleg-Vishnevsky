<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'city_id' => City::inRandomOrder()->first()->id,
        ];
    }
}
