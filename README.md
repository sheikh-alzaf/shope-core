# Shope Core Package
![License](https://img.shields.io/badge/License-MIT-green.svg)

The Shope Core Package is a Laravel package that provides essential functionality for the Shope microservice. This package includes configuration, middleware, and helper utilities to streamline development.

## Installation

1. Add the Private Repository in Your Laravel Project:
   ```bash
   "repositories": [
      {
         "type": "vcs",
         "url": "https://github.com/sheikh-alzaf/shope-core"
      }
   ]

   ```
2. Install the package via Composer:
   ```bash
   composer require shope/core
   ```

3. Publish the configuration file:
   ```bash
   php artisan vendor:publish --tag=config

   ```

4. Add the required environment variables to your `.env` file:
   ```env
   SHOPE_API_KEY=your_api_key
   SHOPE_API_SECRET=your_api_secret
   ```

## Configuration

The package configuration file is located at `config/shope-core.php`. You can customize the following settings:

```bash
   return [
      'require_api_credentials' => true,
      'enable_ip_whitelist' => false,
      'secret_pepper'    => env("secret_pepper","nexzan"),
      'models' => [
         'api_key' => \App\Models\ApiKey::class,
      ],
   ];
```

## Middleware

The package includes the `GatewayAuth` middleware, which can be used to authenticate requests. To use this middleware, add it to your route or controller:

```php
use Shope\Core\Middleware\GatewayAuth;

Route::middleware([GatewayAuth::class])->group(function () {
    // Define your routes here
});
```

## Helpers

The package provides helper utilities to simplify common tasks. Refer to the `Helpers` directory for available functions.

## License

This package is open-source and available under the [MIT license](LICENSE).