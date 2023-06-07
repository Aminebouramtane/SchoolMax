<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all specialits
        $specialits = DB::table('specialits')->pluck('id');

        // Insert 10 teachers
        for ($i = 0; $i < 10; $i++) {
            DB::table('teachers')->insert([
                'teacher_name_en' => $faker->name(),
                'teacher_name_ar' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'birthday' => $faker->date(),
                'phone' => $faker->phoneNumber(),
                'adress_en' => $faker->address(),
                'adress_ar' => $faker->address(),
                'cin' => $faker->numberBetween(1000000000, 9999999999),
                'sexe' => $faker->boolean(),
                'specialit_id' => $specialits->random(),
                'photo' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
