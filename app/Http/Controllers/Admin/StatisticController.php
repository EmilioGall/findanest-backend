<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\View;
use App\Models\House;
use App\Models\Sponsorship;
use App\Models\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $startDate = $request->input('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));
        $houseId = $request->input('house_id');

        // Query per ottenere le visualizzazioni per casa nel periodo specificato
        $query = View::whereBetween('view_date', [$startDate, $endDate])
            ->selectRaw('house_id, COUNT(*) as views')
            ->groupBy('house_id');

        if ($houseId) {
            $query->where('house_id', $houseId);
        }

        $views = $query->get();
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

        // Otteniamo i nomi delle case
        $views = $views->map(function ($view) {
            $house = House::find($view->house_id);
            $view->house_name = $house ? $house->title : 'N/A';
            return $view;
        });

        // Query per ottenere le visualizzazioni nel tempo per la casa selezionata
        $timeViews = [];
        if ($houseId) {
            $timeViews = View::where('house_id', $houseId)
                ->whereBetween('view_date', [$startDate, $endDate])
                ->selectRaw('DATE(view_date) as date, COUNT(*) as views')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        }

        // Query per ottenere i tre appartamenti più visitati
        $topThreeHouses = View::whereBetween('view_date', [$startDate, $endDate])
            ->selectRaw('house_id, COUNT(*) as views')
            ->groupBy('house_id')
            ->orderBy('views', 'desc')
            ->take(3)
            ->get();

        $topThreeHouses = $topThreeHouses->map(function ($view) {
            $house = House::find($view->house_id);
            $view->house_name = $house ? $house->title : 'N/A';
            return $view;
        });

        return view('admin.statistics.index', compact('views', 'startDate', 'endDate', 'houseId', 'houses', 'totalHouses', 'activeSponsorships', 'totalMessages', 'topThreeHouses', 'timeViews'));
    }
}
