<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(){
        $houses = House::with(['user'])->get();
        $data = [

            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }
    public function show(string $houses) {
        $houses = House::with(['user'])->where('slug', $houses)->first();
        $data = [
            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }
}
