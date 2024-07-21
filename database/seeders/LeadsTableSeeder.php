<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');

        for ($i = 0; $i < 50; $i++) {
            $newLead = new Lead();
            $newLead->name = $faker->name;
            $newLead->email = $faker->unique()->safeEmail;
            $newLead->phone_number = $faker->optional()->regexify('(3|0)\d{9}');
            $newLead->message = $faker->text(200);
            $newLead->house_id = $faker->numberBetween(2, 10);;

            $newLead->save();
        }
    }
}
