<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Київ', 'Львів', 'Одеса', 'Харків', 'Дніпро',
            'Запоріжжя', 'Вінниця', 'Миколаїв', 'Полтава', 'Чернігів'
        ];

        foreach ($cities as $city) {
            City::firstOrCreate(['name' => $city]);
        }
    }
}
