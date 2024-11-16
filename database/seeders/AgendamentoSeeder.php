<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgendamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("agendamentos")->insert([
            'start_on' => "2024-09-28",
            'end_on' => '22:00:00',
            'end_time' => '22:00:00',

            'user_id' => 1,
            'campo_id' => 1,
            'created_at' => '2024-09-28 22:00:00',
            'updated_at' => '2024-09-28 22:00:00'
        ]);
    }
}
