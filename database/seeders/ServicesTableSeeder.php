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
        $services = [
            [
                "name" => "Ascensore",
                "icon" => "fas fa-elevator"
            ],
            [
                "name" => "Garage",
                "icon" => "fas fa-square-parking"
            ],
            [
                "name" => "Posto auto",
                "icon" => "fas fa-warehouse"
            ],
            [
                "name" => "Cantina",
                "icon" => "fas fa-cube"
            ],
            [
                "name" => "Balcone",
                "icon" => "fas fa-window-maximize"
            ],
            [
                "name" => "Giardino",
                "icon" => "fas fa-tree"
            ],
            [
                "name" => "Aria condizionata",
                "icon" => "fas fa-snowflake"
            ],
            [
                "name" => "Cucina attrezzata",
                "icon" => "fas fa-utensils"
            ],
            [
                "name" => "Lavanderia",
                "icon" => "fas fa-jug-detergent"
            ],
            [
                "name" => "Piscina",
                "icon" => "fas fa-swimming-pool"
            ],
            [
                "name" => "Palestra",
                "icon" => "fas fa-dumbbell"
            ],
            [
                "name" => "Portineria",
                "icon" => "fas fa-door-open"
            ],
            [
                "name" => "Videocitofono",
                "icon" => "fas fa-video"
            ],
            [
                "name" => "Allarme",
                "icon" => "fas fa-bell"
            ],
            [
                "name" => "Wi-Fi",
                "icon" => "fas fa-wifi"
            ]
        ];

        foreach ($services as $service) {

            $newService = new Service();

            $newService->service_name = $service['name'];
            $newService->icon = $service['icon'];

            $newService->save();
        }
    }
}
