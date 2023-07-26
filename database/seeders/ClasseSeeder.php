<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Classe;


class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = Grade::all();

        // Generate 10 random classes for each grade
        foreach ($grades as $grade) {
            for ($i = 1; $i <= 5; $i++) {
                Classe::create([
                    'classe_name_en' => 'Class ' . $i,
                    'classe_name_ar' => 'الصف ' . $i,
                    'grade_id' => $grade->id,
                ]);
            }
        }
    }
}
