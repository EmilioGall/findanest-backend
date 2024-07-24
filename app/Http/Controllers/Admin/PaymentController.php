<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Sponsorship;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        // Configura Braintree Gateway
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    // Mostra la vista del modulo di pagamento con le informazioni del pacchetto
    public function index(Request $request)
    {
        // Recupera i parametri inviati dal modulo di acquisto
        $type = $request->input('type');
        $price = $request->input('price');
        $duration = $request->input('duration');
        $houseId = $request->input('house_id');
        $sponsorshipId = $request->input('sponsorship_id');

        // Passa i dati alla vista
        return view('admin.payments.index', [
            'amount' => $price,
            'sponsorshipType' => $type,
            'duration' => $duration,
            'houseId' => $houseId,
            'sponsorshipId' => $sponsorshipId
        ]);
    }

    // Fornisce il token di autenticazione di Braintree al client
    public function getToken()
    {
        $token = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $token]);
    }

    // Gestisce il pagamento
    public function handlePayment(Request $request)
    {
        $nonceFromTheClient = $request->input('payment_method_nonce');
        $amount = $request->input('amount');
        $houseId = $request->input('house_id');
        $sponsorshipId = $request->input('sponsorship_id');
        $duration = $request->input('duration');

        // Controlla se il nonce è presente
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
                // Trova la casa e la sponsorizzazione
                $house = House::findOrFail($houseId);
                $sponsorship = Sponsorship::findOrFail($sponsorshipId);

                // Calcola la data di scadenza
                $expiryDate = now()->addHours($duration);

                // Aggiungi la sponsorizzazione alla casa con la data di scadenza
                $house->sponsorships()->attach($sponsorshipId, ['expire_date' => $expiryDate]);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => $result->message], 400);
            }
        } catch (\Exception $e) {
            // Gestisci eccezioni
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
