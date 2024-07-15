<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = ["Ascensore", "Garage", "Posto auto", "Cantina", "Balcone", "Giardino", "Aria condizionata", "Cucina attrezzata", "Lavanderia", "Piscina", "Palestra", "Portineria", "Videocitofono", "Allarme", "Wi-Fi"];

        foreach ($services as $service) {

            $newService = new Service();

            $newService->service_name = $service;
            $newService->icon = 'fa-solid fa-wifi';

            $newService->save();

        }
    }
}
