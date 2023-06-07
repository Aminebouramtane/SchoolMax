<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialits')->insert([
            [
                'specialit_name_en' => 'Computer Science',
                'specialit_name_ar' => 'علوم الحاسوب',
            ],
            [
                'specialit_name_en' => 'Mechanical Engineering',
                'specialit_name_ar' => 'الهندسة الميكانيكية',
            ],
            [
                'specialit_name_en' => 'Electrical Engineering',
                'specialit_name_ar' => 'الهندسة الكهربائية',
            ],
            [
                'specialit_name_en' => 'Civil Engineering',
                'specialit_name_ar' => 'الهندسة المدنية',
            ],
            [
                'specialit_name_en' => 'Chemical Engineering',
                'specialit_name_ar' => 'الهندسة الكيميائية',
            ],
        ]);
    }
}
