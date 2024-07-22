<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House; // Assicurati di importare il modello House

class SponsorshipController extends Controller
{
    public function index(Request $request)
    {
        // Ottieni l'utente autenticato
        $user = auth()->user();

        // Recupera tutte le case associate a quell'utente
        $houses = House::where('user_id', $user->id)->get();

        // Filtra la casa se è stato selezionato un house_id
        $selectedHouse = null;
        if ($request->has('house_id') && $request->input('house_id') != '') {
            $selectedHouse = House::find($request->input('house_id'));
        }

        // Passa le case e la casa selezionata alla vista
        return view('admin.sponsorships.index', compact('houses', 'selectedHouse'));
    }
}
