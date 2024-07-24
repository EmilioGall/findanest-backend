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

        dd($request);

        $query = $request->input('query');

        $houses = House::where('title', 'like', "%$query%")->orWhere('address', 'like', "%$query%")->get();

        return response()->json($houses);
    }
}
