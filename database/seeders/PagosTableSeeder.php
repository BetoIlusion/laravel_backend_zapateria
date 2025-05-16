<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pagos')->insert([
            'tipoPago' => 'Efectivo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pagos')->insert([
            'tipoPago' => 'Tarjeta de crédito',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pagos')->insert([
            'tipoPago' => 'Transferencia bancaria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
