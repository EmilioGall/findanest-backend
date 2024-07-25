<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function index(){

        
        $services = Service::all();

        $data = [

            'result' => $services,
            'success' => true
        ];

        return response()->json($data);
    }


}
