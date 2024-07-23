<?php

namespace App\Http\Controllers\Admin;

use App\Models\House;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            $activeSponsorships = $selectedHouse->sponsorships;
        }

        return view('admin.sponsorships.index', compact('houses', 'selectedHouse', 'activeSponsorships'));
    }
}
