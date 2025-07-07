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
        // for ($i = 0; $i < 30; $i++) {
        //     DB::table('productos')->insert([
        //         'nombre' => fake()->words(2, true),
        //         'descripcion' => fake()->sentence(9),
        //         'precio' => fake()->numberBetween(50, 200),
        //         'volumen' => fake()->randomFloat(2, 0.5, 2.5), // volumen en litros, por ejemplo
        //         'stock' => fake()->numberBetween(30, 100),
        //         'id_tipo' => fake()->numberBetween(1, 5),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
         // Producto 1
    DB::table('productos')->insert([
        'nombre' => 'Zapato Deportivo Pro',
        'descripcion' => 'Zapato ideal para correr con amortiguación avanzada.',
        'precio' => 250.00,
        'volumen' => 1.2,
        'stock' => 50,
        'id_tipo' => 1,
        'imagen' => 'imagenes_productos/zapatero.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Producto 2
    DB::table('productos')->insert([
        'nombre' => 'Zapato Elegante Formal',
        'descripcion' => 'Perfecto para eventos nocturnos, estilo clásico y cómodo.',
        'precio' => 310.00,
        'volumen' => 1.5,
        'stock' => 30,
        'id_tipo' => 2,
        'imagen' => 'imagenes_productos/zapato2.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    // Producto 3
    DB::table('productos')->insert([
        'nombre' => 'Botín Casual Urbano',
        'descripcion' => 'Botín resistente para uso diario, diseño moderno.',
        'precio' => 180.00,
        'volumen' => 1.3,
        'stock' => 40,
        'id_tipo' => 3,
        'imagen' => 'imagenes_productos/zapito.jpg',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
        
    }
}
