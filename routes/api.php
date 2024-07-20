<?php

use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/houses', [HouseController::class, 'index']);

Route::post('/leads', [LeadController::class, 'store']);

Route::get('/houses/{houses}', [HouseController::class, 'show']);       //parametro slug

Route::post('/leads', [LeadController::class, 'store']);
