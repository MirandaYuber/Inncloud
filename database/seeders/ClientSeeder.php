<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach(range(1, 10) as $index) {
            DB::table('clients')
                ->insert([
                    [
                        'name' => $faker->firstName(),
                        'email' => $faker->email,
                        'created_at' => now(),
                    ]
            ]);
        }

    }
}
