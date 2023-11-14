<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faker = Factory::create();

       DB::table('games')->truncate();

       for($i=0; $i<100; $i++){
           DB::table('games')->insert([
            'title' => $faker->words($faker ->numberBetween(1,3), true),
          //  'description' => $faker->sentence,
            'description' => 'a',
            'publisher' => $faker->randomElement(['Atari','EA','Blizzard','Ubisoft','Sega','Sony','Nintendo']),
            'genre_id' => $faker->numberBetween(1,5),
            'score' => $faker->numberBetween(1,10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
           ]);

       }
    }
}
