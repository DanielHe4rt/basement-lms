<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin', 'instructor', 'subscriber'
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

    }
}
