<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key & Secret Enforcement
    |--------------------------------------------------------------------------
    |
    | If enabled, all incoming requests must include valid
    | X-API-KEY and X-API-SECRET headers for verification.
    |
    */
    'require_api_credentials' => env("REQUIRE_API_CREDENTIALS", true),

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist Enforcement
    |--------------------------------------------------------------------------
    |
    | If enabled, incoming requests will only be accepted from
    | predefined IP addresses listed in the IP whitelist.
    |
    */
    'enable_ip_whitelist' => env("ENABLE_IP_WHITELIST", false),

    "secret_pepper" => env("SECRET_PEPPER", "shope"),

    // Allow user to customize ApiKey model namespace
    'models' => [
        'api_key' => \App\Models\ApiKey::class,
    ],


    'api_key' => env('SHOPE_API_KEY', 'default_key'),
    'api_secret' => env('SHOPE_API_SECRET', 'default_secret'),
];
