<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Models\House;
use App\Models\Service;
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

        $curPage = $request->input('page', 1);

        $authUserId = Auth::id();

        $houses = House::byCurUser()->paginate($perPage)->appends(['per_page' => $perPage]);

        return view('admin.houses.index', compact('houses', 'curPage', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $servicesCollection = Service::all();
        foreach ($servicesCollection as $service) {
            $service->slug = Str::slug($service->service_name);
        }
        // dd($servicesCollection);
        return view('admin.houses.create', compact('servicesCollection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseRequest $request)
    {
        $data = $request->validated();

        // dd($request);

        // aggiunta immagine nel database
        if ($request->hasFile('image')) {

            // Salvo il file nel storage e mi crea una nuova cartella in public chiamata house_images
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

        // Aggiunta relazione tra servizi estratti da request e casa nella tabella pvot
        if ($request->has('services')) {

            $house->services()->attach($request->services);
        }

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

        $curPage = request()->query('curPage', 1);
        $perPage = request()->query('perPage', 5);

        return view('admin.houses.show', compact('house','curPage', 'perPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        $house = House::with('services')->where('slug', $house->slug)->first();


        $servicesCollection = Service::all();

        foreach ($servicesCollection as $service) {
            $service->slug = Str::slug($service->service_name);
        }
        // dd($house);

        $curPage = request()->query('curPage', 1);
        $perPage = request()->query('perPage', 5);

        return view('admin.houses.edit', compact('house', 'servicesCollection', 'curPage', 'perPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseRequest $request, House $house)
    {

        $data = $request->validated();

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

        // Aggiunta relazione tra servizi estratti da request e casa nella tabella pvot
        if ($request->has('services')) {

            $house->services()->sync($request->services);
        }

        $curPage = request()->query('curPage', 1);
        $perPage = request()->query('perPage', 5);


        return redirect()->route('admin.house.index', ['curPage' => $curPage, 'perPage' => $perPage])->with('success', 'Informazioni casa modificati con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {

        if ($house->user_id !== Auth::id()) {

            abort(403);
        }

        // Se la casa ha l'immagine viene cancellata
        if ($house->cover_image) {

            Storage::delete($house->cover_image);
        }

        $house->delete();

        return redirect()->route('admin.house.index')->with('message', 'La casa ' . $house->title . ' è stato cancellata con successo.');
    }

}
