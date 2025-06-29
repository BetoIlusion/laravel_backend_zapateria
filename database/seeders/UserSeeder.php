<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'lui',
            'telefono' => '7989384',
            'email' => 'luis@gmail.com',
            'rol' => 'cliente',
            'password' => bcrypt('123456789')
        ]);
    }
}
