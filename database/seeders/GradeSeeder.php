<?php

namespace Database\Seeders;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeNames = [
            'First Grade',
            'Second Grade',
            'Third Grade',
            'Fourth Grade',
            'Fifth Grade',
            'Sixth Grade',
            'Seventh Grade',
            'Eighth Grade',
            'Ninth Grade',
            'Tenth Grade',
        ];

        foreach ($gradeNames as $name) {
            Grade::create([
                'grade_name_en' => $name,
                'grade_name_ar' => 'الصف ' . $name,
                'grade_note' => 'This is a note for ' . $name,
            ]);
        }
    }
}
