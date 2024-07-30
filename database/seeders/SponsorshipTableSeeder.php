<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\Sponsorship;
use Carbon\Carbon;

class SponsorshipTableSeeder extends Seeder
{
    public function run()
    {
        // Array di possibili sponsorizzazioni
        $sponsorshipTypes = [
            ['type_name' => 'Essential', 'type_duration' => '24:00:00', 'price' => 2.99],
            ['type_name' => 'Regular', 'type_duration' => '72:00:00', 'price' => 5.99],
            ['type_name' => 'Premium', 'type_duration' => '144:00:00', 'price' => 9.99],
        ];

        // Crea le sponsorizzazioni
        foreach ($sponsorshipTypes as $type) {
            Sponsorship::updateOrCreate(
                ['type_name' => $type['type_name']], // Identifica il record esistente
                $type // Aggiorna o crea il record
            );
        }

        // Ottenere le case con ID da 1 a 10
        $houses = House::whereBetween('id', [1, 5])->get();

        // Assegna una sponsorizzazione a ciascuna casa
        foreach ($houses as $house) {
            // Ottieni tutte le sponsorizzazioni disponibili
            $sponsorships = Sponsorship::all();

            // Seleziona una sponsorizzazione casuale
            $randomSponsorship = $sponsorships->random();

            // Estrai le ore dalla stringa 'type_duration'
            $duration = $randomSponsorship->type_duration;
            $hours = (int) explode(':', $duration)[0]; // Estrai solo le ore

            // Calcola la data di scadenza aggiungendo le ore alla data corrente
            $expiryDate = Carbon::now()->addHours($hours);

            // Collega la sponsorizzazione alla casa con la data di scadenza calcolata
            $house->sponsorships()->attach($randomSponsorship->id, [
                'expire_date' => $expiryDate,
            ]);
        }
    }
}
