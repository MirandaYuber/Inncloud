<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('client_product')
            ->insert([
                'client_id' => DB::table('clients')->inRandomOrder()->first()->id,
                'product_id' => DB::table('products')->inRandomOrder()->first()->id,
            ]);
    }
}
