<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("campos")->insert([
            'nome' => "Sintético",
            'created_at' => '2024-09-28 22:00:00',
            'updated_at' => '2024-09-28 22:00:00'
        ]);
    }
}
