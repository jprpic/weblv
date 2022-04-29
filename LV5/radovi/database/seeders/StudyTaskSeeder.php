<?php

namespace Database\Seeders;

use App\Models\Study;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $undergraduate_task_ids = ['1', '2', '3', '4', '8', '9', '10', '11'];
        $graduate_task_ids = ['5', '6', '7'];

        // Svaki završni rad je za preddiplomski i stručni studij
        foreach($undergraduate_task_ids as $id){
            DB::table('study_task')->insert([
                [
                    'study_id' => Study::STRUCNI,
                    'task_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'study_id' => Study::PREDDIPLOMSKI,
                    'task_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

        // Svaki diplomski rad je za diplomski studij
        foreach($graduate_task_ids as $id){
            DB::table('study_task')->insert([
                [
                    'study_id' => Study::DIPLOMSKI,
                    'task_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

    }
}
