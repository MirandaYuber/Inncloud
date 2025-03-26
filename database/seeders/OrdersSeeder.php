<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach(range(1, 10) as $index) {
            DB::table('orders')
                ->insert([
                    'client_id' => DB::table('clients')->inRandomOrder()->first()->id,
                    'created_at' => now()
                ]);
        }
    }
}
