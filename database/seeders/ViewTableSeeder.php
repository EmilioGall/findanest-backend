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
        $totalViews = 700;
        $house4Views = intval($totalViews * 0.3); // 40% delle visualizzazioni totali
        $remainingViews = $totalViews - $house4Views;

        // Genera visualizzazioni per la casa con ID 12
        for ($i = 0; $i < $house4Views; $i++) {
            $newView = new View();
            $newView->ip_address = $faker->ipv4;
            $newView->view_date = $faker->dateTimeBetween('-3 months', '2024-07-31')->format('Y-m-d');
            $newView->house_id = 12;
            $newView->save();
        }

        // Genera le restanti visualizzazioni per le altre case
        for ($i = 0; $i < $remainingViews; $i++) {
            $newView = new View();
            $newView->ip_address = $faker->ipv4;
            $newView->view_date = $faker->dateTimeBetween('-3 months', '2024-07-31')->format('Y-m-d');
            // Escludi la casa con ID 4 per il resto delle visualizzazioni
            $newView->house_id = $faker->numberBetween(1, 14);
            if ($newView->house_id == 12) {
                $newView->house_id = 8; // Cambia ID se il numero generato è 12
            }
            $newView->save();
        }
    }
}
