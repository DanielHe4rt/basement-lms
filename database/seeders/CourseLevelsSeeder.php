<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LMS\Courses\Models\Level;

class CourseLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            'Iniciante',
            'Intermediário',
            'Avançado',
            'Todos os Níveis'
        ];

        foreach ($levels as $level) {
            Level::create(['name' => $level]);
        }
    }
}
