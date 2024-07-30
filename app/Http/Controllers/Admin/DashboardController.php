<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = Auth::id();

        $houses = House::where('user_id', $userId)->get();
        $totalHouses = $houses->count();

        // Query per ottenere il numero di sponsorizzazioni attive
        $activeSponsorships = House::where('user_id', $userId)
            ->whereHas('sponsorships', function ($query) {
                $query->where('house_sponsorship.expire_date', '>=', Carbon::now());
            })->count();

        // Query per ottenere il numero di messaggi ricevuti
        $totalMessages = Lead::whereHas('house', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        return view('admin.dashboard', compact('user', 'totalHouses', 'activeSponsorships', 'totalMessages',));
    }
}
