<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => '3',
                'name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'name' => 'Nastavnik',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '1',
                'name' => 'Student',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
