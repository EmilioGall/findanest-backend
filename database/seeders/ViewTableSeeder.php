<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\View;
use Faker\Factory as Faker;

class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            $newView = new View();
            $newView->ip_address = $faker->ipv4;
            $newView->view_date = $faker->dateTimeBetween('-2 months', '2024-07-31')->format('Y-m-d');
            $newView->house_id = $faker->numberBetween(1, 10);
            $newView->created_at = now();
            $newView->updated_at = now();
            $newView->save();
        }
    }
}
