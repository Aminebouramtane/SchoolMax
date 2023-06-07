<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $fee = new Fee();
            $fee->fees_name_en = $faker->word;
            $fee->fees_name_ar = $faker->word;
            $fee->amount = $faker->randomFloat(2, 100, 1000);
            $fee->note = $faker->sentence;
            $fee->season = $faker->randomElement([$faker->year('-1 year'), null]);
            $fee->grade_id = rand(1, 5);
            $fee->classe_id = rand(1, 10);
            $fee->save();
        }
    }
}
