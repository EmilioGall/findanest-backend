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
        $houses = House::with(['user', 'sponsorships', 'services'])->get();
        $data = [

            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }

    public function show(string $houses)
    {
        //eager loading
        $houses = House::with(['user', 'sponsorships', 'services'])->where('slug', $houses)->first();
        $data = [
            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }

    ////////// Custom Methods //////////

    public function search(Request $request)
    {
        $services = $request->input('services');

        $numberOfServicesSelected = count($services);

        // Inizializza la query per ottenere le case
        $housesQuery = House::with(['user', 'sponsorships', 'services']);

        // Query for services filter


        // Query for other filters
        if (!empty($otherFilters = [

            'rooms' => $request->input('rooms'),
            'bathrooms' => $request->input('bathrooms'),
            'beds' => $request->input('beds'),
            'sqm' => $request->input('sqm'),
            'price' => $request->input('price'),

        ])) {
            if (!empty($housesWithServices)) {

                $housesWithOtherFilters = House::with(['user', 'sponsorships', 'services'])
                    ->whereIn('id', $housesWithServices->pluck('id'))
                    ->when(array_filter($otherFilters), function ($query) use ($otherFilters) {

                        foreach ($otherFilters as $column => $filter) {

                            if (!empty($filter)) {
                                $query->where($column, '>=', $filter);
                            }
                        }
                    })
                    ->get();
            } else {
                $housesWithOtherFilters = House::with(['user', 'sponsorships', 'services'])
                    ->when(array_filter($otherFilters), function ($query) use ($otherFilters) {
                        foreach ($otherFilters as $column => $filter) {
                            if (!empty($filter)) {
                                $query->where($column, '>=', $filter);
                            }
                        }
                    })
                    ->get();
            }
        } else {

            if (!empty($housesWithServices)) {

                $housesWithOtherFilters = $housesWithServices;
            } else {

                $housesWithOtherFilters = House::with(['user', 'sponsorships', 'services'])->orderedBy('created_at')->get();
            }
        }

        return response()->json($housesWithOtherFilters);
    }
}
