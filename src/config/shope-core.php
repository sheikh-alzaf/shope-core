<?php

use Illuminate\Support\Str;

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

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'filesystems' => [
        'default' => env('FILESYSTEM_DISK', 'public'),
        'default_image_format' => env('DEFAULT_IMAGE_FORMAT', 'webp'),
    
        's3' => [
            'driver' => 's3',
            'key' => env('DO_SPACES_KEY'),
            'secret' => env('DO_SPACES_SECRET'),
            'region' => env('DO_SPACES_REGION'),
            'bucket' => env('DO_SPACES_BUCKET'),
            'endpoint' => env('DO_SPACES_ENDPOINT'),
            'url' => env('DO_SPACES_URL'),
            'use_path_style_endpoint' => true,
            'visibility' => 'public',
            // 'root' => 'pos',
            'root' => Str::slug(env('APP_NAME')),
        ],
    ],



];
