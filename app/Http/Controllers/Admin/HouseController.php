<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $houses = House::all();
        return view('admin.houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.houses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($request);
        $house = new House();
        $house->fill($data);

        $house->slug = Str::slug($house->title);


        // TomTomService

        // Definisco la variabile address prelevandola dal request
        $address = $request->input('address');
        $encodedAddress = urlencode($address);

        // dd($encodedAddress);

        $apiKey = env('TOMTOM_API_KEY');

        $coordinates = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $encodedAddress . '.json', [
            'key' => $apiKey,
        ]);

        $data = $coordinates->json();

        // dd($data);

        if (isset($data['results'][0]['position'])) {
            $house->latitude = $data['results'][0]['position']['lat'];
            $house->longitude = $data['results'][0]['position']['lon'];
        }

        $authUserId = Auth::id();

        $house->user_id = $authUserId;

        $house->save();

        return redirect()->route('admin.house.index')->with('success', 'Home added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
