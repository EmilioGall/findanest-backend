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

        $houses = House::where('title', 'like', "%$text%")
        ->orWhere('address', 'like', "%$text%")
        ->where('rooms', '>=', $rooms)
        ->where('bathrooms', '>=', $bathrooms)
        ->where('beds', '>=', $beds)
        ->where('sqm', '>=', $sqm)
        ->where('price', '>=', $price)
        ->get();

        return response()->json($houses);
    }
}
