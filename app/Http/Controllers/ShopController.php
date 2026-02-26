<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Przelewy24Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    public function __construct(private Przelewy24Service $p24) {}

    // -----------------------------------------------------------------------
    // GET /sklep
    // -----------------------------------------------------------------------
    public function index()
    {
        $product = $this->getProduct();
        return view('sklep.index', compact('product'));
    }

    // -----------------------------------------------------------------------
    // POST /sklep/checkout
    // -----------------------------------------------------------------------
    public function checkout(Request $request)
    {
        $data = $request->validate([
            'quantity'       => 'required|integer|min:1|max:99',
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
        ]);

        $product    = $this->getProduct();
        $quantity   = (int) $data['quantity'];
        $unitPrice  = $product['price']; // w groszach
        $total      = $unitPrice * $quantity;
        $sessionId  = Str::uuid()->toString();

        $order = Order::create([
            'session_id'     => $sessionId,
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'product_name'   => $product['name'],
            'quantity'       => $quantity,
            'unit_price'     => $unitPrice,
            'total_amount'   => $total,
            'currency'       => 'PLN',
            'status'         => 'pending',
        ]);

        try {
            $result = $this->p24->registerTransaction([
                'sessionId'   => $sessionId,
                'amount'      => $total,
                'currency'    => 'PLN',
                'description' => "{$product['name']} x{$quantity}",
                'email'       => $data['customer_email'],
                'country'     => 'PL',
                'language'    => 'pl',
                'urlReturn'   => route('sklep.return', ['sessionId' => $sessionId]),
                'urlStatus'   => route('sklep.notify'),
            ]);

            $token = $result['data']['token'];
            $order->update(['p24_token' => $token]);

            return redirect($this->p24->getPaymentUrl($token));
        } catch (\Throwable $e) {
            Log::error('P24 checkout error', ['message' => $e->getMessage()]);
            return redirect()->route('sklep.index')
                ->with('error', 'Wystąpił błąd podczas inicjowania płatności. Spróbuj ponownie.');
        }
    }

    // -----------------------------------------------------------------------
    // GET /sklep/return  – powrót klienta po płatności
    // -----------------------------------------------------------------------
    public function return(Request $request)
    {
        $sessionId = $request->query('sessionId');
        $order     = Order::where('session_id', $sessionId)->firstOrFail();

        return view('sklep.return', compact('order'));
    }

    // -----------------------------------------------------------------------
    // POST /sklep/notify  – webhook Przelewy24
    // -----------------------------------------------------------------------
    public function notify(Request $request)
    {
        $data = $request->all();
        Log::info('P24 notify', $data);

        $order = Order::where('session_id', $data['sessionId'] ?? '')->first();

        if (!$order) {
            return response('Order not found', 404);
        }

        $verified = $this->p24->verifyTransaction([
            'sessionId' => $data['sessionId'],
            'amount'    => $data['amount'],
            'currency'  => $data['currency'],
            'orderId'   => $data['orderId'],
        ]);

        if ($verified) {
            $order->update([
                'status'       => 'paid',
                'p24_order_id' => $data['orderId'],
            ]);
        } else {
            $order->update(['status' => 'failed']);
        }

        return response('OK', 200);
    }

    // -----------------------------------------------------------------------
    // GET /sklep/success / /sklep/cancel
    // -----------------------------------------------------------------------
    public function success(Request $request)
    {
        $sessionId = $request->query('sessionId');
        $order     = Order::where('session_id', $sessionId)->firstOrFail();
        return view('sklep.success', compact('order'));
    }

    public function cancel()
    {
        return view('sklep.cancel');
    }

    // -----------------------------------------------------------------------
    // Dane produktu (w prawdziwej aplikacji z bazy/config)
    // -----------------------------------------------------------------------
    private function getProduct(): array
    {
        return [
            'name'        => 'Kurs Laravel Pro',
            'description' => 'Kompleksowy kurs Laravel od podstaw do zaawansowanych technik. Dożywotni dostęp, certyfikat ukończenia, 40+ godzin video.',
            'price'       => 19900, // 199,00 PLN w groszach
            'image'       => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600&q=80',
            'features'    => [
                '40+ godzin materiałów video',
                'Projekty praktyczne',
                'Certyfikat ukończenia',
                'Dożywotni dostęp',
                'Wsparcie społeczności',
            ],
        ];
    }
}
