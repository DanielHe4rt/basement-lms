<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LMS\Courses\Models\Status;

class CourseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Invisível',
            'Em Planejamento',
            'Gravando',
            'Finalizado'
        ];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
