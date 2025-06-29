<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('productos')->insert([
                'nombre' => fake()->words(2, true),
                'descripcion' => fake()->sentence(9),
                'precio' => fake()->numberBetween(50, 200),
                'volumen' => fake()->randomFloat(2, 0.5, 2.5), // volumen en litros, por ejemplo
                'stock' => fake()->numberBetween(30, 100),
                'id_tipo' => fake()->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
