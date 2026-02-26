<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class ShopController extends Controller
{
    /**
     * Produkt dostępny w sklepie.
     */
    private array $product = [
        'id'          => 1,
        'name'        => 'Kurs Laravel + React',
        'description' => 'Kompletny kurs tworzenia nowoczesnych aplikacji webowych z Laravel i React.',
        'price'       => 29900, // grosze (299.00 PLN)
        'image'       => '/images/product-course.png',
    ];

    /**
     * Wyświetl stronę sklepu.
     */
    public function index(): Response
    {
        return Inertia::render('sklep/index', [
            'product' => $this->product,
        ]);
    }

    /**
     * Inicjuj płatność Przelewy24.
     */
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
            'email'    => 'required|email',
            'name'     => 'required|string|max:255',
        ]);

        $quantity  = (int) $validated['quantity'];
        $unitPrice = $this->product['price'];
        $amount    = $unitPrice * $quantity;

        $sessionId = uniqid('order_', true);
        $orderId   = strtoupper(substr($sessionId, 0, 16));

        $merchantId = (int) config('przelewy24.merchant_id');
        $posId      = (int) config('przelewy24.pos_id') ?: $merchantId;
        $apiKey     = config('przelewy24.api_key');
        $crcKey     = config('przelewy24.crc');
        $sandbox    = config('przelewy24.sandbox', true);

        $baseUrl = $sandbox
            ? 'https://sandbox.przelewy24.pl'
            : 'https://secure.przelewy24.pl';

        // Wygeneruj sign (SHA-384 hash)
        $signData = json_encode([
            'sessionId'  => $sessionId,
            'merchantId' => $merchantId,
            'amount'     => $amount,
            'currency'   => 'PLN',
            'crc'        => $crcKey,
        ]);
        $sign = hash('sha384', $signData);

        $payload = [
            'merchantId'  => $merchantId,
            'posId'       => $posId,
            'sessionId'   => $sessionId,
            'amount'      => $amount,
            'currency'    => 'PLN',
            'description' => $this->product['name'] . ' x' . $quantity,
            'email'       => $validated['email'],
            'client'      => $validated['name'],
            'country'     => 'PL',
            'language'    => 'pl',
            'urlReturn'   => route('shop.return', ['session' => $sessionId]),
            'urlStatus'   => route('shop.notify'),
            'sign'        => $sign,
            'encoding'    => 'UTF-8',
        ];

        try {
            $response = Http::withBasicAuth($posId, $apiKey)
                ->post("{$baseUrl}/api/v1/transaction/register", $payload);

            if ($response->successful() && isset($response->json()['data']['token'])) {
                $token       = $response->json()['data']['token'];
                $paymentUrl  = "{$baseUrl}/trnRequest/{$token}";

                return redirect()->away($paymentUrl);
            }

            Log::error('Przelewy24 registration failed', [
                'status'   => $response->status(),
                'body'     => $response->body(),
            ]);

            return back()->withErrors(['payment' => 'Błąd inicjalizacji płatności. Spróbuj ponownie.']);
        } catch (\Exception $e) {
            Log::error('Przelewy24 exception', ['message' => $e->getMessage()]);

            return back()->withErrors(['payment' => 'Błąd połączenia z serwisem płatności.']);
        }
    }

    /**
     * Powrót klienta po płatności.
     */
    public function paymentReturn(Request $request)
    {
        $sessionId = $request->query('session');

        return Inertia::render('sklep/return', [
            'success'   => true,
            'sessionId' => $sessionId,
        ]);
    }

    /**
     * Powiadomienie IPN od Przelewy24.
     */
    public function paymentNotify(Request $request)
    {
        // Tu obsłuż weryfikację i zapis statusu zamówienia
        Log::info('Przelewy24 IPN', $request->all());

        return response()->json(['status' => 'ok']);
    }
}
