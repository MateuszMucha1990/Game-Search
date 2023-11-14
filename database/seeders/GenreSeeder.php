<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Factory::create();
        DB::table('genres')->truncate();

        for($i=0; $i<5; $i++){
            DB::table('genres')->insert([
                'name' => $faker->randomElement(['rpg','fps','sport','sim','adventure']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);
        }
    }
}
