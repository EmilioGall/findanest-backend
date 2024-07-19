<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(){
        $houses = House::all();
        $data = [

            'result' => $houses,
            'success' => true
        ];
        return response()->json($data);
    }
}
