<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AddParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        // Generate 50 random parents
        for ($i = 1; $i <= 50; $i++) {
            DB::table('add_parents')->insert([
                'parent_name_en' => $faker->name,
                'parent_name_ar' => 'اسم الأبو/الأم بالعربية ' . $i,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'birthday' => $faker->date(),
                'phone' => $faker->phoneNumber,
                'adress_en' => $faker->address,
                'adress_ar' => 'عنوان الأبو/الأم بالعربية ' . $i,
                'cin' => "CD564543",
                'sexe' => $faker->boolean,
                'jobe_en' => $faker->jobTitle,
                'jobe_ar' => 'مهنة الأبو/الأم بالعربية ' . $i,
                'photo' => null,
            ]);
        }
    }
}
