<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            'is_admin' => 1,
            'name' => "Gustavo",
            'lastname' => "Gonzaga da Silva",
            'email' => "gustavogonzagasilva@outlook.com",
            'password' => '$2y$10$xLQEdvkb53Dyb9BN7RkRD.lak4h.hh2wpjQ5Ffz94cukOhWVJC26a',
            'created_at' => '2024-09-28 22:00:00',
            'updated_at' => '2024-09-28 22:00:00'
        ]);
    }
}
