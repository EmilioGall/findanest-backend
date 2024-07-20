<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request)
    {
        // dd($request->all()); // test dd in postman

        $data = $request->validated();

        // test
        if (!isset($data['house_id'])) {
            $data['house_id'] = 15;
        }

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new NewContact($newLead));

        return response()->json([
            'success' => true
        ]);
    }
}
