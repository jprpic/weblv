<?php

namespace Database\Seeders;

use Faker\Extension\Helper;
use Faker\Provider\Address;
use Faker\Provider\Lorem;
use Faker\Provider\Text;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'created_by' => '5',
                'name' => 'Vektorsko upravljanje sinkronih motora',
                'name_eng' => 'Vector control of synchronous motors',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Web stranica za ispitivanje mišljenja posjetitelja o vijestima',
                'name_eng' => 'Website to survey visitors\' opinions on the news',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Izrada aplikacije za pametni telefon kao mjerni instrument',
                'name_eng' => 'The development of smartphone applications as a measuring instrument',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Vjetroelektrane u Hrvatskoj',
                'name_eng' => 'Windpower in Croatia',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Internet aplikacija za vođenje statistike o treninzima',
                'name_eng' => 'Internet application for training statistics tracking',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Analiza mogućnosti primjene UPFC-FACTS uređaja',
                'name_eng' => 'Analysis of the possibility of applying FACTS devices',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'MVC server-side aplikacija za praćenje i administraciju nogometne lige',
                'name_eng' => 'MVC server-side application for football league tracking and administration',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Prekidači u elektroenergetskom postrojenju',
                'name_eng' => 'Circuit breakers in power system',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Projektiranje rasvjete u nuždi',
                'name_eng' => 'Design of emergency lighting',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Beskonfliktni raspored figura na šahovskoj ploči u programskom jeziku C++.',
                'name_eng' => 'Peaceful arrangement of chess figures in C++ programming language',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'created_by' => '5',
                'name' => 'Pametni sustav upravljanja ogrijjevnim sustavom temeljen na ESP IoT',
                'name_eng' => 'An ESP IoT smart heating control system',
                'description' => Lorem::text(1000),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
