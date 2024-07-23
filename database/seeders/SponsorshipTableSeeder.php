<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\Sponsorship;

class SponsorshipTableSeeder extends Seeder
{
    public function run()
    {
        // Array di possibili sponsorizzazioni
        $sponsorshipTypes = [
            ['type_name' => 'Essential', 'type_duration' => '12:00:00', 'price' => 2.99],
            ['type_name' => 'Regular', 'type_duration' => '72:00:00', 'price' => 5.99],
            ['type_name' => 'Premium', 'type_duration' => '144:00:00', 'price' => 9.99],
        ];

        // Creare le sponsorizzazioni
        foreach ($sponsorshipTypes as $type) {
            Sponsorship::create($type);
        }

        // Ottenere le case con ID da 1 a 10
        $houses = House::whereBetween('id', [1, 10])->get();

        // Assegna un numero casuale di sponsorizzazioni (da 0 a 2) a ciascuna casa
        foreach ($houses as $house) {
            // Determina il numero casuale di sponsorizzazioni (da 0 a 2)
            $numberOfSponsorships = rand(0, 2);

            // Ottieni sponsorizzazioni casuali
            $randomSponsorships = Sponsorship::inRandomOrder()->take($numberOfSponsorships)->get();

            // Collega sponsorizzazioni alla casa con una data di scadenza nel futuro
            foreach ($randomSponsorships as $sponsorship) {
                $house->sponsorships()->attach($sponsorship->id, [
                    'expire_date' => now()->addDays(rand(1, 15)),
                ]);
            }
        }
    }
}
