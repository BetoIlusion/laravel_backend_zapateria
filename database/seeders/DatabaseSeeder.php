<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        
        $persona = new Persona();
        $persona->nombre = 'beto';
        $persona->telefono = '77889945';
        $persona->save();
        \App\Models\User::factory()->create([
            'name' => 'beto',
            'email' => 'beto@gmail.com',
            'password' => bcrypt('123456789'),
            'id_persona' => $persona->id,
        ]);
        //$this->call(PagosTableSeeder::class);
 
    }
}
