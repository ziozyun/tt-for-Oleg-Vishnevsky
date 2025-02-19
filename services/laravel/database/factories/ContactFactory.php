<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'contactable_id' => Client::inRandomOrder()->first()->id,
            'contactable_type' => Client::class,
            'type' => $this->faker->randomElement(['Phone', 'Email']),
            'value' => $this->faker->unique()->safeEmail(),
        ];
    }
}
