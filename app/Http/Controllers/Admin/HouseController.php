<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseRequest;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = $request->per_page ? $request->per_page : 5;

        $authUserId = Auth::id();

        $houses = House::byCurUser()->paginate($perPage)->appends(['per_page' => $perPage]);

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
    public function store(StoreHouseRequest $request)
    {
        $data = $request->validated();

        // aggiunta immagine nel database
        if ($request->hasFile('image')) {

            // Salvo il file nel storage e mi crea una nuova cartella in public chiamata wine_images
            $image_path = Storage::put('house_images', $request->image);

            // salvo il path del file nei dati da inserire nel daabase
            $data['image'] = $image_path;
        }

        // dd($data);

        $house = new House();

        $house->fill($data);

        $house->slug = Str::slug($house->title);


        ///// TomTomService /////

        // Definisco la variabile address prelevandola dal request
        $address = $request->input('address');

        // Trasformo la variabile address in URL
        $encodedAddress = urlencode($address);

        // Definisco la variabile apiKey prelevandola dal file .env
        $apiKey = env('TOMTOM_API_KEY');

        // dd($encodedAddress);

        // Chiamo API TomTom inserendo come parametro inline address e la chiave come secondo parametro 
        $coordinates = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $encodedAddress . '.json', [
            'key' => $apiKey,
        ]);

        $data = $coordinates->json();

        // dd($data);

        // Se nei risultati della chiamata API ci sono informazioni sulla posizione vengono aggiunti alla tabella
        if (isset($data['results'][0]['position'])) {

            $house->latitude = $data['results'][0]['position']['lat'];
            $house->longitude = $data['results'][0]['position']['lon'];
        }

        $authUserId = Auth::id();

        $house->user_id = $authUserId;

        $house->save();

        return redirect()->route('admin.house.index')->with('success', 'Informazioni casa aggiunti con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {

        // dd($house);

        // Verify that user_id match with authorized id
        if ($house->user_id !== Auth::id()) {

            abort(403);
        }

        return view('admin.houses.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        // dd($project);

        return view('admin.houses.edit', compact('house'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {

        $data = $request->all();

        // aggiunta immagine nel database
        if ($request->hasFile('image')) {

            // Salvo il file nel storage e mi crea una nuova cartella in public chiamata wine_images
            $image_path = Storage::put('house_images', $request->image);

            // salvo il path del file nei dati da inserire nel daabase
            $data['image'] = $image_path;

        }

        $house->update($data);

        $house->slug = Str::slug($house->title);


        ///// TomTomService /////

        // Definisco la variabile address prelevandola dal request
        $address = $request->input('address');

        // Trasformo la variabile address in URL
        $encodedAddress = urlencode($address);

        // Definisco la variabile apiKey prelevandola dal file .env
        $apiKey = env('TOMTOM_API_KEY');

        // dd($encodedAddress);

        // Chiamo API TomTom inserendo come parametro inline address e la chiave come secondo parametro
        $coordinates = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . $encodedAddress . '.json', [
            'key' => $apiKey,
        ]);

        $data = $coordinates->json();

        // dd($data);

        // Se nei risultati della chiamata API ci sono informazioni sulla posizione vengono aggiunti alla tabella
        if (isset($data['results'][0]['position'])) {

            $house->latitude = $data['results'][0]['position']['lat'];
            $house->longitude = $data['results'][0]['position']['lon'];
        }

        $authUserId = Auth::id();

        $house->user_id = $authUserId;

        $house->save();

        return redirect()->route('admin.house.index')->with('success', 'Informazioni casa modificati con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $houses = House::where('title', 'like', "%$query%")
            ->orWhere('address', 'like', "%$query%")
            ->get();

        return view('admin.houses.index', compact('houses'));
    }
}
