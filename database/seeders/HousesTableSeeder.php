<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $housesArray = config('houses');
        // dd($housesArray);
        foreach ($housesArray as $house) {
            $newHouse = new House();
            $newHouse->title = $house['title'];
            $newHouse->price = $house['price'];
            $newHouse->address = $house['address'];
            $newHouse->description = $house['description'];
            $newHouse->rooms = $house['rooms'];
            $newHouse->beds = $house['beds'];
            $newHouse->bathrooms = $house['bathrooms'];
            $newHouse->sqm = $house['sqm'];
            $newHouse->latitude = $house['latitude'];
            $newHouse->longitude = $house['longitude'];
            $newHouse->image = 'https://placehold.co/300x150?text=Anteprima+non+disponibile';
            $newHouse->visible = $house['visible'];
            $newHouse->slug = $house['slug'];
            $newHouse->save();
        }
    }
}
