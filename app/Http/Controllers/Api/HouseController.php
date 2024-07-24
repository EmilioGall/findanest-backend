<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index()
    {
        //eager loading
        $houses = House::with(['user', 'sponsorships'])->get();
        $data = [

            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }

    public function show(string $houses)
    {
        //eager loading
        $houses = House::with(['user', 'sponsorships'])->where('slug', $houses)->first();
        $data = [
            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }

    ////////// Custom Methods //////////

    public function search(Request $request)
    {

        // dd($request);

        $text = $request->text;

        // dd($text, gettype($text));

        $rooms = $request->rooms;

        $bathrooms = $request->bathrooms;

        $beds = $request->beds;

        $sqm = $request->sqm;

        $distance = $request->distance;

        $price = $request->price;

        $services = $request->services;

        $houses = House::with(['user', 'services'])
        ->when($services, function ($query) use ($services) {
            $query->whereIn('services', $services);
        })
        ->when($rooms, function ($query) use ($rooms) {
            $query->where('rooms', '>=', $rooms);
        })
        ->when($bathrooms, function ($query) use ($bathrooms) {
            $query->where('bathrooms', '>=', $bathrooms);
        })
        ->when($beds, function ($query) use ($beds) {
            $query->where('beds', '>=', $beds);
        })
        ->when($sqm, function ($query) use ($sqm) {
            $query->where('sqm', '>=', $sqm);
        })
        ->when($price, function ($query) use ($price) {
            $query->where('price', '>=', $price);
        })->where(function ($query) use ($request) {
            $query->where('title', 'like', "%{$request->text}%")
                ->orWhere('address', 'like', "%{$request->text}%");
        })->get();

        return response()->json($houses);
    }
}
