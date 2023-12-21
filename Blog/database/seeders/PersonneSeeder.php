<?php

namespace Database\Seeders;

use App\Models\Personne;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            Personne::create([
                "nom" => $faker->name,
                "information" => $faker->paragraph(1),
                "age" => $faker->numberBetween(18, 40),
                "active" => $faker->boolean,
            ]);
        }
    }
}
