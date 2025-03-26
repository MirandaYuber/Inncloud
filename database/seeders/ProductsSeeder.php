<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach((range(1, 10)) as $index) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'stock' => $faker->numberBetween(1,10),
                'created_at' => now()
            ]);
        }
    }
}
