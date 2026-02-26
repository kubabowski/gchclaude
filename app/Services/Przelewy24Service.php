<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Przelewy24Service
{
    private string $merchantId;
    private string $posId;
    private string $crcKey;
    private string $apiKey;
    private string $baseUrl;
    private bool $sandbox;

    public function __construct()
    {
        $this->merchantId = config('przelewy24.merchant_id');
        $this->posId      = config('przelewy24.pos_id');
        $this->crcKey     = config('przelewy24.crc_key');
        $this->apiKey     = config('przelewy24.api_key');
        $this->sandbox    = config('przelewy24.sandbox', true);
        $this->baseUrl    = $this->sandbox
            ? 'https://sandbox.przelewy24.pl'
            : 'https://secure.przelewy24.pl';
    }

    /**
     * Rejestruje transakcję w Przelewy24 i zwraca token.
     */
    public function registerTransaction(array $data): array
    {
        $sign = $this->generateSign([
            'merchantId' => $this->merchantId,
            'posId'      => $this->posId,
            'sessionId'  => $data['sessionId'],
            'amount'     => $data['amount'],
            'currency'   => $data['currency'],
            'crc'        => $this->crcKey,
        ]);

        $payload = array_merge($data, [
            'merchantId' => (int) $this->merchantId,
            'posId'      => (int) $this->posId,
            'sign'       => $sign,
            'encoding'   => 'UTF-8',
        ]);

        $response = Http::withBasicAuth($this->posId, $this->apiKey)
            ->post("{$this->baseUrl}/api/v1/transaction/register", $payload);

        if ($response->failed()) {
            Log::error('P24 register failed', ['body' => $response->body()]);
            throw new \RuntimeException('Błąd rejestracji płatności: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Buduje URL do przekierowania do bramki płatności.
     */
    public function getPaymentUrl(string $token): string
    {
        return "{$this->baseUrl}/trnRequest/{$token}";
    }

    /**
     * Weryfikuje płatność po powrocie (notify).
     */
    public function verifyTransaction(array $data): bool
    {
        $sign = $this->generateSign([
            'merchantId' => $this->merchantId,
            'posId'      => $this->posId,
            'sessionId'  => $data['sessionId'],
            'amount'     => $data['amount'],
            'currency'   => $data['currency'],
            'orderId'    => $data['orderId'],
            'crc'        => $this->crcKey,
        ]);

        $payload = [
            'merchantId' => (int) $this->merchantId,
            'posId'      => (int) $this->posId,
            'sessionId'  => $data['sessionId'],
            'amount'     => (int) $data['amount'],
            'currency'   => $data['currency'],
            'orderId'    => (int) $data['orderId'],
            'sign'       => $sign,
        ];

        $response = Http::withBasicAuth($this->posId, $this->apiKey)
            ->put("{$this->baseUrl}/api/v1/transaction/verify", $payload);

        if ($response->failed()) {
            Log::error('P24 verify failed', ['body' => $response->body()]);
            return false;
        }

        $json = $response->json();
        return isset($json['data']['status']) && $json['data']['status'] === 'success';
    }

    /**
     * Generuje podpis SHA384.
     */
    private function generateSign(array $fields): string
    {
        return hash('sha384', json_encode($fields, JSON_UNESCAPED_UNICODE));
    }
}
