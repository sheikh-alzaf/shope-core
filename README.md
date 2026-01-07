# Shope Core Package

The Shope Core Package is a Laravel package that provides essential functionality for the Shope microservice. This package includes configuration, middleware, and helper utilities to streamline development.

## Installation

1. Install the package via Composer:
   ```bash
   composer require your-vendor/shope-core
   ```

2. Publish the configuration file:
   ```bash
   php artisan vendor:publish --provider="YourVendor\ShopeCore\ShopeCommonServiceProvider"
   ```

3. Add the required environment variables to your `.env` file:
   ```env
   SHOPE_API_KEY=your_api_key
   SHOPE_API_SECRET=your_api_secret
   ```

## Configuration

The package configuration file is located at `config/shopecore.php`. You can customize the following settings:

- `api_key`: The API key for authentication.
- `api_secret`: The API secret for authentication.

## Middleware

The package includes the `GatewayAuth` middleware, which can be used to authenticate requests. To use this middleware, add it to your route or controller:

```php
use YourVendor\ShopeCore\Middleware\GatewayAuth;

Route::middleware([GatewayAuth::class])->group(function () {
    // Define your routes here
});
```

## Helpers

The package provides helper utilities to simplify common tasks. Refer to the `Helpers` directory for available functions.

## License

This package is open-source and available under the [MIT license](LICENSE).