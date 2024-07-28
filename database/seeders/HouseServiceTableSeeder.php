<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\Service;

class HouseServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all house and service IDs
        $houseIds = House::pluck('id')->toArray();
        $serviceIds = Service::pluck('id')->toArray();

        // For each house, attach a random number of services
        foreach ($houseIds as $houseId) {
            // Get a random number of services to attach
            $numberOfServices = rand(0, count($serviceIds));

            // Initialize an empty array for random services
            $randomServices = [];

            if ($numberOfServices > 0) {
                // Randomly select services if numberOfServices is greater than 0
                $randomServices = array_rand(array_flip($serviceIds), $numberOfServices);
                // Ensure $randomServices is an array even if only one service is selected
                if ($numberOfServices == 1) {
                    $randomServices = [$randomServices];
                }
            }

            // Attach the services to the house
            $house = House::find($houseId);
            $house->services()->sync($randomServices);
        }
    }
}
