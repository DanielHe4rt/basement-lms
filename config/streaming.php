<?php

return [
    'azure' => [
        'client_id' => env('AAD_CLIENTID'),
        'client_secret' => env('AAD_SECRET'),
        'tenant_id' => env('AAD_TENANTID'),
        'subscription_id' => env('AAD_SUBSCRIPTIONID'),
        'account_name' => env('AAD_ACCOUNTNAME'),
        'resource_group' => env('AAD_RESOURCEGROUP'),
        'endpoint' => env('AAD_ENDPOINT'),
        'tenant_oauth_url' => 'https://login.microsoftonline.com/' . env('AAD_TENANTID') . '/oauth2/token',
        'management_url' => 'https://management.azure.com/',
    ]
];
