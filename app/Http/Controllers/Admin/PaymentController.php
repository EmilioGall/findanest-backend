<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Sponsorship;
use Carbon\Carbon;


class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        // Configure Braintree Gateway
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    // Show the payment form view with package information

    public function index(Request $request)
    {
        // Retrieve parameters sent from the purchase form

        $type = $request->input('type');
        $price = $request->input('price');
        $duration = $request->input('duration');
        $houseId = $request->input('house_id');
        $sponsorshipId = $request->input('sponsorship_id');

        // Pass data to the view

        return view('admin.payments.index', [
            'amount' => $price,
            'sponsorshipType' => $type,
            'duration' => $duration,
            'houseId' => $houseId,
            'sponsorshipId' => $sponsorshipId
        ]);
    }

    // Provide Braintree authentication token to the client

    public function getToken()
    {
        $token = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $token]);
    }

    // Handle the payment

    public function handlePayment(Request $request)
    {
        $nonceFromTheClient = $request->input('payment_method_nonce');
        $amount = $request->input('amount');
        $houseId = $request->input('house_id');
        $sponsorshipId = $request->input('sponsorship_id');
        $duration = $request->input('duration');

        // Check if nonce is present
        if (!$nonceFromTheClient) {
            return response()->json(['error' => 'Payment method nonce is missing'], 400);
        }

        try {
            $result = $this->gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonceFromTheClient,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            if ($result->success) {
                // Find the house and sponsorship
                $house = House::findOrFail($houseId);
                $sponsorship = Sponsorship::findOrFail($sponsorshipId);

                // Find the latest active sponsorship for the house
                $lastSponsorship = $house->sponsorships()
                    ->wherePivot('expire_date', '>', now())
                    ->orderBy('pivot_expire_date', 'desc')
                    ->first();

                // Calculate the expiry date
                $startDate = $lastSponsorship ? Carbon::parse($lastSponsorship->pivot->expire_date) : now();
                $expiryDate = $startDate->copy()->addHours($duration);

                // Add the sponsorship to the house with the expiry date
                $house->sponsorships()->attach($sponsorshipId, ['expire_date' => $expiryDate]);

                return response()->json(['success' => true]);
            } else {
                // Handle Braintree specific errors
                if ($result->transaction) {
                    $errorCode = $result->transaction->processorResponseCode;
                    if ($errorCode === '2000') {
                        $errorMessage = 'Dati della carta non validi.';
                    } else {
                        $errorMessage = $result->message;
                    }
                } else {
                    $errorMessage = 'Si è verificato un errore durante il pagamento.';
                }
                return response()->json(['error' => $errorMessage], 400);
            }
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json(['error' => 'Errore del server: ' . $e->getMessage()], 500);
        }
    }
}
