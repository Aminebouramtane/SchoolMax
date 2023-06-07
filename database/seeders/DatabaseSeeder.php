<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClasseSeeder::class,
            GradeSeeder::class,
            SectionSeeder::class,
            AddParentSeeder::class,
            SpecialitSeeder::class,
            TeacherSeeder::class,
            // StudentSeeder::class,
        ]);
    }
}
