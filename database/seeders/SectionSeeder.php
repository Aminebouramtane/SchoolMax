<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Classe;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = Classe::all();

        foreach ($classes as $class) {
            for ($i = 1; $i <= 5; $i++) {
                $active = rand(0, 1) ? true : false;
                Section::create([
                    'section_name_en' => 'Section ' . $i ,
                    'section_name_ar' => 'القسم ' . $i ,
                    'active' => $active,
                    'grade_id' => $class->grade_id,
                    'classe_id' => $class->id,
                ]);
            }
        }
    }
}
