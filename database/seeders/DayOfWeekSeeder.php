<?php

namespace Database\Seeders;

use Gal\Models\DayOfWeek\DayOfWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayOfWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daysOfWeek = [
            ['name' => 'Domingo'],
            ['name' => 'Segunda-feira'],
            ['name' => 'Terça-feira'],
            ['name' => 'Quarta-feira'],
            ['name' => 'Quinta-feira'],
            ['name' => 'Sexta-feira'],
            ['name' => 'Sábado'],
        ];

        DayOfWeek::truncate(); // Limpa a tabela antes de inserir os novos registros

        foreach ($daysOfWeek as $day) {
            if (DayOfWeek::where('name', $day['name'])->first()) {
                return;
            }
            DayOfWeek::create($day);
        }
    }
}
