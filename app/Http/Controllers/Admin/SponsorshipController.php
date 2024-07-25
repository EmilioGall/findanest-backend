<?php

namespace App\Http\Controllers\Admin;

use App\Models\House;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SponsorshipController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $houses = House::where('user_id', $user->id)->get();
        $selectedHouse = null;
        $activeSponsorships = collect();

        if ($request->has('house_id') && $request->input('house_id') != '') {
            $selectedHouse = House::with('sponsorships')->find($request->input('house_id'));

            // Sort the sponsorships by expiry date
            $activeSponsorships = $selectedHouse->sponsorships()
                ->orderBy('pivot_expire_date', 'asc')
                ->get();
        }

        return view('admin.sponsorships.index', compact('houses', 'selectedHouse', 'activeSponsorships'));
    }

    public function purchase(Request $request)
    {
        $request->validate([
            'house_id' => 'required|exists:houses,id',
            'sponsorship_id' => 'required|exists:sponsorships,id',
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01'
        ]);

        $house = House::findOrFail($request->house_id);
        $sponsorship = Sponsorship::findOrFail($request->sponsorship_id);

        // Get the latest expiry date for this house and sponsorship
        $lastExpireDate = $house->sponsorships()
            ->where('sponsorship_id', $sponsorship->id)
            ->orderBy('pivot_expire_date', 'desc')
            ->first()
            ->pivot
            ->expire_date ?? Carbon::now();

        // Calculate the new expiry date
        $newExpireDate = Carbon::parse($lastExpireDate)->addHours($request->duration);

        // Add the new sponsorship
        $house->sponsorships()->attach($sponsorship->id, ['expire_date' => $newExpireDate]);

        return redirect()->route('admin.sponsorships.index')->with('success', 'Sponsorizzazione acquistata con successo!');
    }
}
