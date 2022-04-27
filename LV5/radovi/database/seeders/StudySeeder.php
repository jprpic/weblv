<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studies')->insert([
            [
                'id' => '3',
                'name' => 'Diplomski',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '2',
                'name' => 'Preddiplomski',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '1',
                'name' => 'Stručni',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
