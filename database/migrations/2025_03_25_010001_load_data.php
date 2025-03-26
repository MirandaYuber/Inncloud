<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')
            ->insert([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);

        DB::table('clients')->insert([
            [
                'name' => 'Cliente uno',
                'email' => 'cliente_uno@example.com',
                'created_at' => now(),
            ],
            [
                'name' => 'Cliente dos',
                'email' => 'cliente_dos@example.com',
                'created_at' => now(),
            ]
        ]);

        DB::table('products')->insert([
            [
                'name' => 'Producto uno',
                'stock' => 83,
                'created_at' => now(),
            ],
            [
                'name' => 'Producto dos',
                'stock' => 5,
                'created_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
