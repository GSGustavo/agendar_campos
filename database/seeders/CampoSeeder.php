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
            'maps_link' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.31974579718064!2d-58.09740602415415!3d-15.679166956024652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a17007aad73ad%3A0x6bc6f07c89fbd09a!2sCampo%20de%20Grama%20Sint%C3%A9tica!5e1!3m2!1sen!2sbr!4v1729992960908!5m2!1sen!2sbr",
            'created_at' => '2024-09-28 22:00:00',
            'updated_at' => '2024-09-28 22:00:00'
        ]);
        DB::table("campos")->insert([
            'nome' => "Grande",
            'maps_link' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d957.9108276127985!2d-58.09612860935985!3d-15.678842202838366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x939a170e44b9cb9b%3A0x7f3b81b334d0e913!2sCampo%20de%20futebol!5e1!3m2!1sen!2sbr!4v1731630271560!5m2!1sen!2sbr",
            'created_at' => '2024-09-28 22:00:00',
            'updated_at' => '2024-09-28 22:00:00'
        ]);
    }
}