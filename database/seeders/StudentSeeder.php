<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Student::create([
                'student_name_ar' => $faker->name('ar'),
                'student_name_en' => $faker->name('en'),
                'email' => $faker->unique()->safeEmail,
                'password' => '12345678',
                'birthday' => $faker->date('Y-m-d', '2005-01-01'),
                'phone' => $faker->phoneNumber,
                'adress_en' => $faker->address,
                'adress_ar' => $faker->address('ar'),
                'cin' => 'CD346476',
                'sexe' => $faker->randomElement([0, 1]),
                'grade_id' => 1,
                'classe_id' => 1,
                'section_id' => $faker->numberBetween(1, 3),
                'parent_id' => $faker->numberBetween(1, 5),
                'season' => $faker->randomElement(['2022-2023', '2023-2024']),
            ]);
        }
    }
}
