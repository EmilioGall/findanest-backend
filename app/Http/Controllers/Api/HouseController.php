<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;
use App\Models\View;

class HouseController extends Controller
{
    public function index()
    {
        // Eager loading
        $houses = House::with(['user', 'sponsorships'])->get();
        $data = [
            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }

    public function show(string $slug)
    {
        // Recupera la casa in base allo slug
        $houses = House::with(['user', 'sponsorships'])->where('slug', $slug)->first();

        if ($houses) {
            // Registra la visualizzazione
            $this->registerView($houses->id);

            // Ottieni il conteggio delle visualizzazioni giornaliere
            $dailyViewCount = $this->getDailyViewCount($houses->id);
        }

        $data = [
            'result' => $houses,
            'success' => true,
            'daily_views' => $dailyViewCount ?? 0 // Include il conteggio delle visualizzazioni giornaliere nella risposta
        ];
        return response()->json($data);
    }

    // Metodo per registrare una visualizzazione
    protected function registerView(int $houseId)
    {
        $ipAddress = request()->ip(); // Ottieni l'indirizzo IP dell'utente
        $today = date('Y-m-d'); // Data odierna

        // Registra una nuova visualizzazione
        View::create([
            'ip_address' => $ipAddress,
            'house_id' => $houseId,
            'view_date' => $today, // Assicurati che 'view_date' esista nella tua tabella
        ]);
    }

    // Metodo per ottenere il conteggio delle visualizzazioni giornaliere
    protected function getDailyViewCount(int $houseId)
    {
        $today = date('Y-m-d');
        return View::where('house_id', $houseId)
            ->where('view_date', $today)
            ->count();
    }

    ////////// Custom Methods //////////

    public function search(Request $request)
    {
        $text = $request->text;
        $rooms = $request->rooms;
        $bathrooms = $request->bathrooms;
        $beds = $request->beds;
        $sqm = $request->sqm;
        $distance = $request->distance;
        $price = $request->price;
        $services = $request->services; // The variable $services is an array of id numbers for services

        $houses = House::with(['user', 'services'])
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
            })
            ->where(function ($query) use ($request) {
                $query->where('title', 'like', "%{$request->text}%")
                    ->orWhere('address', 'like', "%{$request->text}%");
            })
            ->get();

        return response()->json($houses);
    }
}
