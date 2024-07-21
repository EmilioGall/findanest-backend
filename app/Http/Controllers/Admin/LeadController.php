<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\House;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $houseId = $request->input('house_id');

        // get houses by user
        $houses = $user->houses;

        // Filter leads by the user's houses
        $query = Lead::whereHas('house', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        });

        // If a house is selected, also filter by that house
        if ($houseId) {
            $query->where('house_id', $houseId);
        }

        $leads = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.leads.index', compact('leads', 'houses', 'houseId'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $house = $lead->house;
        $houseId = $house;

        return view('admin.leads.show', compact('lead', 'house', 'houseId'));
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
