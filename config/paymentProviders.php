<?php

return [
    'environment' => env('GERENCIANET_ENVIRONMENT'),
    'gerencianet' => [
        'baseUri' => [
            'production' => 'https://api.gerencianet.com.br',
            'sandbox' => 'https://sandbox.gerencianet.com.br'
        ],
        'client_id' => [
            'production' => '?',
            'sandbox' => env('GERENCIANET_SANDBOX_CLIENT_ID')
        ],
        'client_secret' => [
            'production' => '?',
            'sandbox' => env('GERENCIANET_SANDBOX_CLIENT_SECRET')
        ],
    ]
];
