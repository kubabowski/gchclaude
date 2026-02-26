<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Przelewy24 – konfiguracja
    |--------------------------------------------------------------------------
    | Ustaw wartości w pliku .env:
    |
    |   P24_MERCHANT_ID=12345
    |   P24_POS_ID=12345
    |   P24_CRC_KEY=twój_klucz_crc
    |   P24_API_KEY=twój_klucz_api
    |   P24_SANDBOX=true
    */

    'merchant_id' => env('P24_MERCHANT_ID', ''),
    'pos_id'      => env('P24_POS_ID', ''),
    'crc_key'     => env('P24_CRC_KEY', ''),
    'api_key'     => env('P24_API_KEY', ''),
    'sandbox'     => env('P24_SANDBOX', true),
];
